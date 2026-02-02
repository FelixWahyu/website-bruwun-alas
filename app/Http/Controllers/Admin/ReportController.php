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
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));
        $status = $request->input('status', 'all');

        $query = Order::with('user')
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $orders = $query->latest()->get();

        $totalTransaksi = $orders->count();

        $totalPendapatan = Order::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->whereIn('status', ['dikirim', 'selesai'])
            ->sum('grand_total');

        return view('admin.reports.sales-report', compact('orders', 'startDate', 'endDate', 'status', 'totalPendapatan', 'totalTransaksi'));
    }

    public function export(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $status = $request->status ?? 'all';

        return Excel::download(new SalesReportExport($startDate, $endDate, $status), 'Laporan-Penjualan-' . $startDate . '-sd-' . $endDate . '.xlsx');
    }
}
