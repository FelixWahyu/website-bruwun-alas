<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Bruwun Alas',
            'email' => 'admin@bruwunalas.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Owner Bruwun Alas',
            'email' => 'owner@bruwunalas.com',
            'password' => Hash::make('owner123'),
            'role' => 'owner'
        ]);
    }
}
