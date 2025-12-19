@extends('layouts.admin')

@section('title', 'Detail Nilai Kuis')
@section('subtitle', 'Tinjau jawaban peserta dan status kelulusan')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.quiz-results.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-3 py-2 text-sm font-medium text-slate-600 hover:border-indigo-200 hover:text-indigo-600">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            Kembali
        </a>
        <span class="text-sm text-slate-500">Attempt #{{ $attempt->id }}</span>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white shadow-[0_25px_50px_-35px_rgba(15,23,42,0.35)] overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-800 via-blue-800 to-slate-900 px-6 py-6 text-white">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-white/70">Peserta</p>
                    <h1 class="mt-2 text-2xl font-semibold">{{ $attempt->user->name ?? 'Pengguna' }}</h1>
                    <p class="text-sm text-white/80">{{ $attempt->user->email ?? '-' }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-2xl border border-white/20 px-5 py-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-white/70">Kuis</p>
                    <h2 class="mt-1 text-xl font-semibold">{{ $attempt->quiz->title ?? 'Quiz tidak tersedia' }}</h2>
                    <p class="text-sm text-white/80">
                        {{ $attempt->quiz->category_display ?? $attempt->quiz->category ?? 'Kategori tidak diketahui' }}
                        @if($attempt->quiz?->course)
                            • {{ $attempt->quiz->course->title }}
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="grid gap-4 p-6 md:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Nilai</p>
                <p class="mt-2 text-3xl font-bold {{ $attempt->is_passed ? 'text-emerald-600' : 'text-rose-600' }}">{{ $attempt->score ?? 0 }}%</p>
                <p class="text-xs text-slate-500">Attempt ke-{{ $attempt->attempt_number }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Status</p>
                <div class="mt-2 inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold {{ $attempt->is_passed ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                    <span class="h-1.5 w-1.5 rounded-full {{ $attempt->is_passed ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                    {{ $attempt->is_passed ? 'Lulus' : 'Belum lulus' }}
                </div>
                <p class="mt-2 text-xs text-slate-500">Selesai {{ optional($attempt->completed_at)->format('d M Y H:i') ?? '—' }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Durasi</p>
                @php
                    $durationMinutes = $attempt->duration ?? 0;
                    $durationText = $durationMinutes > 0 ? $durationMinutes . ' menit' : ($attempt->time_taken ? round($attempt->time_taken / 60) . ' menit' : '—');
                @endphp
                <p class="mt-2 text-3xl font-bold text-slate-900">{{ $durationText }}</p>
                <p class="text-xs text-slate-500">{{ $attempt->total_questions }} soal</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Jawaban benar</p>
                <p class="mt-2 text-3xl font-bold text-slate-900">{{ $attempt->correct_answers }}/{{ $attempt->total_questions }}</p>
                <p class="text-xs text-slate-500">Passing grade {{ $attempt->quiz->passing_score ?? 0 }}%</p>
            </div>
        </div>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white shadow-[0_25px_50px_-35px_rgba(15,23,42,0.35)]">
        <div class="border-b border-slate-200 px-6 py-4 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-slate-900">Detail Jawaban</h3>
                <p class="text-sm text-slate-500">Breakdown per pertanyaan beserta jawaban benar.</p>
            </div>
            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">{{ $questionBreakdown->count() }} pertanyaan</span>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse($questionBreakdown as $item)
                @php
                    $question = $item['question'];
                    $answer = $item['answer'];
                    $optionCollection = $question->option_collection ?? collect();
                    $selectedValue = $item['selected_value'] ?? null;
                    $selectedLabel = $selectedValue;

                    if ($optionCollection->isNotEmpty()) {
                        $matchedOption = $optionCollection->first(function ($option) use ($selectedValue) {
                            return (string) $option->id === (string) $selectedValue || (string) $option->value === (string) $selectedValue;
                        });
                        $selectedLabel = $matchedOption->option_text ?? $selectedLabel;
                    }

                    $correctOptions = $optionCollection->where('is_correct', true);
                    if ($correctOptions->isNotEmpty()) {
                        $correctLabel = $correctOptions->pluck('option_text')->implode(', ');
                    } elseif (is_array($question->correct_answer) && !empty($question->correct_answer)) {
                        $correctLabel = collect($question->correct_answer)->implode(', ');
                    } else {
                        $fallbackCorrect = $question->options->firstWhere('is_correct', true);
                        $correctLabel = $fallbackCorrect->option_text ?? 'Belum diatur';
                    }
                @endphp
                <div class="px-6 py-5 space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-indigo-50 text-xs font-semibold text-indigo-600">{{ $loop->iteration }}</span>
                            <p class="font-semibold text-slate-900">{{ $question->question }}</p>
                        </div>
                        <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-semibold {{ $item['is_correct'] ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                            <span class="h-1.5 w-1.5 rounded-full {{ $item['is_correct'] ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                            {{ $item['is_correct'] ? 'Benar' : 'Salah' }}
                        </span>
                    </div>
                    <div class="grid gap-3 md:grid-cols-2">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Jawaban Peserta</p>
                            <p class="mt-1 text-sm text-slate-800">{{ $selectedLabel ?? 'Tidak dijawab' }}</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-white px-4 py-3">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Jawaban Benar</p>
                            <p class="mt-1 text-sm font-semibold text-slate-900">{{ $correctLabel }}</p>
                        </div>
                    </div>
                    @if(!empty($question->explanation))
                        <div class="rounded-2xl border border-amber-100 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                            <p class="font-semibold text-amber-900 mb-1">Pembahasan</p>
                            <p>{{ $question->explanation }}</p>
                        </div>
                    @endif
                </div>
            @empty
                <div class="px-6 py-10 text-center text-sm text-slate-500">Tidak ada data pertanyaan yang bisa ditampilkan.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
