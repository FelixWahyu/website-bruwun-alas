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
    protected $status;

    public function __construct($startDate, $endDate, $status = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = $status;
    }

    public function collection()
    {
        $query = Order::with('user')
            ->whereBetween('created_at', [$this->startDate . ' 00:00:00', $this->endDate . ' 23:59:59']);

        if ($this->status && $this->status !== 'all') {
            $query->where('status', $this->status);
        }

        return $query->latest()->get();
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
            $order->created_at->format('d-m-Y H:i'),
            $order->invoice_code,
            $order->user->name,
            $order->total_pice,
            $order->shipping_cost,
            $order->grand_total,
            ucwords(str_replace('_', ' ', $order->status)),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
