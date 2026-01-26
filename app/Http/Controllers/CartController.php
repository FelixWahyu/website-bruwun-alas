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
    private function getCartIdentity()
    {
        if (Auth::check()) {
            return ['key' => 'user_id', 'value' => Auth::id()];
        }

        $guestId = Cookie::get('bruwun_guest_id');

        if (!$guestId) {
            $guestId = (string) Str::uuid();
            Cookie::queue('bruwun_guest_id', $guestId, 43200);
        }

        return ['key' => 'guest_id', 'value' => $guestId];
    }

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

        $existingCart = Cart::where($identity['key'], $identity['value'])
            ->where('product_variant_id', $request->product_variant_id)
            ->first();

        if ($existingCart) {
            $existingCart->update([
                'quantity' => $existingCart->quantity + $request->quantity
            ]);
        } else {
            $data = [
                'product_variant_id' => $request->product_variant_id,
                'quantity' => $request->quantity,
            ];

            $data[$identity['key']] = $identity['value'];

            Cart::create($data);
        }

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request, $id)
    {
        $identity = $this->getCartIdentity();

        $cart = Cart::with('variant')
            ->where($identity['key'], $identity['value'])
            ->where('id', $id)
            ->firstOrFail();

        if ($request->type === 'increment') {
            if ($cart->variant->stock > $cart->quantity) {
                $cart->increment('quantity');
            } else {
                return back()->with('error', 'Stok maksimal untuk produk ini telah tercapai.');
            }
        } elseif ($request->type === 'decrement') {
            if ($cart->quantity > 1) {
                $cart->decrement('quantity');
            } else {
                return back()->with('error', 'Jumlah minimal adalah 1. Gunakan tombol hapus jika ingin membatalkan.');
            }
        }

        return back()->with('success', 'Keranjang diperbarui.');
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
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login atau daftar terlebih dahulu untuk menyelesaikan pesanan.');
        }

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
            return redirect()->route('home')->with('error', 'Keranjang Anda kosong.');
        }

        return view('frontend.checkout', compact('carts'));
    }
}
