@extends('template-modern')

@section('title', 'Daftar Quiz - PASKIBRA E-Learning')

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
        <div class="bg-gradient-to-r from-indigo-900 via-blue-800 to-blue-600 px-8 py-10 text-white">
            <div class="max-w-3xl space-y-4">
                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold tracking-[0.35em] uppercase bg-white/10 border border-white/20 rounded-full">Evaluasi Pembelajaran</span>
                <h1 class="text-3xl font-bold leading-tight">Quiz Interaktif PASKIBRA WiraPurusa</h1>
                <p class="text-white/80 text-base">Kerjakan quiz untuk mengukur pemahaman Anda terhadap materi yang telah dipelajari. Hasil quiz akan tercatat otomatis dalam laporan nilai.</p>
            </div>
        </div>
        <div class="p-6 lg:p-8">
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5">
                    <p class="text-sm text-blue-700">Quiz aktif</p>
                    <p class="text-3xl font-bold text-blue-900 mt-1">{{ $quizzes->count() }}</p>
                    <p class="text-xs text-blue-600 mt-2">Siap dikerjakan kapan saja</p>
                </div>
                <div class="bg-green-50 border border-green-100 rounded-2xl p-5">
                    <p class="text-sm text-green-700">Quiz lulus</p>
                    <p class="text-3xl font-bold text-green-900 mt-1">{{ $userAttempts->where('is_passed', true)->count() }}</p>
                    <p class="text-xs text-green-600 mt-2">Dari {{ $userAttempts->count() }} attempt</p>
                </div>
                <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">
                    <p class="text-sm text-orange-700">Nilai tertinggi</p>
                    <p class="text-3xl font-bold text-orange-900 mt-1">{{ $userAttempts->max('score') ?? 0 }}%</p>
                    <p class="text-xs text-orange-600 mt-2">Pertahankan performa terbaik</p>
                </div>
                <div class="bg-purple-50 border border-purple-100 rounded-2xl p-5">
                    <p class="text-sm text-purple-700">Nilai rata-rata</p>
                    <p class="text-3xl font-bold text-purple-900 mt-1">{{ $userAttempts->avg('score') ? number_format($userAttempts->avg('score'), 1) : 0 }}%</p>
                    <p class="text-xs text-purple-600 mt-2">Dari seluruh attempt yang tersimpan</p>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Quiz Tersedia</h2>
                <p class="text-sm text-gray-500">Pilih quiz sesuai materi yang sedang Anda pelajari</p>
            </div>
            <a href="{{ route('quizzes.history') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-blue-600 hover:text-blue-700">
                Lihat riwayat quiz
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        @if($quizzes->count())
            <div class="space-y-6">
                @foreach($quizzes as $quiz)
                    @php
                        $attempt = $userAttempts->get($quiz->id);
                        $canRetake = $quiz->allow_retake;
                        $category = $categoryLabels[$quiz->category] ?? ucfirst(str_replace('_', ' ', $quiz->category));
                        $difficulty = $difficultyLabels[$quiz->difficulty] ?? ucfirst($quiz->difficulty);
                        $questionCount = $quiz->questions->count();
                    @endphp
                    <article class="bg-white border border-gray-200 rounded-3xl shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                        <div class="p-6 sm:p-8">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                                <div class="flex-1 space-y-4">
                                    <div class="flex flex-wrap items-center gap-3 text-xs uppercase tracking-wide text-gray-500">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-700 font-semibold">{{ $category }}</span>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-700 font-semibold">{{ $difficulty }}</span>
                                        <span>{{ $questionCount }} soal</span>
                                        <span>•</span>
                                        <span>Skor kelulusan {{ $quiz->passing_score }}%</span>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-semibold text-gray-900">{{ $quiz->title }}</h3>
                                        <p class="text-sm text-gray-600 mt-2 max-w-3xl">{{ \Illuminate\Support\Str::limit($quiz->description, 220) }}</p>
                                    </div>
                                    <dl class="grid gap-4 text-sm text-gray-500 sm:grid-cols-3 max-w-2xl">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <div>
                                                <dt>Durasi</dt>
                                                <dd class="text-gray-900 font-semibold">{{ $quiz->time_limit }} menit</dd>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                            </svg>
                                            <div>
                                                <dt>Max attempt</dt>
                                                <dd class="text-gray-900 font-semibold">{{ $quiz->max_attempts ?? 'Tanpa batas' }}</dd>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m4 6V6a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2h10" />
                                            </svg>
                                            <div>
                                                <dt>Status</dt>
                                                <dd class="text-gray-900 font-semibold">
                                                    @if($quiz->is_active && $quiz->published_at <= now())
                                                        Tersedia
                                                    @else
                                                        Segera hadir
                                                    @endif
                                                </dd>
                                            </div>
                                        </div>
                                    </dl>
                                </div>
                                <div class="w-full lg:w-[280px] bg-gray-50 border border-gray-200 rounded-2xl p-5 space-y-4">
                                    @if($attempt)
                                        <div class="space-y-2">
                                            <p class="text-xs uppercase tracking-wide text-gray-500">Attempt terakhir</p>
                                            <p class="text-3xl font-bold text-gray-900">{{ $attempt->score }}%</p>
                                            <p class="text-sm text-gray-500">{{ $attempt->correct_answers }} dari {{ $attempt->total_questions }} benar</p>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $attempt->is_passed ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $attempt->is_passed ? 'Lulus' : 'Belum lulus' }}
                                            </span>
                                        </div>
                                    @else
                                        <div class="space-y-2">
                                            <p class="text-xs uppercase tracking-wide text-gray-500">Belum ada attempt</p>
                                            <p class="text-sm text-gray-600">Kerjakan quiz ini untuk mendapatkan skor pertama Anda.</p>
                                        </div>
                                    @endif

                                    <div class="space-y-3">
                                        @if(!$quiz->is_active || $quiz->published_at > now())
                                            <span class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-semibold text-gray-500 bg-gray-100 rounded-lg">Belum dibuka</span>
                                        @else
                                            <a href="{{ route('quizzes.show', $quiz->id) }}" class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-semibold text-white rounded-lg {{ $attempt ? 'bg-blue-600 hover:bg-blue-700' : 'bg-green-600 hover:bg-green-700' }} transition-colors">
                                                {{ $attempt ? ($canRetake ? 'Kerjakan Lagi' : 'Lihat hasil') : 'Mulai Quiz' }}
                                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                            @if($attempt && !$canRetake)
                                                <a href="{{ route('quizzes.result', $attempt->id) }}" class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg">
                                                    Lihat hasil attempt
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="bg-white border border-dashed border-gray-300 rounded-3xl p-12 text-center">
                <div class="mx-auto w-16 h-16 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3 10 4-18 3 8h4" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada quiz untuk tingkatan ini</h3>
                <p class="text-gray-600 max-w-md mx-auto">Instruktur belum menerbitkan quiz baru untuk tingkatan belajar Anda. Silakan cek kembali nanti atau lanjutkan mempelajari materi yang tersedia.</p>
            </div>
        @endif
    </div>
</div>
@endsection
