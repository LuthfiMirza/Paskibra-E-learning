@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle', 'Pantau performa platform e-learning PASKIBRA')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <!-- Metric overview -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">
        @php
            $metricCards = [
                [
                    'label' => 'Total Pengguna',
                    'value' => number_format($stats['total_users'] ?? 0),
                    'trend' => $trends['total_users'] ?? null,
                    'iconColor' => 'text-indigo-500',
                    'iconBg' => 'bg-indigo-100',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11a4 4 0 118 0 4 4 0 01-8 0z"/>',
                ],
                [
                    'label' => 'Total Kursus',
                    'value' => number_format($stats['total_courses'] ?? 0),
                    'trend' => $trends['total_courses'] ?? null,
                    'iconColor' => 'text-sky-500',
                    'iconBg' => 'bg-sky-100',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h6a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 7h4a2 2 0 012 2v11"/>',
                ],
                [
                    'label' => 'Pengguna Aktif Hari Ini',
                    'value' => number_format($stats['active_users_today'] ?? 0),
                    'trend' => $trends['active_users_today'] ?? null,
                    'iconColor' => 'text-amber-500',
                    'iconBg' => 'bg-amber-100',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
                ],
                [
                    'label' => 'Rata-rata Skor Kuis',
                    'value' => number_format($stats['average_quiz_score'] ?? 0, 1) . '%',
                    'trend' => $trends['average_quiz_score'] ?? null,
                    'iconColor' => 'text-emerald-500',
                    'iconBg' => 'bg-emerald-100',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                ],
            ];
        @endphp
        @foreach ($metricCards as $card)
            <div class="relative rounded-[26px] border border-slate-200 bg-white px-6 py-6 shadow-[0_30px_60px_-35px_rgba(15,23,42,0.35)]">
                <span class="absolute right-5 top-5 flex h-9 w-9 items-center justify-center rounded-2xl {{ $card['iconBg'] }} {{ $card['iconColor'] }} opacity-70">
                    <svg class="h-4.5 w-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $card['icon'] !!}</svg>
                </span>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">{{ $card['label'] }}</p>
                <div class="mt-4 flex flex-wrap items-center gap-3">
                    <p class="text-3xl font-semibold text-slate-900">{{ $card['value'] }}</p>
                    @php
                        $trend = $card['trend'] ?? null;
                        $trendDirection = $trend['direction'] ?? 'neutral';
                        $deltaText = $trend['formatted'] ?? '—';
                        $badgeClasses = match ($trendDirection) {
                            'up' => 'bg-emerald-50 text-emerald-600',
                            'down' => 'bg-rose-50 text-rose-600',
                            default => 'bg-slate-100 text-slate-500',
                        };
                        $trendIcon = match ($trendDirection) {
                            'down' => 'M19 14l-7 7m0 0l-7-7m7 7V3',
                            'neutral' => 'M4 12h16',
                            default => 'M5 10l7-7m0 0l7 7m-7-7v18',
                        };
                    @endphp
                    <span class="inline-flex items-center gap-1 rounded-full {{ $badgeClasses }} px-3 py-1 text-xs font-semibold">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $trendIcon }}"/>
                        </svg>
                        {{ $deltaText }}
                    </span>
                    <span class="text-xs font-medium text-slate-400">@lang('vs bulan lalu')</span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Analytics -->
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="rounded-[26px] border border-slate-200 bg-white p-6 shadow-[0_30px_60px_-35px_rgba(15,23,42,0.35)] lg:col-span-2">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Analitik</p>
                    <h3 class="text-xl font-semibold text-slate-900">Aktivitas pengguna {{ $filters['user_growth']['label'] ?? '30 hari terakhir' }}</h3>
                    <p class="text-xs text-slate-500">@lang('Pilih rentang waktu untuk melihat tren pertumbuhan pengguna.')</p>
                </div>
                <div class="flex rounded-full border border-slate-200 bg-slate-100/60 p-1 text-xs font-semibold text-slate-500">
                    @foreach ([
                        '12_months' => '12 bulan',
                        '30_days' => '30 hari',
                        '7_days' => '7 hari',
                        '24_hours' => '24 jam',
                    ] as $filter => $label)
                        <a href="{{ request()->fullUrlWithQuery(['growth_range' => $filter]) }}" class="rounded-full px-3 py-1 {{ ($filters['user_growth']['active'] ?? '12_months') === $filter ? 'bg-white text-slate-900 shadow-sm' : 'hover:text-slate-900' }}">{{ $label }}</a>
                    @endforeach
                </div>
            </div>
            <div class="mt-6 h-[320px]">
                <canvas id="userGrowthChart"></canvas>
            </div>
        </div>
        <div class="rounded-[26px] border border-slate-200 bg-white p-6 shadow-[0_30px_60px_-35px_rgba(15,23,42,0.35)]">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Kinerja Kuis</p>
                    <h3 class="text-xl font-semibold text-slate-900">Perbandingan skor rata-rata</h3>
                </div>
                <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-600">+8% lulus</span>
            </div>
            <div class="mt-6 h-[280px]">
                <canvas id="quizPerformanceChart"></canvas>
            </div>
            <div class="mt-6 space-y-2 text-xs text-slate-500">
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-2"><span class="inline-flex h-2.5 w-2.5 rounded-full bg-emerald-500"></span> Tingkat kelulusan</span>
                    <span class="font-semibold text-slate-900">{{ number_format($stats['pass_rate'] ?? 0, 1) }}%</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-2"><span class="inline-flex h-2.5 w-2.5 rounded-full bg-indigo-500"></span> Skor rata-rata</span>
                    <span class="font-semibold text-slate-900">{{ number_format($stats['average_quiz_score'] ?? 0, 1) }}%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent activity -->
    <div class="rounded-[26px] border border-slate-200 bg-white shadow-[0_30px_60px_-35px_rgba(15,23,42,0.35)]">
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-200/80 px-6 py-5">
            <div>
                <h3 class="text-lg font-semibold text-slate-900">Aktivitas Terbaru</h3>
                <p class="text-xs text-slate-500">Log aktivitas penting dalam 24 jam terakhir</p>
            </div>
            <div class="flex items-center gap-3 text-xs font-semibold text-slate-500">
                <div class="relative">
                    <input type="search" placeholder="Cari aktivitas" class="h-10 rounded-2xl border border-slate-200 bg-slate-50 pl-10 pr-4 text-sm text-slate-600 placeholder:text-slate-400 focus:border-indigo-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100" />
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </span>
                </div>
                <button class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-xs font-medium hover:border-indigo-200 hover:text-indigo-600">Filter</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-6 py-3">
                            <label class="flex items-center gap-3 text-slate-400">
                                <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-indigo-500 focus:ring-indigo-200">
                                Aktivitas
                            </label>
                        </th>
                        <th class="px-6 py-3">Detail</th>
                        <th class="px-6 py-3 text-right">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/80 bg-white">
                    @forelse($recentActivities as $activity)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-indigo-500 focus:ring-indigo-200">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-500">
                                        @switch($activity['type'])
                                            @case('user_registration')
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                                @break
                                            @case('quiz_completed')
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                @break
                                            @default
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                        @endswitch
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-900">{{ $activity['user'] }}</p>
                                        <p class="text-xs text-slate-500">{{ $activity['action'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ $activity['meta'] ?? 'Aktivitas sistem' }}</td>
                            <td class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">{{ \Carbon\Carbon::parse($activity['timestamp'])->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-16 text-center text-slate-400">Tidak ada aktivitas terbaru saat ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userGrowthCtx = document.getElementById('userGrowthChart');
        if (userGrowthCtx) {
            new Chart(userGrowthCtx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: @json($userGrowth['labels'] ?? []),
                    datasets: [{
                        label: 'Pertumbuhan Pengguna',
                        data: @json($userGrowth['data'] ?? []),
                        borderColor: '#4f46e5',
                        backgroundColor: 'rgba(79, 70, 229, 0.12)',
                        borderWidth: 3,
                        tension: 0.45,
                        fill: true,
                        pointRadius: 3,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#4f46e5',
                        pointBorderColor: '#fff',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#94a3b8',
                                font: { size: 11 }
                            },
                            grid: {
                                color: 'rgba(148, 163, 184, 0.15)',
                                drawBorder: false
                            }
                        },
                        x: {
                            ticks: {
                                color: '#94a3b8',
                                font: { size: 11 }
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            borderColor: '#4f46e5',
                            borderWidth: 1,
                            padding: 10,
                            titleFont: { size: 12 },
                            bodyFont: { size: 12 }
                        }
                    }
                }
            });
        }

        const quizPerformanceCtx = document.getElementById('quizPerformanceChart');
        if (quizPerformanceCtx) {
            new Chart(quizPerformanceCtx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: @json($quizPerformance['labels'] ?? []),
                    datasets: [{
                        label: 'Rata-rata Skor',
                        data: @json($quizPerformance['data'] ?? []),
                        backgroundColor: 'rgba(16, 185, 129, 0.9)',
                        borderRadius: 10,
                        maxBarThickness: 26,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                color: '#94a3b8',
                                font: { size: 11 }
                            },
                            grid: {
                                color: 'rgba(148, 163, 184, 0.15)',
                                drawBorder: false
                            }
                        },
                        x: {
                            ticks: {
                                color: '#94a3b8',
                                font: { size: 11 }
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            padding: 10,
                            titleFont: { size: 12 },
                            bodyFont: { size: 12 }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush

