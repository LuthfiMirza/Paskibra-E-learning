<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Announcement;
use App\Models\QuizAttempt;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $notifications = $this->buildNotifications($user);

        $stats = [
            'total' => $notifications->count(),
            'unread' => $notifications->where('is_read', false)->count(),
            'today' => $notifications->filter(fn ($item) => $item['created_at'] && $item['created_at']->isToday())->count(),
            'announcements' => $notifications->where('type', 'announcement')->count(),
            'achievements' => $notifications->where('type', 'achievement')->count(),
        ];

        $typeCounts = $notifications
            ->groupBy('type')
            ->map->count();

        $filters = collect(['announcement', 'quiz', 'achievement'])
            ->filter(fn ($type) => $typeCounts->get($type, 0) > 0)
            ->values();

        return view('notifications.index', [
            'notifications' => $notifications,
            'stats' => $stats,
            'typeCounts' => $typeCounts,
            'filters' => $filters,
        ]);
    }

    public function getUnreadCount()
    {
        $user = Auth::user();
        $unreadCount = $this->buildNotifications($user)
            ->where('is_read', false)
            ->count();
        
        return response()->json(['count' => $unreadCount]);
    }

    public function markAsRead($id)
    {
        // In a real application, this would update the database
        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        // In a real application, this would update all notifications for the user
        return response()->json(['success' => true]);
    }

    public function getRecent()
    {
        $user = Auth::user();

        $notifications = $this->buildNotifications($user)
            ->take(5)
            ->map(function (array $notification) {
                $createdAt = $notification['created_at'];

                return [
                    'id' => $notification['id'],
                    'type' => $notification['type'],
                    'title' => $notification['title'],
                    'message' => $notification['message'],
                    'icon' => $notification['icon'],
                    'color' => $notification['color'],
                    'is_read' => $notification['is_read'],
                    'created_at' => $createdAt ? $createdAt->toDateTimeString() : null,
                    'time_ago' => $createdAt ? $createdAt->diffForHumans() : null,
                ];
            })->values();

        return response()->json($notifications);
    }

    /**
     * Build a unified notification feed for the authenticated user.
     */
    private function buildNotifications($user): Collection
    {
        $now = now();

        $announcementNotifications = Announcement::active()
            ->published()
            ->latest('published_at')
            ->take(10)
            ->get()
            ->map(function ($announcement) use ($now) {
                $timestamp = $announcement->published_at ?? $announcement->created_at;

                return [
                    'id' => 'announcement-' . $announcement->id,
                    'type' => 'announcement',
                    'title' => $announcement->title,
                    'message' => Str::limit(strip_tags($announcement->content ?? ''), 160),
                    'icon' => 'megaphone',
                    'color' => 'blue',
                    'badge' => $announcement->type_display,
                    'is_read' => $timestamp ? $timestamp->lt($now->copy()->subDays(3)) : false,
                    'created_at' => $timestamp,
                    'action_url' => route('announcements.index'),
                    'action_text' => 'Lihat Pengumuman',
                ];
            });

        $quizNotifications = $user->quizAttempts()
            ->with('quiz')
            ->completed()
            ->latest('completed_at')
            ->take(10)
            ->get()
            ->map(function (QuizAttempt $attempt) use ($now) {
                $quizTitle = optional($attempt->quiz)->title ?? 'Quiz';
                $timestamp = $attempt->completed_at ?? $attempt->created_at;

                return [
                    'id' => 'quiz-' . $attempt->id,
                    'type' => 'quiz',
                    'title' => 'Quiz "' . $quizTitle . '" selesai',
                    'message' => sprintf(
                        'Skor Anda %s dari %s soal. %s',
                        $attempt->score,
                        $attempt->total_questions,
                        $attempt->is_passed ? 'Selamat, Anda lulus!' : 'Belum mencapai nilai lulus, coba lagi.'
                    ),
                    'icon' => 'check-circle',
                    'color' => 'green',
                    'badge' => $attempt->is_passed ? 'Lulus' : 'Perlu Perbaikan',
                    'is_read' => $timestamp ? $timestamp->lt($now->copy()->subDays(3)) : false,
                    'created_at' => $timestamp,
                    'action_url' => route('quizzes.history'),
                    'action_text' => 'Lihat Hasil',
                ];
            });

        $achievementNotifications = $user->achievements()
            ->orderByDesc('user_achievements.earned_at')
            ->take(10)
            ->get()
            ->map(function ($achievement) use ($now) {
                $timestamp = $achievement->pivot->earned_at ?? $achievement->created_at;

                return [
                    'id' => 'achievement-' . $achievement->id . '-' . optional($achievement->pivot)->earned_at,
                    'type' => 'achievement',
                    'title' => 'Pencapaian baru: ' . $achievement->name,
                    'message' => Str::limit($achievement->description ?? 'Selamat atas pencapaian baru Anda.', 160),
                    'icon' => 'trophy',
                    'color' => 'yellow',
                    'badge' => '+' . $achievement->points . ' XP',
                    'is_read' => $timestamp ? $timestamp->lt($now->copy()->subDays(3)) : false,
                    'created_at' => $timestamp,
                    'action_url' => route('achievements.index'),
                    'action_text' => 'Lihat Lencana',
                ];
            });

        return $announcementNotifications
            ->concat($quizNotifications)
            ->concat($achievementNotifications)
            ->sortByDesc('created_at')
            ->values();
    }
}
