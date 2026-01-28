<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    private function getApiConfig()
    {
        return [
            'url' => config('services.rajaongkir.base_url'),
            'key' => config('services.rajaongkir.key'),
        ];
    }

    public function index()
    {
        $guestId = Cookie::get('bruwun_guest_id');

        if ($guestId) {
            // Update semua cart milik guest menjadi milik user yang sedang login
            Cart::where('guest_id', $guestId)->update([
                'guest_id' => null,
                'user_id' => Auth::id()
            ]);

            // Hapus cookie guest agar tidak dobel merge di masa depan
            Cookie::queue(Cookie::forget('bruwun_guest_id'));
        }

        // 1. Ambil Keranjang User
        $carts = Cart::with(['variant.product'])
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        // 2. Hitung Total Berat & Harga (Estimasi)
        $totalWeight = 0;
        $subtotal = 0;
        foreach ($carts as $cart) {
            $totalWeight += $cart->variant->product->weight * $cart->quantity;
            $subtotal += $cart->variant->price * $cart->quantity;
        }

        // 3. Ambil Metode Pembayaran (Bank Transfer / E-wallet)
        $paymentMethods = PaymentMethod::where('is_active', true)->get();

        $provinces = [];
        try {
            $api = $this->getApiConfig();
            // Endpoint Komerce: /destination/province
            $response = Http::withoutVerifying()
                ->withHeaders(['key' => $api['key']])
                ->get($api['url'] . '/destination/province');

            // Struktur Komerce: $json['data']
            if ($response->successful()) {
                $provinces = $response->json()['data'] ?? [];
            }
        } catch (\Exception $e) {
            $provinces = [];
        }

        return view('checkout.checkout-page', compact('carts', 'subtotal', 'totalWeight', 'paymentMethods', 'provinces'));
    }

    public function getCities($provinceId)
    {
        try {
            $api = $this->getApiConfig();
            // URL Baru: /destination/city/{province_id}
            $response = Http::withoutVerifying()
                ->withHeaders(['key' => $api['key']])
                ->get($api['url'] . '/destination/city/' . $provinceId);

            $data = $response->json()['data'] ?? [];
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getSubdistricts($cityId)
    {
        try {
            $api = $this->getApiConfig();
            // URL Baru: /destination/sub-district/{city_id}
            // Note: Komerce menamakan parameter district_id, tapi di flow kita itu city_id
            $response = Http::withoutVerifying()
                ->withHeaders(['key' => $api['key']])
                ->get($api['url'] . '/destination/sub-district/' . $cityId);

            $data = $response->json()['data'] ?? [];
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    public function checkOngkir(Request $request)
    {
        if (!$request->subdistrict_id) {
            return response()->json([]);
        }

        try {
            $api = $this->getApiConfig();

            // URL Spesifik Komerce untuk Hitung Ongkir Kecamatan
            $url = 'https://rajaongkir.komerce.id/api/v1/calculate/district/domestic-cost';

            // Menggunakan asForm() untuk application/x-www-form-urlencoded
            $response = Http::withoutVerifying()
                ->asForm()
                ->withHeaders([
                    'key' => $api['key']
                ])
                ->post($url, [
                    // Origin diambil dari .env (ID KECAMATAN TOKO)
                    'origin'      => config('services.rajaongkir.origin_city'),

                    // Destination diambil dari input user (ID KECAMATAN TUJUAN)
                    'destination' => $request->subdistrict_id,

                    'weight'      => $request->weight,
                    'courier'     => $request->courier, // jne, sicepat, idexpress
                    'payment_method' => 'NON_COD' // Tambahkan ini agar hasil lebih akurat
                ]);

            $result = $response->json();

            // Debugging: Cek jika ada error dari API
            if (isset($result['meta']['code']) && $result['meta']['code'] != 200) {
                return response()->json(['error' => $result['meta']['message'] ?? 'API Error'], 500);
            }

            $data = $result['data'] ?? [];
            $costs = [];

            foreach ($data as $service) {
                // Filter: Hanya ambil layanan yang ada harganya
                $costValue = $service['cost'] ?? $service['price'] ?? 0;

                if ($costValue > 0) {
                    $costs[] = [
                        'service' => $service['service'] ?? $service['service_code'] ?? 'Layanan',
                        'description' => $service['description'] ?? $service['service_name'] ?? '',
                        'cost' => [
                            [
                                'value' => $costValue,
                                'etd'   => $service['etd'] ?? '-'
                            ]
                        ]
                    ];
                }
            }

            return response()->json([
                [
                    'code' => $request->courier,
                    'name' => strtoupper($request->courier),
                    'costs' => $costs
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'address' => 'required|string',
            'province_name' => 'required',
            'city_name' => 'required',
            'subdistrict_name' => 'required',
            'postal_code' => 'required|numeric',
            'phone' => 'required|numeric',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'shipping_service' => 'required|string',
            'shipping_cost' => 'required|numeric',
        ]);

        // 2. Cek Stok Ulang (Mencegah Race Condition)
        $carts = Cart::with('variant')->where('user_id', Auth::id())->get();

        foreach ($carts as $cart) {
            if ($cart->variant->stock < $cart->quantity) {
                return back()->with('error', 'Stok produk ' . $cart->variant->product->product_name . ' (' . $cart->variant->size . ') tidak mencukupi.');
            }
        }

        DB::beginTransaction();

        try {
            // 4. Hitung Total
            $subTotal = 0;
            foreach ($carts as $cart) {
                $subTotal += $cart->variant->price * $cart->quantity;
            }

            $provinceName = $request->province_name;
            $cityName = $request->city_name;

            $fullAddress = "{$request->address}, {$cityName}, {$provinceName}, {$request->postal_code}. (Telp: {$request->phone}) - Pengiriman: {$request->shipping_service}";

            $grandTotal = $subTotal + $request->shipping_cost;

            // 6. Simpan Order
            $order = Order::create([
                'user_id' => Auth::id(),
                'invoice_code' => 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(5)),
                'total_pice' => $subTotal,
                'shipping_cost' => $request->shipping_cost, // Default 0, admin yang input nanti
                'grand_total' => $grandTotal, // Nanti admin update + ongkir
                'status' => 'menunggu_pembayaran',
                'shipping_address' => $fullAddress,
                'proof_of_payment' => null,
                'note' => $request->note
            ]);

            // 7. Simpan Order Items & Kurangi Stok
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $cart->product_variant_id,
                    'product_name' => $cart->variant->product->product_name,
                    'product_size' => $cart->variant->size,
                    'quantity' => $cart->quantity,
                    'price' => $cart->variant->price,
                ]);

                // Kurangi Stok
                $cart->variant->decrement('stock', $cart->quantity);
            }

            // 8. Kosongkan Keranjang
            Cart::where('user_id', Auth::id())->delete();

            // 9. Update Data Alamat User (Agar next time auto-fill)
            $user = Auth::user();
            $user->update([
                'address' => $request->address,
                'province' => $request->province,
                'city' => $request->city,
                'subdistrict' => $request->subdistrict,
                'postal_code' => $request->postal_code,
                'phone' => $request->phone
            ]);

            DB::commit();

            return redirect()->route('checkout.payment', ['id' => $order->id, 'bank' => $request->payment_method_id]);
        } catch (\Exception $e) {
            DB::rollBack();
            // Hapus gambar jika gagal
            if (isset($proofPath)) Storage::disk('public')->delete($proofPath);
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function payment(Request $request, $id)
    {
        $order = Order::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

        // Jika status bukan menunggu pembayaran, lempar ke history
        if ($order->status != 'menunggu_pembayaran') {
            return redirect()->route('orders.history');
        }

        // Ambil Bank yang dipilih user (dari parameter URL atau default ambil semua aktif)
        $bankId = $request->query('bank');
        $bank = PaymentMethod::find($bankId);

        // Jika parameter bank hilang, ambil bank pertama atau tampilkan list lagi (opsional)
        if (!$bank) {
            $bank = PaymentMethod::where('is_active', true)->first();
        }

        return view('checkout.payment', compact('order', 'bank'));
    }

    public function updatePayment(Request $request, $id)
    {
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $order = Order::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

        if ($request->hasFile('proof_of_payment')) {
            $path = $request->file('proof_of_payment')->store('payments', 'public');

            $order->update([
                'proof_of_payment' => $path,
                'status' => 'menunggu_konfirmasi' // Update status jadi menunggu konfirmasi admin
            ]);

            return redirect()->route('checkout.success', $order->id);
        }

        return back()->with('error', 'Upload gagal.');
    }

    public function success($id)
    {
        $order = Order::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        return view('checkout.success', compact('order'));
    }
}
