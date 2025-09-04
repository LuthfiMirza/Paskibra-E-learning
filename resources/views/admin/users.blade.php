@extends('layouts.admin')

@section('title', 'Kelola Pengguna')
@section('subtitle', 'Manajemen pengguna sistem e-learning')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Kelola Pengguna</h1>
                <p class="text-gray-600 mt-1">Manajemen akun pengguna dan hak akses sistem.</p>
            </div>
            <div class="flex space-x-2 mt-4 md:mt-0">
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path></svg>
                    <span>Tambah</span>
                </button>
                <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span>Export</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="admin-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Siswa</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ collect($users)->where('role', 'student')->count() }}</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                </div>
            </div>
        </div>
        <div class="admin-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Instruktur</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ collect($users)->where('role', 'instructor')->count() }}</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path></svg>
                </div>
            </div>
        </div>
        <div class="admin-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pengguna Aktif</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ collect($users)->where('status', 'active')->count() }}</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-yellow-100 rounded-full">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
            </div>
        </div>
        <div class="admin-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Admin</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ collect($users)->where('role', 'admin')->count() }}</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-purple-100 rounded-full">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter and Search -->
    <div class="admin-card p-4 mb-8">
        <form class="flex flex-col sm:flex-row items-center gap-4">
            <div class="relative flex-grow w-full sm:w-auto">
                <input type="text" placeholder="Cari pengguna..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <select class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Role</option>
                <option value="student">Siswa</option>
                <option value="instructor">Instruktur</option>
                <option value="admin">Admin</option>
            </select>
            <select class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Status</option>
                <option value="active">Aktif</option>
                <option value="inactive">Tidak Aktif</option>
            </select>
            <button type="submit" class="w-full sm:w-auto bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"></path></svg>
                <span>Filter</span>
            </button>
        </form>
    </div>

    <!-- Users Table -->
    <div class="admin-card bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="p-4">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </th>
                        <th scope="col" class="px-6 py-3">Pengguna</th>
                        <th scope="col" class="px-6 py-3">Role</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Bergabung</th>
                        <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="w-4 p-4">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <img class="w-10 h-10 rounded-full object-cover mr-4" src="{{ $user['avatar'] }}" alt="{{ $user['name'] }}">
                                <div class="min-w-0">
                                    <div class="font-medium text-gray-900 truncate">{{ $user['name'] }}</div>
                                    <div class="text-gray-500 truncate">{{ $user['email'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($user['role'] == 'admin') bg-red-100 text-red-800
                                @elseif($user['role'] == 'instructor') bg-purple-100 text-purple-800
                                @else bg-blue-100 text-blue-800
                                @endif">
                                {{ ucfirst($user['role']) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                             <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($user['status'] == 'active') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ $user['status'] == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ \Carbon\Carbon::parse($user['joined_date'])->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <button class="text-gray-400 hover:text-blue-600 p-1 rounded" title="Edit">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                </button>
                                <button class="text-gray-400 hover:text-red-600 p-1 rounded" title="Delete">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 border-t border-gray-200">
            {{-- Pagination links will be added here --}}
        </div>
    </div>
</div>
@endsection
