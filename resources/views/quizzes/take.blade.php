@extends('template-modern')

@section('title', 'Kerjakan Quiz - ' . ($quiz->title ?? 'PASKIBRA Wira Purusa'))

@section('content')
<div class="space-y-8">
    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 px-8 py-10 text-white">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="space-y-4 max-w-3xl">
                    <p class="text-xs uppercase tracking-[0.45em] text-white/60">Quiz Resmi</p>
                    <h1 class="text-3xl font-bold leading-tight">{{ $quiz->title ?? 'Quiz Demo PASKIBRA' }}</h1>
                    @if(!empty($quiz->description))
                        <p class="text-white/85 text-base">{{ $quiz->description }}</p>
                    @endif
                </div>
                <div class="grid grid-cols-2 gap-4 text-sm text-white/90">
                    <div class="bg-white/10 rounded-2xl p-4">
                        <p class="text-white/60 text-xs uppercase">Durasi</p>
                        <p class="text-xl font-semibold">{{ $quiz->time_limit ?? 15 }} menit</p>
                    </div>
                    <div class="bg-white/10 rounded-2xl p-4">
                        <p class="text-white/60 text-xs uppercase">Skor kelulusan</p>
                        <p class="text-xl font-semibold">{{ $quiz->passing_score ?? 70 }}%</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-6 lg:p-8 space-y-4 text-sm text-gray-600">
            <p class="flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Jawab setiap pertanyaan sesuai instruksi. Klik tombol "Kumpulkan Jawaban" setelah selesai.
            </p>
            <p class="flex items-center gap-2">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Pastikan koneksi stabil. Jawaban akan tersimpan setelah Anda menekan tombol submit.
            </p>
        </div>
</div>

    @if(!empty($timerMeta))
        @php
            $initialSeconds = max(0, $timerMeta['remaining_seconds'] ?? 0);
            $initialMinutesDisplay = str_pad(intval(floor($initialSeconds / 60)), 2, '0', STR_PAD_LEFT);
            $initialSecondsDisplay = str_pad($initialSeconds % 60, 2, '0', STR_PAD_LEFT);
            $percent = ($timerMeta['total_seconds'] ?? 0) > 0
                ? max(0, min(100, ($timerMeta['remaining_seconds'] / $timerMeta['total_seconds']) * 100))
                : 100;
            $serverNowIso = isset($serverNow) ? $serverNow->toIso8601String() : now()->toIso8601String();
        @endphp
        <div
            id="quiz-timer-panel"
            data-quiz-timer="1"
            data-deadline="{{ $timerMeta['ends_at']->toIso8601String() }}"
            data-server-now="{{ $serverNowIso }}"
            data-total-seconds="{{ $timerMeta['total_seconds'] }}"
            data-form-id="quiz-answer-form"
            class="bg-white border border-orange-200 rounded-3xl shadow-sm p-6 flex flex-col gap-4"
        >
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-orange-500">Timer aktif</p>
                    <p class="text-4xl font-bold text-gray-900" data-timer-display>{{ $initialMinutesDisplay }}:{{ $initialSecondsDisplay }}</p>
                    <p class="text-sm text-gray-500 mt-1" data-timer-message>Waktu tersisa akan menghitung mundur secara real-time.</p>
                </div>
                <div class="text-sm text-gray-600 bg-orange-50 border border-orange-200 rounded-2xl px-5 py-3">
                    Jawaban akan dikumpulkan otomatis saat waktu habis. Tetap fokus dan pastikan koneksi stabil.
                </div>
            </div>
            <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                <div
                    data-timer-progress
                    class="h-2 bg-green-500 transition-all duration-300 ease-out"
                    style="width: {{ $percent }}%;"
                ></div>
            </div>
        </div>
    @endif

    <form method="POST" id="quiz-answer-form" action="{{ route('quizzes.submit', $quiz->id ?? 0) }}" class="space-y-6">
        @csrf
        @if(!empty($timerMeta))
            <input type="hidden" name="started_at" value="{{ $timerMeta['starts_at']->toIso8601String() }}">
            <input type="hidden" name="timer_ends_at" value="{{ $timerMeta['ends_at']->toIso8601String() }}">
        @endif
        @if(isset($questions) && $questions->count())
            @foreach($questions as $index => $question)
                <section class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 sm:p-8 space-y-5">
                    <header class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                        <div class="space-y-2">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-700">
                                Soal {{ $index + 1 }} dari {{ $questions->count() }}
                            </span>
                            <h2 class="text-xl font-semibold text-gray-900">{!! nl2br(e($question->question)) !!}</h2>
                        </div>
                        <div class="flex items-center gap-3 text-xs text-gray-500">
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-700 font-semibold">{{ ucfirst(str_replace('_', ' ', $question->type)) }}</span>
                            <span>•</span>
                            <span>{{ $question->points ?? 10 }} poin</span>
                        </div>
                    </header>

                    <div class="space-y-3">
                        @if(in_array($question->type, ['multiple_choice', 'true_false']) && $question->option_collection->count())
                            @foreach($question->option_collection as $option)
                                <label class="flex items-start gap-3 p-4 border border-gray-200 rounded-xl hover:border-blue-400 hover:bg-blue-50/40 transition-all">
                                    <input
                                        type="radio"
                                        class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500"
                                        name="answers[{{ $question->id }}]"
                                        value="{{ $option->value }}"
                                        required
                                    >
                                    <span class="text-sm text-gray-800">{{ $option->option_text }}</span>
                                </label>
                            @endforeach
                        @elseif($question->type === 'fill_blank')
                            <input
                                type="text"
                                name="answers[{{ $question->id }}]"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Tulis jawaban singkat Anda di sini"
                                required
                            >
                        @elseif($question->type === 'essay')
                            <textarea
                                name="answers[{{ $question->id }}]"
                                rows="6"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Tulis jawaban esai Anda di sini"
                                required
                            ></textarea>
                        @else
                            <input
                                type="text"
                                name="answers[{{ $question->id }}]"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Masukkan jawaban Anda"
                                required
                            >
                        @endif
                    </div>

                    @if(!empty($question->image))
                        <div class="rounded-xl overflow-hidden border border-gray-200">
                            <img src="{{ asset('storage/' . $question->image) }}" alt="Ilustrasi soal" class="w-full h-auto">
                        </div>
                    @endif
                </section>
            @endforeach

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white border border-gray-200 rounded-3xl shadow-sm p-6">
                <div class="text-sm text-gray-600">
                    Pastikan semua jawaban telah terisi sebelum mengumpulkan.
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('quizzes.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-semibold text-gray-600 rounded-lg hover:bg-gray-100">
                        Batalkan
                    </a>
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg shadow-sm">
                        Kumpulkan Jawaban
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </div>
            </div>
        @else
            <div class="bg-white border border-dashed border-gray-300 rounded-3xl p-12 text-center">
                <h2 class="text-xl font-semibold text-gray-900 mb-2">Pertanyaan belum disiapkan</h2>
                <p class="text-gray-600">Instruktur belum menambahkan soal untuk quiz ini. Silakan hubungi admin atau kembali lagi nanti.</p>
            </div>
        @endif
    </form>
</div>
@endsection

@if(!empty($timerMeta))
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (window.__QUIZ_TIMER_INITIALIZED__) {
                    return;
                }
                window.__QUIZ_TIMER_INITIALIZED__ = true;

                const timerElement = document.querySelector('[data-quiz-timer]');
                if (!timerElement) {
                    return;
                }

                const display = timerElement.querySelector('[data-timer-display]');
                const progress = timerElement.querySelector('[data-timer-progress]');
                const message = timerElement.querySelector('[data-timer-message]');
                const deadline = Date.parse(timerElement.dataset.deadline || '');
                const serverNow = Date.parse(timerElement.dataset.serverNow || '');
                const totalSeconds = parseInt(timerElement.dataset.totalSeconds || '0', 10);
                const formId = timerElement.dataset.formId || '';
                const form = document.getElementById(formId);

                if (!deadline || !serverNow || !form || !display) {
                    return;
                }

                const offset = Date.now() - serverNow;
                let autoSubmitted = false;

                const formatTime = (seconds) => {
                    const total = Math.max(0, seconds);
                    const mins = Math.floor(total / 60);
                    const secs = total % 60;
                    return `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
                };

                const updateTimer = () => {
                    const now = Date.now() - offset;
                    const remainingMs = deadline - now;
                    const remainingSeconds = Math.max(0, Math.floor(remainingMs / 1000));

                    display.textContent = formatTime(remainingSeconds);

                    if (progress && totalSeconds > 0) {
                        const percent = Math.max(0, Math.min(100, (remainingSeconds / totalSeconds) * 100));
                        progress.style.width = `${percent}%`;
                        progress.classList.toggle('bg-green-500', percent > 35);
                        progress.classList.toggle('bg-orange-500', percent <= 35 && percent > 15);
                        progress.classList.toggle('bg-red-500', percent <= 15);
                    }

                    if (remainingSeconds <= 0 && !autoSubmitted) {
                        autoSubmitted = true;
                        timerElement.classList.add('border-red-200', 'bg-red-50');
                        if (message) {
                            message.textContent = 'Waktu habis, jawaban sedang dikumpulkan otomatis...';
                        }
                        const flagInput = document.createElement('input');
                        flagInput.type = 'hidden';
                        flagInput.name = 'auto_submitted';
                        flagInput.value = '1';
                        form.appendChild(flagInput);
                        form.submit();
                        clearInterval(intervalId);
                    }
                };

                const intervalId = window.setInterval(updateTimer, 1000);
                updateTimer();
            });
        </script>
    @endpush
@endif
