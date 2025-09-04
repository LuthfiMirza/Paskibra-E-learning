@extends('layouts.admin')

@section('title', 'Laporan & Analitik')
@section('subtitle', 'Analisis data dan laporan sistem e-learning')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Laporan & Analitik</h1>
                <p class="text-gray-600">Analisis mendalam tentang performa sistem dan pengguna</p>
            </div>
            <div class="flex space-x-3">
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    Export Laporan
                </button>
                <button class="border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                    Pilih Periode
                </button>
            </div>
        </div>
    </div>

    <!-- Report Categories -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="admin-card bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold mb-2">Aktivitas Pengguna</h3>
                    <p class="text-blue-100 text-sm">Analisis engagement dan aktivitas</p>
                </div>
                <div class="text-blue-200">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="admin-card bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold mb-2">Performa Kursus</h3>
                    <p class="text-green-100 text-sm">Statistik pembelajaran dan penyelesaian</p>
                </div>
                <div class="text-green-200">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="admin-card bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold mb-2">Sistem & Performa</h3>
                    <p class="text-purple-100 text-sm">Monitoring server dan resource</p>
                </div>
                <div class="text-purple-200">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- User Activity Report -->
    <div class="admin-card bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">📊 Laporan Aktivitas Pengguna</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="text-center p-4 bg-blue-50 rounded-lg">
                <div class="text-2xl font-bold text-blue-600">{{ $reports['user_activity']['daily_active_users'] }}</div>
                <div class="text-sm text-gray-600">Aktif Harian</div>
            </div>
            <div class="text-center p-4 bg-green-50 rounded-lg">
                <div class="text-2xl font-bold text-green-600">{{ $reports['user_activity']['weekly_active_users'] }}</div>
                <div class="text-sm text-gray-600">Aktif Mingguan</div>
            </div>
            <div class="text-center p-4 bg-purple-50 rounded-lg">
                <div class="text-2xl font-bold text-purple-600">{{ $reports['user_activity']['monthly_active_users'] }}</div>
                <div class="text-sm text-gray-600">Aktif Bulanan</div>
            </div>
            <div class="text-center p-4 bg-orange-50 rounded-lg">
                <div class="text-2xl font-bold text-orange-600">{{ $reports['user_activity']['user_retention_rate'] }}%</div>
                <div class="text-sm text-gray-600">Retention Rate</div>
            </div>
        </div>

        <!-- Chart Placeholder -->
        <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
            <div class="text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <p class="text-gray-500">Chart Aktivitas Pengguna</p>
                <p class="text-sm text-gray-400 mt-2">Data akan ditampilkan di sini</p>
            </div>
        </div>
    </div>

    <!-- Course Performance Report -->
    <div class="admin-card bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">📚 Laporan Performa Kursus</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="text-center p-4 bg-blue-50 rounded-lg">
                <div class="text-2xl font-bold text-blue-600">{{ $reports['course_performance']['total_enrollments'] }}</div>
                <div class="text-sm text-gray-600">Total Pendaftaran</div>
            </div>
            <div class="text-center p-4 bg-green-50 rounded-lg">
                <div class="text-2xl font-bold text-green-600">{{ $reports['course_performance']['completion_rate'] }}%</div>
                <div class="text-sm text-gray-600">Tingkat Penyelesaian</div>
            </div>
            <div class="text-center p-4 bg-purple-50 rounded-lg">
                <div class="text-2xl font-bold text-purple-600">{{ $reports['course_performance']['average_score'] }}%</div>
                <div class="text-sm text-gray-600">Rata-rata Nilai</div>
            </div>
            <div class="text-center p-4 bg-red-50 rounded-lg">
                <div class="text-2xl font-bold text-red-600">{{ $reports['course_performance']['dropout_rate'] }}%</div>
                <div class="text-sm text-gray-600">Dropout Rate</div>
            </div>
        </div>

        <!-- Chart Placeholder -->
        <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
            <div class="text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                <p class="text-gray-500">Chart Performa Kursus</p>
                <p class="text-sm text-gray-400 mt-2">Trend penyelesaian dan nilai</p>
            </div>
        </div>
    </div>

    <!-- System Usage Report -->
    <div class="admin-card bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">⚙️ Laporan Penggunaan Sistem</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="text-center p-4 bg-blue-50 rounded-lg">
                <div class="text-2xl font-bold text-blue-600">{{ $reports['system_usage']['storage_used'] }}GB</div>
                <div class="text-sm text-gray-600">Storage Terpakai</div>
            </div>
            <div class="text-center p-4 bg-green-50 rounded-lg">
                <div class="text-2xl font-bold text-green-600">{{ $reports['system_usage']['bandwidth_used'] }}GB</div>
                <div class="text-sm text-gray-600">Bandwidth Bulan Ini</div>
            </div>
            <div class="text-center p-4 bg-purple-50 rounded-lg">
                <div class="text-2xl font-bold text-purple-600">{{ number_format($reports['system_usage']['api_calls_today']) }}</div>
                <div class="text-sm text-gray-600">API Calls Hari Ini</div>
            </div>
            <div class="text-center p-4 bg-orange-50 rounded-lg">
                <div class="text-2xl font-bold text-orange-600">{{ $reports['system_usage']['error_rate'] }}%</div>
                <div class="text-sm text-gray-600">Error Rate</div>
            </div>
        </div>

        <!-- System Health Indicators -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-4 bg-gray-50 rounded-lg">
                <h3 class="text-sm font-medium text-gray-700 mb-3">Storage Usage</h3>
                <div class="w-full bg-gray-200 rounded-full h-3 mb-2">
                    <div class="bg-blue-500 h-3 rounded-full" style="width: {{ ($reports['system_usage']['storage_used'] / 10) * 100 }}%"></div>
                </div>
                <div class="text-xs text-gray-600">{{ $reports['system_usage']['storage_used'] }}GB / 10GB</div>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg">
                <h3 class="text-sm font-medium text-gray-700 mb-3">Server Load</h3>
                <div class="w-full bg-gray-200 rounded-full h-3 mb-2">
                    <div class="bg-green-500 h-3 rounded-full" style="width: 35%"></div>
                </div>
                <div class="text-xs text-gray-600">35% CPU Usage</div>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg">
                <h3 class="text-sm font-medium text-gray-700 mb-3">Memory Usage</h3>
                <div class="w-full bg-gray-200 rounded-full h-3 mb-2">
                    <div class="bg-yellow-500 h-3 rounded-full" style="width: 68%"></div>
                </div>
                <div class="text-xs text-gray-600">68% RAM Usage</div>
            </div>
        </div>
    </div>

    <!-- Detailed Reports Table -->
    <div class="mt-8 admin-card bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Laporan Detail</h2>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Top Performing Courses -->
                <div class="bg-green-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-green-800 mb-4">🏆 Kursus Terpopuler</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Dasar-dasar Paskibra</span>
                            <span class="text-sm font-medium text-green-600">45 siswa</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Teknik Baris Berbaris</span>
                            <span class="text-sm font-medium text-green-600">32 siswa</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Kepemimpinan Paskibra</span>
                            <span class="text-sm font-medium text-green-600">28 siswa</span>
                        </div>
                    </div>
                </div>

                <!-- Top Students -->
                <div class="bg-blue-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-blue-800 mb-4">⭐ Siswa Terbaik</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Ahmad Rizki Pratama</span>
                            <span class="text-sm font-medium text-blue-600">92.5%</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Siti Nurhaliza</span>
                            <span class="text-sm font-medium text-blue-600">89.2%</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Budi Santoso</span>
                            <span class="text-sm font-medium text-blue-600">87.8%</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Issues -->
                <div class="bg-red-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-red-800 mb-4">⚠️ Issues Terbaru</h3>
                    <div class="space-y-3">
                        <div class="text-sm text-gray-700">
                            <div class="font-medium">Slow Query Detected</div>
                            <div class="text-xs text-gray-500">2 jam yang lalu</div>
                        </div>
                        <div class="text-sm text-gray-700">
                            <div class="font-medium">High Memory Usage</div>
                            <div class="text-xs text-gray-500">5 jam yang lalu</div>
                        </div>
                        <div class="text-sm text-gray-700">
                            <div class="font-medium">Failed Login Attempts</div>
                            <div class="text-xs text-gray-500">1 hari yang lalu</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Options -->
    <div class="mt-8 admin-card bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">📄 Export Laporan</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                <div class="flex items-center mb-3">
                    <svg class="w-8 h-8 text-red-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900">PDF Report</h3>
                </div>
                <p class="text-sm text-gray-600 mb-4">Laporan lengkap dalam format PDF</p>
                <button class="w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg transition-colors duration-200">
                    Download PDF
                </button>
            </div>

            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                <div class="flex items-center mb-3">
                    <svg class="w-8 h-8 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900">Excel Export</h3>
                </div>
                <p class="text-sm text-gray-600 mb-4">Data dalam format spreadsheet</p>
                <button class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg transition-colors duration-200">
                    Download Excel
                </button>
            </div>

            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                <div class="flex items-center mb-3">
                    <svg class="w-8 h-8 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900">CSV Export</h3>
                </div>
                <p class="text-sm text-gray-600 mb-4">Data mentah untuk analisis lanjutan</p>
                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition-colors duration-200">
                    Download CSV
                </button>
            </div>
        </div>
    </div>
</div>
@endsection