<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\Lesson;
use App\Models\Announcement;
use App\Models\QuizAttempt;
use App\Models\Achievement;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stats = $this->getStats($user);
        return view('dashboard', compact('stats'));
    }

    public function redesign()
    {
        $user = Auth::user();
        $stats = $this->getStats($user);
        return view('dashboard-redesign', compact('stats'));
    }

    private function getStats($user)
    {
        // Get real-time statistics from database
        return [
            'total_courses' => Course::where('is_active', true)->count(),
            'total_quizzes' => Quiz::where('is_active', true)->count(),
            // Quick actions dynamic data
            'available_lessons' => Lesson::active()
                ->whereHas('course', function ($q) {
                    $q->where('is_active', true);
                })
                ->count(),
            'available_quizzes' => Quiz::where('is_active', true)
                ->where(function ($builder) {
                    $builder->whereNull('published_at')
                        ->orWhere('published_at', '<=', now());
                })
                ->count(),
            'completed_quizzes' => QuizAttempt::where('user_id', $user->id)->completed()->count(),
            'average_score' => QuizAttempt::where('user_id', $user->id)
                ->completed()
                ->avg('score') ?? 0,
        ];
    }

    private function adminDashboard()
    {
        $stats = [
            'total_users' => \App\Models\User::count(),
            'total_courses' => Course::count(),
            'total_quizzes' => Quiz::count(),
            'total_announcements' => Announcement::count(),
        ];

        $recentAnnouncements = Announcement::with('creator')
            ->active()
            ->published()
            ->latest()
            ->take(5)
            ->get();

        $recentQuizAttempts = QuizAttempt::with(['user', 'quiz'])
            ->completed()
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard.admin', compact('stats', 'recentAnnouncements', 'recentQuizAttempts'));
    }

    private function instructorDashboard()
    {
        $user = Auth::user();
        
        $stats = [
            'my_courses' => Course::where('created_by', $user->id)->count(),
            'my_quizzes' => Quiz::where('created_by', $user->id)->count(),
            'total_students' => \App\Models\User::role('member')->count(),
            'quiz_attempts_today' => QuizAttempt::whereDate('created_at', today())->count(),
        ];

        $myCourses = Course::where('created_by', $user->id)
            ->with('lessons')
            ->latest()
            ->take(5)
            ->get();

        $recentQuizAttempts = QuizAttempt::with(['user', 'quiz'])
            ->whereHas('quiz', function($query) use ($user) {
                $query->where('created_by', $user->id);
            })
            ->completed()
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard.instructor', compact('stats', 'myCourses', 'recentQuizAttempts'));
    }

    private function memberDashboard()
    {
        $user = Auth::user();
        
        $stats = [
            'completed_courses' => 0, // Will implement course completion tracking
            'quiz_attempts' => QuizAttempt::where('user_id', $user->id)->count(),
            'passed_quizzes' => QuizAttempt::where('user_id', $user->id)->passed()->count(),
            'total_points' => $user->achievements()->sum('points') ?? 0,
        ];

        $availableCourses = Course::active()
            ->with('lessons')
            ->latest()
            ->take(6)
            ->get();

        $recentQuizzes = Quiz::active()
            ->with('course')
            ->latest()
            ->take(5)
            ->get();

        $recentAnnouncements = Announcement::active()
            ->published()
            ->latest()
            ->take(3)
            ->get();

        $myAchievements = $user->achievements()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.member', compact(
            'stats', 
            'availableCourses', 
            'recentQuizzes', 
            'recentAnnouncements', 
            'myAchievements'
        ));
    }
}
