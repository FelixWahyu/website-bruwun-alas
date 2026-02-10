<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CancelExpiredOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:cancel-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membatalkan pesanan yang belum dibayar lebih dari 8 jam dan mengembalikan stok.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $limitTime = Carbon::now()->subHours(8);

        $this->info("Mencari pesanan yang dibuat sebelum: " . $limitTime->toDateTimeString());

        $expiredOrders = Order::with('items')
            ->where('status', 'menunggu_pembayaran')
            ->where('created_at', '<', $limitTime)
            ->get();

        if ($expiredOrders->isEmpty()) {
            $this->info('Tidak ada pesanan kedaluwarsa.');
            return;
        }

        foreach ($expiredOrders as $order) {
            DB::beginTransaction();
            try {
                foreach ($order->items as $item) {
                    if ($item->product_variant_id) {
                        $variant = ProductVariant::find($item->product_variant_id);
                        if ($variant) {
                            $variant->increment('stock', $item->quantity);
                            $this->info("- Stok dikembalikan: {$item->product_name} ({$item->product_size}) +{$item->quantity}");
                        }
                    }
                }

                $order->update([
                    'status' => 'dibatalkan',
                    'note' => $order->note . ' [Dibatalkan otomatis oleh sistem karena melewati batas waktu pembayaran 8 jam]'
                ]);

                DB::commit();
                $this->info("Order #{$order->invoice_code} berhasil dibatalkan.");
            } catch (\Exception $e) {
                DB::rollBack();
                $this->error("Gagal membatalkan order #{$order->invoice_code}: " . $e->getMessage());
            }
        }
    }
}
