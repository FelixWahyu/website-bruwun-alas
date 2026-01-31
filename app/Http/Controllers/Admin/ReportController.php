<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Exports\SalesReportExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Default: Tanggal awal bulan ini sampai hari ini
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        // Query Data untuk Tampilan Tabel
        $orders = Order::with('user')
            ->where('status', 'selesai') // Hanya hitung yang sudah lunas/selesai
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->latest()
            ->get();

        // Hitung Ringkasan
        $totalPendapatan = $orders->sum('grand_total');
        $totalTransaksi = $orders->count();

        return view('admin.reports.sales-report', compact('orders', 'startDate', 'endDate', 'totalPendapatan', 'totalTransaksi'));
    }

    public function export(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        return Excel::download(new SalesReportExport($startDate, $endDate), 'Laporan-Penjualan-' . $startDate . '-sd-' . $endDate . '.xlsx');
    }
}
