@extends('template-modern')

@section('title', 'Hasil Quiz - ' . ($attempt->quiz->title ?? 'Quiz'))

@section('content')
@php
@endphp

<div class="space-y-8">
    <nav class="text-sm text-gray-500">
        <ol class="flex flex-wrap items-center gap-2">
            <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600">Dashboard</a></li>
            <li>/</li>
            <li><a href="{{ route('quizzes.index') }}" class="hover:text-blue-600">Quiz</a></li>
            <li>/</li>
            <li class="text-gray-700">{{ \Illuminate\Support\Str::limit($attempt->quiz->title ?? 'Hasil Quiz', 60) }}</li>
        </ol>
    </nav>

    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-green-500 via-emerald-500 to-teal-500 px-8 py-10 text-white">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="space-y-3 max-w-3xl">
                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold tracking-[0.35em] uppercase bg-white/15 border border-white/25 rounded-full">Hasil Quiz</span>
                    <h1 class="text-3xl font-bold leading-tight">{{ $attempt->quiz->title ?? 'Quiz' }}</h1>
                    <p class="text-white/80 text-sm">Attempt ke-{{ $attempt->attempt_number }} � {{ optional($attempt->completed_at)->format('d M Y � H:i') }}</p>
                </div>
                <div class="grid grid-cols-3 gap-3 text-center">
                    <div class="rounded-2xl bg-white/15 px-6 py-4">
                        <p class="text-xs uppercase tracking-wide text-white/70">Nilai</p>
                        <p class="text-3xl font-bold text-white">{{ $attempt->score }}%</p>
                    </div>
                    <div class="rounded-2xl bg-white/15 px-6 py-4">
                        <p class="text-xs uppercase tracking-wide text-white/70">Benar</p>
                        <p class="text-3xl font-bold text-white">{{ $attempt->correct_answers }}</p>
                    </div>
                    <div class="rounded-2xl bg-white/15 px-6 py-4">
                        <p class="text-xs uppercase tracking-wide text-white/70">Status</p>
                        <p class="text-sm font-semibold {{ $attempt->is_passed ? 'text-white' : 'text-red-100' }}">{{ $attempt->is_passed ? 'Lulus' : 'Belum Lulus' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 lg:p-10 space-y-6">
            <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5 text-sm">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Durasi</p>
                    <p class="text-lg font-semibold text-gray-900 mt-1">{{ $attempt->time_taken ? gmdate('i \m\e\n\i\t s \d\e\t\i\k', $attempt->time_taken) : '-' }}</p>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5 text-sm">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Soal</p>
                    <p class="text-lg font-semibold text-gray-900 mt-1">{{ $attempt->total_questions }} soal</p>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5 text-sm">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Kategori</p>
                    <p class="text-lg font-semibold text-gray-900 mt-1">{{ $attempt->quiz->category_display ?? 'Umum' }}</p>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-5 text-sm">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Passing Score</p>
                    <p class="text-lg font-semibold text-gray-900 mt-1">{{ $attempt->quiz->passing_score }}%</p>
                </div>
            </section>

            <section class="space-y-4">
                <header class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Pembahasan Soal</h2>
                    <span class="text-xs text-gray-500">{{ $attempt->quiz->questions->count() }} soal</span>
                </header>
                <div class="space-y-4">
                                        @foreach($attempt->quiz->questions as $index => $question)
                        @php
                            $answer = $attempt->getRelation('answers')->firstWhere('quiz_question_id', $question->id);
                            $isCorrect = $answer?->is_correct ?? false;
                            $correctOption = collect($question->option_collection ?? [])->firstWhere('is_correct', true);
                        @endphp
                        <article class="border border-gray-200 rounded-2xl p-6">
                            <div class="flex items-start justify-between gap-4">
                                <div class="space-y-2">
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full {{ $isCorrect ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">Soal {{ $index + 1 }}</span>
                                    <h3 class="text-base font-semibold text-gray-900">{!! nl2br(e($question->question)) !!}</h3>
                                </div>
                                <span class="text-xs text-gray-500">{{ ucfirst(str_replace('_', ' ', $question->type)) }} � {{ $question->points }} poin</span>
                            </div>
                            <div class="mt-4 space-y-2 text-sm">
                                <p class="text-gray-600">Jawaban Anda:</p>
                                <div class="bg-gray-50 border border-gray-200 rounded-xl p-3 text-gray-800">
                                    @if(in_array($question->type, ['multiple_choice', 'true_false']))
                                        {{ $answer?->selectedOption->option_text ?? $answer?->selected_answer ?? '-' }}
                                    @else
                                        {!! nl2br(e($answer?->selected_answer ?? '-')) !!}
                                    @endif
                                </div>
                                <p class="text-gray-600">Jawaban benar:</p>
                                <div class="bg-green-50 border border-green-200 rounded-xl p-3 text-green-900">
                                    @if(in_array($question->type, ['multiple_choice', 'true_false']))
                                        {{ $correctOption->option_text ?? collect($question->correct_answer)->join(', ') }}
                                    @else
                                        {{ collect($question->correct_answer)->join(', ') }}
                                    @endif
                                </div>
                            </div>
                            @if($question->explanation)
                                <div class="mt-4 rounded-xl bg-blue-50 border border-blue-100 p-4 text-sm text-blue-900">
                                    <p class="font-semibold mb-1">Pembahasan</p>
                                    <p>{!! nl2br(e($question->explanation)) !!}</p>
                                </div>
                            @endif
                        </article>
                    @endforeach
                </div>
            </section>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <a href="{{ route('quizzes.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-semibold text-gray-600 rounded-lg hover:bg-gray-100">Kembali ke daftar quiz</a>
                <div class="flex items-center gap-3">
                    <a href="{{ route('quizzes.show', $attempt->quiz_id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg">Kerjakan Lagi</a>
                    <a href="{{ route('grades.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-blue-600 hover:text-blue-700">Lihat laporan nilai</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
