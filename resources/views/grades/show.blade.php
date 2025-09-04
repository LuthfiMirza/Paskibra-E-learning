@extends('layouts.dashboard')

@section('title', $grade['course_title'])
@section('subtitle', 'Detail nilai dan progress kursus')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm text-gray-500">
            <li><a href="{{ route('dashboard') }}" class="hover:text-blue-600">Dashboard</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="{{ route('grades.index') }}" class="hover:text-blue-600">Nilai</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-800">{{ $grade['course_title'] }}</li>
        </ol>
    </nav>

    <!-- Course Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div class="mb-4 lg:mb-0">
                <div class="flex items-center mb-2">
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full mr-3">
                        {{ $grade['course_code'] }}
                    </span>
                    <span class="text-sm text-gray-500">{{ $grade['credits'] }} SKS</span>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $grade['course_title'] }}</h1>
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="mr-4">{{ $grade['instructor'] }}</span>
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ $grade['semester'] }}</span>
                </div>
            </div>
            
            <div class="flex flex-col items-end">
                <div class="text-right mb-2">
                    <div class="text-3xl font-bold 
                        @if($grade['final_grade'] >= 85) text-green-600
                        @elseif($grade['final_grade'] >= 70) text-blue-600
                        @elseif($grade['final_grade'] >= 60) text-yellow-600
                        @else text-red-600
                        @endif">
                        {{ number_format($grade['final_grade'], 1) }}
                    </div>
                    <div class="text-sm text-gray-500">Nilai Akhir</div>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    @if($grade['letter_grade'] == 'A') bg-green-100 text-green-800
                    @elseif($grade['letter_grade'] == 'B+') bg-blue-100 text-blue-800
                    @elseif($grade['letter_grade'] == 'B') bg-blue-100 text-blue-800
                    @elseif($grade['letter_grade'] == 'C+') bg-yellow-100 text-yellow-800
                    @elseif($grade['letter_grade'] == 'C') bg-yellow-100 text-yellow-800
                    @else bg-red-100 text-red-800
                    @endif">
                    Grade {{ $grade['letter_grade'] }}
                </span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Grade Breakdown -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Rincian Nilai</h2>
                
                <!-- Grade Calculation Summary -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Perhitungan Nilai Akhir</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        @php
                            $totalWeightedScore = 0;
                            $totalWeight = 0;
                            foreach($grade['assignments'] as $assignment) {
                                $weightedScore = ($assignment['score'] / $assignment['max_score']) * $assignment['weight'];
                                $totalWeightedScore += $weightedScore;
                                $totalWeight += $assignment['weight'];
                            }
                        @endphp
                        
                        <div class="text-center">
                            <div class="text-lg font-semibold text-blue-600">{{ count($grade['assignments']) }}</div>
                            <div class="text-gray-600">Tugas</div>
                        </div>
                        <div class="text-center">
                            <div class="text-lg font-semibold text-green-600">{{ $totalWeight }}%</div>
                            <div class="text-gray-600">Total Bobot</div>
                        </div>
                        <div class="text-center">
                            <div class="text-lg font-semibold text-purple-600">{{ number_format($totalWeightedScore, 1) }}</div>
                            <div class="text-gray-600">Nilai Tertimbang</div>
                        </div>
                        <div class="text-center">
                            <div class="text-lg font-semibold text-orange-600">{{ $grade['attendance']['percentage'] }}%</div>
                            <div class="text-gray-600">Kehadiran</div>
                        </div>
                    </div>
                </div>

                <!-- Assignments List -->
                <div class="space-y-4">
                    @foreach($grade['assignments'] as $assignment)
                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3
                                    @if($assignment['type'] == 'Quiz') bg-blue-100 text-blue-600
                                    @elseif($assignment['type'] == 'Praktik') bg-green-100 text-green-600
                                    @elseif($assignment['type'] == 'Ujian') bg-red-100 text-red-600
                                    @else bg-gray-100 text-gray-600
                                    @endif">
                                    @if($assignment['type'] == 'Quiz')
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif($assignment['type'] == 'Praktik')
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a2 2 0 002 2h4a2 2 0 002-2V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">{{ $assignment['name'] }}</h3>
                                    <p class="text-sm text-gray-500">{{ $assignment['type'] }} • Bobot {{ $assignment['weight'] }}%</p>
                                </div>
                            </div>
                            
                            <div class="text-right">
                                <div class="text-lg font-semibold 
                                    @if($assignment['score'] >= 85) text-green-600
                                    @elseif($assignment['score'] >= 70) text-blue-600
                                    @elseif($assignment['score'] >= 60) text-yellow-600
                                    @else text-red-600
                                    @endif">
                                    {{ $assignment['score'] }}/{{ $assignment['max_score'] }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ number_format(($assignment['score'] / $assignment['max_score']) * 100, 1) }}%
                                </div>
                            </div>
                        </div>
                        
                        <!-- Assignment Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600 mb-3">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                Dikumpulkan: {{ \Carbon\Carbon::parse($assignment['submitted_at'])->format('d M Y') }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Dinilai: {{ \Carbon\Carbon::parse($assignment['graded_at'])->format('d M Y') }}
                            </div>
                        </div>
                        
                        <!-- Feedback -->
                        @if($assignment['feedback'])
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-3 rounded">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        <strong>Feedback Instruktur:</strong> {{ $assignment['feedback'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Course Status -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Kursus</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Status</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($grade['status'] == 'Lulus') bg-green-100 text-green-800
                            @elseif($grade['status'] == 'Sedang Berlangsung') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ $grade['status'] }}
                        </span>
                    </div>
                    
                    @if($grade['completed_at'])
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Selesai</span>
                        <span class="text-sm font-medium text-gray-900">
                            {{ \Carbon\Carbon::parse($grade['completed_at'])->format('d M Y') }}
                        </span>
                    </div>
                    @endif
                    
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">SKS</span>
                        <span class="text-sm font-medium text-gray-900">{{ $grade['credits'] }}</span>
                    </div>
                </div>
                
                @if($grade['status'] == 'Lulus')
                <div class="mt-6 pt-4 border-t border-gray-200">
                    <button class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Download Sertifikat
                    </button>
                </div>
                @endif
            </div>

            <!-- Attendance -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Kehadiran</h3>
                <div class="text-center mb-4">
                    <div class="text-3xl font-bold text-blue-600">{{ $grade['attendance']['percentage'] }}%</div>
                    <div class="text-sm text-gray-500">
                        {{ $grade['attendance']['attended'] }} dari {{ $grade['attendance']['total_sessions'] }} sesi
                    </div>
                </div>
                
                <!-- Attendance Progress Bar -->
                <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                    <div class="bg-blue-500 h-3 rounded-full" style="width: {{ $grade['attendance']['percentage'] }}%"></div>
                </div>
                
                <div class="text-xs text-gray-600 text-center">
                    @if($grade['attendance']['percentage'] >= 80)
                        <span class="text-green-600">✓ Memenuhi syarat kehadiran minimum</span>
                    @else
                        <span class="text-red-600">⚠ Kehadiran kurang dari syarat minimum (80%)</span>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h3>
                <div class="space-y-3">
                    <button class="w-full border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        Download Transkrip
                    </button>
                    
                    <button class="w-full border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path>
                        </svg>
                        Export PDF
                    </button>
                    
                    <button class="w-full border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M15 10a5 5 0 01-5 5 5 5 0 01-5-5 5 5 0 015-5 5 5 0 015 5zm-2 0a3 3 0 11-6 0 3 3 0 016 0z" clip-rule="evenodd"></path>
                        </svg>
                        Lihat Kursus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection