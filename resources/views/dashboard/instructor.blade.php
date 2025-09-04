@extends('layouts.dashboard')

@section('title', 'Dashboard Instructor')
@section('subtitle', 'Selamat datang, ' . auth()->user()->name . '! Kelola kursus dan pantau progress siswa.')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Kursus Saya</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['my_courses'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Quiz Saya</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['my_quizzes'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Siswa</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_students'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Quiz Hari Ini</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['quiz_attempts_today'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- My Courses -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Kursus Saya</h3>
                    <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">Tambah Kursus</button>
                </div>
            </div>
            <div class="p-6">
                @forelse($myCourses as $course)
                    <div class="mb-4 last:mb-0 p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition duration-200">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900 mb-1">{{ $course->title }}</h4>
                                <p class="text-sm text-gray-600 mb-2">{{ Str::limit($course->description, 100) }}</p>
                                <div class="flex items-center space-x-4 text-xs text-gray-500">
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ $course->category_display }}</span>
                                    <span>{{ $course->lessons->count() }} Pelajaran</span>
                                    <span>{{ $course->duration_minutes }} menit</span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded hover:bg-blue-200 transition duration-200">
                                    Edit
                                </button>
                                <button class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded hover:bg-green-200 transition duration-200">
                                    Lihat
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada kursus</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat kursus pertama Anda.</p>
                        <button class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                            Buat Kursus
                        </button>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Quiz Attempts -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Aktivitas Quiz Terbaru</h3>
                    <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</button>
                </div>
            </div>
            <div class="p-6">
                @forelse($recentQuizAttempts as $attempt)
                    <div class="mb-4 last:mb-0 p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition duration-200">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900">{{ $attempt->quiz->title }}</h4>
                                <p class="text-sm text-gray-600">{{ $attempt->user->name }}</p>
                                <div class="flex items-center space-x-4 mt-2">
                                    <span class="text-xs text-gray-500">{{ $attempt->created_at->diffForHumans() }}</span>
                                    @if($attempt->is_passed)
                                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Lulus</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Tidak Lulus</span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-gray-900">{{ $attempt->score ?? 0 }}%</div>
                                <div class="text-xs text-gray-500">{{ $attempt->correct_answers }}/{{ $attempt->total_questions }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada aktivitas quiz</h3>
                        <p class="mt-1 text-sm text-gray-500">Aktivitas quiz dari kursus Anda akan muncul di sini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <button class="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition duration-200">
                    <div class="text-center">
                        <svg class="mx-auto h-8 w-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-900">Buat Kursus Baru</span>
                    </div>
                </button>

                <button class="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition duration-200">
                    <div class="text-center">
                        <svg class="mx-auto h-8 w-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-900">Buat Quiz</span>
                    </div>
                </button>

                <button class="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition duration-200">
                    <div class="text-center">
                        <svg class="mx-auto h-8 w-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-900">Lihat Laporan</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection