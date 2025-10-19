@extends('layouts.admin')

@section('title', 'Konten Kursus: ' . $course->title)
@section('subtitle', 'Atur modul dan materi pembelajaran untuk kursus ini')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">
    <div class="rounded-3xl border border-slate-200 bg-white px-6 py-6 shadow-[0_25px_50px_-35px_rgba(15,23,42,0.35)] flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Kursus</p>
            <h1 class="mt-2 text-2xl font-semibold text-slate-900">{{ $course->title }}</h1>
            <p class="text-sm text-slate-500">Kelola urutan modul, materi belajar, dan status publikasi.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.courses.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:border-indigo-200 hover:text-indigo-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </a>
            <a href="{{ route('admin.courses.lessons.create', $course) }}" class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5"/></svg>
                Materi Baru
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-3 text-sm font-medium text-emerald-600">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-3xl border border-slate-200 bg-white shadow-[0_25px_45px_-35px_rgba(15,23,42,0.3)] overflow-hidden">
        <div class="border-b border-slate-200/70 px-6 py-5 text-sm text-slate-500 flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <p>Daftar materi dan modul pada kursus ini.</p>
            <span class="text-xs text-slate-400">Total modul: <strong class="text-slate-600">{{ $lessons->total() }}</strong></span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-6 py-3">Urutan</th>
                        <th class="px-6 py-3">Judul Materi</th>
                        <th class="px-6 py-3">Jenis</th>
                        <th class="px-6 py-3">Durasi</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/80 bg-white">
                    @forelse($lessons as $lesson)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">#{{ $lesson->order }}</td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-900">{{ $lesson->title }}</p>
                                @if($lesson->content_type === 'text' && \Illuminate\Support\Str::length($lesson->content))
                                    <p class="text-xs text-slate-500 line-clamp-1">{{ \Illuminate\Support\Str::limit(strip_tags($lesson->content), 90) }}</p>
                                @elseif($lesson->file_path)
                                    <p class="text-xs text-slate-500">Lampiran: <span class="font-medium">{{ basename($lesson->file_path) }}</span></p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ $lesson->content_type_display }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $lesson->duration_minutes ?? '—' }} menit</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-semibold {{ $lesson->is_active ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $lesson->is_active ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                    {{ $lesson->is_active ? 'Aktif' : 'Non-aktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-3">
                                    <a href="{{ route('admin.courses.lessons.edit', [$course, $lesson]) }}" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 text-slate-500 hover:border-indigo-200 hover:text-indigo-600" title="Edit">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.125l-2.685.77.77-2.685a4.5 4.5 0 0 1 1.125-1.897L16.862 4.487z" /></svg>
                                    </a>
                                    <form action="{{ route('admin.courses.lessons.destroy', [$course, $lesson]) }}" method="POST" data-confirm="Hapus materi ini?" class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-transparent bg-rose-50 text-rose-500 hover:bg-rose-100" title="Hapus">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12M10 11v6m4-6v6M9 7V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2m2 0v12a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V7z" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-400">Belum ada materi untuk kursus ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-col gap-4 border-t border-slate-200 px-6 py-5 text-sm text-slate-500 md:flex-row md:items-center md:justify-between">
            <p>Menampilkan <span class="font-semibold text-slate-700">{{ $lessons->firstItem() ?? 0 }}-{{ $lessons->lastItem() ?? 0 }}</span> dari <span class="font-semibold text-slate-700">{{ $lessons->total() }}</span> materi</p>
            {{ $lessons->onEachSide(1)->links() }}
        </div>
    </div>
</div>
@endsection
