@extends('layouts.app-layout')
@section('title', 'Pembayaran')
@section('content')
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8" x-data="paymentHandler()">
        <div class="max-w-lg mx-auto">

            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4 animate-pulse">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-extrabold text-gray-900">Menunggu Pembayaran</h2>
                <p class="text-gray-500 mt-2 text-sm">Order ID: <span
                        class="font-mono font-bold text-gray-700">#{{ $order->invoice_code }}</span></p>

                <div class="mt-4 inline-flex items-center bg-orange-100 text-orange-700 px-4 py-2 rounded-full text-sm font-bold tracking-wide shadow-sm"
                    x-init="startTimer({{ $order->created_at->addHours(8)->timestamp * 1000 }})">
                    <svg class="w-4 h-4 mr-2 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span x-text="timeLeft">Memuat...</span>
                </div>

                <p class="text-xs text-gray-400 mt-2">Batas Waktu: 8 Jam dari pemesanan</p>
            </div>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">

                <div class="bg-linear-to-br from-blue-600 to-blue-700 p-8 text-center text-white relative overflow-hidden">
                    <div
                        class="absolute top-0 left-0 w-full h-full opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">
                    </div>

                    <p class="text-blue-100 text-sm font-medium mb-1 relative z-10">Total Tagihan</p>
                    <h1 class="text-4xl font-extrabold tracking-tight relative z-10">
                        Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                    </h1>
                </div>

                <div class="p-6 md:p-8">
                    <p class="text-sm font-bold text-gray-700 mb-4 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Transfer ke Rekening:
                    </p>

                    <div
                        class="relative bg-gray-50 border border-gray-200 rounded-2xl p-5 flex items-center justify-between group hover:border-blue-300 transition-all duration-300">
                        <div class="flex items-center gap-4">
                            @if ($bank->logo)
                                <img src="{{ asset('storage/' . $bank->logo) }}" class="h-10 w-auto object-contain">
                            @else
                                <div
                                    class="h-12 w-12 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center font-bold text-lg shadow-sm">
                                    {{ substr($bank->bank_name, 0, 1) }}
                                </div>
                            @endif

                            <div>
                                <p class="font-bold text-gray-900 text-lg uppercase">{{ $bank->bank_name }}</p>
                                <p class="text-xs text-gray-500 uppercase font-medium tracking-wide">a.n
                                    {{ $bank->account_name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 flex items-center justify-between bg-blue-50 border border-blue-100 rounded-xl p-4">
                        <span
                            class="text-2xl font-mono font-bold text-gray-800 tracking-wider">{{ $bank->account_number }}</span>
                        <button @click="copyToClipboard('{{ $bank->account_number }}')"
                            class="text-blue-600 hover:text-blue-800 hover:bg-blue-100 p-2 rounded-lg transition flex items-center text-sm font-bold">
                            <span x-show="!copied">Salin</span>
                            <span x-show="copied" class="flex items-center" x-cloak>
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Disalin
                            </span>
                        </button>
                    </div>

                    <div class="my-8 border-t border-gray-100"></div>

                    <form action="{{ route('checkout.updatePayment', $order->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-900 mb-2">Konfirmasi Pembayaran</label>
                            <p class="text-xs text-gray-500 mb-3">Upload tangkapan layar (screenshot) atau foto bukti
                                transfer Anda.</p>

                            <label for="proof"
                                class="relative flex flex-col justify-center items-center h-48 border-2 border-dashed border-gray-300 rounded-2xl hover:bg-gray-50 hover:border-blue-400 transition cursor-pointer group bg-white">

                                <div x-show="!fileName" class="text-center space-y-2">
                                    <div
                                        class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto text-gray-400 group-hover:text-blue-500 group-hover:bg-blue-50 transition">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                    </div>
                                    <div class="text-sm text-gray-600 font-medium">Klik untuk upload bukti bayar</div>
                                    <p class="text-xs text-gray-400">Format: JPG, PNG (Max 2MB)</p>
                                </div>

                                <div x-show="fileName" x-cloak class="text-center space-y-3 animate-fade-in-up">
                                    <div
                                        class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto text-blue-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800" x-text="fileName"></p>
                                        <p class="text-xs text-blue-600 mt-1">File siap dikirim</p>
                                    </div>
                                    <span class="text-xs text-gray-400 underline hover:text-blue-500">Ganti File</span>
                                </div>

                                <input id="proof" name="proof_of_payment" type="file" class="sr-only" requiblue
                                    accept="image/*" @change="fileChosen">
                            </label>
                        </div>

                        <button type="submit"
                            class="w-full flex justify-center items-center py-4 px-4 cursor-pointer border border-transparent rounded-xl shadow-lg text-base font-bold text-white bg-blue-600 hover:bg-blue-700 hover:shadow-blue-500/30 focus:outline-none focus:ring-4 focus:ring-blue-200 transition transform hover:-translate-y-0.5">
                            Kirim Bukti Pembayaran
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <a href="{{ route('orders.history') }}"
                            class="text-sm text-gray-500 hover:text-blue-600 font-medium transition">
                            Bayar Nanti & Masuk ke Riwayat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function paymentHandler() {
            return {
                fileName: null,
                copied: false,
                timeLeft: 'Memuat...',
                interval: null,

                fileChosen(event) {
                    if (event.target.files.length > 0) {
                        this.fileName = event.target.files[0].name;
                    }
                },

                copyToClipboard(text) {
                    navigator.clipboard.writeText(text).then(() => {
                        this.copied = true;
                        setTimeout(() => this.copied = false, 2000);
                    });
                },

                startTimer(deadline) {
                    this.updateTime(deadline);
                    this.interval = setInterval(() => {
                        this.updateTime(deadline);
                    }, 1000);
                },

                updateTime(deadline) {
                    const now = new Date().getTime();
                    const distance = deadline - now;

                    if (distance < 0) {
                        this.timeLeft = "Waktu Habis";
                        clearInterval(this.interval);
                        return;
                    }

                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    this.timeLeft =
                        (hours < 10 ? "0" + hours : hours) + " : " +
                        (minutes < 10 ? "0" + minutes : minutes) + " : " +
                        (seconds < 10 ? "0" + seconds : seconds);
                }
            }
        }
    </script>

    <style>
        .animate-spin-slow {
            animation: spin 3s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection
