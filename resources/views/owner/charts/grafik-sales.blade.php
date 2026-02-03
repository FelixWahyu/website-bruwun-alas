@extends('layouts.admin-layout')

@section('title', 'Grafik Tren Penjualan')
@section('header_title', 'Analisa Bisnis')

@section('content')
    <div class="space-y-8">
        <div class="flex flex-col md:flex-row justify-between items-end md:items-center gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Performa Bisnis</h2>
                <p class="text-sm text-gray-500">Analisa data penjualan dan kinerja toko tahun {{ date('Y') }}.</p>
            </div>
            <div class="text-sm font-medium text-gray-500 bg-white px-4 py-2 rounded-lg border border-gray-200 shadow-sm">
                Update Terakhir: {{ now()->format('d M Y H:i') }}
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Tren Pendapatan Bulanan</h3>
                    <p class="text-xs text-gray-500">Total pemasukan per bulan tahun ini</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Total Tahun Ini</p>
                    <p class="text-xl font-extrabold text-blue-600">Rp
                        {{ number_format(array_sum($dataPendapatan), 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="relative h-80 w-full">
                <canvas id="incomeChart"></canvas>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Aktivitas Harian</h3>
                <p class="text-xs text-gray-500 mb-6">Jumlah transaksi dalam 30 hari terakhir</p>
                <div class="relative h-72 w-full">
                    <canvas id="dailyChart"></canvas>
                </div>
            </div>

            <div class="lg:col-span-1 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Komposisi Status</h3>
                <p class="text-xs text-gray-500 mb-6">Distribusi status seluruh pesanan</p>
                <div class="relative h-64 w-full flex-1 flex justify-center items-center">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Top 5 Produk Terlaris</h3>
                <p class="text-xs text-gray-500 mb-6">Produk dengan kuantitas terjual tertinggi</p>
                <div class="relative h-80 w-full">
                    <canvas id="productChart"></canvas>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Metode Pembayaran</h3>
                <p class="text-xs text-gray-500 mb-6">Preferensi pembayaran pelanggan</p>
                <div class="relative h-80 w-full flex justify-center">
                    <canvas id="paymentChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        Chart.defaults.font.family = "'Plus Jakarta Sans', 'Inter', sans-serif";
        Chart.defaults.color = '#64748b';

        const currencyFormatter = (value) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(value);
        };

        const ctxIncome = document.getElementById('incomeChart').getContext('2d');
        const gradientIncome = ctxIncome.createLinearGradient(0, 0, 0, 400);
        gradientIncome.addColorStop(0, 'rgba(59, 130, 246, 0.5)');
        gradientIncome.addColorStop(1, 'rgba(59, 130, 246, 0.0)');

        new Chart(ctxIncome, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pendapatan',
                    data: @json($dataPendapatan),
                    borderColor: '#2563eb',
                    backgroundColor: gradientIncome,
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#2563eb',
                    pointRadius: 4,
                    pointHoverRadius: 6
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
                        backgroundColor: '#1e293b',
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                return ' Pendapatan: ' + currencyFormatter(context.raw);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [2, 4],
                            color: '#e2e8f0'
                        },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + (value / 1000000) + 'jt';
                            }
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

        new Chart(document.getElementById('dailyChart'), {
            type: 'bar',
            data: {
                labels: @json($labelsHarian),
                datasets: [{
                    label: 'Transaksi',
                    data: @json($dataHarian),
                    backgroundColor: '#10b981',
                    borderRadius: 4,
                    hoverBackgroundColor: '#059669'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        grid: {
                            borderDash: [2, 4]
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

        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: @json($labelsStatus),
                datasets: [{
                    data: @json($dataStatus),
                    backgroundColor: ['#fbbf24', '#f59e0b', '#3b82f6', '#8b5cf6', '#10b981', '#ef4444'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 8
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
                    label: 'Terjual',
                    data: @json($dataProduk),
                    backgroundColor: 'rgba(99, 102, 241, 0.8)',
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 1,
                    borderRadius: 4,
                    barThickness: 20
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [2, 4]
                        }
                    },
                    y: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        new Chart(document.getElementById('paymentChart'), {
            type: 'doughnut',
            data: {
                labels: @json($labelsPayment),
                datasets: [{
                    data: @json($dataPayment),
                    backgroundColor: ['#3b82f6', '#ef4444', '#10b981', '#f59e0b', '#6366f1'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    </script>
@endsection
