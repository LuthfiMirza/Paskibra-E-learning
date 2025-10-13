@extends('layouts.admin')

@section('title', 'Tambah Materi Kursus')
@section('subtitle', $course->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="rounded-3xl border border-slate-200 bg-white px-6 py-6 shadow-[0_25px_50px_-35px_rgba(15,23,42,0.35)]">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Materi Baru</p>
                <h1 class="mt-2 text-2xl font-semibold text-slate-900">Tambah Materi untuk {{ $course->title }}</h1>
                <p class="text-sm text-slate-500">Isi detail materi agar tampil rapi di halaman kursus pengguna.</p>
            </div>
            <a href="{{ route('admin.courses.lessons.index', $course) }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:border-indigo-200 hover:text-indigo-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="rounded-2xl border border-rose-200 bg-rose-50 px-5 py-3 text-sm text-rose-600">
            <ul class="list-disc space-y-1 pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.courses.lessons.store', $course) }}" method="POST" enctype="multipart/form-data" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_25px_45px_-35px_rgba(15,23,42,0.3)] space-y-6">
        @csrf

        <div class="grid gap-6 md:grid-cols-2">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600">Judul Materi</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600">Jenis Konten</label>
                    <select name="content_type" id="content_type" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100" required>
                        <option value="text" @selected(old('content_type') === 'text')>Teks</option>
                        <option value="video" @selected(old('content_type') === 'video')>Video</option>
                        <option value="audio" @selected(old('content_type') === 'audio')>Audio</option>
                        <option value="pdf" @selected(old('content_type') === 'pdf')>PDF</option>
                        <option value="interactive" @selected(old('content_type') === 'interactive')>Interaktif</option>
                    </select>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-slate-600">Durasi (menit)</label>
                        <input type="number" name="duration_minutes" value="{{ old('duration_minutes') }}" min="1" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100" placeholder="Contoh: 30">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-600">Urutan</label>
                        <input type="number" name="order" value="{{ old('order') }}" min="1" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100" placeholder="Otomatis">
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1" id="is_active" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label for="is_active" class="text-sm text-slate-600">Tampilkan materi ini kepada pengguna</label>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600">Lampiran (opsional)</label>
                    <input type="file" name="file" class="mt-1 w-full rounded-xl border border-dashed border-slate-300 px-4 py-3 text-sm text-slate-500 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                    <p class="mt-2 text-xs text-slate-400">Video (MP4), audio (MP3/WAV), PDF, atau paket interaktif (ZIP).</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600">Konten Teks</label>
                    <textarea name="content" rows="8" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100" placeholder="Tambahkan materi atau catatan penting">{{ old('content') }}</textarea>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.courses.lessons.index', $course) }}" class="inline-flex items-center rounded-2xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:border-indigo-200 hover:text-indigo-600">Batal</a>
            <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-700">
                Simpan Materi
            </button>
        </div>
    </form>
</div>
@endsection
