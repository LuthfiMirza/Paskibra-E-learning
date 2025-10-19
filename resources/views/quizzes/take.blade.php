@extends('template-modern')

@section('title', 'Kerjakan Quiz - ' . ($quiz->title ?? 'PASKIBRA WiraPurusa'))

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

    <form method="POST" action="{{ route('quizzes.submit', $quiz->id ?? 0) }}" class="space-y-6">
        @csrf
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
