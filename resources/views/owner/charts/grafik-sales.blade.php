@extends('layouts.admin-layout')

@section('title', 'Grafik Tren Penjualan')
@section('header_title', 'Analisa Bisnis')

@section('content')
    <div class="space-y-6">

        <!-- Row 1: Pendapatan Tahunan (Line Chart) -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Tren Pendapatan Tahun {{ date('Y') }}</h3>
            <div class="relative h-80 w-full">
                <canvas id="incomeChart"></canvas>
            </div>
        </div>

        <!-- Row 2: Dua Kolom -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Status Pesanan (Pie Chart) -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Komposisi Status Pesanan</h3>
                <div class="relative h-64 w-full flex justify-center">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>

            <!-- Transaksi Harian (Bar Chart) -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Jumlah Transaksi Harian (Bulan Ini)</h3>
                <div class="relative h-64 w-full">
                    <canvas id="dailyChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Top 5 Produk -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Top 5 Produk Terlaris</h3>
                <div class="relative h-72 w-full">
                    <canvas id="productChart"></canvas>
                </div>
            </div>

            <!-- Metode Pembayaran -->
            {{-- <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Metode Pembayaran Favorit</h3>
                <div class="relative h-72 w-full flex justify-center">
                    <canvas id="paymentChart"></canvas>
                </div>
            </div> --}}
        </div>
    </div>

    <script>
        const ctxIncome = document.getElementById('incomeChart').getContext('2d');
        new Chart(ctxIncome, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: @json($dataPendapatan),
                    borderColor: 'rgb(37, 99, 235)',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: 'rgb(37, 99, 235)',
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += new Intl.NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                }).format(context.raw);
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [2, 2]
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: @json($labelsStatus),
                datasets: [{
                    data: @json($dataStatus),
                    backgroundColor: [
                        '#fcd34d',
                        '#fbbf24',
                        '#60a5fa',
                        '#a78bfa',
                        '#34d399',
                        '#f87171'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });

        const ctxDaily = document.getElementById('dailyChart').getContext('2d');
        new Chart(ctxDaily, {
            type: 'bar',
            data: {
                labels: @json($labelsHarian),
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: @json($dataHarian),
                    backgroundColor: 'rgba(52, 211, 153, 0.7)',
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        new Chart(document.getElementById('productChart'), {
            type: 'bar',
            data: {
                labels: @json($labelsProduk),
                datasets: [{
                    label: 'Terjual (Pcs)',
                    data: @json($dataProduk),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });

        // new Chart(document.getElementById('paymentChart'), {
        //     type: 'polarArea',
        //     data: {
        //         labels: @json($labelsPayment),
        //         datasets: [{
        //             data: @json($dataPayment),
        //             backgroundColor: [
        //                 'rgba(255, 99, 132, 0.7)',
        //                 'rgba(75, 192, 192, 0.7)',
        //                 'rgba(255, 205, 86, 0.7)',
        //                 'rgba(201, 203, 207, 0.7)',
        //                 'rgba(54, 162, 235, 0.7)'
        //             ]
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //         plugins: {
        //             legend: {
        //                 position: 'right'
        //             }
        //         }
        //     }
        // });
    </script>
@endsection
