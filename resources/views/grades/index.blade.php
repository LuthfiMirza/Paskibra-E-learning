@extends('template-modern')

@section('title', 'Laporan Nilai - PASKIBRA WiraPurusa')

@section('content')
@php

    $scoreHistoryLabels = $scoreHistory->pluck('label');
    $scoreHistoryValues = $scoreHistory->pluck('score');
@endphp

<div class="space-y-8">
    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-yellow-500 via-orange-500 to-red-500 px-8 py-10 text-white">
            <div class="max-w-4xl space-y-4">
                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold tracking-[0.35em] uppercase bg-white/10 border border-white/20 rounded-full">Ringkasan Nilai</span>
                <h1 class="text-3xl font-bold leading-tight">Laporan Performa Pembelajaran Anda</h1>
                <p class="text-white/85 text-base">Pantau perkembangan hasil quiz yang telah Anda kerjakan. Nilai dan status kelulusan akan diperbarui otomatis setelah setiap attempt.</p>
            </div>
        </div>
        <div class="p-6 lg:p-8">
            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-2xl border border-gray-200 bg-white p-5">
                    <p class="text-sm text-gray-500">Attempt Selesai</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_attempts'] }}</p>
                    <p class="text-xs text-gray-500 mt-2">{{ $stats['passed_attempts'] }} lulus • {{ $stats['failed_attempts'] }} belum lulus</p>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-white p-5">
                    <p class="text-sm text-gray-500">Nilai Rata-rata</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['average_score'] }}%</p>
                    <p class="text-xs text-gray-500 mt-2">Nilai tertinggi {{ $stats['best_score'] }}%</p>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-white p-5">
                    <p class="text-sm text-gray-500">Terakhir Dikerjakan</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['latest_attempt_at'] ?? 'Belum ada' }}</p>
                    <p class="text-xs text-gray-500 mt-2">Riwayat terbaru tersimpan otomatis</p>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-white p-5">
                    <p class="text-sm text-gray-500">Kategori Quiz</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $categorySummary->count() }}</p>
                    <p class="text-xs text-gray-500 mt-2">Rata-rata: {{ $categorySummary->avg('average') ? number_format($categorySummary->avg('average'), 1) : 0 }}%</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">Grafik Perkembangan Nilai</h2>
            <span class="text-xs text-gray-500">Data berdasarkan attempt terakhir</span>
        </div>
        <div class="p-6">
            @if($scoreHistory->count())
                <canvas id="scoreHistoryChart" class="w-full h-64"></canvas>
            @else
                <div class="border border-dashed border-gray-300 rounded-2xl p-10 text-center text-sm text-gray-500">
                    Belum ada data quiz yang dapat ditampilkan.
                </div>
            @endif
        </div>
    </div>

    <div class="grid gap-8 lg:grid-cols-[2fr,1fr]">
        <section class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">Riwayat Attempt Quiz</h2>
                <a href="{{ route('quizzes.history') }}" class="text-sm text-blue-600 hover:text-blue-700">Lihat semua</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($attempts as $attempt)
                    <article class="px-6 py-5 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div class="flex-1 space-y-1">
                            <div class="flex flex-wrap items-center gap-2 text-xs text-gray-500 uppercase tracking-wide">
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-700 font-semibold">{{ $attempt->quiz->category_display ?? 'Quiz' }}</span>
                                <span>{{ optional($attempt->completed_at)->format('d M Y • H:i') }}</span>
                                <span>•</span>
                                <span>{{ $attempt->total_questions }} soal</span>
                            </div>
                            <h3 class="text-base font-semibold text-gray-900">{{ $attempt->quiz->title ?? 'Quiz Tidak Dikenal' }}</h3>
                            <p class="text-sm text-gray-500">Attempt ke-{{ $attempt->attempt_number }} • {{ $attempt->correct_answers }} benar dari {{ $attempt->total_questions }}</p>
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
                    <div class="px-6 py-12 text-center text-sm text-gray-500">
                        Belum ada attempt quiz yang tersimpan.
                    </div>
                @endforelse
            </div>
        </section>

        <aside class="space-y-6">
            <section class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-base font-semibold text-gray-900">Ringkasan per Kategori</h3>
                </div>
                <ul class="divide-y divide-gray-100">
                    @forelse($categorySummary as $category => $summary)
                        <li class="px-5 py-4 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-gray-900">{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $category)) }}</p>
                                <p class="text-xs text-gray-500">{{ $summary['count'] }} attempt • {{ $summary['passed'] }} lulus</p>
                            </div>
                            <span class="text-base font-semibold text-blue-600">{{ $summary['average'] }}%</span>
                        </li>
                    @empty
                        <li class="px-5 py-6 text-center text-sm text-gray-500">Belum ada data kategori.</li>
                    @endforelse
                </ul>
            </section>

            <section class="bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-800 text-white rounded-3xl shadow-lg p-6">
                <h3 class="text-lg font-semibold mb-2">Tips Meningkatkan Nilai</h3>
                <ul class="space-y-3 text-sm text-white/80">
                    <li class="flex items-start gap-2">
                        <span class="mt-0.5">•</span>
                        <span>Tinjau kembali materi sebelum mengulangi quiz untuk meningkatkan pemahaman.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-0.5">•</span>
                        <span>Fokus pada kategori dengan nilai rata-rata rendah terlebih dahulu.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-0.5">•</span>
                        <span>Diskusikan kesulitan dengan instruktur atau teman satu tim.</span>
                    </li>
                </ul>
            </section>
        </aside>
    </div>
</div>
@endsection

@push('scripts')
@if($scoreHistory->count())
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js" integrity="sha384-UBC94PPYUajF1iN5WaZ4XitUApVn9XzZvUVo1+wSJN0pA72fzQNH0nZX0hgqP/dV" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('scoreHistoryChart');
        if (!ctx) return;

        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($scoreHistoryLabels),
                datasets: [{
                    label: 'Skor (%)',
                    data: @json($scoreHistoryValues),
                    tension: 0.4,
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.12)',
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: '#1d4ed8',
                    pointBorderWidth: 0,
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 100,
                        ticks: {
                            stepSize: 10,
                        },
                        grid: {
                            color: '#e5e7eb',
                        },
                    },
                    x: {
                        grid: {
                            display: false,
                        },
                    },
                },
            },
        });
    });
</script>
@endif
@endpush
