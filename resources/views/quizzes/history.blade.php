@extends('layouts.dashboard')

@section('title', 'Riwayat Quiz')
@section('subtitle', 'Lihat semua quiz yang pernah Anda kerjakan')

@section('content')
<div class="space-y-6">
    <!-- Back Button -->
    <div>
        <a href="{{ route('quizzes.index') }}" 
           class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Quiz
        </a>
    </div>

    <!-- History List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Riwayat Quiz</h2>
            <p class="text-gray-600">Total {{ $attempts->total() }} quiz telah dikerjakan</p>
        </div>

        @if($attempts->count() > 0)
            <div class="divide-y divide-gray-200">
                @foreach($attempts as $attempt)
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $attempt->quiz->title }}</h3>
                                    
                                    <!-- Status Badge -->
                                    @if($attempt->is_passed)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            ✓ Lulus
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            ✗ Tidak Lulus
                                        </span>
                                    @endif
                                    
                                    <!-- Grade Badge -->
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        @if($attempt->grade == 'A') bg-green-100 text-green-800
                                        @elseif($attempt->grade == 'B') bg-blue-100 text-blue-800
                                        @elseif($attempt->grade == 'C') bg-yellow-100 text-yellow-800
                                        @elseif($attempt->grade == 'D') bg-orange-100 text-orange-800
                                        @else bg-red-100 text-red-800 @endif">
                                        Grade {{ $attempt->grade }}
                                    </span>
                                </div>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-3">
                                    <div>
                                        <div class="text-2xl font-bold {{ $attempt->is_passed ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $attempt->score }}%
                                        </div>
                                        <div class="text-sm text-gray-600">Nilai</div>
                                    </div>
                                    <div>
                                        <div class="text-2xl font-bold text-gray-900">
                                            {{ $attempt->correct_answers }}/{{ $attempt->total_questions }}
                                        </div>
                                        <div class="text-sm text-gray-600">Benar</div>
                                    </div>
                                    <div>
                                        <div class="text-2xl font-bold text-gray-900">{{ $attempt->duration }}</div>
                                        <div class="text-sm text-gray-600">Menit</div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $attempt->completed_at->format('d M Y') }}
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            {{ $attempt->completed_at->format('H:i') }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                    <div class="bg-gradient-to-r {{ $attempt->is_passed ? 'from-green-400 to-green-500' : 'from-red-400 to-red-500' }} h-2 rounded-full" 
                                         style="width: {{ ($attempt->correct_answers / $attempt->total_questions) * 100 }}%"></div>
                                </div>

                                <div class="flex items-center justify-between text-sm text-gray-600">
                                    <span>{{ $attempt->quiz->category_display }} • {{ $attempt->quiz->difficulty_display }}</span>
                                    <span>Nilai lulus: {{ $attempt->quiz->passing_score }}%</span>
                                </div>
                            </div>

                            <div class="ml-6">
                                <a href="{{ route('quizzes.result', $attempt->id) }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($attempts->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $attempts->links() }}
                </div>
            @endif
        @else
            <div class="p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada riwayat quiz</h3>
                <p class="mt-1 text-sm text-gray-500">Mulai kerjakan quiz untuk melihat riwayat di sini.</p>
                <div class="mt-6">
                    <a href="{{ route('quizzes.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Lihat Daftar Quiz
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection