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
            Cart::where('guest_id', $guestId)->update([
                'guest_id' => null,
                'user_id' => Auth::id()
            ]);

            Cookie::queue(Cookie::forget('bruwun_guest_id'));
        }

        $carts = Cart::with(['variant.product'])
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $totalWeight = 0;
        $subtotal = 0;
        foreach ($carts as $cart) {
            $totalWeight += $cart->variant->product->weight * $cart->quantity;
            $subtotal += $cart->variant->price * $cart->quantity;
        }

        $paymentMethods = PaymentMethod::where('is_active', true)->get();

        $provinces = [];
        try {
            $api = $this->getApiConfig();
            $response = Http::withoutVerifying()->withHeaders(['key' => $api['key']])
                ->get($api['url'] . '/destination/province');

            if ($response->successful()) {
                $json = $response->json();
                $provinces = $json['data'] ?? $json['rajaongkir']['results'] ?? [];
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
            $url = $api['url'] . '/destination/city/' . $provinceId;

            if (strpos($api['url'], 'api.rajaongkir.com') !== false) {
                $response = Http::withoutVerifying()->withHeaders(['key' => $api['key']])->get($api['url'] . '/city', ['province' => $provinceId]);
            } else {
                $response = Http::withoutVerifying()->withHeaders(['key' => $api['key']])->get($url);
            }

            $json = $response->json();
            $data = $json['data'] ?? $json['rajaongkir']['results'] ?? [];

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // public function getSubdistricts($cityId)
    // {
    //     try {
    //         $api = $this->getApiConfig();

    //         $response = Http::withoutVerifying()
    //             ->withHeaders(['key' => $api['key']])
    //             ->get($api['url'] . '/destination/sub-district/' . $cityId);

    //         $data = $response->json()['data'] ?? [];
    //         return response()->json($data);
    //     } catch (\Exception $e) {
    //         return response()->json([], 500);
    //     }
    // }

    public function checkOngkir(Request $request)
    {
        if (!$request->city_id) {
            return response()->json([]);
        }

        try {
            $api = $this->getApiConfig();

            $url = $api['url'] . '/calculate/domestic-cost'; // Komerce
            if (strpos($api['url'], 'api.rajaongkir.com') !== false) {
                $url = $api['url'] . '/cost'; // RajaOngkir Asli
            }

            $response = Http::withoutVerifying()
                ->asForm()
                ->withHeaders(['key' => $api['key']])
                ->post($url, [
                    'origin'      => config('services.rajaongkir.origin_city'), // ID KOTA ASAL (42)
                    'destination' => $request->city_id, // ID KOTA TUJUAN
                    'weight'      => $request->weight,
                    'courier'     => $request->courier
                ]);

            $result = $response->json();

            // Mapping Data Cost (Komerce/RajaOngkir)
            $costs = [];

            // 1. Cek Format RajaOngkir Starter
            if (isset($result['rajaongkir']['results'][0]['costs'])) {
                $rawCosts = $result['rajaongkir']['results'][0]['costs'];
                foreach ($rawCosts as $c) {
                    $costs[] = [
                        'service' => $c['service'],
                        'description' => $c['description'],
                        'cost' => $c['cost'] // Array value, etd, note
                    ];
                }
            }
            // 2. Cek Format Komerce (Data langsung array services)
            elseif (isset($result['data'])) {
                foreach ($result['data'] as $service) {
                    $costs[] = [
                        'service' => $service['service_code'] ?? $service['service_name'] ?? 'REG',
                        'description' => $service['description'] ?? $service['service'] ?? '',
                        'cost' => [
                            [
                                'value' => $service['price'] ?? $service['cost'] ?? 0,
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
        $request->validate([
            'address' => 'required|string',
            'province_name' => 'required',
            'city_name' => 'required',
            'subdistrict' => 'required|string',
            'postal_code' => 'required|string|max:10',
            'phone' => 'required|numeric',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'shipping_service' => 'required|string',
            'shipping_cost' => 'required|numeric',
        ]);

        // $carts = Cart::with('variant')->where('user_id', Auth::id())->get();
        $carts = Cart::with('variant.product')->where('user_id', Auth::id())->get();

        if ($carts->isEmpty()) return redirect()->route('cart.index');


        DB::beginTransaction();

        try {
            foreach ($carts as $cart) {
                $variant = $cart->variant()->lockForUpdate()->first();
                if ($variant->stock < $cart->quantity) {
                    return back()->with('error', 'Stok produk ' . $variant->product->product_name . ' (' . $variant->size . ') tidak mencukupi.');
                }
            }

            $subTotal = 0;
            foreach ($carts as $cart) {
                $subTotal += $cart->variant->price * $cart->quantity;
            }

            $fullAddress = "{$request->address}, Kec. {$request->subdistrict}, {$request->city_name}, {$request->province_name}, {$request->postal_code}. (Telp: {$request->phone}) - Pengiriman: {$request->shipping_service}";

            if (!str_contains($request->shipping_service, strtoupper($request->courier ?? ''))) {
                throw new \Exception('Data pengiriman tidak valid');
            }

            $grandTotal = $subTotal + $request->shipping_cost;

            $order = Order::create([
                'user_id' => Auth::id(),
                'invoice_code' => 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(5)),
                'total_pice' => $subTotal,
                'shipping_cost' => $request->shipping_cost,
                'grand_total' => $grandTotal,
                'status' => 'menunggu_pembayaran',
                'shipping_address' => $fullAddress,
                'proof_of_payment' => null,
                'note' => $request->note,
                'payment_method_id' => $request->payment_method_id,
            ]);

            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $cart->product_variant_id,
                    'product_name' => $cart->variant->product->product_name,
                    'product_size' => $cart->variant->size,
                    'quantity' => $cart->quantity,
                    'price' => $cart->variant->price,
                ]);

                $cart->variant->decrement('stock', $cart->quantity);
            }

            Cart::where('user_id', Auth::id())->delete();

            // 9. Update Data Alamat User (Agar next time auto-fill)
            $user = Auth::user();
            $user->update([
                'address' => $request->address,
                'province' => $request->province_name,
                'city' => $request->city_name,
                'subdistrict' => $request->subdistrict,
                'postal_code' => $request->postal_code,
                'phone' => $request->phone
            ]);

            DB::commit();

            return redirect()->route('checkout.payment', ['id' => $order->id, 'bank' => $request->payment_method_id]);
        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($proofPath)) Storage::disk('public')->delete($proofPath);
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function payment(Request $request, $id)
    {
        $order = Order::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

        if ($order->status != 'menunggu_pembayaran') {
            return redirect()->route('orders.history');
        }

        $bankId = $request->query('bank');
        $bank = PaymentMethod::find($bankId);

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
                'status' => 'menunggu_konfirmasi'
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
