@extends('template-modern')

@section('title', 'Hasil Pencarian - PASKIBRA E-Learning')

@section('content')
<div class="space-y-10">
    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-blue-900 via-indigo-700 to-red-600 px-8 py-10 text-white">
            <div class="max-w-3xl space-y-4">
                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold tracking-[0.35em] uppercase bg-white/10 border border-white/20 rounded-full">Hasil Pencarian</span>
                <h1 class="text-3xl font-bold leading-tight">{{ $query !== '' ? 'Menampilkan pencarian untuk "'.$query.'"' : 'Cari Materi, Quiz, dan Pengumuman' }}</h1>
                <p class="text-white/80 text-base">Temukan materi, quiz, dan pengumuman terbaru di platform PASKIBRA Wira Purusa.</p>
            </div>
        </div>
        <div class="p-6 lg:p-8">
            <form action="{{ route('search') }}" method="GET" class="grid gap-4 lg:grid-cols-[2fr,auto]">
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </span>
                    <input type="search" name="q" value="{{ $query }}" placeholder="Cari materi, quiz, atau pengumuman" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-sm">Cari</button>
                </div>
            </form>
        </div>
    </div>

    @if($query === '')
        <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8 text-center text-gray-500">
            Masukkan kata kunci untuk memulai pencarian.
        </div>
    @else
        <div class="space-y-8">
            <section>
                <header class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Materi Pembelajaran</h2>
                    <a href="{{ route('courses.index', ['search' => $query]) }}" class="text-sm text-blue-600 hover:text-blue-700">Lihat semua</a>
                </header>
                @if($lessons->isEmpty())
                    <p class="text-sm text-gray-500">Tidak ada modul yang cocok.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($lessons as $lesson)
                            <a href="{{ route('courses.lesson', [$lesson->course, $lesson]) }}" class="bg-white border border-gray-200 rounded-2xl p-5 hover:shadow-lg transition-shadow">
                                <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $lesson->title }}</h3>
                                <p class="text-xs text-gray-500 mb-3">Bagian dari {{ optional($lesson->course)->title ?? 'Kursus' }}</p>
                                <p class="text-sm text-gray-600 line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($lesson->content), 120) }}</p>
                            </a>
                        @endforeach
                    </div>
                @endif
            </section>

            <section>
                <header class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Quiz</h2>
                    <a href="{{ route('quizzes.index', ['search' => $query]) }}" class="text-sm text-blue-600 hover:text-blue-700">Lihat semua</a>
                </header>
                @if($quizzes->isEmpty())
                    <p class="text-sm text-gray-500">Tidak ada quiz yang cocok.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($quizzes as $quiz)
                            <a href="{{ route('quizzes.show', $quiz) }}" class="bg-white border border-gray-200 rounded-2xl p-5 hover:shadow-lg transition-shadow">
                                <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $quiz->title }}</h3>
                                <p class="text-xs text-gray-500 mb-3">Kategori: {{ ucfirst($quiz->category_display ?? $quiz->category) }}</p>
                                <p class="text-sm text-gray-600 line-clamp-3">{{ \Illuminate\Support\Str::limit($quiz->description, 120) }}</p>
                            </a>
                        @endforeach
                    </div>
                @endif
            </section>

            <section>
                <header class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Pengumuman</h2>
                    <a href="{{ route('announcements.index', ['search' => $query]) }}" class="text-sm text-blue-600 hover:text-blue-700">Lihat semua</a>
                </header>
                @if($announcements->isEmpty())
                    <p class="text-sm text-gray-500">Tidak ada pengumuman yang cocok.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($announcements as $announcement)
                            <a href="{{ route('announcements.show', $announcement) }}" class="bg-white border border-gray-200 rounded-2xl p-5 hover:shadow-lg transition-shadow">
                                <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">{{ $announcement->title }}</h3>
                                <p class="text-xs text-gray-500 mb-3">Dipublikasikan {{ optional($announcement->published_at)->diffForHumans() }}</p>
                                <p class="text-sm text-gray-600 line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($announcement->content), 120) }}</p>
                            </a>
                        @endforeach
                    </div>
                @endif
            </section>
        </div>
    @endif
</div>
@endsection
