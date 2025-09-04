@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle', 'Selamat datang kembali, Admin!')

@section('content')
<div class="space-y-8">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users Card -->
        <div class="admin-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['total_users'] ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-full">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m-4.5-4.5A2.5 2.5 0 019 3.5V1m0 18v-2.5a2.5 2.5 0 015 0V21m-5-18a2.5 2.5 0 00-5 0V3.5"></path></svg>
                </div>
            </div>
        </div>
        <!-- Total Courses Card -->
        <div class="admin-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Kursus</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['total_courses'] ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
            </div>
        </div>
        <!-- Active Users Card -->
        <div class="admin-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pengguna Aktif Hari Ini</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['active_users_today'] ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-yellow-100 rounded-full">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
            </div>
        </div>
        <!-- Avg. Quiz Score Card -->
        <div class="admin-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Rata-rata Skor Kuis</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ number_format($stats['average_quiz_score'] ?? 0, 1) }}%</p>
                </div>
                <div class="w-12 h-12 flex items-center justify-center bg-purple-100 rounded-full">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- User Growth Chart -->
        <div class="lg:col-span-2 admin-card p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Pertumbuhan Pengguna</h3>
            <div class="relative h-80">
                <canvas id="userGrowthChart"></canvas>
            </div>
        </div>
        <!-- Quiz Performance Chart -->
        <div class="admin-card p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Kinerja Kuis</h3>
            <div class="relative h-80">
                <canvas id="quizPerformanceChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="admin-card">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Aktivitas Terbaru</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentActivities as $activity)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 flex-shrink-0 mr-4 flex items-center justify-center bg-gray-100 rounded-full">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if($activity['type'] == 'user_registration')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            @elseif($activity['type'] == 'quiz_completed')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.168 18.477 18.582 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            @endif
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $activity['user'] }}</p>
                                        <p class="text-sm text-gray-500">{{ $activity['action'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($activity['timestamp'])->diffForHumans() }}</p>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center py-12 text-gray-500">
                                Tidak ada aktivitas terbaru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
        const userGrowthChart = new Chart(userGrowthCtx, {
            type: 'line',
            data: {
                labels: @json($userGrowth['labels'] ?? []),
                datasets: [{
                    label: 'Pertumbuhan Pengguna',
                    data: @json($userGrowth['data'] ?? []),
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        const quizPerformanceCtx = document.getElementById('quizPerformanceChart').getContext('2d');
        const quizPerformanceChart = new Chart(quizPerformanceCtx, {
            type: 'bar',
            data: {
                labels: @json($quizPerformance['labels'] ?? []),
                datasets: [{
                    label: 'Rata-rata Skor',
                    data: @json($quizPerformance['data'] ?? []),
                    backgroundColor: '#10b981',
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endsection
