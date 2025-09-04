@extends('layouts.dashboard')

@section('title', 'Hasil Quiz: ' . $attempt->quiz->title)
@section('subtitle', 'Detail hasil dan pembahasan jawaban')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Result Summary -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r {{ $attempt->is_passed ? 'from-green-500 to-green-600' : 'from-red-500 to-red-600' }} text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">{{ $attempt->quiz->title }}</h1>
                    <p class="text-green-100">{{ $attempt->is_passed ? '🎉 Selamat! Anda Lulus!' : '😔 Belum Lulus' }}</p>
                </div>
                <div class="text-right">
                    <div class="text-4xl font-bold">{{ $attempt->score }}%</div>
                    <div class="text-sm opacity-90">{{ $attempt->grade }}</div>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-900">{{ $attempt->correct_answers }}</div>
                    <div class="text-sm text-gray-600">Jawaban Benar</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-900">{{ $attempt->total_questions - $attempt->correct_answers }}</div>
                    <div class="text-sm text-gray-600">Jawaban Salah</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-900">{{ $attempt->total_questions }}</div>
                    <div class="text-sm text-gray-600">Total Soal</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-900">{{ $attempt->duration }}</div>
                    <div class="text-sm text-gray-600">Menit</div>
                </div>
            </div>
            
            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="flex items-center justify-between text-sm text-gray-600">
                    <div>
                        <span class="font-medium">Dikerjakan:</span> 
                        {{ $attempt->completed_at->format('d M Y, H:i') }}
                    </div>
                    <div>
                        <span class="font-medium">Nilai Lulus:</span> 
                        {{ $attempt->quiz->passing_score }}%
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Bar -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-gray-700">Progress Jawaban</span>
            <span class="text-sm text-gray-500">{{ $attempt->correct_answers }}/{{ $attempt->total_questions }}</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-3">
            <div class="bg-gradient-to-r {{ $attempt->is_passed ? 'from-green-400 to-green-500' : 'from-red-400 to-red-500' }} h-3 rounded-full transition-all duration-500" 
                 style="width: {{ ($attempt->correct_answers / $attempt->total_questions) * 100 }}%"></div>
        </div>
    </div>

    <!-- Detailed Answers -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">Pembahasan Jawaban</h2>
            <p class="text-gray-600">Review jawaban Anda dan pelajari penjelasan untuk setiap soal</p>
        </div>
        
        <div class="divide-y divide-gray-200">
            @foreach($attempt->quiz->questions as $index => $question)
                @php
                    // Get user answer from relationship (quiz_answers table)
                    $userAnswerRecord = $attempt->answers()->where('quiz_question_id', $question->id)->first();
                    
                    // Get user answer from JSON (quiz_attempts.answers column)
                    $userSelectedAnswer = isset($attempt->answers[$question->id]) ? $attempt->answers[$question->id] : null;
                    
                    $isCorrect = $userAnswerRecord ? $userAnswerRecord->is_correct : false;
                @endphp
                
                <div class="p-6">
                    <div class="flex items-start space-x-4">
                        <!-- Question Number -->
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium
                                {{ $isCorrect ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $index + 1 }}
                            </div>
                        </div>
                        
                        <div class="flex-1">
                            <!-- Question -->
                            <h3 class="text-lg font-medium text-gray-900 mb-4">
                                {{ $question->question }}
                            </h3>
                            
                            <!-- Options -->
                            <div class="space-y-3 mb-4">
                                @if($question->options && is_array($question->options))
                                    {{-- JSON options --}}
                                    @foreach($question->options as $key => $optionText)
                                        @php
                                            $isSelected = $userSelectedAnswer == $key;
                                            $isCorrectOption = in_array($key, $question->correct_answer ?? []);
                                        @endphp
                                        
                                        <div class="flex items-start space-x-3 p-3 rounded-lg border
                                            @if($isSelected && $isCorrectOption) border-green-300 bg-green-50
                                            @elseif($isSelected && !$isCorrectOption) border-red-300 bg-red-50
                                            @elseif(!$isSelected && $isCorrectOption) border-green-300 bg-green-50
                                            @else border-gray-200 @endif">
                                            
                                            <div class="flex-shrink-0 mt-1">
                                                @if($isSelected && $isCorrectOption)
                                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                @elseif($isSelected && !$isCorrectOption)
                                                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                    </svg>
                                                @elseif(!$isSelected && $isCorrectOption)
                                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                @else
                                                    <div class="w-5 h-5 border-2 border-gray-300 rounded-full"></div>
                                                @endif
                                            </div>
                                            
                                            <div class="flex-1">
                                                <span class="text-gray-900 {{ $isCorrectOption ? 'font-medium' : '' }}">
                                                    {{ $key }}. {{ $optionText }}
                                                </span>
                                                
                                                @if($isSelected && $isCorrectOption)
                                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Jawaban Anda (Benar)
                                                    </span>
                                                @elseif($isSelected && !$isCorrectOption)
                                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        Jawaban Anda (Salah)
                                                    </span>
                                                @elseif(!$isSelected && $isCorrectOption)
                                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Jawaban Benar
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    {{-- Relationship options --}}
                                    @foreach($question->options as $option)
                                        @php
                                            $isSelected = $userAnswerRecord && $userAnswerRecord->selected_option_id == $option->id;
                                            $isCorrectOption = $option->is_correct;
                                        @endphp
                                        
                                        <div class="flex items-start space-x-3 p-3 rounded-lg border
                                            @if($isSelected && $isCorrectOption) border-green-300 bg-green-50
                                            @elseif($isSelected && !$isCorrectOption) border-red-300 bg-red-50
                                            @elseif(!$isSelected && $isCorrectOption) border-green-300 bg-green-50
                                            @else border-gray-200 @endif">
                                            
                                            <div class="flex-shrink-0 mt-1">
                                                @if($isSelected && $isCorrectOption)
                                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                @elseif($isSelected && !$isCorrectOption)
                                                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                    </svg>
                                                @elseif(!$isSelected && $isCorrectOption)
                                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                @else
                                                    <div class="w-5 h-5 border-2 border-gray-300 rounded-full"></div>
                                                @endif
                                            </div>
                                            
                                            <div class="flex-1">
                                                <span class="text-gray-900 {{ $isCorrectOption ? 'font-medium' : '' }}">
                                                    {{ $option->option_text }}
                                                </span>
                                                
                                                @if($isSelected && $isCorrectOption)
                                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Jawaban Anda (Benar)
                                                    </span>
                                                @elseif($isSelected && !$isCorrectOption)
                                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        Jawaban Anda (Salah)
                                                    </span>
                                                @elseif(!$isSelected && $isCorrectOption)
                                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Jawaban Benar
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            
                            <!-- Explanation -->
                            @if($question->explanation)
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <div class="flex items-start space-x-2">
                                        <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <div>
                                            <h4 class="font-medium text-blue-900 mb-1">Penjelasan:</h4>
                                            <p class="text-blue-800 text-sm">{{ $question->explanation }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-between">
        <a href="{{ route('quizzes.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Quiz
        </a>
        
        <div class="flex space-x-3">
            @if(!$attempt->is_passed && $attempt->quiz->allow_retake && $attempt->quiz->canUserTake(auth()->id()))
                <a href="{{ route('quizzes.show', $attempt->quiz->id) }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Coba Lagi
                </a>
            @endif
            
            <button onclick="window.print()" 
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Cetak Hasil
            </button>
        </div>
    </div>
</div>

<style>
    @media print {
        .no-print {
            display: none !important;
        }
        
        body {
            background: white !important;
        }
        
        .bg-gradient-to-r {
            background: #374151 !important;
            color: white !important;
        }
    }
</style>
@endsection