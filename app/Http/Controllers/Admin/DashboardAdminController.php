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

        $pendapatanBulanan = Order::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('SUM(grand_total) as total')
        )
            ->where('status', 'selesai')
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')->orderBy('bulan')->pluck('total', 'bulan')->toArray();

        $chartPendapatan = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartPendapatan[] = $pendapatanBulanan[$i] ?? 0;
        }

        $penjualanHarian = Order::select(
            DB::raw('DATE(created_at) as tanggal'),
            DB::raw('COUNT(*) as total')
        )
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('tanggal')->orderBy('tanggal')->get();

        $chartHarianLabels = $penjualanHarian->pluck('tanggal');
        $chartHarianData = $penjualanHarian->pluck('total');

        $topPayment = DB::table('orders')
            ->join('payment_methods', 'orders.payment_method_id', '=', 'payment_methods.id')
            ->select('payment_methods.bank_name', DB::raw('count(*) as total'))
            ->groupBy('payment_methods.bank_name')->orderByDesc('total')->get();

        $chartPaymentLabels = $topPayment->pluck('bank_name');
        $chartPaymentData = $topPayment->pluck('total');

        return view('admin.dashboard', compact(
            'totalPendapatan',
            'totalPesanan',
            'totalProduk',
            'totalPelanggan',
            'stokMenipis',
            'produkTerlaris',
            'pesananTerbaru',
            'chartPendapatan',
            'chartHarianLabels',
            'chartHarianData',
            'chartPaymentLabels',
            'chartPaymentData'
        ));
    }
}
