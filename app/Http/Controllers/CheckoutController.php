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
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
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

        return view('checkout.checkout-page', compact('carts', 'subtotal', 'totalWeight', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'address' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'subdistrict' => 'required|string',
            'postal_code' => 'required|numeric',
            'phone' => 'required|numeric',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg|max:2048',
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
            // 3. Upload Bukti Bayar
            $proofPath = $request->file('proof_of_payment')->store('payments', 'public');

            // 4. Hitung Total
            $totalPrice = 0;
            foreach ($carts as $cart) {
                $totalPrice += $cart->variant->price * $cart->quantity;
            }

            // 5. Buat String Alamat Lengkap (Snapshot)
            $fullAddress = "{$request->address}, Kec. {$request->subdistrict}, {$request->city}, {$request->province}, {$request->postal_code}. (Telp: {$request->phone})";

            // 6. Simpan Order
            $order = Order::create([
                'user_id' => Auth::id(),
                'invoice_code' => 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(5)),
                'total_pice' => $totalPrice,
                'shipping_cost' => 0, // Default 0, admin yang input nanti
                'grand_total' => $totalPrice, // Nanti admin update + ongkir
                'status' => 'menunggu_konfirmasi',
                'shipping_address' => $fullAddress,
                'proof_of_payment' => $proofPath,
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

            return redirect()->route('checkout.success', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            // Hapus gambar jika gagal
            if (isset($proofPath)) Storage::disk('public')->delete($proofPath);
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function success($id)
    {
        $order = Order::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        return view('checkout.success', compact('order'));
    }
}
