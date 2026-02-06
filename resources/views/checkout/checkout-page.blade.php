@extends('layouts.app-layout')
@section('title', 'Checkout Page')
@section('content')
    @php
        $grandTotal = 0;
        foreach ($carts as $cart) {
            $grandTotal += $cart->variant->price * $cart->quantity;
        }
    @endphp

    <div class="bg-gray-50 min-h-screen py-10" x-data="checkoutHandler()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="{{ route('cart.index') }}"
                        class="p-2.5 rounded-xl bg-white border border-gray-200 hover:bg-gray-100 text-gray-500 transition shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-2xl font-extrabold text-gray-900">Checkout Pengiriman</h1>
                        <p class="text-sm text-gray-500">Lengkapi data pengiriman dan pembayaran.</p>
                    </div>
                </div>
            </div>

            @if (session('error'))
                <div
                    class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 text-red-700 flex items-center gap-3 shadow-sm animate-fade-in-up">
                    <div class="bg-red-100 p-2 rounded-full"><svg class="w-5 h-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></div>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
                @csrf
                <input type="hidden" name="province_name" x-model="provinceName">
                <input type="hidden" name="city_name" x-model="cityName">
                <input type="hidden" name="shipping_service" x-model="shippingService">
                <input type="hidden" name="shipping_cost" x-model="shippingCost">

                <div class="flex flex-col lg:flex-row gap-8 items-start">

                    <div class="lg:w-2/3 space-y-6 w-full">

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center gap-3">
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-red-600 text-white font-bold text-sm shadow-md shadow-red-200">1</span>
                                <h2 class="text-lg font-bold text-gray-800">Alamat Tujuan</h2>
                            </div>

                            <div class="p-6 space-y-5">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Penerima</label>
                                        <div class="relative">
                                            <span
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><svg
                                                    class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                    </path>
                                                </svg></span>
                                            <input type="text" value="{{ Auth::user()->name }}" readonly
                                                class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-500 cursor-not-allowed text-sm font-medium">
                                        </div>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">WhatsApp</label>
                                        <div class="relative">
                                            <span
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><svg
                                                    class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                    </path>
                                                </svg></span>
                                            <input type="tel" name="phone"
                                                value="{{ old('phone', Auth::user()->phone) }}"
                                                class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:outline-0 focus:ring-red-500 focus:border-red-500 text-sm transition"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Provinsi</label>
                                        <div class="relative">
                                            <select name="province_id" x-model="provinceId" x-ref="provinceSelect"
                                                @change="getCity()"
                                                class="w-full appearance-none px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-0 focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm bg-white"
                                                required>
                                                <option value="">Pilih Provinsi</option>
                                                @foreach ($provinces as $prov)
                                                    <option value="{{ $prov['province_id'] ?? $prov['id'] }}">
                                                        {{ $prov['province'] ?? $prov['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label
                                            class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Kota/Kabupaten</label>
                                        <div class="relative">
                                            <select name="city_id" x-model="cityId" x-ref="citySelect"
                                                @change="onCityChange()" :disabled="!provinceId"
                                                class="w-full appearance-none px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-0 focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm disabled:bg-gray-100 disabled:cursor-not-allowed bg-white"
                                                required>
                                                <option value="">Pilih Kota</option>
                                                <template x-for="city in cities" :key="city.city_id || city.id">
                                                    <option :value="city.city_id || city.id"
                                                        x-text="(city.type || '') + ' ' + (city.city_name || city.name)">
                                                    </option>
                                                </template>
                                            </select>
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                    <div class="md:col-span-2">
                                        <label
                                            class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Kecamatan</label>
                                        <input type="text" name="subdistrict"
                                            value="{{ old('subdistrict', Auth::user()->subdistrict) }}"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-0 focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm"
                                            placeholder="Nama Kecamatan" required>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Kode
                                            Pos</label>
                                        <input type="text" inputMode="numeric" name="postal_code"
                                            value="{{ old('postal_code', Auth::user()->postal_code) }}"
                                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-0 focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm"
                                            required>
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Alamat
                                        Lengkap</label>
                                    <textarea name="address" rows="2"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-0 focus:ring-2 focus:ring-red-500 focus:border-red-500 text-sm"
                                        placeholder="Nama Jalan, RT/RW, No. Rumah, Patokan..." required>{{ old('address', Auth::user()->address) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center gap-3">
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-red-600 text-white font-bold text-sm shadow-md shadow-red-200">2</span>
                                <h2 class="text-lg font-bold text-gray-800">Kurir Pengiriman</h2>
                            </div>

                            <div class="p-6">
                                <p class="text-sm font-medium text-gray-700 mb-3">Pilih Ekspedisi:</p>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
                                    <template x-for="c in ['jne', 'pos', 'jnt', 'tiki']">
                                        <label class="cursor-pointer group">
                                            <input type="radio" name="courier_code" :value="c"
                                                x-model="courier" @change="checkOngkir()" class="peer sr-only"
                                                :disabled="!cityId">
                                            <div
                                                class="p-3 rounded-xl border-2 border-gray-100 bg-white text-center transition-all duration-200 peer-checked:border-red-600 peer-checked:bg-red-50 peer-checked:text-red-700 group-hover:border-red-200 h-full flex items-center justify-center">
                                                <span class="uppercase font-bold text-sm tracking-wide"
                                                    x-text="c"></span>
                                            </div>
                                        </label>
                                    </template>
                                </div>

                                <div x-show="isLoading"
                                    class="flex flex-col items-center justify-center py-6 text-red-600" x-transition>
                                    <svg class="animate-spin h-8 w-8 mb-2" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    <span class="text-sm font-medium">Mengecek ongkir...</span>
                                </div>

                                <div x-show="costs.length > 0 && !isLoading" class="space-y-3 animate-fade-in-down">
                                    <p class="text-sm font-medium text-gray-700">Layanan Tersedia:</p>
                                    <template x-for="(cost, index) in costs" :key="index">
                                        <label
                                            class="relative flex items-center justify-between p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-red-400 hover:bg-red-50/50 transition duration-200"
                                            :class="{
                                                'ring-2 ring-red-500 bg-red-50 border-red-500': shippingService &&
                                                    shippingService.includes(cost.service)
                                            }">

                                            <div class="flex items-start gap-4">
                                                <input type="radio" name="shipping_option"
                                                    @click="selectShipping(cost.service, cost.cost?.[0]?.value || 0)"
                                                    class="mt-1 h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300"
                                                    required>
                                                <div>
                                                    <span class="block text-sm font-bold text-gray-900"
                                                        x-text="cost.service"></span>
                                                    <span class="block text-xs text-gray-500"
                                                        x-text="cost.description"></span>
                                                    <span
                                                        class="inline-block mt-1 text-[10px] font-bold uppercase tracking-wide bg-gray-100 text-gray-600 px-2 py-0.5 rounded"
                                                        x-text="(cost.cost?.[0]?.etd ? cost.cost[0].etd.replace('HARI','').replace('Hari','') : '2-3') + ' Hari'"></span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <span class="block text-base font-bold text-red-700"
                                                    x-text="formatRupiah(cost.cost?.[0]?.value || 0)"></span>
                                            </div>
                                        </label>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center gap-3">
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-red-600 text-white font-bold text-sm shadow-md shadow-red-200">3</span>
                                <h2 class="text-lg font-bold text-gray-800">Pembayaran</h2>
                            </div>

                            <div class="p-6">
                                <p class="text-sm font-medium text-gray-700 mb-3">Pilih Rekening Transfer:</p>
                                <div class="grid grid-cols-1 gap-3">
                                    @foreach ($paymentMethods as $bank)
                                        <label
                                            class="relative flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-red-400 hover:bg-red-50/50 transition group">
                                            <input type="radio" name="payment_method_id" value="{{ $bank->id }}"
                                                class="peer sr-only" required>

                                            <div
                                                class="absolute inset-0 rounded-xl border-2 border-transparent peer-checked:border-red-600 pointer-events-none">
                                            </div>

                                            <div class="flex items-center justify-between w-full relative z-10">
                                                <div class="flex items-center gap-4">
                                                    <div
                                                        class="w-12 h-12 rounded-lg bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-400">
                                                        @if ($bank->logo)
                                                            <img src="{{ asset('storage/' . $bank->logo) }}"
                                                                class="w-8 h-8 object-contain">
                                                        @else
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                                </path>
                                                            </svg>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <span
                                                            class="block text-sm font-bold text-gray-900 uppercase">{{ $bank->bank_name }}</span>
                                                        <span
                                                            class="block text-xs text-gray-500 font-mono">{{ $bank->account_number }}</span>
                                                        <span class="block text-[10px] text-gray-400">a.n
                                                            {{ $bank->account_name }}</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="h-5 w-5 rounded-full border border-gray-300 peer-checked:bg-red-600 peer-checked:border-transparent flex items-center justify-center transition">
                                                    <div class="h-2 w-2 bg-white rounded-full"></div>
                                                </div>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>

                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan
                                        (Opsional)</label>
                                    <textarea name="note" rows="2"
                                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm transition"
                                        placeholder="Pesan untuk penjual...">{{ old('note') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:w-1/3 w-full lg:sticky lg:top-24 h-fit">
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Ringkasan Pesanan
                            </h3>

                            <div class="space-y-4 mb-6 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                                @foreach ($carts as $cart)
                                    <div class="flex gap-3">
                                        <div
                                            class="w-14 h-14 rounded-lg bg-gray-50 border border-gray-100 overflow-hidden shrink-0">
                                            <img src="{{ asset('storage/' . $cart->variant->product->thumbnail) }}"
                                                class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-bold text-gray-900 line-clamp-1">
                                                {{ $cart->variant->product->product_name }}</p>
                                            <p class="text-xs text-gray-500">Var: {{ $cart->variant->size }} |
                                                x{{ $cart->quantity }}</p>
                                            <p class="text-xs font-semibold text-red-600 mt-1">Rp
                                                {{ number_format($cart->variant->price * $cart->quantity, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="border-t border-gray-100 pt-4 space-y-3">
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Berat Total</span>
                                    <span
                                        class="font-medium bg-gray-100 px-2 py-0.5 rounded text-xs text-gray-700">{{ $totalWeight > 0 ? $totalWeight : 1000 }}
                                        Gram</span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Subtotal</span>
                                    <span class="font-medium text-gray-900">Rp
                                        {{ number_format($grandTotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Ongkos Kirim</span>
                                    <span class="font-medium text-gray-900"
                                        x-text="shippingCost ? formatRupiah(shippingCost) : '-'"></span>
                                </div>
                                <div class="flex justify-between items-center pt-3 border-t border-dashed border-gray-200">
                                    <span class="text-base font-bold text-gray-900">Total Tagihan</span>
                                    <span class="text-xl font-extrabold text-gray-900"
                                        x-text="formatRupiah({{ $grandTotal }} + (parseInt(shippingCost) || 0))"></span>
                                </div>
                            </div>

                            <button type="submit" :disabled="shippingCost == 0"
                                class="w-full mt-6 bg-red-600 text-white font-bold py-3.5 rounded-xl hover:bg-red-700 transition shadow-lg hover:shadow-red-500/30 disabled:bg-gray-300 disabled:cursor-not-allowed disabled:shadow-none flex justify-center items-center gap-2 transform active:scale-95 duration-200">
                                <span>Buat Pesanan</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>

                            <p class="text-[10px] text-center text-gray-400 mt-4 leading-tight">
                                Pastikan alamat dan pesanan sudah benar sebelum melanjutkan pembayaran.
                            </p>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function checkoutHandler() {
            return {
                provinceId: '',
                provinceName: '',
                cityId: '',
                cityName: '',
                courier: '',
                shippingCost: 0,
                shippingService: '',
                cities: [],
                costs: [],
                isLoading: false,
                weight: {{ $totalWeight > 0 ? $totalWeight : 1000 }},

                getCity() {
                    const select = this.$refs.provinceSelect;

                    // Cek jika select valid sebelum akses properti
                    if (select && select.selectedIndex >= 0) {
                        this.provinceName = select.options[select.selectedIndex].text;
                    }
                    this.cityId = '';
                    this.cityName = '';
                    this.cities = [];
                    this.resetOngkir();

                    if (!this.provinceId) return;

                    // this.isLoading = true;

                    fetch(`{{ url('/api/cities') }}/${this.provinceId}`)
                        .then(res => res.json())
                        .then(data => {
                            this.cities = data;
                        });
                },

                onCityChange() {
                    const select = this.$refs.citySelect;

                    if (select && select.selectedIndex >= 0) {
                        this.cityName = select.options[select.selectedIndex].text;
                    }
                    this.resetOngkir();
                    if (this.courier) {
                        this.checkOngkir();
                    }
                },

                checkOngkir() {
                    this.resetOngkir();
                    if (!this.cityId || !this.courier) return;

                    this.isLoading = true;

                    fetch('{{ route('api.checkOngkir') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                city_id: this.cityId,
                                weight: this.weight,
                                courier: this.courier
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            this.costs = data[0]?.costs || [];
                            if (this.costs.length === 0) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Layanan Tidak Tersedia',
                                    text: 'Maaf, kurir ' + this.courier.toUpperCase() +
                                        ' tidak mendukung pengiriman ke rute ini.',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Pilih Kurir Lain'
                                });
                                this.courier = ''; // Reset pilihan kurir
                            }
                        })
                        .catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: 'Gagal mengecek ongkos kirim. Silakan coba lagi nanti.',
                                confirmButtonColor: '#d33'
                            });
                        })
                        .finally(() => this.isLoading = false);
                },

                selectShipping(service, cost) {
                    this.shippingService = this.courier.toUpperCase() + ' - ' + service;
                    this.shippingCost = cost;
                },

                resetOngkir() {
                    this.costs = [];
                    this.shippingCost = 0;
                    this.shippingService = '';
                },

                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(number);
                }
            }
        }
    </script>
@endsection
