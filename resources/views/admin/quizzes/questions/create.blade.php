@extends('layouts.admin')

@section('title', 'Tambah Pertanyaan')

@section('content')
<div class="px-4 py-6 md:px-6 lg:px-8 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Tambah Pertanyaan - {{ $quiz->title }}</h1>
    <form method="POST" action="{{ route('admin.quizzes.questions.store', $quiz) }}" class="space-y-5 bg-white p-6 rounded-xl border border-slate-200">
        @csrf
        <div>
            <label class="block text-sm text-slate-600 mb-1">Teks Pertanyaan</label>
            <textarea name="question" rows="3" class="w-full border border-slate-300 rounded-lg px-3 py-2" required>{{ old('question') }}</textarea>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div>
                <label class="block text-sm text-slate-600 mb-1">Tipe</label>
                <select name="type" id="type" class="w-full border border-slate-300 rounded-lg px-3 py-2">
                    <option value="multiple_choice" {{ old('type')=='multiple_choice' ? 'selected' : '' }}>Multiple Choice</option>
                    <option value="true_false" {{ old('type')=='true_false' ? 'selected' : '' }}>True / False</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-slate-600 mb-1">Poin</label>
                <input type="number" name="points" value="{{ old('points',10) }}" class="w-full border border-slate-300 rounded-lg px-3 py-2">
            </div>
        </div>

        <div id="mc-section" class="space-y-3">
            <label class="block text-sm text-slate-600">Opsi Jawaban</label>
            @for($i=0;$i<4;$i++)
            <div class="flex items-center gap-3">
                <input type="radio" name="correct_option" value="{{ $i }}" class="text-blue-600" {{ old('correct_option')==$i ? 'checked' : '' }}>
                <input name="options[{{ $i }}]" value="{{ old('options.'.$i) }}" class="flex-1 border border-slate-300 rounded-lg px-3 py-2" placeholder="Teks opsi">
            </div>
            @endfor
        </div>

        <div id="tf-section" class="space-y-3 hidden">
            <label class="block text-sm text-slate-600">Jawaban Benar</label>
            <div class="flex items-center gap-6">
                <label class="inline-flex items-center"><input type="radio" name="tf_correct" value="true" class="text-blue-600" checked> <span class="ml-2">True</span></label>
                <label class="inline-flex items-center"><input type="radio" name="tf_correct" value="false" class="text-blue-600"> <span class="ml-2">False</span></label>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.quizzes.questions.index', $quiz) }}" class="px-4 py-2 rounded-lg border border-slate-300">Batal</a>
            <button class="px-4 py-2 rounded-lg bg-blue-600 text-white">Simpan</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const type = document.getElementById('type');
    const mc = document.getElementById('mc-section');
    const tf = document.getElementById('tf-section');
    function sync(){
        if(type.value === 'true_false'){ mc.classList.add('hidden'); tf.classList.remove('hidden'); }
        else { tf.classList.add('hidden'); mc.classList.remove('hidden'); }
    }
    type.addEventListener('change', sync); sync();
});
</script>
@endsection

