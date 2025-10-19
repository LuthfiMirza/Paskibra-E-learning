@extends('layouts.dashboard')

@section('title')
    <span class="mr-3">👋</span>Selamat Datang, {{ auth()->user()->name }}!
@endsection

@section('subtitle', 'Semangat belajar! Mari tingkatkan kemampuan PASKIBRA Anda hari ini.')

@section('content')
<div class="space-y-8">
    <!-- Welcome Header with Time -->
    <div class="bg-slate-800 rounded-2xl p-8 text-white relative overflow-hidden border-l-4 border-blue-600">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 via-transparent to-purple-600/10"></div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-10 rounded-full -ml-24 -mb-24"></div>
        
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold mb-2 font-display">Selamat Belajar! 🎯</h2>
                    <p class="text-blue-100 text-lg">Mari tingkatkan kemampuan PASKIBRA Anda hari ini</p>
                </div>
                <div class="text-right">
                    <p class="text-blue-200 text-sm">Terakhir login:</p>
                    <p class="text-white font-semibold">Hari ini, {{ now()->format('H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modern Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: Materi Dipelajari -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-lg transition-all duration-300 hover-lift">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Materi Dipelajari</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['completed_courses'] }}<span class="text-sm text-gray-500">/{{ $availableCourses->count() }}</span></p>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        @php
                            $progress = $availableCourses->count() > 0 ? ($stats['completed_courses'] / $availableCourses->count()) * 100 : 0;
                        @endphp
                        <div class="bg-blue-600 h-2 rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
                    </div>
                    <span class="ml-2 text-sm text-gray-600">{{ number_format($progress, 0) }}%</span>
                </div>
            </div>
        </div>

        <!-- Card 2: Quiz Diselesaikan -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-lg transition-all duration-300 hover-lift">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Quiz Diselesaikan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['passed_quizzes'] }}<span class="text-sm text-gray-500">/{{ $stats['quiz_attempts'] }}</span></p>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        @php
                            $quizProgress = $stats['quiz_attempts'] > 0 ? ($stats['passed_quizzes'] / $stats['quiz_attempts']) * 100 : 0;
                        @endphp
                        <div class="bg-green-600 h-2 rounded-full transition-all duration-500" style="width: {{ $quizProgress }}%"></div>
                    </div>
                    <span class="ml-2 text-sm text-gray-600">{{ number_format($quizProgress, 0) }}%</span>
                </div>
            </div>
        </div>

        <!-- Card 3: Rata-rata Nilai -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-lg transition-all duration-300 hover-lift">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-lg">
                        <svg class="h-6 w-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Rata-rata Nilai</p>
                        <p class="text-2xl font-bold text-gray-900">87.5</p>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    ⭐ Sangat Baik
                </span>
            </div>
        </div>
    </div>

    <!-- Quick Actions Widget -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 font-display">🚀 Aksi Cepat</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <button class="flex flex-col items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-all duration-300 group hover-lift">
                <svg class="h-8 w-8 text-blue-600 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <span class="text-sm font-medium text-blue-900">Mulai Belajar</span>
            </button>
            
            <button class="flex flex-col items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-all duration-300 group hover-lift">
                <svg class="h-8 w-8 text-green-600 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm font-medium text-green-900">Kerjakan Quiz</span>
            </button>

            <button class="flex flex-col items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-all duration-300 group hover-lift">
                <svg class="h-8 w-8 text-yellow-600 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="text-sm font-medium text-yellow-900">Lihat Nilai</span>
            </button>

            <button class="flex flex-col items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-all duration-300 group hover-lift">
                <svg class="h-8 w-8 text-purple-600 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <span class="text-sm font-medium text-purple-900">Pencapaian</span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Available Courses -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Kursus Tersedia</h3>
                    <p class="text-sm text-gray-600">Pilih kursus untuk memulai pembelajaran</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse($availableCourses as $course)
                            <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                                <!-- Course Image -->
                                <div class="mb-4">
                                    @if($course->category === 'kepaskibraan')
                                        <img src="{{ asset('images/paskibra/kepaskibraan.svg') }}" alt="Kepaskibraan" class="w-full h-32 object-cover rounded-lg">
                                    @elseif($course->category === 'baris_berbaris')
                                        <img src="{{ asset('images/paskibra/baris-berbaris.svg') }}" alt="Baris Berbaris" class="w-full h-32 object-cover rounded-lg">
                                    @elseif($course->category === 'wawasan')
                                        <img src="{{ asset('images/paskibra/wawasan.svg') }}" alt="Wawasan Kebangsaan" class="w-full h-32 object-cover rounded-lg">
                                    @elseif($course->category === 'kepemimpinan')
                                        <img src="{{ asset('images/paskibra/kepemimpinan.svg') }}" alt="Kepemimpinan" class="w-full h-32 object-cover rounded-lg">
                                    @elseif($course->category === 'protokoler')
                                        <img src="{{ asset('images/paskibra/protokoler.svg') }}" alt="Protokoler" class="w-full h-32 object-cover rounded-lg">
                                    @else
                                        <div class="w-full h-32 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900 mb-2 text-lg">{{ $course->title }}</h4>
                                    <p class="text-sm text-gray-600 mb-3">{{ Str::limit($course->description, 100) }}</p>
                                    
                                    <!-- Course Info -->
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center space-x-3 text-xs text-gray-500">
                                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full font-medium">{{ $course->category_display }}</span>
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                </svg>
                                                {{ $course->lessons_count ?? $course->lessons->count() }} Pelajaran
                                            </span>
                                        </div>
                                        <div class="text-xs text-gray-500 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $course->duration_minutes }} menit
                                        </div>
                                    </div>
                                    
                                    <!-- Progress Bar -->
                                    <div class="mb-4">
                                        <div class="flex justify-between text-xs text-gray-600 mb-1">
                                            <span>Progress</span>
                                            <span>0%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full" style="width: 0%"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <button class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-3 px-4 rounded-lg text-sm font-semibold transition duration-200 transform hover:scale-105 shadow-md">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Mulai Belajar
                                    </span>
                                </button>
                            </div>
                        @empty
                            <div class="col-span-2 text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada kursus</h3>
                                <p class="mt-1 text-sm text-gray-500">Kursus akan segera tersedia.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Recent Activity Widget -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 font-display">📈 Aktivitas Terbaru</h3>
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-800 transition-colors">Lihat Semua</a>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 w-2 h-2 bg-blue-600 rounded-full mt-2"></div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">Menyelesaikan quiz <span class="font-medium">"Dasar Kepaskibraan"</span></p>
                            <p class="text-xs text-gray-500">2 jam yang lalu</p>
                        </div>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Nilai: 85
                        </span>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 w-2 h-2 bg-green-600 rounded-full mt-2"></div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">Menonton video <span class="font-medium">"Teknik Baris Berbaris"</span></p>
                            <p class="text-xs text-gray-500">5 jam yang lalu</p>
                        </div>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            Selesai
                        </span>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 w-2 h-2 bg-yellow-600 rounded-full mt-2"></div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">Mendapat achievement <span class="font-medium">"Pemula PASKIBRA"</span></p>
                            <p class="text-xs text-gray-500">1 hari yang lalu</p>
                        </div>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            🏆 +100 XP
                        </span>
                    </div>
                </div>
            </div>

            <!-- Recent Announcements -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 font-display">📢 Pengumuman Terbaru</h3>
                </div>
                <div class="p-6">
                    @forelse($recentAnnouncements as $announcement)
                        <div class="mb-4 last:mb-0 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    @if($announcement->type === 'urgent')
                                        <div class="w-3 h-3 bg-red-500 rounded-full mt-1 badge-pulse"></div>
                                    @elseif($announcement->type === 'important')
                                        <div class="w-3 h-3 bg-yellow-500 rounded-full mt-1"></div>
                                    @elseif($announcement->type === 'event')
                                        <div class="w-3 h-3 bg-green-500 rounded-full mt-1"></div>
                                    @else
                                        <div class="w-3 h-3 bg-blue-500 rounded-full mt-1"></div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900">{{ $announcement->title }}</h4>
                                    <p class="text-xs text-gray-600 mt-1">{{ Str::limit($announcement->content, 80) }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $announcement->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                            </svg>
                            <p class="text-sm text-gray-500 mt-2">Belum ada pengumuman.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Quizzes -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 font-display">🎯 Quiz Terbaru</h3>
                </div>
                <div class="p-6">
                    @forelse($recentQuizzes as $quiz)
                        <div class="mb-4 last:mb-0 p-3 rounded-lg border border-gray-100 hover:border-blue-200 hover:bg-blue-50 transition-all">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900">{{ $quiz->title }}</h4>
                                    <p class="text-xs text-gray-600 mt-1">{{ $quiz->course->title ?? 'Quiz Umum' }}</p>
                                    <div class="flex items-center mt-2 space-x-3">
                                        <span class="text-xs text-gray-500 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $quiz->time_limit }} menit
                                        </span>
                                        <span class="text-xs text-gray-500 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $quiz->questions->count() ?? 0 }} soal
                                        </span>
                                    </div>
                                </div>
                                <button class="ml-3 text-xs bg-green-100 text-green-800 px-3 py-2 rounded-lg hover:bg-green-200 transition-colors font-medium">
                                    Mulai
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-sm text-gray-500 mt-2">Belum ada quiz tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- My Achievements -->
            @if($myAchievements->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 font-display">🏆 Pencapaian Terbaru</h3>
                    </div>
                    <div class="p-6">
                        @foreach($myAchievements as $achievement)
                            <div class="mb-4 last:mb-0 p-3 rounded-lg bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-gray-900">{{ $achievement->name }}</h4>
                                        <p class="text-xs text-gray-600">{{ $achievement->description }}</p>
                                        <p class="text-xs text-yellow-700 font-medium mt-1">+{{ $achievement->points }} XP</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
