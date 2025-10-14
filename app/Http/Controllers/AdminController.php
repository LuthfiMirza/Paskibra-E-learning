<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $stats = $this->buildDashboardStats();
        $trends = $this->buildDashboardTrends($stats);
        $filters = $this->resolveFilters($request);

        return view('admin.index', [
            'stats' => $stats,
            'trends' => $trends,
            'recentActivities' => $this->buildRecentActivities(),
            'userGrowth' => $this->buildUserGrowthDataset($filters['user_growth']['active']),
            'quizPerformance' => $this->buildQuizPerformanceDataset(),
            'filters' => $filters,
        ]);
    }

    public function users()
    {
        // TODO: Replace dummy users with real data in a follow-up iteration.
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
                'avatar' => 'https://ui-avatars.com/api/?name=Ahmad+Rizki+Pratama&background=1B365D&color=fff',
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
                'avatar' => 'https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=DC2626&color=fff',
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
                'avatar' => 'https://ui-avatars.com/api/?name=Pembina+Paskibra&background=F59E0B&color=fff',
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
                'avatar' => 'https://ui-avatars.com/api/?name=Budi+Santoso&background=10B981&color=fff',
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
                'avatar' => 'https://ui-avatars.com/api/?name=Admin+System&background=8B5CF6&color=fff',
            ],
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
        $defaults = [
            'site_name' => 'PASKIBRA WiraPurusa E-Learning',
            'site_description' => 'Platform pembelajaran online untuk anggota PASKIBRA',
            'admin_email' => 'admin@school.edu',
            'max_file_upload' => '10MB',
            'session_timeout' => '120 minutes',
            'backup_frequency' => 'daily',
            'maintenance_mode' => '0',
            'user_registration' => '1',
            'email_notifications' => '1',
            'auto_backup' => '1',
            'debug_mode' => '0',
        ];

        $settings = \App\Models\Setting::getMany(array_keys($defaults), $defaults);
        return view('admin.settings', compact('settings'));
    }

    protected function buildDashboardStats(): array
    {
        [$usedStorage, $totalStorage] = $this->calculateStorageUsage();
        $averageScore = QuizAttempt::completed()->whereNotNull('score')->avg('score');

        return [
            'total_users' => User::count(),
            'total_students' => User::students()->count(),
            'total_instructors' => User::instructors()->count(),
            'total_admins' => User::admins()->count(),
            'total_courses' => Course::count(),
            'total_quizzes' => Quiz::count(),
            'total_announcements' => Announcement::count(),
            'active_users_today' => $this->countActiveUsersBetween(now()->copy()->startOfDay(), now()),
            'new_registrations_this_week' => User::where('created_at', '>=', now()->startOfWeek())->count(),
            'completed_quizzes_today' => QuizAttempt::completed()
                ->whereNotNull('completed_at')
                ->whereDate('completed_at', now())
                ->count(),
            'average_quiz_score' => round($averageScore ?? 0, 1),
            'system_storage_used' => $usedStorage,
            'system_storage_total' => $totalStorage,
        ];
    }

    protected function buildDashboardTrends(array $stats): array
    {
        $now = now();
        $lastMonth = $now->copy()->subMonthNoOverflow();

        $previousUsers = $this->countUsersAsOf($lastMonth->copy()->endOfMonth());
        $previousCourses = $this->countCoursesAsOf($lastMonth->copy()->endOfMonth());
        $previousActiveUsers = $this->countActiveUsersOn($now->copy()->subDay());
        $previousAverageScore = $this->averageQuizScoreForPeriod(
            $lastMonth->copy()->startOfMonth(),
            $lastMonth->copy()->endOfMonth()
        );

        return [
            'total_users' => $this->formatChange($stats['total_users'], $previousUsers),
            'total_courses' => $this->formatChange($stats['total_courses'], $previousCourses),
            'active_users_today' => $this->formatChange($stats['active_users_today'], $previousActiveUsers),
            'average_quiz_score' => $this->formatChange($stats['average_quiz_score'], $previousAverageScore),
        ];
    }

    protected function resolveFilters(Request $request): array
    {
        $range = $request->query('growth_range', '12_months');
        $labels = [
            '12_months' => '12 bulan terakhir',
            '6_months' => '6 bulan terakhir',
            '30_days' => '30 hari terakhir',
            '7_days' => '7 hari terakhir',
            '24_hours' => '24 jam terakhir',
        ];

        if (!array_key_exists($range, $labels)) {
            $range = '12_months';
        }

        return [
            'user_growth' => [
                'active' => $range,
                'label' => $labels[$range],
            ],
        ];
    }

    protected function buildUserGrowthDataset(string $range): array
    {
        return match ($range) {
            '24_hours' => $this->userGrowthHourlyDataset(24),
            '7_days' => $this->userGrowthDailyDataset(7),
            '30_days' => $this->userGrowthDailyDataset(30),
            '6_months' => $this->userGrowthMonthlyDataset(6),
            default => $this->userGrowthMonthlyDataset(12),
        };
    }

    protected function buildQuizPerformanceDataset(): array
    {
        $start = now()->copy()->subWeeks(3)->startOfWeek();
        $averages = QuizAttempt::completed()
            ->whereNotNull('completed_at')
            ->where('completed_at', '>=', $start)
            ->selectRaw("DATE_FORMAT(completed_at, '%x-%v') as period, AVG(score) as average")
            ->groupBy('period')
            ->orderBy('period')
            ->pluck('average', 'period');

        $labels = [];
        $data = [];

        for ($i = 0; $i < 4; $i++) {
            $weekStart = $start->copy()->addWeeks($i);
            $key = sprintf('%d-%02d', $weekStart->isoWeekYear, $weekStart->isoWeek);
            $labels[] = 'Minggu ' . $weekStart->translatedFormat('d M');
            $data[] = round((float) ($averages[$key] ?? 0), 1);
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    protected function buildRecentActivities(): array
    {
        $activities = collect()
            ->merge($this->recentUserActivities())
            ->merge($this->recentCourseActivities())
            ->merge($this->recentAnnouncementActivities())
            ->merge($this->recentQuizAttemptActivities());

        return $activities
            ->filter(fn ($activity) => !empty($activity['timestamp']))
            ->sortByDesc(fn ($activity) => $activity['timestamp'])
            ->take(10)
            ->map(function ($activity) {
                if ($activity['timestamp'] instanceof Carbon) {
                    $activity['timestamp'] = $activity['timestamp']->toDateTimeString();
                }

                return $activity;
            })
            ->values()
            ->toArray();
    }

    protected function calculateStorageUsage(): array
    {
        $path = storage_path();
        $total = @disk_total_space($path);
        $free = @disk_free_space($path);

        if ($total === false || $free === false) {
            return [null, null];
        }

        $used = $total - $free;

        return [
            round($used / (1024 ** 3), 1),
            round($total / (1024 ** 3), 1),
        ];
    }

    protected function countActiveUsersBetween(Carbon $start, Carbon $end): int
    {
        return (int) DB::table('sessions')
            ->whereNotNull('user_id')
            ->whereBetween('last_activity', [$start->timestamp, $end->timestamp])
            ->distinct('user_id')
            ->count('user_id');
    }

    protected function countActiveUsersOn(Carbon $date): int
    {
        $start = $date->copy()->startOfDay();
        $end = $date->copy()->endOfDay();

        return $this->countActiveUsersBetween($start, $end);
    }

    protected function countUsersAsOf(Carbon $date): int
    {
        return User::where('created_at', '<=', $date->copy()->endOfDay())->count();
    }

    protected function countCoursesAsOf(Carbon $date): int
    {
        return Course::where('created_at', '<=', $date->copy()->endOfDay())->count();
    }

    protected function averageQuizScoreForPeriod(Carbon $start, Carbon $end): ?float
    {
        return QuizAttempt::completed()
            ->whereNotNull('completed_at')
            ->whereBetween('completed_at', [$start, $end])
            ->avg('score');
    }

    protected function formatChange($current, $previous): array
    {
        if ($previous === null || (float) $previous === 0.0) {
            return [
                'percent' => null,
                'formatted' => '—',
                'direction' => 'neutral',
            ];
        }

        $change = (($current - $previous) / $previous) * 100;
        $rounded = round($change, 1);
        $direction = $rounded > 0 ? 'up' : ($rounded < 0 ? 'down' : 'neutral');

        $formatted = match (true) {
            $rounded > 0 => '+' . number_format($rounded, 1) . '%',
            $rounded < 0 => number_format($rounded, 1) . '%',
            default => '0%',
        };

        return [
            'percent' => $rounded,
            'formatted' => $formatted,
            'direction' => $direction,
        ];
    }

    protected function userGrowthMonthlyDataset(int $months): array
    {
        $start = now()->copy()->startOfMonth()->subMonths($months - 1);
        $totals = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as period, COUNT(*) as total')
            ->where('created_at', '>=', $start)
            ->groupBy('period')
            ->orderBy('period')
            ->pluck('total', 'period');

        $labels = [];
        $data = [];

        for ($i = 0; $i < $months; $i++) {
            $date = $start->copy()->addMonths($i);
            $key = $date->format('Y-m');
            $labels[] = $date->translatedFormat('M Y');
            $data[] = (int) ($totals[$key] ?? 0);
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    protected function userGrowthDailyDataset(int $days): array
    {
        $start = now()->copy()->subDays($days - 1)->startOfDay();
        $totals = User::selectRaw('DATE(created_at) as period, COUNT(*) as total')
            ->where('created_at', '>=', $start)
            ->groupBy('period')
            ->orderBy('period')
            ->pluck('total', 'period');

        $labels = [];
        $data = [];

        for ($i = 0; $i < $days; $i++) {
            $date = $start->copy()->addDays($i);
            $key = $date->format('Y-m-d');
            $labels[] = $date->translatedFormat('d M');
            $data[] = (int) ($totals[$key] ?? 0);
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    protected function userGrowthHourlyDataset(int $hours): array
    {
        $start = now()->copy()->subHours($hours - 1)->startOfHour();
        $totals = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:00:00") as period, COUNT(*) as total')
            ->where('created_at', '>=', $start)
            ->groupBy('period')
            ->orderBy('period')
            ->pluck('total', 'period');

        $labels = [];
        $data = [];

        for ($i = 0; $i < $hours; $i++) {
            $date = $start->copy()->addHours($i);
            $key = $date->format('Y-m-d H:00:00');
            $labels[] = $date->translatedFormat('H:i');
            $data[] = (int) ($totals[$key] ?? 0);
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    protected function recentUserActivities(): Collection
    {
        return User::latest()->take(5)->get()->map(function (User $user) {
            return [
                'type' => 'user_registration',
                'user' => $user->name,
                'action' => 'mendaftar sebagai ' . Str::lower($user->getRoleDisplayName()),
                'timestamp' => $user->created_at,
                'meta' => $user->email,
            ];
        });
    }

    protected function recentCourseActivities(): Collection
    {
        return Course::with('creator')->latest()->take(5)->get()->map(function (Course $course) {
            return [
                'type' => 'course_created',
                'user' => optional($course->creator)->name ?? 'Instruktur',
                'action' => 'membuat kursus "' . $course->title . '"',
                'timestamp' => $course->created_at,
                'meta' => $course->category_display ?? $course->category,
            ];
        });
    }

    protected function recentAnnouncementActivities(): Collection
    {
        return Announcement::with('creator')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->take(5)
            ->get()
            ->map(function (Announcement $announcement) {
                $timestamp = $announcement->published_at ?? $announcement->created_at;

                return [
                    'type' => 'announcement_posted',
                    'user' => optional($announcement->creator)->name ?? 'Admin',
                    'action' => 'memposting pengumuman "' . $announcement->title . '"',
                    'timestamp' => $timestamp,
                    'meta' => $announcement->type_display ?? $announcement->type,
                ];
            });
    }

    protected function recentQuizAttemptActivities(): Collection
    {
        return QuizAttempt::with(['user', 'quiz'])
            ->completed()
            ->whereNotNull('completed_at')
            ->latest('completed_at')
            ->take(5)
            ->get()
            ->map(function (QuizAttempt $attempt) {
                $quizTitle = optional($attempt->quiz)->title ?? 'Quiz';

                return [
                    'type' => 'quiz_completed',
                    'user' => optional($attempt->user)->name ?? 'Pengguna',
                    'action' => 'menyelesaikan quiz "' . $quizTitle . '" dengan nilai ' . ($attempt->score ?? 0) . '%',
                    'timestamp' => $attempt->completed_at,
                    'meta' => $attempt->is_passed ? 'Lulus' : 'Belum lulus',
                ];
            });
    }
}
