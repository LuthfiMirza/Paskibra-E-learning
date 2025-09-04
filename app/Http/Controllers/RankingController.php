<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index()
    {
        // Sample ranking data - in a real application, this would come from a database
        $rankings = [
            [
                'rank' => 1,
                'student_id' => 'PSK001',
                'name' => 'Ahmad Rizki Pratama',
                'class' => 'XI IPA 1',
                'total_points' => 2850,
                'gpa' => 3.85,
                'completed_courses' => 8,
                'quiz_average' => 92.5,
                'attendance_rate' => 98.5,
                'badges' => ['top-performer', 'perfect-attendance', 'quiz-master'],
                'avatar' => 'https://ui-avatars.com/api/?name=Ahmad+Rizki+Pratama&background=1B365D&color=fff',
                'trend' => 'up',
                'last_activity' => '2024-01-03 14:30:00'
            ],
            [
                'rank' => 2,
                'student_id' => 'PSK002',
                'name' => 'Siti Nurhaliza',
                'class' => 'XI IPA 2',
                'total_points' => 2720,
                'gpa' => 3.78,
                'completed_courses' => 7,
                'quiz_average' => 89.2,
                'attendance_rate' => 96.8,
                'badges' => ['consistent-learner', 'quiz-master'],
                'avatar' => 'https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=DC2626&color=fff',
                'trend' => 'up',
                'last_activity' => '2024-01-03 13:45:00'
            ],
            [
                'rank' => 3,
                'student_id' => 'PSK003',
                'name' => 'Budi Santoso',
                'class' => 'XI IPS 1',
                'total_points' => 2680,
                'gpa' => 3.72,
                'completed_courses' => 7,
                'quiz_average' => 87.8,
                'attendance_rate' => 94.2,
                'badges' => ['dedicated-student'],
                'avatar' => 'https://ui-avatars.com/api/?name=Budi+Santoso&background=F59E0B&color=fff',
                'trend' => 'same',
                'last_activity' => '2024-01-03 12:20:00'
            ],
            [
                'rank' => 4,
                'student_id' => 'PSK004',
                'name' => 'Dewi Kartika',
                'class' => 'XI IPA 1',
                'total_points' => 2590,
                'gpa' => 3.65,
                'completed_courses' => 6,
                'quiz_average' => 85.4,
                'attendance_rate' => 92.1,
                'badges' => ['rising-star'],
                'avatar' => 'https://ui-avatars.com/api/?name=Dewi+Kartika&background=10B981&color=fff',
                'trend' => 'up',
                'last_activity' => '2024-01-03 11:15:00'
            ],
            [
                'rank' => 5,
                'student_id' => 'PSK005',
                'name' => 'Andi Wijaya',
                'class' => 'XI IPS 2',
                'total_points' => 2520,
                'gpa' => 3.58,
                'completed_courses' => 6,
                'quiz_average' => 83.7,
                'attendance_rate' => 90.5,
                'badges' => ['team-player'],
                'avatar' => 'https://ui-avatars.com/api/?name=Andi+Wijaya&background=8B5CF6&color=fff',
                'trend' => 'down',
                'last_activity' => '2024-01-03 10:30:00'
            ],
            [
                'rank' => 6,
                'student_id' => 'PSK006',
                'name' => 'Maya Sari',
                'class' => 'XI IPA 2',
                'total_points' => 2480,
                'gpa' => 3.52,
                'completed_courses' => 5,
                'quiz_average' => 82.1,
                'attendance_rate' => 89.3,
                'badges' => ['newcomer'],
                'avatar' => 'https://ui-avatars.com/api/?name=Maya+Sari&background=EC4899&color=fff',
                'trend' => 'up',
                'last_activity' => '2024-01-03 09:45:00'
            ],
            [
                'rank' => 7,
                'student_id' => 'PSK007',
                'name' => 'Reza Firmansyah',
                'class' => 'XI IPS 1',
                'total_points' => 2420,
                'gpa' => 3.45,
                'completed_courses' => 5,
                'quiz_average' => 80.6,
                'attendance_rate' => 87.8,
                'badges' => ['improving'],
                'avatar' => 'https://ui-avatars.com/api/?name=Reza+Firmansyah&background=F97316&color=fff',
                'trend' => 'up',
                'last_activity' => '2024-01-03 08:20:00'
            ],
            [
                'rank' => 8,
                'student_id' => 'PSK008',
                'name' => 'Indira Putri',
                'class' => 'XI IPA 1',
                'total_points' => 2350,
                'gpa' => 3.38,
                'completed_courses' => 4,
                'quiz_average' => 78.9,
                'attendance_rate' => 85.2,
                'badges' => ['potential'],
                'avatar' => 'https://ui-avatars.com/api/?name=Indira+Putri&background=06B6D4&color=fff',
                'trend' => 'same',
                'last_activity' => '2024-01-02 16:30:00'
            ]
        ];

        // Current user's ranking (simulated)
        $currentUserRank = [
            'rank' => 4,
            'student_id' => 'PSK004',
            'name' => auth()->user()->name,
            'class' => 'XI IPA 1',
            'total_points' => 2590,
            'gpa' => 3.65,
            'completed_courses' => 6,
            'quiz_average' => 85.4,
            'attendance_rate' => 92.1,
            'badges' => ['rising-star'],
            'trend' => 'up'
        ];

        // Statistics
        $stats = [
            'total_students' => 156,
            'active_this_week' => 142,
            'average_gpa' => 3.42,
            'top_class' => 'XI IPA 1'
        ];

        // Leaderboard categories
        $categories = [
            'overall' => 'Ranking Keseluruhan',
            'gpa' => 'IPK Tertinggi',
            'quiz' => 'Rata-rata Quiz',
            'attendance' => 'Kehadiran Terbaik',
            'courses' => 'Kursus Terbanyak'
        ];

        return view('rankings.index', compact('rankings', 'currentUserRank', 'stats', 'categories'));
    }
}