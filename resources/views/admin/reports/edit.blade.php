@extends('layouts.admin')

@section('title', 'Edit Report')

@section('content')
<div class="px-4 py-6 md:px-6 lg:px-8 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Edit Report</h1>
    <form method="POST" action="{{ route('admin.reports.update', $report) }}" class="space-y-5 bg-white p-6 rounded-xl border border-slate-200">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm text-slate-600 mb-1">Judul</label>
            <input name="title" value="{{ old('title', $report->title) }}" class="w-full border border-slate-300 rounded-lg px-3 py-2" required>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div>
                <label class="block text-sm text-slate-600 mb-1">Tipe</label>
                <select name="type" class="w-full border border-slate-300 rounded-lg px-3 py-2">
                    @foreach(['custom','users','courses','quizzes'] as $opt)
                        <option value="{{ $opt }}" {{ old('type', $report->type)===$opt ? 'selected' : '' }}>{{ ucfirst($opt) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm text-slate-600 mb-1">Mulai</label>
                <input type="date" name="period_start" value="{{ old('period_start', optional($report->period_start)->format('Y-m-d')) }}" class="w-full border border-slate-300 rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm text-slate-600 mb-1">Selesai</label>
                <input type="date" name="period_end" value="{{ old('period_end', optional($report->period_end)->format('Y-m-d')) }}" class="w-full border border-slate-300 rounded-lg px-3 py-2">
            </div>
        </div>
        <div>
            <label class="block text-sm text-slate-600 mb-1">Filters (JSON)</label>
            <textarea name="filters" rows="4" class="w-full border border-slate-300 rounded-lg px-3 py-2">{{ old('filters', json_encode($report->filters)) }}</textarea>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.reports.index') }}" class="px-4 py-2 rounded-lg border border-slate-300">Batal</a>
            <button class="px-4 py-2 rounded-lg bg-blue-600 text-white">Simpan</button>
        </div>
    </form>
    <form method="POST" action="{{ route('admin.reports.destroy', $report) }}" class="mt-4" onsubmit="return confirm('Hapus preset?')">
        @csrf
        @method('DELETE')
        <button class="text-red-600 hover:text-red-800">Hapus Report</button>
    </form>
</div>
@endsection

