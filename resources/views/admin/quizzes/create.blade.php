@extends('layouts.admin')

@section('title', 'Buat Kuis Baru')
@section('subtitle', 'Rancang evaluasi untuk memperkuat pemahaman peserta')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">
    <div class="rounded-3xl border border-slate-200 bg-white px-6 py-6 shadow-[0_25px_50px_-35px_rgba(15,23,42,0.35)]">
        <div class="flex items-center justify-between gap-3 flex-wrap">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Kuis Baru</p>
                <h1 class="mt-2 text-2xl font-semibold text-slate-900">Buat Kuis Baru</h1>
                <p class="text-sm text-slate-500">Isi detail berikut, kuis akan langsung muncul di portal siswa jika dipublikasikan.</p>
            </div>
            <a href="{{ route('admin.quizzes.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:border-indigo-200 hover:text-indigo-600">
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

    <form action="{{ route('admin.quizzes.store') }}" method="POST" class="rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_25px_45px_-35px_rgba(15,23,42,0.3)] space-y-6">
        @csrf
        <div class="grid gap-6 md:grid-cols-2">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600">Judul Kuis</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600">Deskripsi</label>
                    <textarea name="description" rows="5" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm leading-relaxed focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100" placeholder="Tuliskan ringkasan materi atau tujuan kuis">{{ old('description') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600">Kursus Terkait</label>
                    <select name="course_id" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                        <option value="">Tidak ada</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" @selected(old('course_id') == $course->id)>{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="space-y-4">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-slate-600">Kategori</label>
                        <select name="category" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100" required>
                            <option value="kepaskibraan" @selected(old('category') === 'kepaskibraan')>Dasar Kepaskibraan</option>
                            <option value="baris_berbaris" @selected(old('category') === 'baris_berbaris')>Baris Berbaris</option>
                            <option value="wawasan" @selected(old('category') === 'wawasan')>Pengetahuan Umum</option>
                            <option value="kepemimpinan" @selected(old('category') === 'kepemimpinan')>Kepemimpinan</option>
                            <option value="protokoler" @selected(old('category') === 'protokoler')>Protokoler</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-600">Tingkat Kesulitan</label>
                        <select name="difficulty" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100" required>
                            <option value="umum" @selected(old('difficulty') === 'umum')>Umum</option>
                            <option value="calon_paskibra" @selected(old('difficulty') === 'calon_paskibra')>Calon Paskibra</option>
                            <option value="wiramuda" @selected(old('difficulty') === 'wiramuda')>Wiramuda</option>
                            <option value="wiratama" @selected(old('difficulty') === 'wiratama')>Wiratama</option>
                            <option value="instruktur_muda" @selected(old('difficulty') === 'instruktur_muda')>Instruktur Muda</option>
                            <option value="instruktur" @selected(old('difficulty') === 'instruktur')>Instruktur</option>
                        </select>
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-slate-600">Batas Waktu (menit)</label>
                        <input type="number" name="time_limit" value="{{ old('time_limit') }}" min="1" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100" placeholder="Contoh: 30">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-600">Tanggal Publikasi</label>
                        <input type="datetime-local" name="published_at" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-slate-600">Nilai Kelulusan</label>
                        <input type="number" name="passing_score" value="{{ old('passing_score', 70) }}" min="1" max="100" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-600">Maks. Percobaan</label>
                        <input type="number" name="max_attempts" value="{{ old('max_attempts', 3) }}" min="1" max="10" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                    </div>
                </div>
                <div class="grid gap-3">
                    <label class="inline-flex items-center text-sm text-slate-600">
                        <input type="checkbox" name="allow_retake" value="1" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" {{ old('allow_retake', true) ? 'checked' : '' }}>
                        <span class="ml-2">Izinkan peserta mengulang kuis</span>
                    </label>
                    <label class="inline-flex items-center text-sm text-slate-600">
                        <input type="checkbox" name="show_results_immediately" value="1" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" {{ old('show_results_immediately', true) ? 'checked' : '' }}>
                        <span class="ml-2">Tampilkan hasil segera setelah submit</span>
                    </label>
                    <label class="inline-flex items-center text-sm text-slate-600">
                        <input type="checkbox" name="is_active" value="1" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" {{ old('is_active', true) ? 'checked' : '' }}>
                        <span class="ml-2">Aktifkan kuis untuk peserta</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.quizzes.index') }}" class="inline-flex items-center rounded-2xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:border-indigo-200 hover:text-indigo-600">Batal</a>
            <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-700">
                Simpan Kuis
            </button>
        </div>
    </form>
</div>
@endsection
