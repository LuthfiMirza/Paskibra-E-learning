@extends('layouts.admin')

@section('title', 'Kelola Kuis')
@section('subtitle', 'Pengaturan bank soal dan evaluasi pembelajaran')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div class="rounded-3xl border border-slate-200 bg-white px-6 py-6 shadow-[0_25px_50px_-35px_rgba(15,23,42,0.35)] flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Manajemen Kuis</p>
            <h1 class="mt-2 text-2xl font-semibold text-slate-900">Daftar Kuis</h1>
            <p class="text-sm text-slate-500">Kelola jadwal publikasi, tingkat kesulitan, dan pertanyaan kuis.</p>
        </div>
        <a href="{{ route('admin.quizzes.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5"/></svg>
            Kuis Baru
        </a>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white shadow-[0_25px_45px_-35px_rgba(15,23,42,0.3)]">
        @if(session('success'))
            <div class="border-b border-emerald-100 bg-emerald-50 px-6 py-3 text-sm font-medium text-emerald-600">{{ session('success') }}</div>
        @endif

        <div class="flex flex-col gap-3 border-b border-slate-200/70 px-6 py-5 text-sm text-slate-500 md:flex-row md:items-center md:justify-between">
            <p>Ringkasan kuis beserta status publikasi dan jumlah pertanyaan.</p>
            <div class="flex items-center gap-3 text-xs font-medium text-slate-500">
                <span class="inline-flex items-center gap-1 rounded-full bg-sky-50 px-3 py-1 text-sky-600">
                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-sky-500"></span>
                    @lang('Total kuis'): {{ number_format($quizzes->total()) }}
                </span>
                <span class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-3 py-1 text-indigo-600">
                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                    {{ number_format($quizzes->where('is_active', true)->count()) }} aktif halaman ini
                </span>
            </div>
        </div>

        <div class="px-6 py-4 bg-slate-50 border-b border-slate-200/70">
            <form method="GET" class="grid gap-3 md:grid-cols-2 xl:grid-cols-6">
                <div class="xl:col-span-2">
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Cari</label>
                    <input type="search" name="search" value="{{ $filters['search'] ?? '' }}" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100" placeholder="Cari kuis">
                </div>
                <div>
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Kategori</label>
                    <select name="category" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                        <option value="all" @selected(($filters['category'] ?? 'all') === 'all')>Semua</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" @selected(($filters['category'] ?? 'all') === $category)>{{ ucfirst(str_replace('_', ' ', $category)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Tingkat</label>
                    <select name="difficulty" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                        <option value="all" @selected(($filters['difficulty'] ?? 'all') === 'all')>Semua</option>
                        @foreach($difficulties as $key => $label)
                            <option value="{{ $key }}" @selected(($filters['difficulty'] ?? 'all') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Kursus</label>
                    <select name="course_id" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                        <option value="all" @selected(($filters['course_id'] ?? 'all') === 'all')>Semua</option>
                        @foreach($courseOptions as $course)
                            <option value="{{ $course->id }}" @selected(($filters['course_id'] ?? 'all') == $course->id)>{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Status</label>
                    <select name="status" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                        <option value="all" @selected(($filters['status'] ?? 'all') === 'all')>Semua</option>
                        <option value="active" @selected(($filters['status'] ?? 'all') === 'active')>Aktif</option>
                        <option value="inactive" @selected(($filters['status'] ?? 'all') === 'inactive')>Non-aktif</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-indigo-500/30 hover:bg-indigo-700">Terapkan</button>
                    <a href="{{ route('admin.quizzes.index') }}" class="inline-flex items-center rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:border-indigo-200 hover:text-indigo-600">Reset</a>
                </div>
            </form>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-6 py-3">Judul Kuis</th>
                        <th class="px-6 py-3">Kursus</th>
                        <th class="px-6 py-3">Pertanyaan</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/80 bg-white">
                    @forelse($quizzes as $quiz)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-900">{{ $quiz->title }}</p>
                                <p class="text-xs text-slate-500">{{ $quiz->category_display }} • {{ $quiz->difficulty_display }}</p>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ $quiz->course->title ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $quiz->questions->count() }} soal</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-semibold {{ $quiz->is_active ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $quiz->is_active ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                    {{ $quiz->is_active ? 'Aktif' : 'Non-aktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-3">
                                    <a href="{{ route('admin.quizzes.questions.index', $quiz) }}" class="inline-flex h-9 items-center gap-2 rounded-xl border border-slate-200 px-3 text-xs font-semibold text-slate-500 hover:border-indigo-200 hover:text-indigo-600">Pertanyaan</a>
                                    <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 text-slate-500 hover:border-indigo-200 hover:text-indigo-600" title="Edit">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.125l-2.685.77.77-2.685a4.5 4.5 0 011.125-1.897L16.862 4.487z" /></svg>
                                    </a>
                                    <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" data-confirm="Apakah Anda yakin ingin menghapus kuis ini?" class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-transparent bg-rose-50 text-rose-500 hover:bg-rose-100" title="Hapus">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12M10 11v6m4-6v6M9 7V5a1 1 0 011-1h4a1 1 0 011 1v2m2 0v12a2 2 0 01-2 2H8a2 2 0 01-2-2V7z" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-slate-400">Belum ada kuis yang dibuat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-col gap-4 border-t border-slate-200 px-6 py-5 text-sm text-slate-500 md:flex-row md:items-center md:justify-between">
            <p>Menampilkan <span class="font-semibold text-slate-700">{{ $quizzes->firstItem() }}-{{ $quizzes->lastItem() }}</span> dari <span class="font-semibold text-slate-700">{{ $quizzes->total() }}</span> kuis</p>
            {{ $quizzes->onEachSide(1)->links() }}
        </div>
    </div>
</div>
@endsection
