@extends('layouts.admin')

@section('title', 'Kelola Pengguna')
@section('subtitle', 'Manajemen akses dan peran seluruh pengguna platform')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <!-- Page header -->
    <div class="rounded-3xl border border-slate-200 bg-white px-6 py-6 shadow-[0_25px_50px_-35px_rgba(15,23,42,0.35)] flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-slate-400">
                <span class="inline-flex h-2 w-2 rounded-full bg-indigo-500"></span>
                Manajemen Pengguna
            </div>
            <h1 class="mt-2 text-2xl font-semibold text-slate-900">Kelola Pengguna</h1>
            <p class="mt-1 text-sm text-slate-500">Tambah, mutakhirkan, dan atur hak akses anggota PASKIBRA.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ request()->fullUrlWithQuery(['export' => 'csv']) }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-medium text-slate-600 hover:border-indigo-200 hover:text-indigo-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 10l5 5 5-5"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15V3"/></svg>
                Export CSV
            </a>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5"/></svg>
                Pengguna Baru
            </a>
        </div>
    </div>

    <!-- Snapshot statistics -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">
        @php
            $summary = [
                [
                    'label' => 'Total Siswa',
                    'value' => number_format($stats['students'] ?? 0),
                    'iconBg' => 'bg-sky-100 text-sky-600',
                    'chip' => '+4%',
                    'chipVariant' => 'bg-sky-50 text-sky-600',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4" />',
                ],
                [
                    'label' => 'Instruktur Aktif',
                    'value' => number_format($stats['instructors'] ?? 0),
                    'iconBg' => 'bg-emerald-100 text-emerald-600',
                    'chip' => '+2%',
                    'chipVariant' => 'bg-emerald-50 text-emerald-600',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16 6 4 4-10 10H6v-4Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m17.5 2.5-1.5 1.5"/>',
                ],
                [
                    'label' => 'Pengguna Aktif',
                    'value' => number_format($stats['active'] ?? 0),
                    'iconBg' => 'bg-amber-100 text-amber-600',
                    'chip' => '+1%',
                    'chipVariant' => 'bg-amber-50 text-amber-600',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v4m4.2 1.8 2.9-2.9M18 12h4m-5.8 4.2 2.9 2.9M12 18v4m-4.2-3.8-2.9 2.9M6 12H2m5.8-4.2-2.9-2.9" /><circle cx="12" cy="12" r="4"/>',
                ],
                [
                    'label' => 'Total Admin',
                    'value' => number_format($stats['admins'] ?? 0),
                    'iconBg' => 'bg-indigo-100 text-indigo-600',
                    'chip' => '+0%',
                    'chipVariant' => 'bg-slate-100 text-slate-500',
                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2z"/>',
                ],
            ];
        @endphp
        @foreach ($summary as $card)
            <div class="rounded-3xl border border-slate-200 bg-white px-5 py-6 shadow-[0_25px_45px_-35px_rgba(15,23,42,0.3)]">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">{{ $card['label'] }}</p>
                        <p class="mt-3 text-2xl font-semibold text-slate-900">{{ $card['value'] }}</p>
                    </div>
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl {{ $card['iconBg'] }}">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $card['icon'] !!}</svg>
                    </span>
                </div>
                <span class="mt-4 inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium {{ $card['chipVariant'] }}">{{ $card['chip'] }} dibanding bulan lalu</span>
            </div>
        @endforeach
    </div>

    <!-- Users table -->
    <div class="rounded-3xl border border-slate-200 bg-white shadow-[0_25px_45px_-35px_rgba(15,23,42,0.3)]">
        @if(session('success'))
            <div class="border-b border-emerald-100 bg-emerald-50 px-6 py-3 text-sm font-medium text-emerald-600">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="border-b border-rose-100 bg-rose-50 px-6 py-3 text-sm font-medium text-rose-600">{{ session('error') }}</div>
        @endif

        <form method="GET" class="flex flex-col gap-3 border-b border-slate-200/70 px-6 py-5 md:grid md:grid-cols-[minmax(0,1fr)_auto_auto_auto]">
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </span>
                    <input name="q" value="{{ request('q') }}" type="search" placeholder="Cari nama atau email" class="h-11 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-10 pr-4 text-sm text-slate-600 placeholder:text-slate-400 focus:border-indigo-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100" />
                </div>
            <select name="role" class="h-11 rounded-2xl border border-slate-200 bg-white px-4 text-sm text-slate-600 focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                <option value="">Semua Peran</option>
                <option value="student" {{ request('role')==='student' ? 'selected' : '' }}>Siswa</option>
                <option value="instructor" {{ request('role')==='instructor' ? 'selected' : '' }}>Instruktur</option>
                <option value="admin" {{ request('role')==='admin' ? 'selected' : '' }}>Admin</option>
            </select>
            <select name="status" class="h-11 rounded-2xl border border-slate-200 bg-white px-4 text-sm text-slate-600 focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status')==='active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status')==='inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                <option value="alumni" {{ request('status')==='alumni' ? 'selected' : '' }}>Alumni</option>
            </select>
            <div class="flex items-center justify-end gap-2">
                <button type="submit" class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-medium text-slate-500 hover:border-indigo-200 hover:text-indigo-600">Terapkan</button>
                <a href="{{ route('admin.users.index') }}" class="rounded-2xl border border-transparent bg-slate-100 px-4 py-2 text-sm text-slate-500 hover:bg-slate-200">Reset</a>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-6 py-3"><input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-indigo-500 focus:ring-indigo-200"></th>
                        <th class="px-6 py-3">Pengguna</th>
                        <th class="px-6 py-3">Peran</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Bergabung</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/80 bg-white">
                    @forelse ($users as $user)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4"><input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-indigo-500 focus:ring-indigo-200"></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img class="h-11 w-11 rounded-2xl object-cover ring-2 ring-slate-100" src="{{ $user->avatar ?? ('https://ui-avatars.com/api/?name=' . urlencode($user->name ?? 'U') . '&background=E0E7FF&color=4338CA') }}" alt="Avatar {{ $user->name }}">
                                    <div>
                                        <p class="font-semibold text-slate-900">{{ $user->name }}</p>
                                        <p class="text-xs text-slate-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ ucfirst($user->role) }}</td>
                            <td class="px-6 py-4">
                                @php $isActive = ($user->status ?? '') === 'active'; @endphp
                                <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-semibold {{ $isActive ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $isActive ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                    {{ $isActive ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ optional($user->created_at)->locale('id')->translatedFormat('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 text-slate-500 hover:border-indigo-200 hover:text-indigo-600" title="Edit">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.125l-2.685.77.77-2.685a4.5 4.5 0 011.125-1.897L16.862 4.487z" /></svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" data-confirm="Hapus pengguna ini?" class="inline-flex">
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
                            <td colspan="6" class="px-6 py-16 text-center text-slate-400">Belum ada data pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-col gap-4 border-t border-slate-200 px-6 py-5 text-sm text-slate-500 md:flex-row md:items-center md:justify-between">
            <p>Menampilkan <span class="font-semibold text-slate-700">{{ $users->firstItem() }}-{{ $users->lastItem() }}</span> dari <span class="font-semibold text-slate-700">{{ $users->total() }}</span> pengguna</p>
            {{ $users->onEachSide(1)->links() }}
        </div>
    </div>
</div>
@endsection
