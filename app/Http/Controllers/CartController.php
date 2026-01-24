<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index()
    {
        $identity = $this->getCartIdentity();

        $carts = Cart::with(['variant.product'])
            ->where($identity['key'], $identity['value'])
            ->get();

        return view('cart.cartsPage', compact('carts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $variant = ProductVariant::find($request->product_variant_id);

        if ($variant->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $identity = $this->getCartIdentity();

        // Cek apakah item sudah ada
        $existingCart = Cart::where($identity['key'], $identity['value'])
            ->where('product_variant_id', $request->product_variant_id)
            ->first();

        if ($existingCart) {
            $existingCart->update([
                'quantity' => $existingCart->quantity + $request->quantity
            ]);
        } else {
            // Siapkan data simpan
            $data = [
                'product_variant_id' => $request->product_variant_id,
                'quantity' => $request->quantity,
            ];

            // Masukkan ID yang sesuai (User atau Guest)
            $data[$identity['key']] = $identity['value'];

            Cart::create($data);
        }

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function destroy($id)
    {
        $identity = $this->getCartIdentity();

        $cart = Cart::where($identity['key'], $identity['value'])
            ->where('id', $id)
            ->firstOrFail();

        $cart->delete();

        return back()->with('success', 'Item dihapus dari keranjang.');
    }

    /**
     * Halaman Checkout (Wajib Login)
     */
    public function checkout()
    {
        // 1. Jika belum login, lempar ke login dengan pesan
        if (!Auth::check()) {
            // Simpan url checkout agar setelah login balik lagi kesini (Laravel feature 'intended')
            return redirect()->route('login')
                ->with('error', 'Silakan login atau daftar terlebih dahulu untuk menyelesaikan pesanan.');
        }

        // 2. Logic Merge Cart (PENTING)
        // Jika user punya cart "guest" sebelum login, pindahkan ke "user_id" dia sekarang
        $guestId = Cookie::get('bruwun_guest_id');
        if ($guestId) {
            Cart::where('guest_id', $guestId)->update([
                'guest_id' => null,
                'user_id' => Auth::id()
            ]);
            // Hapus cookie setelah merge
            Cookie::queue(Cookie::forget('bruwun_guest_id'));
        }

        // 3. Ambil data keranjang user
        $carts = Cart::with(['variant.product'])
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('home')->with('error', 'Keranjang Anda kosong.');
        }

        // Return view checkout (Form Alamat, dll)
        return view('frontend.checkout', compact('carts'));
    }

    private function getCartIdentity()
    {
        if (Auth::check()) {
            return ['key' => 'user_id', 'value' => Auth::id()];
        }

        // Jika Guest, cek apakah sudah punya cookie 'guest_id'
        $guestId = Cookie::get('bruwun_guest_id');

        // Jika belum ada, buat baru
        if (!$guestId) {
            $guestId = (string) Str::uuid();
            // Simpan cookie selama 30 hari (43200 menit)
            Cookie::queue('bruwun_guest_id', $guestId, 43200);
        }

        return ['key' => 'guest_id', 'value' => $guestId];
    }
}
