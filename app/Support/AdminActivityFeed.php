<?php

namespace App\Support;

use App\Models\QuizAttempt;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminActivityFeed
{
    /**
     * Build activity feed items for the admin top bar notification dropdown.
     */
    public static function build(int $limit = 8): Collection
    {
        if (!Schema::hasTable('users')) {
            return collect();
        }

        $now = Carbon::now();
        $activities = collect();

        if (Schema::hasTable('quiz_attempts')) {
            $quizActivities = QuizAttempt::with(['user', 'quiz'])
                ->completed()
                ->latest('completed_at')
                ->take($limit)
                ->get()
                ->map(function (QuizAttempt $attempt) use ($now) {
                    $timestamp = $attempt->completed_at ?? $attempt->created_at ?? $now;

                    return [
                        'id' => 'quiz-' . $attempt->id,
                        'type' => 'quiz',
                        'title' => optional($attempt->user)->name ?? 'Peserta',
                        'description' => sprintf(
                            'menyelesaikan kuis "%s" dengan skor %s%%.',
                            optional($attempt->quiz)->title ?? 'Tanpa Judul',
                            number_format($attempt->score ?? 0, 0)
                        ),
                        'badge' => $attempt->is_passed ? 'Lulus' : 'Perlu Review',
                        'icon' => 'quiz',
                        'icon_color' => $attempt->is_passed ? 'text-emerald-600' : 'text-amber-600',
                        'icon_background' => $attempt->is_passed ? 'bg-emerald-50' : 'bg-amber-50',
                        'timestamp' => $timestamp,
                        'time_ago' => $timestamp?->diffForHumans(),
                        'is_new' => $timestamp?->gt($now->copy()->subDay()) ?? false,
                        'link' => route('admin.quizzes.index'),
                    ];
                });

            $activities = $activities->concat($quizActivities);
        }

        if (Schema::hasTable('user_achievements') && Schema::hasTable('achievements')) {
            $achievementActivities = DB::table('user_achievements')
                ->join('users', 'user_achievements.user_id', '=', 'users.id')
                ->join('achievements', 'user_achievements.achievement_id', '=', 'achievements.id')
                ->select([
                    'user_achievements.*',
                    'users.name as user_name',
                    'achievements.name as achievement_name',
                    'achievements.description as achievement_description',
                    'achievements.points as achievement_points',
                ])
                ->orderByDesc('user_achievements.earned_at')
                ->take($limit)
                ->get()
                ->map(function ($row) use ($now) {
                    $timestamp = Carbon::parse($row->earned_at ?? $row->created_at ?? $now);

                    return [
                        'id' => 'achievement-' . $row->id,
                        'type' => 'achievement',
                        'title' => $row->user_name,
                        'description' => 'meraih pencapaian "' . $row->achievement_name . '".',
                        'badge' => '+' . $row->achievement_points . ' XP',
                        'icon' => 'trophy',
                        'icon_color' => 'text-amber-600',
                        'icon_background' => 'bg-amber-50',
                        'timestamp' => $timestamp,
                        'time_ago' => $timestamp?->diffForHumans(),
                        'is_new' => $timestamp?->gt($now->copy()->subDay()) ?? false,
                        'link' => route('achievements.index'),
                    ];
                });

            $activities = $activities->concat($achievementActivities);
        }

        $studentActivities = User::students()
            ->latest()
            ->take($limit)
            ->get()
            ->map(function (User $user) use ($now) {
                $timestamp = $user->created_at ?? $now;

                return [
                    'id' => 'student-' . $user->id,
                    'type' => 'student',
                    'title' => $user->name,
                    'description' => 'mendaftar sebagai siswa tingkat ' . ($user->learning_level_display ?? 'Umum') . '.',
                    'badge' => 'Akun Baru',
                    'icon' => 'user',
                    'icon_color' => 'text-indigo-600',
                    'icon_background' => 'bg-indigo-50',
                    'timestamp' => $timestamp,
                    'time_ago' => $timestamp?->diffForHumans(),
                    'is_new' => $timestamp?->gt($now->copy()->subDay()) ?? false,
                    'link' => route('admin.users.index'),
                ];
            });

        $activities = $activities->concat($studentActivities);

        return $activities
            ->filter(fn ($item) => !empty($item['timestamp']))
            ->sortByDesc('timestamp')
            ->values()
            ->take($limit);
    }
}
