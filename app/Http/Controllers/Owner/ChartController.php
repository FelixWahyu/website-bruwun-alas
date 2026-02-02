<?php

namespace App\Http\Controllers\Owner;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChartController extends Controller
{
    public function index()
    {
        $pendapatanBulanan = Order::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('SUM(grand_total) as total')
        )
            ->where('status', 'selesai')
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $dataPendapatan = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataPendapatan[] = $pendapatanBulanan[$i] ?? 0;
        }

        $statusPesanan = Order::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $labelsStatus = array_map(function ($val) {
            return ucfirst(str_replace('_', ' ', $val));
        }, array_keys($statusPesanan));
        $dataStatus = array_values($statusPesanan);

        $penjualanHarian = Order::select(
            DB::raw('DATE(created_at) as tanggal'),
            DB::raw('COUNT(*) as total_transaksi')
        )
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $labelsHarian = $penjualanHarian->pluck('tanggal');
        $dataHarian = $penjualanHarian->pluck('total_transaksi');

        $topProduk = OrderItem::select('product_name', DB::raw('SUM(quantity) as total_qty'))
            ->groupBy('product_name')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        $labelsProduk = $topProduk->pluck('product_name');
        $dataProduk = $topProduk->pluck('total_qty');

        $topPayment = DB::table('orders')
            ->join('payment_methods', 'orders.payment_method_id', '=', 'payment_methods.id')
            ->select('payment_methods.bank_name', DB::raw('count(*) as total_usage'))
            ->groupBy('payment_methods.bank_name')
            ->orderByDesc('total_usage')
            ->get();

        $labelsPayment = $topPayment->pluck('bank_name');
        $dataPayment = $topPayment->pluck('total_usage');

        return view('owner.charts.grafik-sales', compact(
            'dataPendapatan',
            'labelsStatus',
            'dataStatus',
            'labelsHarian',
            'dataHarian',
            'labelsProduk',
            'dataProduk',
            'labelsPayment',
            'dataPayment'
        ));
    }
}
