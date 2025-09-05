@extends('layouts.admin')

@section('title', 'Reports Preset')

@section('content')
<div class="px-4 py-6 md:px-6 lg:px-8 max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Report Presets</h1>
            <p class="text-slate-500">Simpan dan kelola preset laporan Anda.</p>
        </div>
        <a href="{{ route('admin.reports.create') }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Buat Report</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">Judul</th>
                    <th class="px-4 py-3 text-left">Tipe</th>
                    <th class="px-4 py-3 text-left">Periode</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $r)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $r->title }}</td>
                    <td class="px-4 py-3">{{ ucfirst($r->type) }}</td>
                    <td class="px-4 py-3">{{ optional($r->period_start)->format('d M Y') }} - {{ optional($r->period_end)->format('d M Y') }}</td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.reports.edit', $r) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('admin.reports.destroy', $r) }}" method="POST" class="inline ml-3" onsubmit="return confirm('Hapus preset?')">@csrf @method('DELETE')<button class="text-red-600 hover:text-red-800">Hapus</button></form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-4 py-10 text-center text-slate-500">Belum ada preset laporan.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $reports->links() }}</div>
    </div>
</div>
@endsection

