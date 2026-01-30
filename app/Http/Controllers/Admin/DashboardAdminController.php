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
        // 1. KARTU STATISTIK UTAMA
        $totalPendapatan = Order::where('status', 'selesai')->sum('grand_total'); // Hanya hitung yang sudah selesai
        $totalPesanan = Order::count();
        $totalProduk = Product::count();
        $totalPelanggan = User::where('role', 'pelanggan')->count();

        // 2. PRODUK MAU HABIS (Stok < 5)
        // Kita ambil varian yang stoknya sedikit, lalu load relasi product-nya
        $stokMenipis = ProductVariant::with('product')
            ->where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->limit(5)
            ->get();

        // 3. TOP 5 PRODUK TERLARIS
        // Menggunakan agragasi sum pada tabel order_items
        $produkTerlaris = OrderItem::select('product_name', DB::raw('SUM(quantity) as total_terjual'))
            ->groupBy('product_name')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        // 4. HISTORY PESANAN TERBARU
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
