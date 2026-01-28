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

            <div class="mb-8 flex items-center gap-3">
                <a href="{{ route('cart.index') }}"
                    class="p-2 rounded-full bg-white border border-gray-200 hover:bg-gray-100 text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900">Checkout Pesanan</h1>
            </div>

            @if (session('error'))
                <div
                    class="mb-6 p-4 rounded-xl bg-red-50 border-l-4 border-red-500 text-red-700 animate-fade-in-up flex items-start gap-3">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
                @csrf
                <input type="hidden" name="province_name" x-model="provinceName">
                <input type="hidden" name="city_name" x-model="cityName">
                <input type="hidden" name="subdistrict_name" x-model="subdistrictName">
                <input type="hidden" name="shipping_service" x-model="shippingService">
                <input type="hidden" name="shipping_cost" x-model="shippingCost">

                <div class="flex flex-col lg:flex-row gap-8 items-start">

                    <div class="lg:w-2/3 space-y-6 w-full">

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-red-600 text-white font-bold text-sm">1</span>
                                <h2 class="text-lg font-bold text-gray-800">Alamat Pengiriman</h2>
                            </div>

                            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Penerima</label>
                                        <input type="text" value="{{ Auth::user()->name }}" readonly
                                            class="w-full bg-gray-100 border-gray-300 rounded-xl px-4 py-2.5 text-gray-500 cursor-not-allowed text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1.5">No. WhatsApp</label>
                                        <input type="number" name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                                            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-red-500 focus:border-red-500 text-sm"
                                            placeholder="08123456789" required>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Provinsi</label>
                                    <select name="province_id" x-model="provinceId" @change="getCity()"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-red-500 focus:border-red-500 text-sm bg-white"
                                        required>
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($provinces as $prov)
                                            <option value="{{ $prov['id'] }}">{{ $prov['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kota/Kabupaten</label>
                                    <select name="city_id" x-model="cityId" @change="getSubdistrict()"
                                        :disabled="!provinceId"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-red-500 focus:border-red-500 text-sm bg-white disabled:bg-gray-50 disabled:text-gray-400"
                                        required>
                                        <option value="">Pilih Kota</option>
                                        <template x-for="city in cities" :key="city.id">
                                            <option :value="city.id" x-text="city.name"></option>
                                        </template>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kecamatan</label>
                                    <select name="subdistrict_id" x-model="subdistrictId" @change="resetOngkir()"
                                        :disabled="!cityId"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-red-500 focus:border-red-500 text-sm bg-white disabled:bg-gray-50 disabled:text-gray-400"
                                        required>
                                        <option value="">Pilih Kecamatan</option>
                                        <template x-for="sub in subdistricts" :key="sub.id">
                                            <option :value="sub.id" x-text="sub.name"></option>
                                        </template>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kode Pos</label>
                                    <input type="number" name="postal_code"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-red-500 focus:border-red-500 text-sm"
                                        placeholder="Contoh: 55571" required>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Alamat Lengkap</label>
                                    <textarea name="address" rows="2"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-red-500 focus:border-red-500 text-sm"
                                        placeholder="Nama Jalan, RT/RW, No. Rumah, Patokan..." required>{{ old('address', Auth::user()->address) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-red-600 text-white font-bold text-sm">2</span>
                                <h2 class="text-lg font-bold text-gray-800">Metode Pengiriman</h2>
                            </div>

                            <div class="p-6">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Pilih Kurir</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
                                    <template x-for="c in ['jne', 'sicepat', 'jnt', 'idexpress']">
                                        <label class="cursor-pointer">
                                            <input type="radio" name="courier_code" :value="c"
                                                x-model="courier" @change="checkOngkir()" class="peer sr-only"
                                                :disabled="!subdistrictId">
                                            <div
                                                class="p-3 border rounded-xl text-center peer-checked:border-red-600 peer-checked:bg-red-50 peer-checked:text-red-700 transition hover:bg-gray-50 h-full flex items-center justify-center uppercase font-bold text-sm text-gray-600">
                                                <span x-text="c"></span>
                                            </div>
                                        </label>
                                    </template>
                                </div>

                                <div x-show="isLoading" class="flex items-center justify-center py-8 text-red-600">
                                    <svg class="animate-spin h-6 w-6 mr-2" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    <span class="text-sm font-medium">Mengecek Ongkir...</span>
                                </div>

                                <div x-show="costs.length > 0" class="space-y-3" x-transition>
                                    <p class="text-sm font-medium text-gray-700">Layanan Tersedia:</p>
                                    <div class="grid gap-3">
                                        <template x-for="cost in costs" :key="cost.service">
                                            <label
                                                class="relative flex items-center justify-between p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-red-500 hover:bg-red-50/30 transition group">
                                                <div class="flex items-center">
                                                    <input type="radio" name="shipping_option"
                                                        @click="selectShipping(cost.service, cost.cost[0].value)"
                                                        class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300"
                                                        required>
                                                    <div class="ml-3">
                                                        <span class="block text-sm font-bold text-gray-900"
                                                            x-text="cost.service + ' (' + cost.description + ')'"></span>
                                                        <span class="block text-xs text-gray-500 mt-0.5"
                                                            x-text="'Estimasi sampai: ' + cost.cost[0].etd + (courier === 'pos' ? '' : ' Hari')"></span>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <span class="block text-sm font-bold text-red-700"
                                                        x-text="formatRupiah(cost.cost[0].value)"></span>
                                                </div>
                                            </label>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-red-600 text-white font-bold text-sm">3</span>
                                <h2 class="text-lg font-bold text-gray-800">Pembayaran</h2>
                            </div>

                            <div class="p-6 space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">Metode Pembayaran (Transfer
                                        Bank)</label>
                                    <div class="space-y-3">
                                        @foreach ($paymentMethods as $bank)
                                            <label
                                                class="relative flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:border-red-500 hover:bg-red-50/30 transition group">
                                                <input type="radio" name="payment_method_id"
                                                    value="{{ $bank->id }}"
                                                    class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300"
                                                    required>
                                                <div class="ml-4 flex-1">
                                                    <div class="flex justify-between items-center">
                                                        <span
                                                            class="block text-sm font-bold text-gray-900 uppercase">{{ $bank->bank_name }}</span>
                                                        <div
                                                            class="h-6 px-2 bg-gray-100 rounded text-[10px] text-gray-500 flex items-center">
                                                            Transfer</div>
                                                    </div>
                                                    <span
                                                        class="block text-sm text-gray-600 mt-1 font-mono tracking-wide">{{ $bank->account_number }}</span>
                                                    <span class="block text-xs text-gray-400">a.n
                                                        {{ $bank->account_name }}</span>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan
                                        (Opsional)</label>
                                    <textarea name="note" rows="2"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-red-500 focus:border-red-500 text-sm"
                                        placeholder="Pesan khusus untuk penjual...">{{ old('note') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:w-1/3 w-full lg:sticky lg:top-24">
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-6">Ringkasan Pesanan</h3>

                            <div class="space-y-4 mb-6 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                                @foreach ($carts as $cart)
                                    <div class="flex gap-3">
                                        <div
                                            class="w-14 h-14 rounded-lg bg-gray-100 border border-gray-200 overflow-hidden shrink-0">
                                            <img src="{{ asset('storage/' . $cart->variant->product->thumbnail) }}"
                                                class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-bold text-gray-900 line-clamp-1">
                                                {{ $cart->variant->product->product_name }}</p>
                                            <p class="text-xs text-gray-500">Size: {{ $cart->variant->size }} |
                                                x{{ $cart->quantity }}</p>
                                            <p class="text-xs font-semibold text-red-700 mt-1">Rp
                                                {{ number_format($cart->variant->price * $cart->quantity, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="border-t border-gray-100 pt-4 space-y-3">
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Total Berat</span>
                                    <span>{{ $totalWeight }} Gram</span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Subtotal Produk</span>
                                    <span class="font-medium">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600">
                                    <span>Ongkos Kirim</span>
                                    <span class="font-medium"
                                        x-text="shippingCost ? formatRupiah(shippingCost) : '-'"></span>
                                </div>
                                <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                                    <span class="text-base font-bold text-gray-900">Total Bayar</span>
                                    <span class="text-xl font-extrabold text-red-600"
                                        x-text="formatRupiah({{ $grandTotal }} + parseInt(shippingCost))"></span>
                                </div>
                            </div>

                            <button type="submit" :disabled="shippingCost == 0"
                                class="w-full mt-6 bg-red-600 cursor-pointer text-white font-bold py-3.5 rounded-xl hover:bg-red-700 focus:ring-4 focus:ring-red-200 transition shadow-lg hover:shadow-red-500/30 disabled:bg-gray-300 disabled:cursor-not-allowed disabled:shadow-none flex justify-center items-center gap-2">
                                <span>Buat Pesanan</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>

                            <p class="text-xs text-center text-gray-400 mt-4">
                                Dengan membuat pesanan, Anda menyetujui Syarat & Ketentuan kami.
                            </p>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script>
        function checkoutHandler() {
            return {
                provinceId: '',
                provinceName: '',
                cityId: '',
                cityName: '',
                subdistrictId: '',
                subdistrictName: '',

                courier: '',
                shippingCost: 0,
                shippingService: '',

                cities: [],
                subdistricts: [],
                costs: [],
                isLoading: false,
                weight: {{ $totalWeight }},

                getCity() {
                    this.provinceName = this.$el.querySelector('select[name="province_id"] option:checked').text;
                    this.cityId = '';
                    this.subdistrictId = '';
                    this.cities = [];
                    this.subdistricts = [];
                    this.resetOngkir();

                    if (!this.provinceId) return;

                    fetch(`{{ url('/api/cities') }}/${this.provinceId}`)
                        .then(res => res.json())
                        .then(data => {
                            this.cities = data;
                        });
                },

                getSubdistrict() {
                    this.cityName = this.$el.querySelector('select[name="city_id"] option:checked').text;
                    this.subdistrictId = '';
                    this.subdistricts = [];
                    this.resetOngkir();

                    if (!this.cityId) return;

                    fetch(`{{ url('/api/subdistricts') }}/${this.cityId}`)
                        .then(res => res.json())
                        .then(data => {
                            this.subdistricts = data;
                        });
                },

                checkOngkir() {
                    const subSelect = document.querySelector('select[name="subdistrict_id"]');
                    if (subSelect && subSelect.selectedIndex >= 0) {
                        this.subdistrictName = subSelect.options[subSelect.selectedIndex].text;
                    }

                    this.resetOngkir();
                    if (!this.subdistrictId || !this.courier) return;

                    this.isLoading = true;

                    fetch('{{ route('api.checkOngkir') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                city_id: this.cityId,
                                subdistrict_id: this.subdistrictId,
                                weight: this.weight,
                                courier: this.courier
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.length > 0 && data[0].costs) {
                                this.costs = data[0].costs;
                            } else {
                                this.costs = [];
                                alert('Layanan pengiriman tidak tersedia untuk rute ini.');
                            }
                            this.isLoading = false;
                        })
                        .catch(err => {
                            this.isLoading = false;
                            console.error(err);
                        });
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
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }).format(number);
                }
            }
        }
    </script>
@endsection
