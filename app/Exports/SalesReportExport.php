<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalesReportExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        // Ambil data order yang sudah SELESAI dalam rentang tanggal
        return Order::with('user')
            ->where('status', 'selesai')
            ->whereBetween('created_at', [$this->startDate . ' 00:00:00', $this->endDate . ' 23:59:59'])
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'Invoice',
            'Pelanggan',
            'Total Belanja',
            'Ongkos Kirim',
            'Total Bayar',
            'Status',
        ];
    }

    public function map($order): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $order->created_at->format('d-m-Y'),
            $order->invoice_code,
            $order->user->name,
            $order->total_pice,
            $order->shipping_cost,
            $order->grand_total,
            ucfirst($order->status),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
