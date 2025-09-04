@extends('template-modern')

@section('title', 'Laporan Nilai - PASKIBRA E-Learning')

@section('content')
<!-- Page Header -->
<div class="mb-8">
    <div class="bg-slate-800 rounded-xl p-8 text-white relative overflow-hidden border-l-4 border-yellow-600">
        <div class="absolute inset-0 bg-gradient-to-r from-yellow-600/10 via-transparent to-blue-600/10"></div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
        
        <div class="relative z-10">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-12 h-12 bg-yellow-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold">Laporan Nilai</h1>
                    <p class="text-lg text-white/90">Pantau progress dan pencapaian pembelajaran Anda</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-600">Rata-rata Nilai</h3>
            <div class="w-12 h-12 bg-gradient-to-br from-yellow-600 to-yellow-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-2">85.2</div>
        <div class="flex items-center text-sm text-green-600">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
            <span>+2.1 dari bulan lalu</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-600">Quiz Lulus</h3>
            <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-2">8</div>
        <div class="flex items-center text-sm text-green-600">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>dari 10 quiz</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-600">Materi Selesai</h3>
            <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-2">18</div>
        <div class="flex items-center text-sm text-green-600">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>dari 24 materi</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-600">Ranking Kelas</h3>
            <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-2">#3</div>
        <div class="flex items-center text-sm text-green-600">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
            <span>dari 45 siswa</span>
        </div>
    </div>
</div>

<!-- Grade Chart -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-900">Progress Nilai</h2>
        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
            <option>3 Bulan Terakhir</option>
            <option>6 Bulan Terakhir</option>
            <option>1 Tahun Terakhir</option>
        </select>
    </div>
    
    <!-- Simple Chart Placeholder -->
    <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
        <div class="text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <p class="text-gray-500">Grafik progress nilai akan ditampilkan di sini</p>
        </div>
    </div>
</div>

<!-- Detailed Grades -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold text-gray-900">Riwayat Nilai</h2>
            <div class="flex space-x-2">
                <select class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                    <option>Semua Kategori</option>
                    <option>Kepaskibraan</option>
                    <option>Baris Berbaris</option>
                    <option>Kepemimpinan</option>
                </select>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm">
                    Export PDF
                </button>
            </div>
        </div>
    </div>

    <div class="divide-y divide-gray-200">
        <!-- Grade Item 1 -->
        <div class="p-6 hover:bg-gray-50 transition-colors">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 mb-2">
                        <h3 class="text-lg font-semibold text-gray-900">Quiz Dasar Kepaskibraan</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            Kepaskibraan
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            ✓ Lulus
                        </span>
                    </div>
                    
                    <div class="flex items-center space-x-6 text-sm text-gray-500 mb-3">
                        <span>Tanggal: 15 Nov 2024</span>
                        <span>Waktu: 12 menit</span>
                        <span>Soal: 8/10 benar</span>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="flex-1 max-w-xs">
                            <div class="flex justify-between text-xs text-gray-600 mb-1">
                                <span>Progress</span>
                                <span>85%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-right">
                    <div class="text-3xl font-bold text-green-600 mb-1">85</div>
                    <div class="text-sm text-gray-500">Sangat Baik</div>
                </div>
            </div>
        </div>

        <!-- Grade Item 2 -->
        <div class="p-6 hover:bg-gray-50 transition-colors">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 mb-2">
                        <h3 class="text-lg font-semibold text-gray-900">Quiz Teknik Baris Berbaris</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Baris Berbaris
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            ✓ Lulus
                        </span>
                    </div>
                    
                    <div class="flex items-center space-x-6 text-sm text-gray-500 mb-3">
                        <span>Tanggal: 12 Nov 2024</span>
                        <span>Waktu: 18 menit</span>
                        <span>Soal: 13/15 benar</span>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="flex-1 max-w-xs">
                            <div class="flex justify-between text-xs text-gray-600 mb-1">
                                <span>Progress</span>
                                <span>87%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: 87%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-right">
                    <div class="text-3xl font-bold text-green-600 mb-1">87</div>
                    <div class="text-sm text-gray-500">Sangat Baik</div>
                </div>
            </div>
        </div>

        <!-- Grade Item 3 -->
        <div class="p-6 hover:bg-gray-50 transition-colors">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 mb-2">
                        <h3 class="text-lg font-semibold text-gray-900">Quiz Wawasan Kebangsaan</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            Wawasan
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            ✗ Tidak Lulus
                        </span>
                    </div>
                    
                    <div class="flex items-center space-x-6 text-sm text-gray-500 mb-3">
                        <span>Tanggal: 10 Nov 2024</span>
                        <span>Waktu: 22 menit</span>
                        <span>Soal: 11/20 benar</span>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="flex-1 max-w-xs">
                            <div class="flex justify-between text-xs text-gray-600 mb-1">
                                <span>Progress</span>
                                <span>55%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-red-600 h-2 rounded-full" style="width: 55%"></div>
                            </div>
                        </div>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Coba Lagi</a>
                    </div>
                </div>
                
                <div class="text-right">
                    <div class="text-3xl font-bold text-red-600 mb-1">55</div>
                    <div class="text-sm text-gray-500">Perlu Perbaikan</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection