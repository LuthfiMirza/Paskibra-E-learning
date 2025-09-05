@extends('layouts.admin')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="px-4 py-6 md:px-6 lg:px-8 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-slate-900 mb-6">Tambah Pengguna</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-5 bg-white p-6 rounded-xl border border-slate-200">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-slate-600 mb-1">Nama</label>
                <input name="name" value="{{ old('name') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-sm text-slate-600 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-slate-600 mb-1">Password</label>
                <input type="password" name="password" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-sm text-slate-600 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm text-slate-600 mb-1">Peran</label>
                <select name="role" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="student" {{ old('role')=='student' ? 'selected' : '' }}>Student</option>
                    <option value="instructor" {{ old('role')=='instructor' ? 'selected' : '' }}>Instructor</option>
                    <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-slate-600 mb-1">Status</label>
                <select name="status" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="active" {{ old('status')=='active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status')=='inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    <option value="alumni" {{ old('status')=='alumni' ? 'selected' : '' }}>Alumni</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-slate-600 mb-1">Angkatan</label>
                <input type="number" name="angkatan" value="{{ old('angkatan') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-slate-600 mb-1">NIS</label>
                <input name="nis" value="{{ old('nis') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm text-slate-600 mb-1">Avatar URL</label>
                <input name="avatar" value="{{ old('avatar') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        <div>
            <label class="block text-sm text-slate-600 mb-1">Bio</label>
            <textarea name="bio" rows="4" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('bio') }}</textarea>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700 bg-white hover:bg-slate-50">Batal</a>
            <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection

