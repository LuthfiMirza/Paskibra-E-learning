@extends('template-modern')

@section('title', $course->title . ' - PASKIBRA E-Learning')

@section('content')
@php

    $categoryLabels = [
        'kepaskibraan' => 'Dasar Kepaskibraan',
        'baris_berbaris' => 'Baris Berbaris',
        'wawasan' => 'Wawasan Kebangsaan',
        'kepemimpinan' => 'Kepemimpinan',
        'protokoler' => 'Protokoler',
    ];

    $difficultyLabels = [
        'umum' => 'Umum',
        'calon_paskibra' => 'Calon Paskibra',
        'wiramuda' => 'Wiramuda',
        'wiratama' => 'Wiratama',
        'instruktur_muda' => 'Instruktur Muda',
        'instruktur' => 'Instruktur',
    ];
@endphp

<div class="space-y-8">
    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
        <div class="bg-gradient-to-br from-blue-900 via-blue-700 to-indigo-600 px-8 py-10 text-white relative">
            <div class="absolute top-6 right-8 hidden md:block">
                <div class="w-28 h-28 rounded-3xl bg-white/10 backdrop-blur flex items-center justify-center text-3xl font-bold">
                    {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($course->title, 0, 2)) }}
                </div>
            </div>
            <div class="relative z-10 max-w-4xl space-y-6">
                <div class="inline-flex items-center px-3 py-1 text-xs font-semibold tracking-wider uppercase bg-white/10 border border-white/20 rounded-full">
                    {{ $categoryLabels[$course->category] ?? ucfirst(str_replace('_', ' ', $course->category)) }}
                </div>
                <h1 class="text-4xl font-bold leading-tight">{{ $course->title }}</h1>
                <p class="text-lg text-white/80 max-w-3xl">{{ $course->description }}</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-sm text-white/90">
                    <div class="flex items-center space-x-3">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/15">🎯</span>
                        <div>
                            <p class="text-white/60 text-xs uppercase tracking-wide">Tingkat</p>
                            <p class="font-semibold">{{ $difficultyLabels[$course->difficulty] ?? ucfirst($course->difficulty) }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/15">📚</span>
                        <div>
                            <p class="text-white/60 text-xs uppercase tracking-wide">Jumlah Modul</p>
                            <p class="font-semibold">{{ $lessons->count() }} modul</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/15">⏱️</span>
                        <div>
                            <p class="text-white/60 text-xs uppercase tracking-wide">Durasi</p>
                            <p class="font-semibold">{{ $course->duration_minutes }} menit</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/15">👤</span>
                        <div>
                            <p class="text-white/60 text-xs uppercase tracking-wide">Instruktur</p>
                            <p class="font-semibold">{{ optional($course->creator)->name ?? 'Instruktur PASKIBRA' }}</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-4 pt-4">
                    <a href="{{ route('courses.lesson', [$course, $lessons->first()]) }}" class="inline-flex items-center px-5 py-2.5 bg-white text-blue-900 font-semibold rounded-xl shadow-sm hover:-translate-y-[1px] transition-transform">
                        Mulai Belajar Sekarang
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a href="{{ route('quizzes.index') }}" class="inline-flex items-center px-4 py-2 border border-white/40 text-white rounded-xl backdrop-blur hover:bg-white/10">
                        Lihat Quiz Terkait
                    </a>
                </div>
            </div>
        </div>
        <div class="grid gap-8 p-6 lg:p-10 lg:grid-cols-[2fr,1fr]">
            <div class="space-y-6">
                <section class="bg-white border border-gray-200 rounded-2xl shadow-sm">
                    <header class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Daftar Modul</h2>
                            <p class="text-sm text-gray-500">Urutkan pembelajaran Anda sesuai alur yang direkomendasikan</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full">
                            {{ $lessons->count() }} modul
                        </span>
                    </header>
                    <div class="divide-y divide-gray-200">
                        @foreach($lessons as $lesson)
                            <article class="px-6 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div class="flex items-start sm:items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 font-semibold flex items-center justify-center">
                                        {{ $loop->iteration }}
                                    </div>
                                    <div>
                                        <h3 class="text-base font-semibold text-gray-900">{{ $lesson->title }}</h3>
                                        <p class="text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($lesson->content, 120) }}</p>
                                        <div class="flex items-center space-x-4 text-xs text-gray-400 mt-2">
                                            <span class="inline-flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20.25L7.5 17H4.5L7.35 14.625L6.75 11.25L9 13.125L11.25 11.25L10.65 14.625L13.5 17H10.5L9.75 17Z" />
                                                </svg>
                                                {{ ucfirst($lesson->content_type) }}
                                            </span>
                                            <span>•</span>
                                            <span>{{ $lesson->duration_minutes }} menit</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('courses.lesson', [$course, $lesson]) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors">
                                        Lihat Modul
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>

                <section class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-3">Tentang Kursus</h2>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Kursus ini dirancang untuk membantu anggota PASKIBRA memahami materi secara mendalam dengan pendekatan yang modern. Setiap modul dilengkapi dengan latihan dan contoh nyata untuk memudahkan pemahaman.
                    </p>
                    <ul class="mt-5 grid gap-3 sm:grid-cols-2">
                        <li class="flex items-center text-sm text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Materi disusun oleh instruktur bersertifikat
                        </li>
                        <li class="flex items-center text-sm text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Akses tanpa batas kapan saja
                        </li>
                        <li class="flex items-center text-sm text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Sertifikat penyelesaian otomatis
                        </li>
                        <li class="flex items-center text-sm text-gray-700">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Quiz evaluasi setelah materi selesai
                        </li>
                    </ul>
                </section>
            </div>

            <aside class="space-y-6">
                <section class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Progres Belajar</h2>
                    <div class="space-y-4">
                        <div>
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-2">
                                <span>Modul selesai</span>
                                <span class="font-semibold text-gray-900">0 / {{ $lessons->count() }}</span>
                            </div>
                            <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden">
                                <div class="bg-blue-600 h-full w-0 rounded-full"></div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">Progres akan diperbarui otomatis setelah Anda menyelesaikan modul.</p>
                    </div>
                </section>

                <section class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Rekomendasi Lainnya</h2>
                    <div class="space-y-4">
                        @forelse($relatedCourses as $related)
                            <div class="flex items-start gap-3">
                                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 font-semibold flex items-center justify-center">
                                    {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($related->title, 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <a href="{{ route('courses.show', $related) }}" class="font-semibold text-gray-900 hover:text-blue-600 transition-colors">{{ $related->title }}</a>
                                    <p class="text-xs text-gray-500">{{ \Illuminate\Support\Str::limit($related->description, 80) }}</p>
                                    <div class="mt-1 text-xs text-gray-400 flex items-center space-x-2">
                                        <span>{{ $related->lessons_count ?? $related->lessons()->count() }} modul</span>
                                        <span>•</span>
                                        <span>{{ $difficultyLabels[$related->difficulty] ?? ucfirst($related->difficulty) }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Belum ada rekomendasi kursus lain pada kategori ini.</p>
                        @endforelse
                    </div>
                </section>

                <section class="bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-800 text-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Siap untuk evaluasi?</h3>
                    <p class="text-sm text-white/70">Uji pemahaman Anda setelah menyelesaikan materi dengan mengerjakan quiz yang tersedia.</p>
                    <a href="{{ route('quizzes.index') }}" class="inline-flex items-center mt-4 px-4 py-2 bg-white text-blue-900 font-semibold rounded-lg">
                        Lihat Daftar Quiz
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </section>
            </aside>
        </div>
    </div>
</div>
@endsection
