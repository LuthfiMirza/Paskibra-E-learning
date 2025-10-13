@extends('template-modern')

@section('title', 'Riwayat Quiz - PASKIBRA WiraPurusa')

@section('content')
<div class="space-y-8">
    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-blue-800 via-indigo-700 to-purple-700 px-8 py-10 text-white">
            <h1 class="text-3xl font-bold leading-tight">Riwayat Pengerjaan Quiz</h1>
            <p class="text-white/80 text-sm mt-2">Semua attempt yang Anda kerjakan tercatat di sini lengkap dengan skor dan status kelulusan.</p>
        </div>
    </div>

    <section class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
        <header class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">Daftar Attempt</h2>
            <span class="text-xs text-gray-500">{{ $attempts->total() }} attempt</span>
        </header>
        <div class="divide-y divide-gray-100">
            @forelse($attempts as $attempt)
                <article class="px-6 py-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div class="flex-1 space-y-2">
                        <div class="flex flex-wrap items-center gap-2 text-xs uppercase tracking-wide text-gray-500">
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-700 font-semibold">{{ $attempt->quiz->category_display ?? 'Quiz' }}</span>
                            <span>{{ optional($attempt->completed_at)->format('d M Y • H:i') }}</span>
                            <span>•</span>
                            <span>Attempt ke-{{ $attempt->attempt_number }}</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $attempt->quiz->title ?? 'Quiz Tidak Dikenal' }}</h3>
                        <p class="text-sm text-gray-500">{{ $attempt->correct_answers }} benar dari {{ $attempt->total_questions }} soal</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-2xl font-bold {{ $attempt->is_passed ? 'text-green-600' : 'text-red-600' }}">{{ $attempt->score }}%</p>
                            <p class="text-xs text-gray-500">{{ $attempt->is_passed ? 'Lulus' : 'Belum lulus' }}</p>
                        </div>
                        <a href="{{ route('quizzes.result', $attempt->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-blue-600 hover:text-blue-700">Detail
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </article>
            @empty
                <div class="px-6 py-10 text-center text-sm text-gray-500">Belum ada attempt quiz.</div>
            @endforelse
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $attempts->links() }}
        </div>
    </section>
</div>
@endsection
