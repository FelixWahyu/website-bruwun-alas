@extends('layouts.admin-layout')
@section('title', 'Dashboard')
@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <p class="text-gray-500 text-sm">Total Pendapatan</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">Rp 12.500.000</h3>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <p class="text-gray-500 text-sm">Pesanan Baru</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">24</h3>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <p class="text-gray-500 text-sm">Produk Aktif</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">56</h3>
        </div>
    </div>
@endsection
