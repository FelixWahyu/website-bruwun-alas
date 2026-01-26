@extends('layouts.app-layout')
@section('title', 'Checkout Page')
@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout Pesanan</h1>
            @if (session('error'))
                <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded animate-pulse">
                    <div class="flex">
                        <div class="py-1"><svg class="fill-current h-6 w-6 text-red-500 mr-4"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path
                                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                            </svg></div>
                        <div>
                            <p class="font-bold">Gagal Memproses:</p>
                            <p class="text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
                    <p class="font-bold">Terjadi Kesalahan:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- KOLOM KIRI: ALAMAT & PEMBAYARAN -->
                    <div class="lg:w-2/3 space-y-6">
                        <!-- Card Alamat Pengiriman -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <span
                                    class="bg-blue-100 text-blue-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">1</span>
                                Alamat Pengiriman
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima</label>
                                    <input type="text" value="{{ Auth::user()->name }}" readonly
                                        class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 text-gray-500 cursor-not-allowed">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp / HP</label>
                                    <input type="number" name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                                        required placeholder="Contoh: 08123456789"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap (Jalan, No.
                                        Rumah, RT/RW)</label>
                                    <textarea name="address" rows="2" required placeholder="Jl. Mawar No. 12, RT 01/02"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">{{ old('address', Auth::user()->address) }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                                    <input type="text" name="province"
                                        value="{{ old('province', Auth::user()->province) }}" required
                                        placeholder="Jawa Tengah"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kota / Kabupaten</label>
                                    <input type="text" name="city" value="{{ old('city', Auth::user()->city) }}"
                                        required placeholder="Kulon Progo"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                    <input type="text" name="subdistrict"
                                        value="{{ old('subdistrict', Auth::user()->subdistrict) }}" required
                                        placeholder="Kokap"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                                    <input type="number" name="postal_code"
                                        value="{{ old('postal_code', Auth::user()->postal_code) }}" required
                                        placeholder="55653"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Pesanan
                                        (Opsional)</label>
                                    <textarea name="note" rows="2" placeholder="Contoh: Tolong packing yang rapi, atau titip di pos satpam."
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">{{ old('note') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Card Metode Pembayaran -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <span
                                    class="bg-blue-100 text-blue-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">2</span>
                                Metode Pembayaran (Transfer)
                            </h2>

                            <div class="space-y-3">
                                @foreach ($paymentMethods as $bank)
                                    <label
                                        class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all">
                                        <input type="radio" name="payment_method_id" value="{{ $bank->id }}"
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" required>
                                        <div class="ml-4 flex-1">
                                            <div class="flex justify-between items-center">
                                                <span
                                                    class="block text-sm font-bold text-gray-900 uppercase">{{ $bank->bank_name }}</span>
                                                @if ($bank->logo)
                                                    <img src="{{ asset('storage/' . $bank->logo) }}"
                                                        alt="{{ $bank->bank_name }}" class="h-6">
                                                @endif
                                            </div>
                                            <span class="block text-sm text-gray-500">No. Rek: <span
                                                    class="font-mono font-bold text-gray-800">{{ $bank->account_number }}</span></span>
                                            <span class="block text-xs text-gray-400">a.n {{ $bank->account_name }}</span>
                                        </div>
                                    </label>
                                @endforeach

                                @if ($paymentMethods->isEmpty())
                                    <p class="text-red-500 text-sm">Belum ada metode pembayaran tersedia. Hubungi Admin.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Card Upload Bukti -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <span
                                    class="bg-blue-100 text-blue-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">3</span>
                                Upload Bukti Pembayaran
                            </h2>

                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center"
                                x-data="{ fileName: null }">
                                <input type="file" name="proof_of_payment" id="proof" required accept="image/*"
                                    class="hidden" @change="fileName = $event.target.files[0].name">

                                <label for="proof" class="cursor-pointer flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="text-blue-600 font-medium hover:underline">Upload Foto / Screenshot</span>
                                    <span class="text-gray-500 text-xs mt-1">Format: JPG, PNG (Max 2MB)</span>
                                </label>

                                <div x-show="fileName"
                                    class="mt-4 p-2 bg-green-50 text-green-700 rounded-lg text-sm font-medium flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span x-text="fileName"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: RINGKASAN PESANAN -->
                    <div class="lg:w-1/3">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                            <h2 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Pesanan</h2>

                            <div class="space-y-4 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                                @foreach ($carts as $cart)
                                    <div class="flex gap-4">
                                        <div class="w-16 h-16 shrink-0 bg-gray-100 rounded-md overflow-hidden">
                                            <img src="{{ asset('storage/' . $cart->variant->product->thumbnail) }}"
                                                class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-sm font-medium text-gray-900 line-clamp-1">
                                                {{ $cart->variant->product->product_name }}</h4>
                                            <p class="text-xs text-gray-500">Size: {{ $cart->variant->size }} x
                                                {{ $cart->quantity }}</p>
                                            <p class="text-sm font-bold text-gray-700">Rp
                                                {{ number_format($cart->variant->price * $cart->quantity, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="border-t border-gray-100 mt-4 pt-4 space-y-2">
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Total Berat</span>
                                    <span>{{ $totalWeight }} gr</span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Subtotal Produk</span>
                                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Biaya Pengiriman</span>
                                    <span class="text-blue-600 text-xs font-bold bg-blue-50 px-2 py-1 rounded">Dihitung
                                        Admin</span>
                                </div>
                            </div>

                            <div class="border-t border-gray-100 mt-4 pt-4">
                                <div class="flex justify-between items-center mb-6">
                                    <span class="text-base font-bold text-gray-900">Total Bayar</span>
                                    <span class="text-xl font-bold text-blue-600">Rp
                                        {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>

                                <button type="submit"
                                    class="w-full bg-blue-600 text-white font-bold py-3.5 rounded-xl hover:bg-blue-700 transition shadow-lg hover:shadow-blue-500/30">
                                    Buat Pesanan
                                </button>
                                <p class="text-xs text-gray-400 text-center mt-3">
                                    Dengan memesan, Anda menyetujui S&K kami.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
