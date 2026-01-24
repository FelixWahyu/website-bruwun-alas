@extends('layouts.app-layout')
@section('title', 'Keranjang Belanja - Bruwun Alas')
@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 bg-white min-h-screen">
        <h1 class="text-3xl font-bold mb-8">Keranjang Belanja</h1>

        @if ($carts->isEmpty())
            <div class="text-center py-12 bg-gray-50 rounded-lg">
                <p class="text-gray-500 mb-4">Keranjang Anda masih kosong.</p>
                <a href="{{ route('home') }}" class="text-red-600 font-bold hover:underline">Mulai Belanja &rarr;</a>
            </div>
        @else
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="lg:w-3/4">
                    <div class="border rounded-lg overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Produk</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Harga</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jumlah</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php $grandTotal = 0; @endphp
                                @foreach ($carts as $cart)
                                    @php
                                        $subtotal = $cart->variant->price * $cart->quantity;
                                        $grandTotal += $subtotal;
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="shrink-0 h-16 w-16">
                                                    <img class="h-16 w-16 rounded object-cover"
                                                        src="{{ asset('storage/' . $cart->variant->product->thumbnail) }}"
                                                        alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $cart->variant->product->product_name }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        Size: {{ $cart->variant->size }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Rp {{ number_format($cart->variant->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                            {{ $cart->quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-800">
                                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 cursor-pointer hover:text-red-900"
                                                    onclick="return confirm('Hapus item ini?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="lg:w-1/4">
                    <div class="bg-gray-50 p-6 rounded-lg border">
                        <h2 class="text-lg font-bold mb-4 text-gray-900">Ringkasan Pesanan</h2>
                        <div class="flex justify-between mb-4 text-lg font-bold">
                            <span>Total</span>
                            <span>Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                        </div>
                        <p class="text-xs text-gray-500 mb-6">*Ongkir dihitung saat checkout</p>

                        <a href="{{ route('checkout') }}"
                            class="block w-full bg-red-600 text-white text-center py-3 rounded-md font-bold hover:bg-red-700 transition">
                            Checkout Sekarang
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
