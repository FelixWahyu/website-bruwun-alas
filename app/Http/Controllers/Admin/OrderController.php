<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

        // Filter Status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('invoice_code', 'like', "%$search%")
                    ->orWhereHas('user', function ($u) use ($search) {
                        $u->where('name', 'like', "%$search%");
                    });
            });
        }

        $orders = $query->paginate(10);

        return view('admin.orders.order-list', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items']);
        return view('admin.orders.order-details', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:menunggu_pembayaran,menunggu_konfirmasi,diproses,dikirim,selesai,dibatalkan',
            'resi_number' => 'nullable|string'
        ]);

        // Logic Validasi: Jika status diubah jadi 'dikirim', Resi Wajib Diisi
        if ($request->status == 'dikirim' && empty($request->resi_number)) {
            return back()->with('error', 'Jika status dikirim, Nomor Resi wajib diisi.');
        }

        $order->update([
            'status' => $request->status,
            'resi_number' => $request->resi_number
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
