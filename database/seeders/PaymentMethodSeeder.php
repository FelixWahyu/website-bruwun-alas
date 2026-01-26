<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            [
                'bank_name' => 'BCA',
                'account_number' => '8030123456',
                'account_name' => 'UMKM Bruwun Alas',
                'is_active' => true,
                'logo' => null, // Nanti bisa diupload lewat admin jika perlu
            ],
            [
                'bank_name' => 'BRI',
                'account_number' => '1234-01-0000-53-5',
                'account_name' => 'UMKM Bruwun Alas',
                'is_active' => true,
                'logo' => null,
            ],
            [
                'bank_name' => 'MANDIRI',
                'account_number' => '137-00-1234567-8',
                'account_name' => 'UMKM Bruwun Alas',
                'is_active' => true,
                'logo' => null,
            ],
            [
                'bank_name' => 'DANA (E-Wallet)',
                'account_number' => '0812-3456-7890',
                'account_name' => 'Admin Bruwun',
                'is_active' => true,
                'logo' => null,
            ],
        ];

        foreach ($methods as $method) {
            PaymentMethod::create($method);
        }
    }
}
