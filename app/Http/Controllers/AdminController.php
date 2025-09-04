<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Sample admin dashboard data - in a real application, this would come from a database
        $stats = [
            'total_users' => 156,
            'total_students' => 142,
            'total_instructors' => 12,
            'total_admins' => 2,
            'total_courses' => 8,
            'total_quizzes' => 24,
            'total_announcements' => 15,
            'active_users_today' => 89,
            'new_registrations_this_week' => 12,
            'completed_quizzes_today' => 45,
            'average_quiz_score' => 82.5,
            'system_storage_used' => 2.4, // GB
            'system_storage_total' => 10.0, // GB
        ];

        // Recent activities
        $recentActivities = [
            [
                'id' => 1,
                'type' => 'user_registration',
                'user' => 'Ahmad Rizki Pratama',
                'action' => 'mendaftar sebagai siswa baru',
                'timestamp' => '2024-01-03 14:30:00',
                'icon' => 'user-plus',
                'color' => 'green'
            ],
            [
                'id' => 2,
                'type' => 'quiz_completed',
                'user' => 'Siti Nurhaliza',
                'action' => 'menyelesaikan quiz "Sejarah PASKIBRA" dengan nilai 92%',
                'timestamp' => '2024-01-03 13:45:00',
                'icon' => 'check-circle',
                'color' => 'blue'
            ],
            [
                'id' => 3,
                'type' => 'course_created',
                'user' => 'Pembina Paskibra',
                'action' => 'membuat kursus baru "Teknik Lanjutan PBB"',
                'timestamp' => '2024-01-03 12:20:00',
                'icon' => 'book-open',
                'color' => 'purple'
            ],
            [
                'id' => 4,
                'type' => 'announcement_posted',
                'user' => 'Admin System',
                'action' => 'memposting pengumuman "Latihan Rutin Minggu Ini"',
                'timestamp' => '2024-01-03 11:15:00',
                'icon' => 'megaphone',
                'color' => 'orange'
            ],
            [
                'id' => 5,
                'type' => 'user_achievement',
                'user' => 'Budi Santoso',
                'action' => 'meraih badge "Quiz Master"',
                'timestamp' => '2024-01-03 10:30:00',
                'icon' => 'trophy',
                'color' => 'yellow'
            ]
        ];

        // System health
        $systemHealth = [
            'server_status' => 'online',
            'database_status' => 'online',
            'storage_status' => 'healthy',
            'backup_status' => 'completed',
            'last_backup' => '2024-01-03 02:00:00',
            'uptime' => '99.8%',
            'response_time' => '120ms'
        ];

        // Quick stats for charts
        $userGrowth = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'data' => [120, 125, 132, 138, 145, 156]
        ];

        $quizPerformance = [
            'labels' => ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
            'data' => [78, 82, 85, 82.5]
        ];

        return view('admin.index', compact('stats', 'recentActivities', 'systemHealth', 'userGrowth', 'quizPerformance'));
    }

    public function users()
    {
        // Sample users data
        $users = [
            [
                'id' => 1,
                'name' => 'Ahmad Rizki Pratama',
                'email' => 'ahmad.rizki@example.com',
                'role' => 'student',
                'status' => 'active',
                'last_login' => '2024-01-03 14:30:00',
                'joined_date' => '2023-09-15',
                'courses_enrolled' => 6,
                'quizzes_completed' => 18,
                'average_score' => 87.5,
                'avatar' => 'https://ui-avatars.com/api/?name=Ahmad+Rizki+Pratama&background=1B365D&color=fff'
            ],
            [
                'id' => 2,
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@example.com',
                'role' => 'student',
                'status' => 'active',
                'last_login' => '2024-01-03 13:45:00',
                'joined_date' => '2023-09-20',
                'courses_enrolled' => 5,
                'quizzes_completed' => 15,
                'average_score' => 92.3,
                'avatar' => 'https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=DC2626&color=fff'
            ],
            [
                'id' => 3,
                'name' => 'Pembina Paskibra',
                'email' => 'pembina@school.edu',
                'role' => 'instructor',
                'status' => 'active',
                'last_login' => '2024-01-03 12:20:00',
                'joined_date' => '2023-08-01',
                'courses_created' => 4,
                'students_taught' => 142,
                'average_rating' => 4.8,
                'avatar' => 'https://ui-avatars.com/api/?name=Pembina+Paskibra&background=F59E0B&color=fff'
            ],
            [
                'id' => 4,
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'role' => 'student',
                'status' => 'inactive',
                'last_login' => '2024-01-01 09:15:00',
                'joined_date' => '2023-10-05',
                'courses_enrolled' => 3,
                'quizzes_completed' => 8,
                'average_score' => 75.2,
                'avatar' => 'https://ui-avatars.com/api/?name=Budi+Santoso&background=10B981&color=fff'
            ],
            [
                'id' => 5,
                'name' => 'Admin System',
                'email' => 'admin@school.edu',
                'role' => 'admin',
                'status' => 'active',
                'last_login' => '2024-01-03 15:00:00',
                'joined_date' => '2023-07-01',
                'permissions' => 'full_access',
                'actions_today' => 12,
                'avatar' => 'https://ui-avatars.com/api/?name=Admin+System&background=8B5CF6&color=fff'
            ]
        ];

        return view('admin.users', compact('users'));
    }

    public function courses()
    {
        $courses = Course::with('creator')->latest()->paginate(10);
        return view('admin.courses', compact('courses'));
    }

    public function settings()
    {
        // Sample system settings
        $settings = [
            'site_name' => 'PASKIBRA WiraPurusa E-Learning',
            'site_description' => 'Platform pembelajaran online untuk anggota PASKIBRA',
            'admin_email' => 'admin@school.edu',
            'max_file_upload' => '10MB',
            'session_timeout' => '120 minutes',
            'backup_frequency' => 'daily',
            'maintenance_mode' => false,
            'user_registration' => true,
            'email_notifications' => true,
            'auto_backup' => true,
            'debug_mode' => false
        ];

        return view('admin.settings', compact('settings'));
    }

    public function reports()
    {
        // Sample reports data
        $reports = [
            'user_activity' => [
                'daily_active_users' => 89,
                'weekly_active_users' => 134,
                'monthly_active_users' => 156,
                'user_retention_rate' => 85.2
            ],
            'course_performance' => [
                'total_enrollments' => 245,
                'completion_rate' => 72.8,
                'average_score' => 82.5,
                'dropout_rate' => 12.3
            ],
            'system_usage' => [
                'storage_used' => 2.4,
                'bandwidth_used' => 45.6,
                'api_calls_today' => 1250,
                'error_rate' => 0.02
            ]
        ];

        return view('admin.reports', compact('reports'));
    }
}