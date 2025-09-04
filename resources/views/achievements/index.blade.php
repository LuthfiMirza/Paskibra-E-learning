@extends('template-modern')

@section('title', 'Pencapaian - PASKIBRA E-Learning')

@section('content')
<!-- Page Header -->
<div class="mb-8">
    <div class="bg-slate-800 rounded-xl p-8 text-white relative overflow-hidden border-l-4 border-yellow-600">
        <div class="absolute inset-0 bg-gradient-to-r from-yellow-600/10 via-transparent to-purple-600/10"></div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
        
        <div class="relative z-10">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-12 h-12 bg-yellow-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold">Pencapaian</h1>
                    <p class="text-lg text-white/90">Kumpulkan lencana dan raih prestasi dalam pembelajaran PASKIBRA</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Achievement Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-600">Total Lencana</h3>
            <div class="w-12 h-12 bg-gradient-to-br from-yellow-600 to-yellow-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-2">6</div>
        <div class="flex items-center text-sm text-green-600">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
            <span>+2 bulan ini</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-600">Poin XP</h3>
            <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-2">650</div>
        <div class="flex items-center text-sm text-green-600">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
            <span>+120 minggu ini</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-600">Level Saat Ini</h3>
            <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-2">7</div>
        <div class="flex items-center text-sm text-blue-600">
            <span>Anggota Terampil</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-gray-600">Progress ke Level 8</h3>
            <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-900 mb-2">65%</div>
        <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
            <div class="bg-green-600 h-2 rounded-full transition-all duration-1000" style="width: 65%"></div>
        </div>
    </div>
</div>

<!-- Recent Achievements -->
<div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl border border-yellow-200 p-6 mb-8">
    <div class="flex items-center space-x-3 mb-4">
        <div class="w-8 h-8 bg-yellow-600 rounded-lg flex items-center justify-center">
            <span class="text-white text-lg">🎉</span>
        </div>
        <h2 class="text-xl font-bold text-gray-900">Pencapaian Terbaru</h2>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-lg p-4 border border-yellow-200">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                    <span class="text-white text-xl">📚</span>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Pembelajar Aktif</h3>
                    <p class="text-sm text-gray-600">Selesaikan 10 materi</p>
                    <p class="text-xs text-yellow-600 font-medium">Baru saja diraih!</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 border border-yellow-200">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center">
                    <span class="text-white text-xl">🏆</span>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Quiz Master</h3>
                    <p class="text-sm text-gray-600">Lulus 5 quiz berturut-turut</p>
                    <p class="text-xs text-yellow-600 font-medium">2 hari yang lalu</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-4 border border-yellow-200">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
                    <span class="text-white text-xl">⭐</span>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Nilai Sempurna</h3>
                    <p class="text-sm text-gray-600">Raih nilai 100 dalam quiz</p>
                    <p class="text-xs text-yellow-600 font-medium">1 minggu yang lalu</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Achievement Categories -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Earned Achievements -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Lencana yang Diraih</h2>
                <span class="text-sm text-gray-500">6 dari 15 lencana</span>
            </div>
        </div>

        <div class="p-6 space-y-4">
            <!-- Achievement Item 1 -->
            <div class="flex items-center space-x-4 p-4 bg-green-50 rounded-lg border border-green-200">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                    <span class="text-white text-2xl">📚</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900">Pembelajar Aktif</h3>
                    <p class="text-sm text-gray-600">Selesaikan 10 materi pembelajaran</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-green-600 font-medium">✓ Selesai</span>
                        <span class="text-xs text-gray-500 ml-2">15 Nov 2024</span>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-lg font-bold text-green-600">+50 XP</div>
                </div>
            </div>

            <!-- Achievement Item 2 -->
            <div class="flex items-center space-x-4 p-4 bg-green-50 rounded-lg border border-green-200">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center">
                    <span class="text-white text-2xl">🏆</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900">Quiz Master</h3>
                    <p class="text-sm text-gray-600">Lulus 5 quiz berturut-turut dengan nilai minimal 80</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-green-600 font-medium">✓ Selesai</span>
                        <span class="text-xs text-gray-500 ml-2">13 Nov 2024</span>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-lg font-bold text-green-600">+75 XP</div>
                </div>
            </div>

            <!-- Achievement Item 3 -->
            <div class="flex items-center space-x-4 p-4 bg-green-50 rounded-lg border border-green-200">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
                    <span class="text-white text-2xl">⭐</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900">Nilai Sempurna</h3>
                    <p class="text-sm text-gray-600">Raih nilai 100 dalam quiz apapun</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-green-600 font-medium">✓ Selesai</span>
                        <span class="text-xs text-gray-500 ml-2">8 Nov 2024</span>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-lg font-bold text-green-600">+100 XP</div>
                </div>
            </div>

            <!-- Achievement Item 4 -->
            <div class="flex items-center space-x-4 p-4 bg-green-50 rounded-lg border border-green-200">
                <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center">
                    <span class="text-white text-2xl">🎯</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900">Konsisten</h3>
                    <p class="text-sm text-gray-600">Login dan belajar selama 7 hari berturut-turut</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-green-600 font-medium">✓ Selesai</span>
                        <span class="text-xs text-gray-500 ml-2">5 Nov 2024</span>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-lg font-bold text-green-600">+60 XP</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Achievements -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Lencana Tersedia</h2>
                <span class="text-sm text-gray-500">9 lencana tersisa</span>
            </div>
        </div>

        <div class="p-6 space-y-4">
            <!-- Available Achievement 1 -->
            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <div class="w-16 h-16 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full flex items-center justify-center">
                    <span class="text-white text-2xl">🚀</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900">Pemimpin Masa Depan</h3>
                    <p class="text-sm text-gray-600">Selesaikan semua materi kepemimpinan</p>
                    <div class="flex items-center mt-2">
                        <div class="flex-1 max-w-xs">
                            <div class="flex justify-between text-xs text-gray-600 mb-1">
                                <span>Progress</span>
                                <span>3/5 materi</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 60%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-lg font-bold text-gray-400">+150 XP</div>
                </div>
            </div>

            <!-- Available Achievement 2 -->
            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <div class="w-16 h-16 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full flex items-center justify-center">
                    <span class="text-white text-2xl">🎖️</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900">Master Baris Berbaris</h3>
                    <p class="text-sm text-gray-600">Raih nilai minimal 90 di semua quiz baris berbaris</p>
                    <div class="flex items-center mt-2">
                        <div class="flex-1 max-w-xs">
                            <div class="flex justify-between text-xs text-gray-600 mb-1">
                                <span>Progress</span>
                                <span>2/4 quiz</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 50%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-lg font-bold text-gray-400">+200 XP</div>
                </div>
            </div>

            <!-- Available Achievement 3 -->
            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <div class="w-16 h-16 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full flex items-center justify-center">
                    <span class="text-white text-2xl">👑</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900">Top 3 Ranking</h3>
                    <p class="text-sm text-gray-600">Masuk ke 3 besar ranking kelas</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-blue-600 font-medium">Posisi saat ini: #3</span>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-lg font-bold text-gray-400">+300 XP</div>
                </div>
            </div>

            <!-- Available Achievement 4 -->
            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <div class="w-16 h-16 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full flex items-center justify-center">
                    <span class="text-white text-2xl">🔥</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900">Streak Champion</h3>
                    <p class="text-sm text-gray-600">Belajar selama 30 hari berturut-turut</p>
                    <div class="flex items-center mt-2">
                        <div class="flex-1 max-w-xs">
                            <div class="flex justify-between text-xs text-gray-600 mb-1">
                                <span>Progress</span>
                                <span>7/30 hari</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-orange-600 h-2 rounded-full" style="width: 23%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-lg font-bold text-gray-400">+500 XP</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection