@extends('layouts.admin')

@section('title', 'Hasil Nilai Kuis')
@section('subtitle', 'Pantau skor peserta dan status kelulusan setiap attempt')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div class="rounded-3xl border border-slate-200 bg-white px-6 py-6 shadow-[0_25px_50px_-35px_rgba(15,23,42,0.35)] flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Rekap Nilai</p>
            <h1 class="mt-2 text-2xl font-semibold text-slate-900">Hasil Kuis Pengguna</h1>
            <p class="text-sm text-slate-500">Lihat attempt terbaru beserta nilai, status lulus, dan detail peserta.</p>
        </div>
        <div class="flex items-center gap-3 text-xs font-medium text-slate-500">
            <span class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-3 py-1 text-indigo-700">
                <span class="inline-block h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                {{ number_format($summary['average_score'] ?? 0, 1) }}% rata-rata
            </span>
            <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1 text-emerald-700">
                <span class="inline-block h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                {{ number_format($summary['pass_rate'] ?? 0, 1) }}% lulus
            </span>
        </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Attempt terekam</p>
            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($summary['total'] ?? 0) }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Rata-rata skor</p>
            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($summary['average_score'] ?? 0, 1) }}%</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Tingkat kelulusan</p>
            <p class="mt-2 text-3xl font-semibold text-emerald-600">{{ number_format($summary['pass_rate'] ?? 0, 1) }}%</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Attempt lulus</p>
            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ number_format($summary['passed'] ?? 0) }}</p>
        </div>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white shadow-[0_25px_45px_-35px_rgba(15,23,42,0.3)]">
        <div class="flex flex-col gap-3 border-b border-slate-200/70 px-6 py-5 text-sm text-slate-500 md:flex-row md:items-center md:justify-between">
            <p>Monitor nilai kuis untuk seluruh peserta beserta detail attempt.</p>
            <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                <span class="inline-block h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                Menampilkan {{ $attempts->total() }} data
            </span>
        </div>

        <div class="px-6 py-4 bg-slate-50 border-b border-slate-200/70">
            <form method="GET" class="grid gap-3 md:grid-cols-2 xl:grid-cols-6">
                <div class="xl:col-span-2">
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Cari</label>
                    <input type="search" name="search" value="{{ $filters['search'] ?? '' }}" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100" placeholder="Nama peserta atau judul kuis">
                </div>
                <div>
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Kuis</label>
                    <select name="quiz_id" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                        <option value="all" @selected(($filters['quiz_id'] ?? 'all') === 'all')>Semua</option>
                        @foreach($quizzes as $quiz)
                            <option value="{{ $quiz->id }}" @selected(($filters['quiz_id'] ?? 'all') == $quiz->id)>{{ $quiz->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Status</label>
                    <select name="status" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                        <option value="all" @selected(($filters['status'] ?? 'all') === 'all')>Semua</option>
                        <option value="passed" @selected(($filters['status'] ?? 'all') === 'passed')>Lulus</option>
                        <option value="failed" @selected(($filters['status'] ?? 'all') === 'failed')>Belum lulus</option>
                    </select>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Urutkan</label>
                    <select name="sort" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                        <option value="latest" @selected(($filters['sort'] ?? 'latest') === 'latest')>Terbaru</option>
                        <option value="highest" @selected(($filters['sort'] ?? 'latest') === 'highest')>Nilai tertinggi</option>
                        <option value="lowest" @selected(($filters['sort'] ?? 'latest') === 'lowest')>Nilai terendah</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-indigo-500/30 hover:bg-indigo-700">Terapkan</button>
                    <a href="{{ route('admin.quiz-results.index') }}" class="inline-flex items-center rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:border-indigo-200 hover:text-indigo-600">Reset</a>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-6 py-3">Peserta</th>
                        <th class="px-6 py-3">Kuis</th>
                        <th class="px-6 py-3">Nilai</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Selesai</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/80 bg-white">
                    @forelse($attempts as $attempt)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-900">{{ $attempt->user->name ?? 'Pengguna' }}</p>
                                <p class="text-xs text-slate-500">{{ $attempt->user->email ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-900">{{ $attempt->quiz->title ?? 'Quiz tidak tersedia' }}</p>
                                <p class="text-xs text-slate-500">
                                    {{ $attempt->quiz->category_display ?? $attempt->quiz->category ?? 'Kategori tidak diketahui' }}
                                    @if($attempt->quiz?->course)
                                        • {{ $attempt->quiz->course->title }}
                                    @endif
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                @php $scoreColor = $attempt->is_passed ? 'text-emerald-600' : 'text-rose-600'; @endphp
                                <p class="text-2xl font-bold {{ $scoreColor }}">{{ $attempt->score ?? 0 }}%</p>
                                <p class="text-xs text-slate-500">Attempt ke-{{ $attempt->attempt_number }} • {{ $attempt->correct_answers }}/{{ $attempt->total_questions }} benar</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-semibold {{ $attempt->is_passed ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $attempt->is_passed ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                    {{ $attempt->is_passed ? 'Lulus' : 'Belum lulus' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">
                                <p class="font-semibold">{{ optional($attempt->completed_at)->format('d M Y') ?? '—' }}</p>
                                <p class="text-xs text-slate-500">{{ optional($attempt->completed_at)?->format('H:i') }}</p>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.quiz-results.show', $attempt) }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 hover:border-indigo-200 hover:text-indigo-600">
                                    Detail
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-400">Belum ada attempt yang bisa ditampilkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-col gap-4 border-t border-slate-200 px-6 py-5 text-sm text-slate-500 md:flex-row md:items-center md:justify-between">
            <p>Menampilkan <span class="font-semibold text-slate-700">{{ $attempts->firstItem() }}-{{ $attempts->lastItem() }}</span> dari <span class="font-semibold text-slate-700">{{ $attempts->total() }}</span> attempt</p>
            {{ $attempts->onEachSide(1)->links() }}
        </div>
    </div>
</div>
@endsection
