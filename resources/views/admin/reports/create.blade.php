@extends('layouts.admin')

@section('title', 'Buat Pengumuman')
@section('subtitle', 'Sampaikan informasi terbaru kepada anggota PASKIBRA')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="rounded-3xl border border-slate-200 bg-white px-6 py-6 shadow-[0_25px_50px_-35px_rgba(15,23,42,0.35)]">
        <div class="flex items-center justify-between gap-3 flex-wrap">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Pengumuman Baru</p>
                <h1 class="mt-2 text-2xl font-semibold text-slate-900">Tambah Pengumuman</h1>
                <p class="text-sm text-slate-500">Isi detail berikut agar pengumuman tampil di portal siswa.</p>
            </div>
            <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:border-indigo-200 hover:text-indigo-600">
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

    <form action="{{ route('admin.reports.store') }}" method="POST" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_25px_45px_-35px_rgba(15,23,42,0.3)] space-y-6">
        @csrf
        <div class="grid gap-6 md:grid-cols-2">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600">Judul Pengumuman</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600">Kategori</label>
                    <select name="type" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100" required>
                        @foreach($typeOptions as $value => $label)
                            <option value="{{ $value }}" @selected(old('type') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-slate-600">Waktu Publikasi</label>
                        <input type="datetime-local" name="published_at" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                    </div>
                    <div class="flex flex-col gap-3 pt-6">
                        <label class="inline-flex items-center text-sm text-slate-600">
                            <input type="checkbox" name="is_active" value="1" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" {{ old('is_active', true) ? 'checked' : '' }}>
                            <span class="ml-2">Tampilkan segera</span>
                        </label>
                        <label class="inline-flex items-center text-sm text-slate-600">
                            <input type="checkbox" name="is_pinned" value="1" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" {{ old('is_pinned') ? 'checked' : '' }}>
                            <span class="ml-2">Sematkan di bagian atas</span>
                        </label>
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600">Isi Pengumuman</label>
                <textarea name="content" rows="12" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm leading-relaxed focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100" placeholder="Tulis detail pengumuman yang akan diterima anggota" required>{{ old('content') }}</textarea>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center rounded-2xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:border-indigo-200 hover:text-indigo-600">Batal</a>
            <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-700">
                Simpan Pengumuman
            </button>
        </div>
    </form>
</div>
@endsection
