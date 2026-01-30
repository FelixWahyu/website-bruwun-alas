<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    /**
     * Tampilkan Daftar Riwayat Pesanan
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->paginate(5);

        return view('orders.order-page', compact('orders'));
    }

    /**
     * Tampilkan Detail Pesanan
     */
    public function show($id)
    {
        $order = Order::with('items.variant.product')
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }

    /**
     * Aksi Pelanggan: Terima Pesanan (Selesai)
     */
    public function markAsCompleted($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('id', $id)
            ->where('status', 'dikirim')
            ->firstOrFail();

        $order->update(['status' => 'selesai']);

        return back()->with('success', 'Terima kasih! Pesanan telah diselesaikan.');
    }

    /**
     * Aksi Pelanggan: Batalkan Pesanan
     */
    public function cancelOrder($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('id', $id)
            ->whereIn('status', ['menunggu_pembayaran', 'menunggu_konfirmasi'])
            ->firstOrFail();

        foreach ($order->items as $item) {
            if ($item->variant) {
                $item->variant->increment('stock', $item->quantity);
            }
        }

        $order->update(['status' => 'dibatalkan']);

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
