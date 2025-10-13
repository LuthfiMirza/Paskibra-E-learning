@extends('template-modern')

@section('title', $lesson->title . ' - ' . $course->title)

@section('content')
@php

    $contentTypeLabels = [
        'text' => 'Materi Teks',
        'video' => 'Materi Video',
        'audio' => 'Materi Audio',
        'pdf' => 'Materi PDF',
        'interactive' => 'Materi Interaktif',
    ];
@endphp

<div class="grid gap-6 lg:grid-cols-[2fr,1fr]">
    <article class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
        <header class="px-6 sm:px-10 py-8 border-b border-gray-200 bg-gradient-to-r from-blue-900 via-indigo-700 to-blue-600 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <p class="text-xs uppercase tracking-[0.45em] text-white/60 mb-2">Modul {{ $currentIndex + 1 }} dari {{ $lessons->count() }}</p>
                    <h1 class="text-3xl font-bold leading-tight">{{ $lesson->title }}</h1>
                    <p class="text-sm text-white/70 mt-2">Bagian dari kursus <span class="font-semibold text-white">{{ $course->title }}</span></p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-center">
                        <p class="text-white/60 text-xs uppercase">Durasi</p>
                        <p class="text-lg font-semibold">{{ $lesson->duration_minutes }} menit</p>
                    </div>
                    <div class="text-center">
                        <p class="text-white/60 text-xs uppercase">Jenis Materi</p>
                        <p class="text-lg font-semibold">{{ $contentTypeLabels[$lesson->content_type] ?? ucfirst($lesson->content_type) }}</p>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-6 sm:p-10 space-y-8">
            <section class="space-y-4">
                @if($lesson->content_type === 'video' && $lesson->file_path)
                    <div class="aspect-video rounded-2xl overflow-hidden bg-black">
                        <video class="w-full h-full" controls>
                            <source src="{{ asset('storage/' . $lesson->file_path) }}" type="video/mp4">
                            Browser Anda tidak mendukung pemutar video.
                        </video>
                    </div>
                @elseif($lesson->content_type === 'audio' && $lesson->file_path)
                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-6">
                        <audio controls class="w-full">
                            <source src="{{ asset('storage/' . $lesson->file_path) }}" type="audio/mpeg">
                            Browser Anda tidak mendukung pemutar audio.
                        </audio>
                    </div>
                @elseif($lesson->content_type === 'pdf' && $lesson->file_path)
                    <iframe src="{{ asset('storage/' . $lesson->file_path) }}" class="w-full min-h-[600px] border border-gray-200 rounded-2xl"></iframe>
                @elseif($lesson->content_type === 'interactive')
                    <div class="rounded-2xl border border-dashed border-blue-300 bg-blue-50 p-8 text-center">
                        <h2 class="text-lg font-semibold text-blue-900 mb-2">Materi Interaktif</h2>
                        <p class="text-sm text-blue-700">Konten interaktif akan dibuka oleh instruktur pada sesi praktik. Ikuti instruksi yang diberikan untuk pengalaman terbaik.</p>
                    </div>
                @endif

                <div class="prose max-w-none text-gray-800 leading-relaxed">
                    {!! nl2br(e($lesson->content)) !!}
                </div>
            </section>

            <section class="rounded-2xl border border-gray-200 bg-gray-50 p-6">
                <h2 class="text-base font-semibold text-gray-900 mb-3">Tujuan Pembelajaran</h2>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3 text-sm text-gray-700">
                        <span class="mt-0.5 text-blue-600">•</span>
                        <span>Menguasai materi "{{ $lesson->title }}" sebagai bagian dari kurikulum PASKIBRA WiraPurusa.</span>
                    </li>
                    <li class="flex items-start gap-3 text-sm text-gray-700">
                        <span class="mt-0.5 text-blue-600">•</span>
                        <span>Menerapkan teori pada latihan praktik dan evaluasi berkala.</span>
                    </li>
                    <li class="flex items-start gap-3 text-sm text-gray-700">
                        <span class="mt-0.5 text-blue-600">•</span>
                        <span>Menyiapkan diri untuk mengikuti quiz evaluasi terkait materi ini.</span>
                    </li>
                </ul>
            </section>

            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-3 text-sm text-gray-500">
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-semibold">Modul {{ $currentIndex + 1 }}</span>
                    @if($lesson->content_type === 'video')
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-purple-100 text-purple-700 font-semibold">Video</span>
                    @endif
                </div>
                <div class="flex items-center gap-3">
                    @if($previousLesson)
                        <a href="{{ route('courses.lesson', [$course, $previousLesson]) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-100">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Sebelumnya
                        </a>
                    @endif
                    @if($nextLesson)
                        <a href="{{ route('courses.lesson', [$course, $nextLesson]) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg">
                            Selanjutnya
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @elseif($lessons->isNotEmpty())
                        <a href="{{ route('quizzes.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg">
                            Ikuti Quiz
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </article>

    <aside class="space-y-6">
        <section class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
            <header class="px-5 py-4 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-base font-semibold text-gray-900">Navigasi Modul</h2>
                <span class="text-xs text-gray-500">{{ $lessons->count() }} modul</span>
            </header>
            <div class="divide-y divide-gray-100">
                @foreach($lessons as $index => $item)
                    <a href="{{ route('courses.lesson', [$course, $item]) }}" class="flex items-start gap-4 px-5 py-4 hover:bg-gray-50 transition-colors {{ $item->id === $lesson->id ? 'bg-blue-50 border-l-4 border-blue-500' : '' }}">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center text-sm font-semibold {{ $item->id === $lesson->id ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600' }}">
                            {{ $index + 1 }}
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm font-semibold text-gray-900">{{ $item->title }}</h3>
                            <p class="text-xs text-gray-500">{{ $item->duration_minutes }} menit • {{ ucfirst($item->content_type) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-800 text-white rounded-3xl shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-2">Tips Penyelesaian</h3>
            <ul class="space-y-3 text-sm text-white/80">
                <li class="flex items-start gap-2">
                    <span class="mt-0.5">•</span>
                    <span>Baca materi sampai akhir sebelum lanjut ke modul berikutnya.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="mt-0.5">•</span>
                    <span>Catat poin penting untuk memudahkan saat mengikuti quiz.</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="mt-0.5">•</span>
                    <span>Diskusikan dengan teman atau instruktur jika ada bagian yang belum dipahami.</span>
                </li>
            </ul>
        </section>
    </aside>
</div>
@endsection
