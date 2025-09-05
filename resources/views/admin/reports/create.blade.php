@extends('layouts.admin')

@section('title', 'Buat Report')

@section('content')
<div class="px-4 py-6 md:px-6 lg:px-8 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Buat Report</h1>
    <form method="POST" action="{{ route('admin.reports.store') }}" class="space-y-5 bg-white p-6 rounded-xl border border-slate-200">
        @csrf
        <div>
            <label class="block text-sm text-slate-600 mb-1">Judul</label>
            <input name="title" value="{{ old('title') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2" required>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div>
                <label class="block text-sm text-slate-600 mb-1">Tipe</label>
                <select name="type" class="w-full border border-slate-300 rounded-lg px-3 py-2">
                    <option value="custom">Custom</option>
                    <option value="users">Users</option>
                    <option value="courses">Courses</option>
                    <option value="quizzes">Quizzes</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-slate-600 mb-1">Mulai</label>
                <input type="date" name="period_start" class="w-full border border-slate-300 rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm text-slate-600 mb-1">Selesai</label>
                <input type="date" name="period_end" class="w-full border border-slate-300 rounded-lg px-3 py-2">
            </div>
        </div>
        <div>
            <label class="block text-sm text-slate-600 mb-1">Filters (JSON)</label>
            <textarea name="filters" rows="4" class="w-full border border-slate-300 rounded-lg px-3 py-2" placeholder='{"role":"student"}'></textarea>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.reports.index') }}" class="px-4 py-2 rounded-lg border border-slate-300">Batal</a>
            <button class="px-4 py-2 rounded-lg bg-blue-600 text-white">Simpan</button>
        </div>
    </form>
</div>
@endsection

