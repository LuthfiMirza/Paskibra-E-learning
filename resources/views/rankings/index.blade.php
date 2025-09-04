@extends('template-modern')

@section('title', 'Ranking Kelas - PASKIBRA E-Learning')

@section('content')
<!-- Page Header -->
<div class="mb-8">
    <div class="bg-slate-800 rounded-xl p-8 text-white relative overflow-hidden border-l-4 border-purple-600">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-600/10 via-transparent to-blue-600/10"></div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
        
        <div class="relative z-10">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold">Ranking Kelas</h1>
                    <p class="text-lg text-white/90">Lihat posisi Anda di antara anggota PASKIBRA lainnya</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Top 3 Podium -->
<div class="mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
        <h2 class="text-2xl font-bold text-gray-900 text-center mb-8">🏆 Top 3 Anggota Terbaik</h2>
        
        <div class="flex items-end justify-center space-x-8">
            <!-- 2nd Place -->
            <div class="text-center">
                <div class="relative">
                    <div class="w-20 h-20 bg-gradient-to-br from-gray-400 to-gray-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">2</span>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-gray-400 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm">🥈</span>
                    </div>
                </div>
                <div class="bg-gray-100 rounded-lg p-4 h-32 flex flex-col justify-end">
                    <img class="w-12 h-12 rounded-full mx-auto mb-2" src="https://ui-avatars.com/api/?name=Sari+Dewi&background=6B7280&color=fff" alt="Sari Dewi">
                    <h3 class="font-semibold text-gray-900">Sari Dewi</h3>
                    <p class="text-sm text-gray-600">92.5 poin</p>
                </div>
            </div>

            <!-- 1st Place -->
            <div class="text-center">
                <div class="relative">
                    <div class="w-24 h-24 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-2xl">1</span>
                    </div>
                    <div class="absolute -top-2 -right-2 w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center">
                        <span class="text-white">👑</span>
                    </div>
                </div>
                <div class="bg-yellow-50 rounded-lg p-4 h-40 flex flex-col justify-end border-2 border-yellow-200">
                    <img class="w-16 h-16 rounded-full mx-auto mb-2" src="https://ui-avatars.com/api/?name=Ahmad+Rizki&background=F59E0B&color=fff" alt="Ahmad Rizki">
                    <h3 class="font-semibold text-gray-900">Ahmad Rizki</h3>
                    <p class="text-sm text-gray-600">95.8 poin</p>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 mt-1">
                        🏆 Juara
                    </span>
                </div>
            </div>

            <!-- 3rd Place -->
            <div class="text-center">
                <div class="relative">
                    <div class="w-20 h-20 bg-gradient-to-br from-orange-400 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">3</span>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-orange-400 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm">🥉</span>
                    </div>
                </div>
                <div class="bg-orange-50 rounded-lg p-4 h-32 flex flex-col justify-end">
                    <img class="w-12 h-12 rounded-full mx-auto mb-2" src="https://ui-avatars.com/api/?name=Budi+Santoso&background=F97316&color=fff" alt="Budi Santoso">
                    <h3 class="font-semibold text-gray-900">Budi Santoso</h3>
                    <p class="text-sm text-gray-600">89.2 poin</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Your Position -->
<div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl border border-blue-200 p-6 mb-8">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-purple-600 rounded-full flex items-center justify-center">
                <span class="text-white font-bold text-xl">3</span>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900">Posisi Anda</h3>
                <p class="text-gray-600">{{ auth()->user()->name ?? 'Anda' }}</p>
                <p class="text-sm text-gray-500">85.2 poin • Naik 2 posisi dari minggu lalu</p>
            </div>
        </div>
        <div class="text-right">
            <div class="text-3xl font-bold text-blue-600 mb-1">#3</div>
            <div class="text-sm text-gray-500">dari 45 siswa</div>
            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-2">
                ↗️ Naik 2 posisi
            </span>
        </div>
    </div>
</div>

<!-- Filter and Search -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
    <div class="flex flex-wrap gap-4 items-center">
        <div class="flex-1 min-w-64">
            <div class="relative">
                <input type="text" placeholder="Cari nama anggota..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
        <select class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option>Semua Kategori</option>
            <option>Kepaskibraan</option>
            <option>Baris Berbaris</option>
            <option>Kepemimpinan</option>
        </select>
        <select class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option>Bulan Ini</option>
            <option>3 Bulan Terakhir</option>
            <option>Semester Ini</option>
            <option>Sepanjang Masa</option>
        </select>
    </div>
</div>

<!-- Rankings Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold text-gray-900">Ranking Lengkap</h2>
            <span class="text-sm text-gray-500">45 anggota total</span>
        </div>
    </div>

    <div class="divide-y divide-gray-200">
        <!-- Ranking Item 1 -->
        <div class="p-6 hover:bg-gray-50 transition-colors">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold">1</span>
                    </div>
                    <img class="w-12 h-12 rounded-full" src="https://ui-avatars.com/api/?name=Ahmad+Rizki&background=F59E0B&color=fff" alt="Ahmad Rizki">
                    <div>
                        <h3 class="font-semibold text-gray-900">Ahmad Rizki</h3>
                        <p class="text-sm text-gray-500">Kelas XII • Anggota Inti</p>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="text-center">
                        <div class="text-lg font-bold text-gray-900">95.8</div>
                        <div class="text-xs text-gray-500">Total Poin</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-bold text-green-600">12</div>
                        <div class="text-xs text-gray-500">Quiz Lulus</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-bold text-blue-600">24</div>
                        <div class="text-xs text-gray-500">Materi Selesai</div>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        👑 Juara
                    </span>
                </div>
            </div>
        </div>

        <!-- Ranking Item 2 -->
        <div class="p-6 hover:bg-gray-50 transition-colors">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-gray-400 to-gray-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold">2</span>
                    </div>
                    <img class="w-12 h-12 rounded-full" src="https://ui-avatars.com/api/?name=Sari+Dewi&background=6B7280&color=fff" alt="Sari Dewi">
                    <div>
                        <h3 class="font-semibold text-gray-900">Sari Dewi</h3>
                        <p class="text-sm text-gray-500">Kelas XI • Anggota Inti</p>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="text-center">
                        <div class="text-lg font-bold text-gray-900">92.5</div>
                        <div class="text-xs text-gray-500">Total Poin</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-bold text-green-600">11</div>
                        <div class="text-xs text-gray-500">Quiz Lulus</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-bold text-blue-600">22</div>
                        <div class="text-xs text-gray-500">Materi Selesai</div>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        🥈 Runner Up
                    </span>
                </div>
            </div>
        </div>

        <!-- Ranking Item 3 (User) -->
        <div class="p-6 hover:bg-gray-50 transition-colors bg-blue-50 border-l-4 border-blue-600">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold">3</span>
                    </div>
                    <img class="w-12 h-12 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'You') }}&background=3B82F6&color=fff" alt="{{ auth()->user()->name ?? 'You' }}">
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ auth()->user()->name ?? 'Anda' }} <span class="text-blue-600">(Anda)</span></h3>
                        <p class="text-sm text-gray-500">Kelas XI • Anggota Aktif</p>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="text-center">
                        <div class="text-lg font-bold text-gray-900">85.2</div>
                        <div class="text-xs text-gray-500">Total Poin</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-bold text-green-600">8</div>
                        <div class="text-xs text-gray-500">Quiz Lulus</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-bold text-blue-600">18</div>
                        <div class="text-xs text-gray-500">Materi Selesai</div>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        ↗️ Naik 2
                    </span>
                </div>
            </div>
        </div>

        <!-- Ranking Item 4 -->
        <div class="p-6 hover:bg-gray-50 transition-colors">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold">4</span>
                    </div>
                    <img class="w-12 h-12 rounded-full" src="https://ui-avatars.com/api/?name=Andi+Pratama&background=9CA3AF&color=fff" alt="Andi Pratama">
                    <div>
                        <h3 class="font-semibold text-gray-900">Andi Pratama</h3>
                        <p class="text-sm text-gray-500">Kelas X • Anggota Baru</p>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="text-center">
                        <div class="text-lg font-bold text-gray-900">82.1</div>
                        <div class="text-xs text-gray-500">Total Poin</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-bold text-green-600">7</div>
                        <div class="text-xs text-gray-500">Quiz Lulus</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-bold text-blue-600">16</div>
                        <div class="text-xs text-gray-500">Materi Selesai</div>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        ↘️ Turun 1
                    </span>
                </div>
            </div>
        </div>

        <!-- Ranking Item 5 -->
        <div class="p-6 hover:bg-gray-50 transition-colors">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold">5</span>
                    </div>
                    <img class="w-12 h-12 rounded-full" src="https://ui-avatars.com/api/?name=Maya+Sari&background=9CA3AF&color=fff" alt="Maya Sari">
                    <div>
                        <h3 class="font-semibold text-gray-900">Maya Sari</h3>
                        <p class="text-sm text-gray-500">Kelas XI • Anggota Aktif</p>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="text-center">
                        <div class="text-lg font-bold text-gray-900">79.8</div>
                        <div class="text-xs text-gray-500">Total Poin</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-bold text-green-600">6</div>
                        <div class="text-xs text-gray-500">Quiz Lulus</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg font-bold text-blue-600">15</div>
                        <div class="text-xs text-gray-500">Materi Selesai</div>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        = Tetap
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Load More -->
    <div class="p-6 border-t border-gray-200 text-center">
        <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium transition-colors">
            Muat Lebih Banyak
        </button>
    </div>
</div>
@endsection