@extends('layouts.admin')

@section('title', 'Pertanyaan: ' . $quiz->title)

@section('content')
<div class="px-4 py-6 md:px-6 lg:px-8 max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Pertanyaan: {{ $quiz->title }}</h1>
            <p class="text-slate-500">Kelola pertanyaan dan opsi jawaban.</p>
        </div>
        <a href="{{ route('admin.quizzes.questions.create', $quiz) }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Tambah Pertanyaan</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">Urutan</th>
                    <th class="px-4 py-3 text-left">Pertanyaan</th>
                    <th class="px-4 py-3">Tipe</th>
                    <th class="px-4 py-3">Poin</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($questions as $q)
                <tr class="border-t">
                    <td class="px-4 py-3 align-top w-16">{{ $q->order }}</td>
                    <td class="px-4 py-3">
                        <div class="font-medium text-slate-900">{{ $q->question }}</div>
                        <ul class="mt-2 text-slate-600 list-disc pl-5 space-y-1">
                            @forelse($q->option_collection as $opt)
                                <li>{!! $opt->is_correct ? '<span class="text-green-600 font-semibold">[Benar]</span>' : '' !!} {{ $opt->option_text }}</li>
                            @empty
                                <li class="text-xs text-slate-400 italic">Belum ada opsi jawaban.</li>
                            @endforelse
                        </ul>
                    </td>
                    <td class="px-4 py-3 text-center">{{ str_replace('_', ' ', ucfirst($q->type)) }}</td>
                    <td class="px-4 py-3 text-center">{{ $q->points }}</td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.quizzes.questions.edit', [$quiz, $q]) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        <form action="{{ route('admin.quizzes.questions.destroy', [$quiz, $q]) }}" method="POST" class="inline ml-3" data-confirm="Hapus pertanyaan ini?">@csrf @method('DELETE')<button class="text-red-600 hover:text-red-800">Hapus</button></form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-4 py-10 text-center text-slate-500">Belum ada pertanyaan.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $questions->links() }}</div>
    </div>
</div>
@endsection

