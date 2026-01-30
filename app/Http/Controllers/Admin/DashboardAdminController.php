<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardAdminController extends Controller
{
    public function dashboardPage()
    {
        $totalPendapatan = Order::where('status', 'selesai')->sum('grand_total');
        $totalPesanan = Order::count();
        $totalProduk = Product::count();
        $totalPelanggan = User::where('role', 'pelanggan')->count();

        $stokMenipis = ProductVariant::with('product')
            ->where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->limit(5)
            ->get();

        $produkTerlaris = OrderItem::select('product_name', DB::raw('SUM(quantity) as total_terjual'))
            ->groupBy('product_name')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        $pesananTerbaru = Order::with('user')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPendapatan',
            'totalPesanan',
            'totalProduk',
            'totalPelanggan',
            'stokMenipis',
            'produkTerlaris',
            'pesananTerbaru'
        ));
    }
}
