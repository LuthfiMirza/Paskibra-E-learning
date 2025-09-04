@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')
@section('subtitle', 'Selamat datang, ' . auth()->user()->name . '! Kelola platform PASKIBRA WiraPurusa.')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Pengguna</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Kursus</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_courses'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Quiz</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_quizzes'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Pengumuman</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_announcements'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Announcements -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Pengumuman Terbaru</h3>
                    <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</button>
                </div>
            </div>
            <div class="p-6">
                @forelse($recentAnnouncements as $announcement)
                    <div class="mb-4 last:mb-0 p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition duration-200">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    @if($announcement->type === 'urgent')
                                        <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Mendesak</span>
                                    @elseif($announcement->type === 'important')
                                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Penting</span>
                                    @elseif($announcement->type === 'event')
                                        <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Kegiatan</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Umum</span>
                                    @endif
                                    <span class="text-xs text-gray-500">{{ $announcement->created_at->diffForHumans() }}</span>
                                </div>
                                <h4 class="font-medium text-gray-900 mb-1">{{ $announcement->title }}</h4>
                                <p class="text-sm text-gray-600">{{ Str::limit($announcement->content, 120) }}</p>
                                <p class="text-xs text-gray-500 mt-2">Oleh: {{ $announcement->creator->name }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada pengumuman</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat pengumuman pertama.</p>
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
                        <p class="mt-1 text-sm text-gray-500">Aktivitas quiz akan muncul di sini.</p>
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <button class="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition duration-200">
                    <div class="text-center">
                        <svg class="mx-auto h-8 w-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-900">Kelola Pengguna</span>
                    </div>
                </button>

                <button class="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition duration-200">
                    <div class="text-center">
                        <svg class="mx-auto h-8 w-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-900">Tambah Kursus</span>
                    </div>
                </button>

                <button class="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-yellow-500 hover:bg-yellow-50 transition duration-200">
                    <div class="text-center">
                        <svg class="mx-auto h-8 w-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-900">Buat Pengumuman</span>
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