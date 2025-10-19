@extends('layouts.admin')

@section('title', 'Pengumuman')
@section('subtitle', 'Simpan dan kelola informasi yang tampil di portal siswa')

@section('content')
<div class="px-4 py-6 md:px-6 lg:px-8 max-w-6xl mx-auto space-y-6">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Pengumuman</h1>
            <p class="text-sm text-slate-500">Kelola pengumuman terbaru untuk anggota PASKIBRA.</p>
        </div>
        <a href="{{ route('admin.reports.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5"/></svg>
            Pengumuman Baru
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-3 text-sm font-medium text-emerald-600">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl border border-slate-200 shadow-[0_20px_40px_-30px_rgba(15,23,42,0.25)]">
        <form method="GET" class="grid gap-3 md:grid-cols-2 xl:grid-cols-6 px-6 py-5">
            <div class="xl:col-span-2">
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Cari</label>
                    <input type="search" name="search" value="{{ $filters['search'] ?? '' }}" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100" placeholder="Cari pengumuman">
                </div>
                <div>
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Kategori</label>
                    <select name="type" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                        <option value="all" @selected(($filters['type'] ?? 'all') === 'all')>Semua</option>
                        @foreach($typeOptions as $value => $label)
                            <option value="{{ $value }}" @selected(($filters['type'] ?? 'all') === $value)>{{ $label }}</option>
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
                <div>
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wide text-slate-500">Pin</label>
                    <select name="pin" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                        <option value="all" @selected(($filters['pin'] ?? 'all') === 'all')>Semua</option>
                        <option value="pinned" @selected(($filters['pin'] ?? 'all') === 'pinned')>Disematkan</option>
                        <option value="unpinned" @selected(($filters['pin'] ?? 'all') === 'unpinned')>Tidak disematkan</option>
                    </select>
                </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-indigo-500/30 hover:bg-indigo-700">Terapkan</button>
                <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:border-indigo-200 hover:text-indigo-600">Reset</a>
            </div>
        </form>
    </div>
    <div class="bg-white rounded-3xl border border-slate-200 shadow-[0_25px_45px_-35px_rgba(15,23,42,0.3)] overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">Judul</th>
                    <th class="px-4 py-3 text-left">Kategori</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Dipublikasikan</th>
                    <th class="px-4 py-3 text-left">Ringkasan</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($announcements as $announcement)
                    <tr class="border-t">
                        <td class="px-4 py-3 align-top">
                            <div class="font-semibold text-slate-900">{{ $announcement->title }}</div>
                            <div class="text-xs text-slate-400">Oleh {{ optional($announcement->creator)->name ?? 'Admin' }}</div>
                        </td>
                        <td class="px-4 py-3 align-top">
                            <span class="inline-flex items-center gap-1 rounded-full bg-slate-50 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-indigo-400"></span>
                                {{ ucfirst($typeOptions[$announcement->type] ?? $announcement->type) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 align-top">
                            <div class="flex flex-col gap-1 text-xs">
                                <span class="inline-flex items-center gap-1 rounded-full px-2 py-1 font-semibold {{ $announcement->is_active ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $announcement->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                    {{ $announcement->is_active ? 'Aktif' : 'Disembunyikan' }}
                                </span>
                                @if($announcement->is_pinned)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2 py-1 font-semibold text-amber-600">
                                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 17l-4 4m0 0l4-4m-4 4V7a4 4 0 118 0v14l4-4"/></svg>
                                        Disematkan
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 align-top">{{ optional($announcement->published_at)->format('d M Y H:i') }}</td>
                        <td class="px-4 py-3 align-top text-slate-600">{{ \Illuminate\Support\Str::limit(strip_tags($announcement->content), 90) }}</td>
                        <td class="px-4 py-3 text-right align-top">
                            <div class="inline-flex items-center gap-3">
                                <a href="{{ route('admin.reports.edit', $announcement) }}" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 text-slate-500 hover:border-indigo-200 hover:text-indigo-600" title="Edit">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.125l-2.685.77.77-2.685a4.5 4.5 0 0 1 1.125-1.897L16.862 4.487z" /></svg>
                                </a>
                                <form action="{{ route('admin.reports.destroy', $announcement) }}" method="POST" class="inline-flex" data-confirm="Hapus pengumuman ini?">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-transparent bg-rose-50 text-rose-500 hover:bg-rose-100" title="Hapus">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12M10 11v6m4-6v6M9 7V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2m2 0v12a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V7z" /></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-10 text-center text-slate-500">Belum ada pengumuman yang tersimpan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $announcements->links() }}</div>
    </div>
</div>
@endsection
