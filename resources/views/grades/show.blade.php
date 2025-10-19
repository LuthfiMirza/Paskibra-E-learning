@extends('template-modern')

@section('title', 'Detail Nilai - ' . ($attempt->quiz->title ?? 'Quiz'))

@section('content')
@php
@endphp

<div class="space-y-8">
    <nav class="text-sm text-gray-500">
        <ol class="flex flex-wrap items-center gap-2">
            <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600">Dashboard</a></li>
            <li>/</li>
            <li><a href="{{ route('grades.index') }}" class="hover:text-blue-600">Laporan Nilai</a></li>
            <li>/</li>
            <li class="text-gray-700">{{ $attempt->quiz->title ?? 'Detail Attempt' }}</li>
        </ol>
    </nav>

    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-blue-900 via-indigo-800 to-purple-700 px-8 py-10 text-white">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="space-y-3 max-w-3xl">
                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold tracking-[0.35em] uppercase bg-white/10 border border-white/20 rounded-full">Hasil Attempt</span>
                    <h1 class="text-3xl font-bold leading-tight">{{ $attempt->quiz->title ?? 'Quiz' }}</h1>
                    <p class="text-white/80 text-sm">Attempt ke-{{ $attempt->attempt_number }} • {{ optional($attempt->completed_at)->format('d M Y • H:i') }}</p>
                </div>
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div class="rounded-2xl bg-white/10 px-6 py-4">
                        <p class="text-xs uppercase tracking-wide text-white/60">Nilai</p>
                        <p class="text-4xl font-bold {{ $attempt->is_passed ? 'text-green-200' : 'text-red-200' }}">{{ $attempt->score }}%</p>
                        <p class="text-xs uppercase tracking-wide {{ $attempt->is_passed ? 'text-green-200' : 'text-red-200' }}">{{ $attempt->is_passed ? 'Lulus' : 'Belum Lulus' }}</p>
                    </div>
                    <div class="rounded-2xl bg-white/10 px-6 py-4">
                        <p class="text-xs uppercase tracking-wide text-white/60">Jawaban benar</p>
                        <p class="text-4xl font-bold text-white">{{ $attempt->correct_answers }}</p>
                        <p class="text-xs text-white/70">dari {{ $attempt->total_questions }} soal</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 lg:p-8 space-y-6">
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Durasi Pengerjaan</p>
                    <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $attempt->time_taken ? gmdate('i \m\e\n\i\t s \d\e\t\i\k', $attempt->time_taken) : '-' }}</p>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Attempt ke</p>
                    <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $attempt->attempt_number }}</p>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Kategori</p>
                    <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $attempt->quiz->category_display ?? 'Umum' }}</p>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Passing Score</p>
                    <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $attempt->quiz->passing_score }}%</p>
                </div>
            </div>

            <section class="space-y-4">
                <header class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Rincian Pertanyaan</h2>
                    <span class="text-xs text-gray-500">Klik jawaban untuk melihat koreksi</span>
                </header>
                <div class="space-y-4">
                    @forelse($questionBreakdown as $index => $item)
                        @php
                            $question = $item['question'];
                            $answer = $item['answer'];
                        @endphp
                        <article class="border border-gray-200 rounded-2xl p-6">
                            <div class="flex items-start justify-between gap-4">
                                <div class="space-y-2">
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full {{ $item['is_correct'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        Soal {{ $index + 1 }} • {{ $item['is_correct'] ? 'Benar' : 'Salah' }}
                                    </span>
                                    <h3 class="text-base font-semibold text-gray-900">{!! nl2br(e($question->question)) !!}</h3>
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ ucfirst(str_replace('_', ' ', $question->type)) }} • {{ $question->points }} poin
                                </div>
                            </div>
                            <div class="mt-4 space-y-2 text-sm">
                                @if(in_array($question->type, ['multiple_choice', 'true_false']))
                                    <p class="text-gray-600">Jawaban Anda: <span class="font-semibold text-gray-900">{{ $answer?->selectedOption->option_text ?? $answer?->selected_answer ?? '-' }}</span></p>
                                    <p class="text-gray-600">Jawaban Benar: <span class="font-semibold text-gray-900">{{ optional($question->option_collection->firstWhere('is_correct', true))->option_text ?? collect($question->correct_answer)->join(', ') }}</span></p>
                                @else
                                    <p class="text-gray-600">Jawaban Anda:</p>
                                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-4 text-gray-800">{!! nl2br(e($answer?->selected_answer ?? '-')) !!}</div>
                                @endif
                            </div>
                            @if($question->explanation)
                                <div class="mt-4 rounded-2xl bg-blue-50 border border-blue-100 p-4 text-sm text-blue-900">
                                    <p class="font-semibold mb-1">Pembahasan</p>
                                    <p>{!! nl2br(e($question->explanation)) !!}</p>
                                </div>
                            @endif
                        </article>
                    @empty
                        <div class="text-sm text-gray-500">Tidak ada rincian pertanyaan untuk attempt ini.</div>
                    @endforelse
                </div>
            </section>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <a href="{{ route('grades.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-semibold text-gray-600 rounded-lg hover:bg-gray-100">Kembali ke laporan nilai</a>
                <div class="flex items-center gap-3">
                    <a href="{{ route('quizzes.show', $attempt->quiz_id) }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-blue-600 hover:text-blue-700">Kerjakan ulang quiz</a>
                    <a href="{{ route('quizzes.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg">Quiz lainnya</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
