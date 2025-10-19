@extends('layouts.admin')

@section('title', 'Laporan & Analitik')
@section('subtitle', 'Analisis menyeluruh terhadap aktivitas pengguna dan performa sistem')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <!-- Header -->
    <div class="rounded-3xl border border-slate-200 bg-white px-6 py-6 shadow-[0_25px_50px_-35px_rgba(15,23,42,0.35)] flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Panel Laporan</p>
            <h1 class="mt-2 text-2xl font-semibold text-slate-900">Laporan & Analitik</h1>
            <p class="text-sm text-slate-500">Gunakan laporan ini untuk melacak keterlibatan, performa kursus, dan kesehatan sistem.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <button class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5"/></svg>
                Export Laporan
            </button>
            <button class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-medium text-slate-600 hover:border-indigo-200 hover:text-indigo-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4m-9 4h10m-9 4h5"/></svg>
                Pilih Periode
            </button>
        </div>
    </div>

    <!-- Category quick links -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
        @php
            $sections = [
                ['title' => 'Aktivitas Pengguna', 'subtitle' => 'Engagement & interaksi', 'gradient' => 'from-sky-500 to-indigo-500', 'icon' => 'users'],
                ['title' => 'Performa Kursus', 'subtitle' => 'Penyelesaian & kualitas materi', 'gradient' => 'from-emerald-500 to-teal-500', 'icon' => 'book'],
                ['title' => 'Kesehatan Sistem', 'subtitle' => 'Status infrastruktur', 'gradient' => 'from-purple-500 to-fuchsia-500', 'icon' => 'pulse'],
            ];
        @endphp
        @foreach($sections as $section)
            <div class="rounded-3xl bg-gradient-to-r {{ $section['gradient'] }} p-6 text-white shadow-lg shadow-slate-900/20">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-white/80">{{ $section['subtitle'] }}</p>
                        <h3 class="mt-2 text-lg font-semibold">{{ $section['title'] }}</h3>
                    </div>
                    <span class="rounded-2xl bg-white/20 p-3">
                        @switch($section['icon'])
                            @case('users')
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11a4 4 0 118 0 4 4 0 01-8 0z"/></svg>
                                @break
                            @case('book')
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 19.5A2.5 2.5 0 016.5 17H20" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4.5A2.5 2.5 0 016.5 2H20v20H6.5A2.5 2.5 0 014 19.5V4.5z"/></svg>
                                @break
                            @case('pulse')
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h4l3 8 4-16 3 8h4"/></svg>
                                @break
                        @endswitch
                    </span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- User activity -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_25px_45px_-35px_rgba(15,23,42,0.3)]">
        <div class="mb-6 flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Aktivitas Pengguna</p>
                <h2 class="text-xl font-semibold text-slate-900">Pertumbuhan & engagement</h2>
            </div>
            <div class="flex items-center gap-3 text-xs font-medium text-emerald-600">
                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    {{ $reports['user_activity']['retention_rate'] ?? '0%' }} retention
                </span>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-4">
            <div class="rounded-2xl bg-sky-50 p-5 text-center">
                <div class="text-2xl font-semibold text-sky-600">{{ $reports['user_activity']['daily_active_users'] ?? 0 }}</div>
                <p class="text-xs text-slate-500">Aktif harian</p>
            </div>
            <div class="rounded-2xl bg-indigo-50 p-5 text-center">
                <div class="text-2xl font-semibold text-indigo-600">{{ $reports['user_activity']['weekly_active_users'] ?? 0 }}</div>
                <p class="text-xs text-slate-500">Aktif mingguan</p>
            </div>
            <div class="rounded-2xl bg-purple-50 p-5 text-center">
                <div class="text-2xl font-semibold text-purple-600">{{ $reports['user_activity']['monthly_active_users'] ?? 0 }}</div>
                <p class="text-xs text-slate-500">Aktif bulanan</p>
            </div>
            <div class="rounded-2xl bg-emerald-50 p-5 text-center">
                <div class="text-2xl font-semibold text-emerald-600">{{ $reports['user_activity']['completion_rate'] ?? 0 }}%</div>
                <p class="text-xs text-slate-500">Rasio penyelesaian</p>
            </div>
        </div>

        <div class="mt-8">
            <div class="rounded-2xl border border-slate-200 bg-slate-50/60 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Distribusi Aktivitas</h3>
                        <p class="text-xs text-slate-500">Perbandingan login, kuis, dan forum</p>
                    </div>
                </div>
                <div class="mt-4 grid gap-4 text-sm text-slate-600 md:grid-cols-3">
                    <div class="rounded-xl bg-white p-4 shadow-sm shadow-slate-900/5">
                        <p class="text-xs uppercase tracking-wide text-slate-400">Login Harian</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $reports['user_activity']['daily_logins'] ?? 0 }}</p>
                    </div>
                    <div class="rounded-xl bg-white p-4 shadow-sm shadow-slate-900/5">
                        <p class="text-xs uppercase tracking-wide text-slate-400">Kuis Diselesaikan</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $reports['user_activity']['quizzes_completed'] ?? 0 }}</p>
                    </div>
                    <div class="rounded-xl bg-white p-4 shadow-sm shadow-slate-900/5">
                        <p class="text-xs uppercase tracking-wide text-slate-400">Forum Aktif</p>
                        <p class="mt-2 text-lg font-semibold text-slate-900">{{ $reports['user_activity']['forum_posts'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course performance -->
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_25px_45px_-35px_rgba(15,23,42,0.3)] lg:col-span-2">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Performa Kursus</p>
                    <h2 class="text-xl font-semibold text-slate-900">Penyelesaian materi per kategori</h2>
                </div>
                <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-600">{{ $reports['course_performance']['avg_completion'] ?? 0 }}% rata-rata</span>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50/60 p-6">
                <p class="text-sm text-slate-500">Distribusi penyelesaian berdasarkan kategori kursus</p>
                <div class="mt-4 space-y-4">
                    @foreach(($reports['course_performance']['categories'] ?? []) as $category => $value)
                        <div>
                            <div class="flex items-center justify-between text-sm text-slate-600">
                                <span>{{ $category }}</span>
                                <span class="font-semibold text-slate-900">{{ $value }}%</span>
                            </div>
                            <div class="mt-2 h-2 rounded-full bg-slate-200">
                                <div class="h-full rounded-full bg-indigo-500" style="width: {{ $value }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_25px_45px_-35px_rgba(15,23,42,0.3)] space-y-6">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Instruktur Terbaik</p>
                <ul class="mt-4 space-y-3 text-sm text-slate-600">
                    @foreach(($reports['course_performance']['top_instructors'] ?? []) as $instructor)
                        <li class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-2">
                            <span>{{ $instructor['name'] }}</span>
                            <span class="font-semibold text-indigo-600">{{ $instructor['score'] }}%</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Kursus Populer</p>
                <ul class="mt-4 space-y-3 text-sm text-slate-600">
                    @foreach(($reports['course_performance']['popular_courses'] ?? []) as $course)
                        <li class="rounded-2xl border border-slate-200 px-4 py-2">
                            <div class="font-medium text-slate-900">{{ $course['title'] }}</div>
                            <div class="text-xs text-slate-500">{{ $course['enrolled'] }} peserta • {{ $course['completion'] }}% selesai</div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- System health -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_25px_45px_-35px_rgba(15,23,42,0.3)]">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Kesehatan Sistem</p>
                <h2 class="text-xl font-semibold text-slate-900">Ringkasan operasi server</h2>
            </div>
            <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-600">{{ $reports['system_health']['uptime'] ?? '100%' }} uptime</span>
        </div>
        <div class="grid gap-6 md:grid-cols-3">
            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-xs uppercase tracking-wide text-slate-400">Response Time</p>
                <p class="mt-2 text-lg font-semibold text-slate-900">{{ $reports['system_health']['response_time'] ?? '0ms' }}</p>
                <p class="text-xs text-slate-500">Rata-rata 24 jam terakhir</p>
            </div>
            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-xs uppercase tracking-wide text-slate-400">Penggunaan CPU</p>
                <p class="mt-2 text-lg font-semibold text-slate-900">{{ $reports['system_health']['cpu_usage'] ?? '0%' }}</p>
                <p class="text-xs text-slate-500">Batas aman &lt; 80%</p>
            </div>
            <div class="rounded-2xl bg-slate-50 p-4">
                <p class="text-xs uppercase tracking-wide text-slate-400">Penggunaan Memori</p>
                <p class="mt-2 text-lg font-semibold text-slate-900">{{ $reports['system_health']['memory_usage'] ?? '0%' }}</p>
                <p class="text-xs text-slate-500">Update realtime setiap 5 menit</p>
            </div>
        </div>
        <div class="mt-6 grid gap-6 md:grid-cols-2">
            <div class="rounded-2xl border border-slate-200 bg-slate-50/60 p-5">
                <h3 class="text-sm font-semibold text-slate-900">Daftar event sistem</h3>
                <ul class="mt-3 space-y-2 text-xs text-slate-500">
                    @foreach(($reports['system_health']['events'] ?? []) as $event)
                        <li class="rounded-lg bg-white px-3 py-2 flex items-center justify-between">
                            <span>{{ $event['message'] }}</span>
                            <span class="text-slate-400">{{ $event['time'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50/60 p-5">
                <h3 class="text-sm font-semibold text-slate-900">Isu yang perlu ditindak</h3>
                <ul class="mt-3 space-y-2 text-xs text-slate-500">
                    @foreach(($reports['system_health']['alerts'] ?? []) as $alert)
                        <li class="rounded-lg border border-rose-200 bg-rose-50 px-3 py-2 text-rose-600">
                            {{ $alert }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Export options -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_25px_45px_-35px_rgba(15,23,42,0.3)]">
        <h2 class="text-lg font-semibold text-slate-900">Export cepat</h2>
        <p class="text-sm text-slate-500">Pilih format laporan yang ingin diunduh.</p>
        <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-3">
            @php
                $exports = [
                    ['label' => 'PDF Ringkas', 'description' => 'Laporan siap presentasi', 'button' => 'Download PDF', 'color' => 'bg-rose-500 hover:bg-rose-600'],
                    ['label' => 'Spreadsheet Excel', 'description' => 'Analisis data lanjutan', 'button' => 'Download Excel', 'color' => 'bg-emerald-500 hover:bg-emerald-600'],
                    ['label' => 'CSV Mentah', 'description' => 'Integrasi BI & data warehouse', 'button' => 'Download CSV', 'color' => 'bg-indigo-500 hover:bg-indigo-600'],
                ];
            @endphp
            @foreach($exports as $export)
                <div class="rounded-2xl border border-slate-200 p-5 hover:border-indigo-200 hover:shadow-lg hover:shadow-indigo-500/10 transition">
                    <h3 class="text-base font-semibold text-slate-900">{{ $export['label'] }}</h3>
                    <p class="mt-2 text-sm text-slate-500">{{ $export['description'] }}</p>
                    <button class="mt-4 w-full rounded-2xl {{ $export['color'] }} px-4 py-2 text-sm font-medium text-white">{{ $export['button'] }}</button>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
