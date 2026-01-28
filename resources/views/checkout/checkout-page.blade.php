@extends('layouts.app-layout')
@section('title', 'Checkout Page')
@section('content')
    <div class="bg-gray-50 min-h-screen py-12" x-data="checkoutHandler()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout Pesanan</h1>

            @if (session('error'))
                <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">{{ session('error') }}</div>
            @endif

            <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Hidden Inputs untuk Nama Lokasi -->
                <input type="hidden" name="province_name" x-model="provinceName">
                <input type="hidden" name="city_name" x-model="cityName">
                <input type="hidden" name="subdistrict_name" x-model="subdistrictName"> <!-- Tambahan -->

                <input type="hidden" name="shipping_service" x-model="shippingService">
                <input type="hidden" name="shipping_cost" x-model="shippingCost">

                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- KOLOM KIRI -->
                    <div class="lg:w-2/3 space-y-6">

                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h2 class="text-xl font-bold text-gray-800 mb-4">1. Alamat Pengiriman</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-1">Nama Penerima</label>
                                    <input type="text" value="{{ Auth::user()->name }}" readonly
                                        class="w-full bg-gray-100 border rounded-lg px-4 py-2">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-1">No HP / WA</label>
                                    <input type="number" name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                                        class="w-full border rounded-lg px-4 py-2" required>
                                </div>

                                <!-- 1. PROVINSI -->
                                <div>
                                    <label class="block text-sm font-medium mb-1">Provinsi</label>
                                    <select name="province_id" x-model="provinceId" @change="getCity()"
                                        class="w-full border rounded-lg px-4 py-2" required>
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($provinces as $prov)
                                            <option value="{{ $prov['id'] }}">{{ $prov['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- 2. KOTA -->
                                <div>
                                    <label class="block text-sm font-medium mb-1">Kota/Kabupaten</label>
                                    <select name="city_id" x-model="cityId" @change="getSubdistrict()"
                                        :disabled="!provinceId"
                                        class="w-full border rounded-lg px-4 py-2 disabled:bg-gray-100" required>
                                        <option value="">Pilih Kota</option>
                                        <template x-for="city in cities" :key="city.id">
                                            <option :value="city.id" x-text="city.name"></option>
                                        </template>
                                    </select>
                                </div>

                                <!-- 3. KECAMATAN (SUBDISTRICT) -->
                                <div>
                                    <label class="block text-sm font-medium mb-1">Kecamatan</label>
                                    <select name="subdistrict_id" x-model="subdistrictId" @change="resetOngkir()"
                                        :disabled="!cityId"
                                        class="w-full border rounded-lg px-4 py-2 disabled:bg-gray-100" required>
                                        <option value="">Pilih Kecamatan</option>
                                        <template x-for="sub in subdistricts" :key="sub.id">
                                            <option :value="sub.id" x-text="sub.name"></option>
                                        </template>
                                    </select>
                                </div>

                                <!-- KODE POS -->
                                <div>
                                    <label class="block text-sm font-medium mb-1">Kode Pos</label>
                                    <input type="number" name="postal_code" class="w-full border rounded-lg px-4 py-2"
                                        required>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-1">Alamat Jalan (RT/RW, No Rumah)</label>
                                    <textarea name="address" rows="2" class="w-full border rounded-lg px-4 py-2" required>{{ old('address', Auth::user()->address) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- PENGIRIMAN -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h2 class="text-xl font-bold text-gray-800 mb-4">2. Pilih Pengiriman</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium mb-1">Kurir</label>
                                    <select x-model="courier" @change="checkOngkir()" :disabled="!subdistrictId"
                                        class="w-full border rounded-lg px-4 py-2 disabled:bg-gray-100">
                                        <option value="">Pilih Kurir</option>
                                        <option value="jne">JNE</option>
                                        <option value="sicepat">SiCepat</option>
                                        <option value="jnt">J&T</option>
                                        <option value="idexpress">ID Express</option>
                                    </select>
                                </div>

                                <div x-show="isLoading" class="flex items-center text-blue-600 text-sm font-bold pt-6">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-600"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    Cek Ongkir...
                                </div>
                            </div>

                            <!-- Hasil Ongkir -->
                            <div class="mt-4 space-y-2" x-show="costs.length > 0">
                                <p class="text-sm font-bold text-gray-700">Pilih Layanan:</p>
                                <template x-for="cost in costs" :key="cost.service">
                                    <label
                                        class="flex items-center justify-between p-3 border rounded-lg cursor-pointer hover:bg-blue-50 hover:border-blue-500">
                                        <div class="flex items-center">
                                            <input type="radio" name="shipping_option"
                                                @click="selectShipping(cost.service, cost.cost[0].value)"
                                                class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                                            <div class="ml-3">
                                                <span class="block text-sm font-medium text-gray-900"
                                                    x-text="cost.service"></span>
                                                <span class="block text-xs text-gray-500"
                                                    x-text="'Estimasi: ' + cost.cost[0].etd + ' hari'"></span>
                                            </div>
                                        </div>
                                        <span class="text-sm font-bold text-gray-900"
                                            x-text="formatRupiah(cost.cost[0].value)"></span>
                                    </label>
                                </template>
                            </div>
                        </div>

                        <!-- PEMBAYARAN & BUKTI (Sama seperti file sebelumnya, copy paste bagian ini) -->
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h2 class="text-xl font-bold text-gray-800 mb-4">3. Pembayaran</h2>
                            <!-- ... Copy bagian radio button Payment Method ... -->
                            <!-- ... Copy bagian input file Proof of Payment ... -->
                            <!-- ... Copy bagian textarea Note ... -->
                            <div class="space-y-3 mb-6">
                                @foreach ($paymentMethods as $bank)
                                    <label
                                        class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:border-blue-500 hover:bg-blue-50">
                                        <input type="radio" name="payment_method_id" value="{{ $bank->id }}"
                                            class="h-4 w-4 text-blue-600" required>
                                        <div class="ml-4">
                                            <span class="block text-sm font-bold uppercase">{{ $bank->bank_name }}</span>
                                            <span class="block text-sm text-gray-500">{{ $bank->account_number }} (a.n
                                                {{ $bank->account_name }})</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium mb-1">Catatan</label>
                                <textarea name="note" rows="2" class="w-full border rounded-lg px-4 py-2">{{ old('note') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: RINGKASAN (Sama seperti sebelumnya) -->
                    <div class="lg:w-1/3">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                            <h2 class="text-lg font-bold mb-4">Ringkasan</h2>
                            <!-- ... List Items ... -->
                            <div class="space-y-3 mb-4 max-h-60 overflow-y-auto">
                                @foreach ($carts as $cart)
                                    <div class="flex justify-between text-sm">
                                        <span>{{ $cart->variant->product->product_name }} (x{{ $cart->quantity }})</span>
                                        <span class="font-bold">Rp
                                            {{ number_format($cart->variant->price * $cart->quantity, 0, ',', '.') }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <hr class="my-4">
                            <div class="space-y-2 text-sm text-gray-600">
                                <div class="flex justify-between"><span>Subtotal</span><span>Rp
                                        {{ number_format($subtotal, 0, ',', '.') }}</span></div>
                                <div class="flex justify-between font-medium text-blue-600"><span>Ongkir</span><span
                                        x-text="formatRupiah(shippingCost)"></span></div>
                            </div>
                            <div class="border-t mt-4 pt-4 flex justify-between items-center">
                                <span class="font-bold text-lg">Total</span>
                                <span class="font-bold text-xl text-green-600"
                                    x-text="formatRupiah({{ $subtotal }} + shippingCost)"></span>
                            </div>
                            <button type="submit" :disabled="shippingCost == 0"
                                class="w-full mt-6 bg-green-600 text-white font-bold py-3 rounded-xl hover:bg-green-700 disabled:bg-gray-400">Buat
                                Pesanan</button>
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
                subdistrictName: '', // Variable baru

                courier: '',
                shippingCost: 0,
                shippingService: '',
                cities: [],
                subdistricts: [],
                costs: [], // Variable baru
                isLoading: false,
                weight: {{ $totalWeight }},

                getCity() {
                    // Ambil text dari option yang dipilih untuk disimpan
                    this.provinceName = this.$event.target.options[this.$event.target.selectedIndex].text;

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
                    this.cityName = this.$event.target.options[this.$event.target.selectedIndex].text;
                    this.subdistrictId = '';
                    this.subdistricts = [];
                    this.resetOngkir();

                    if (!this.cityId) return;

                    // Fetch Subdistrict
                    fetch(`{{ url('/api/subdistricts') }}/${this.cityId}`)
                        .then(res => res.json())
                        .then(data => {
                            this.subdistricts = data;
                        });
                },

                checkOngkir() {
                    this.subdistrictName = document.querySelector('[name="subdistrict_id"] option:checked').text;
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
                                subdistrict_id: this.subdistrictId, // Kirim ID Kecamatan
                                weight: this.weight,
                                courier: this.courier
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            this.costs = data[0].costs;
                            this.isLoading = false;
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
                        minimumFractionDigits: 0
                    }).format(number);
                }
            }
        }
    </script>
@endsection
