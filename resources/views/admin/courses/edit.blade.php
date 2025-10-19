@extends('layouts.admin')

@section('title', 'Edit Kursus')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <a href="{{ route('admin.courses.index') }}" class="text-blue-500 hover:text-blue-700 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
            Kembali ke Daftar Kursus
        </a>
        <h1 class="text-3xl font-bold text-gray-800 mt-2">Edit Kursus</h1>
        <p class="text-gray-600">Ubah detail kursus lalu simpan.</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('admin.courses.update', $course) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Kursus</label>
                        <input type="text" name="title" value="{{ old('title', $course->title) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="description" rows="8" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description', $course->description) }}</textarea>
                    </div>
                </div>
                <div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                            @php $cats=['kepaskibraan'=>'Dasar Kepaskibraan','baris_berbaris'=>'Baris Berbaris','wawasan'=>'Pengetahuan Umum','kepemimpinan'=>'Kepemimpinan','protokoler'=>'Protokoler']; @endphp
                            @foreach($cats as $k=>$v)
                                <option value="{{ $k }}" {{ old('category', $course->category)==$k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tingkatan</label>
                        <select name="difficulty" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                            @php $diff=['umum'=>'Umum','calon_paskibra'=>'Calon Paskibra','wiramuda'=>'Wiramuda','wiratama'=>'Wiratama','instruktur_muda'=>'Instruktur Muda','instruktur'=>'Instruktur']; @endphp
                            @foreach($diff as $k=>$v)
                                <option value="{{ $k }}" {{ old('difficulty', $course->difficulty)===$k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center">
                                <input type="radio" name="is_active" value="1" class="text-blue-500 focus:ring-blue-500" {{ old('is_active', (int)$course->is_active)==1 ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">Aktif</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="is_active" value="0" class="text-blue-500 focus:ring-blue-500" {{ old('is_active', (int)$course->is_active)==0 ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">Non-Aktif / Draft</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                <a href="{{ route('admin.courses.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-lg mr-4">Batal</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold">Simpan Perubahan</button>
            </div>
        </form>
        <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="mt-4" data-confirm="Hapus kursus ini?">
            @csrf
            @method('DELETE')
            <button class="text-red-600 hover:text-red-800">Hapus Kursus</button>
        </form>
    </div>
</div>
@endsection
