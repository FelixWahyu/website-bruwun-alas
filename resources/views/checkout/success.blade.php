@extends('layouts.app-layout')
@section('title', 'Pesanan Berhasil')
@section('content')
    <div class="min-h-[80vh] flex items-center justify-center bg-gray-50 px-4">
        <div class="max-w-lg w-full bg-white rounded-2xl shadow-lg p-8 text-center border border-gray-100">

            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="text-2xl font-bold text-gray-900 mb-2">Pesanan Berhasil Dibuat!</h1>
            <p class="text-gray-500 mb-6">
                Terima kasih telah berbelanja di Bruwun Alas. Pesanan Anda dengan ID <span
                    class="font-mono font-bold text-gray-800">{{ $order->invoice_code }}</span> sedang menunggu konfirmasi
                admin.
            </p>

            <div class="bg-blue-50 rounded-lg p-4 mb-8 text-left text-sm text-blue-800">
                <p class="font-bold mb-1">Langkah Selanjutnya:</p>
                <ul class="list-disc list-inside space-y-1">
                    <li>Admin akan mengecek bukti pembayaran Anda.</li>
                    <li>Admin akan menghitung ongkos kirim dan menghubungi Anda (jika diperlukan).</li>
                    <li>Cek status pesanan secara berkala di menu <b>Riwayat Pesanan</b>.</li>
                </ul>
            </div>

            <div class="flex flex-col gap-3">
                <a href="{{ route('orders.history') }}"
                    class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition">
                    Lihat Riwayat Pesanan
                </a>
                <a href="{{ route('home') }}"
                    class="w-full bg-white border border-gray-300 text-gray-700 font-bold py-3 rounded-xl hover:bg-gray-50 transition">
                    Kembali Belanja
                </a>
            </div>
        </div>
    </div>
@endsection
