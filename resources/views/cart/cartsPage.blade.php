@extends('layouts.app-layout')
@section('title', 'Keranjang Belanja - Bruwun Alas')
@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8 flex items-center">
                <svg class="w-8 h-8 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                Keranjang Belanja
            </h1>

            @if ($carts->isEmpty())
                <div class="bg-white rounded-2xl shadow-sm p-12 text-center border border-gray-100">
                    <div class="w-24 h-24 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Keranjang Anda Kosong</h3>
                    <p class="text-gray-500 mb-8">Sepertinya Anda belum menambahkan produk apapun.</p>
                    <a href="{{ route('katalogProduk') }}"
                        class="inline-flex items-center justify-center px-8 py-3 bg-green-600 text-white font-bold rounded-full hover:bg-green-700 transition shadow-lg hover:-translate-y-1">
                        Mulai Belanja
                    </a>
                </div>
            @else
                <div class="flex flex-col lg:flex-row gap-8 items-start">

                    <div class="lg:w-2/3 space-y-4">
                        @php $grandTotal = 0; @endphp
                        @foreach ($carts as $cart)
                            @php
                                $subtotal = $cart->variant->price * $cart->quantity;
                                $grandTotal += $subtotal;
                            @endphp

                            <div
                                class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-100 flex gap-4 sm:gap-6 items-start group hover:border-green-200 transition">
                                <div
                                    class="shrink-0 w-20 h-20 sm:w-24 sm:h-24 bg-gray-100 rounded-xl overflow-hidden border border-gray-100">
                                    <img src="{{ asset('storage/' . $cart->variant->product->thumbnail) }}"
                                        alt="{{ $cart->variant->product->product_name }}"
                                        class="w-full h-full object-cover">
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3
                                                class="text-lg font-bold text-gray-900 line-clamp-1 hover:text-green-600 transition">
                                                <a href="{{ route('product.detail', $cart->variant->product->slug) }}">
                                                    {{ $cart->variant->product->product_name }}
                                                </a>
                                            </h3>
                                            <p class="text-sm text-gray-500 mt-1">Ukuran: <span
                                                    class="font-medium text-gray-700">{{ $cart->variant->size }}</span></p>
                                            <p class="text-sm text-gray-500">Harga: Rp
                                                {{ number_format($cart->variant->price, 0, ',', '.') }}</p>
                                        </div>

                                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="confirmDeleteCart(event)"
                                                class="text-gray-400 hover:text-red-500 p-2 rounded-full hover:bg-red-50 transition"
                                                title="Hapus Item">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="flex justify-between items-end mt-4">
                                        <div
                                            class="flex items-center text-sm text-gray-600 bg-gray-50 px-3 py-1 rounded-lg border border-gray-200">
                                            <span>Jml: <span
                                                    class="font-bold text-gray-900">{{ $cart->quantity }}</span></span>
                                        </div>

                                        <div class="text-right">
                                            <p class="text-lg font-extrabold text-green-600">Rp
                                                {{ number_format($subtotal, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="lg:w-1/3 lg:sticky lg:top-24">
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                            <h2 class="text-lg font-bold text-gray-900 mb-6 border-b border-gray-100 pb-4">Ringkasan Belanja
                            </h2>

                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between text-gray-600">
                                    <span>Total Item</span>
                                    <span>{{ $carts->sum('quantity') }} Pcs</span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Total Harga</span>
                                    <span class="font-medium">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center border-t border-dashed border-gray-200 pt-4 mb-6">
                                <span class="text-lg font-bold text-gray-900">Total Tagihan</span>
                                <span class="text-2xl font-extrabold text-green-600">Rp
                                    {{ number_format($grandTotal, 0, ',', '.') }}</span>
                            </div>

                            <a href="{{ route('checkout') }}"
                                class="w-full block text-center py-4 bg-green-600 text-white font-bold rounded-xl shadow-lg hover:bg-green-700 hover:shadow-green-500/30 transition-all transform hover:-translate-y-0.5">
                                Checkout Sekarang
                            </a>

                            <div class="mt-4 flex items-center justify-center gap-2 text-xs text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Transaksi Aman & Terenkripsi
                            </div>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </div>
    <script>
        function confirmDeleteCart(event) {
            event.preventDefault();

            const form = event.target.closest('form');

            Swal.fire({
                title: 'Hapus item ini?',
                text: "Produk akan dihapus dari keranjang belanja Anda.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: 'gray',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'font-sans rounded-2xl'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menghapus...',
                        timer: 1000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                    form.submit();
                }
            });
        }
    </script>
@endsection
