@extends('layouts.admin')

@section('title', 'Kelola Pengguna')
@section('subtitle', 'Manajemen pengguna sistem e-learning')

@section('content')
<div class="px-4 py-6 md:px-6 lg:px-8 space-y-8 max-w-7xl mx-auto">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-4xl md:text-4xl font-extrabold text-slate-900">Kelola Pengguna</h1>
            <p class="mt-1 text-slate-500">Manajemen akun pengguna dan hak akses sistem.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ request()->fullUrlWithQuery(['export' => 'csv']) }}" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                Export
            </a>
            <a href="{{ route('admin.users.create') }}" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                Tambah Pengguna
            </a>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-5">
            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-50 text-blue-600 ring-1 ring-blue-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
            </div>
            <div>
                <p class="text-sm text-slate-500">Total Siswa</p>
                <p class="text-2xl font-bold text-slate-900">{{ $stats['students'] ?? 0 }}</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-5">
            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-green-50 text-green-600 ring-1 ring-green-100">
               <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m16 6 4 4-10 10H6v-4Z"/><path d="m17.5 2.5-1.5 1.5"/></svg>
            </div>
            <div>
                <p class="text-sm text-slate-500">Total Instruktur</p>
                <p class="text-2xl font-bold text-slate-900">{{ $stats['instructors'] ?? 0 }}</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-5">
            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-yellow-50 text-yellow-600 ring-1 ring-yellow-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v4"/><path d="m16.2 7.8 2.9-2.9"/><path d="M18 12h4"/><path d="m16.2 16.2 2.9 2.9"/><path d="M12 18v4"/><path d="m7.8 16.2-2.9 2.9"/><path d="M6 12H2"/><path d="m7.8 7.8-2.9-2.9"/><circle cx="12" cy="12" r="4"/></svg>
            </div>
            <div>
                <p class="text-sm text-slate-500">Pengguna Aktif</p>
                <p class="text-2xl font-bold text-slate-900">{{ $stats['active'] ?? 0 }}</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-5">
            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-indigo-50 text-indigo-600 ring-1 ring-indigo-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 14 4-4"/><path d="M3.34 17a10.018 10.018 0 1 1-.978-2.326 3 3 0 0 0-1.724.117"/><path d="M13 12h4c0-.8-.2-1.2-.5-1.5l-9.5-9.5c-.3-.3-.7-.5-1.5-.5H4v1.5c0 .8.2 1.2.5 1.5z"/></svg>
            </div>
            <div>
                <p class="text-sm text-slate-500">Total Admin</p>
                <p class="text-2xl font-bold text-slate-900">{{ $stats['admins'] ?? 0 }}</p>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="px-4 py-3 bg-green-50 text-green-700 border-b border-green-200">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="px-4 py-3 bg-red-50 text-red-700 border-b border-red-200">{{ session('error') }}</div>
        @endif

        <!-- Filter and Search -->
        <div class="p-4 md:p-5 border-b border-slate-200 bg-slate-50/50 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <form method="GET" class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="relative max-w-xs w-full md:max-w-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    <input name="q" value="{{ request('q') }}" type="text" placeholder="Cari pengguna..." class="w-full pl-10 pr-4 py-2 text-sm bg-white border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div class="flex items-center gap-3 md:justify-end">
                    <select name="role" class="text-sm bg-white border border-slate-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 md:w-44">
                        <option value="">Semua Peran</option>
                        <option value="student" {{ request('role')=='student' ? 'selected' : '' }}>Student</option>
                        <option value="instructor" {{ request('role')=='instructor' ? 'selected' : '' }}>Instructor</option>
                        <option value="admin" {{ request('role')=='admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <select name="status" class="text-sm bg-white border border-slate-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 md:w-44">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status')=='active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status')=='inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        <option value="alumni" {{ request('status')=='alumni' ? 'selected' : '' }}>Alumni</option>
                    </select>
                    <button class="hidden" type="submit">Filter</button>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50">
                    <tr>
                        <th scope="col" class="p-4 w-12"><input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"></th>
                        <th scope="col" class="px-6 py-3">Pengguna</th>
                        <th scope="col" class="px-6 py-3">Peran</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Tanggal Bergabung</th>
                        <th scope="col" class="px-6 py-3">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="bg-white border-b hover:bg-slate-50">
                        <td class="p-4"><input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500"></td>
                        <td class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <img class="w-10 h-10 rounded-full object-cover ring-1 ring-slate-200" src="{{ $user->avatar ?? ('https://ui-avatars.com/api/?name=' . urlencode($user->name ?? 'U') . '&background=E2E8F0&color=475569') }}" alt="{{ $user->name ?? 'User' }} avatar">
                                <div>
                                    <div class="font-semibold">{{ $user->name }}</div>
                                    <div class="text-slate-500">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ ucfirst($user->role) }}</td>
                        <td class="px-6 py-4">
                            @php $isActive = ($user->status ?? '') === 'active'; @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $isActive ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ optional($user->created_at)->locale('id')->translatedFormat('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Hapus pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-800" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center text-slate-500">Belum ada data pengguna.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 flex flex-col md:flex-row items-center justify-between gap-4 text-sm">
            <div class="text-slate-500">
                Menampilkan <span class="font-semibold text-slate-700">{{ $users->firstItem() }}-{{ $users->lastItem() }}</span> dari <span class="font-semibold text-slate-700">{{ $users->total() }}</span> hasil
            </div>
            <div>
                {{ $users->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

