@extends('layouts.admin')

@section('title', 'Edit Kuis')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <a href="{{ route('admin.quizzes.index') }}" class="text-blue-500 hover:text-blue-700 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
            Kembali ke Daftar Kuis
        </a>
        <h1 class="text-3xl font-bold text-gray-800 mt-2">Edit Kuis: {{ $quiz->title }}</h1>
        <p class="text-gray-600">Perbarui detail kuis di bawah ini.</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('admin.quizzes.update', $quiz) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div>
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Kuis <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" value="{{ old('title', $quiz->title) }}" required>
                    </div>
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="description" id="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description', $quiz->description) }}</textarea>
                    </div>
                    <div class="mb-6">
                        <label for="course_id" class="block text-sm font-medium text-gray-700 mb-2">Kursus Terkait (Opsional)</label>
                        <select name="course_id" id="course_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Tidak ada</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" @selected(old('course_id', $quiz->course_id) == $course->id)>{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Right Column -->
                <div>
                    <div class="mb-6">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <select name="category" id="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                            <option value="kepaskibraan" @selected(old('category', $quiz->category) == 'kepaskibraan')>Dasar Kepaskibraan</option>
                            <option value="baris_berbaris" @selected(old('category', $quiz->category) == 'baris_berbaris')>Baris Berbaris</option>
                            <option value="wawasan" @selected(old('category', $quiz->category) == 'wawasan')>Pengetahuan Umum</option>
                            <option value="kepemimpinan" @selected(old('category', $quiz->category) == 'kepemimpinan')>Kepemimpinan</option>
                            <option value="protokoler" @selected(old('category', $quiz->category) == 'protokoler')>Protokoler</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="difficulty" class="block text-sm font-medium text-gray-700 mb-2">Tingkat Kesulitan <span class="text-red-500">*</span></label>
                        <select name="difficulty" id="difficulty" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                            <option value="basic" @selected(old('difficulty', $quiz->difficulty) == 'basic')>Dasar</option>
                            <option value="intermediate" @selected(old('difficulty', $quiz->difficulty) == 'intermediate')>Menengah</option>
                            <option value="advanced" @selected(old('difficulty', $quiz->difficulty) == 'advanced')>Lanjutan</option>
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="time_limit" class="block text-sm font-medium text-gray-700 mb-2">Batas Waktu (Menit)</label>
                        <input type="number" name="time_limit" id="time_limit" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" value="{{ old('time_limit', $quiz->time_limit) }}" placeholder="Contoh: 60">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center"><input type="radio" name="is_active" value="1" class="text-blue-500 focus:ring-blue-500" @checked(old('is_active', $quiz->is_active) == 1)><span class="ml-2">Aktif</span></label>
                            <label class="flex items-center"><input type="radio" name="is_active" value="0" class="text-blue-500 focus:ring-blue-500" @checked(old('is_active', $quiz->is_active) == 0)><span class="ml-2">Non-Aktif</span></label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                <a href="{{ route('admin.quizzes.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-lg mr-4">Batal</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
