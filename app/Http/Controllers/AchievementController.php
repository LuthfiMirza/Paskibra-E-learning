<?php

namespace App\Http\Controllers;

use App\Models\Achievement; // Asumsikan Anda membuat model ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AchievementController extends Controller
{
    public function index()
    {
        // Ambil semua achievement dari database
        $allAchievements = Achievement::all();
        $user = Auth::user(); // Dapatkan user yang sedang login

        // Logika untuk memproses achievement user (earned, progress, dll.)
        // Ini adalah contoh sederhana, Anda perlu menyesuaikannya
        $userAchievements = $user->achievements()->get()->keyBy('id');

        $achievements = $allAchievements->map(function ($achievement) use ($userAchievements) {
            $userAchievement = $userAchievements->get($achievement->id);
            $earned = !is_null($userAchievement);
            // Logika untuk menghitung progress, misal dari tabel pivot
            $current_value = $earned ? $achievement->target_value : ($userAchievement->pivot->progress ?? 0);

            return [
                'id' => $achievement->id,
                'title' => $achievement->title,
                'description' => $achievement->description,
                'icon' => $achievement->icon,
                'category' => $achievement->category,
                'points' => $achievement->points,
                'rarity' => $achievement->rarity,
                'earned' => $earned,
                'earned_at' => $earned ? $userAchievement->pivot->created_at->format('Y-m-d H:i:s') : null,
                'progress' => ($current_value / $achievement->target_value) * 100,
                'requirement' => $achievement->requirement,
                'current_value' => $current_value,
                'target_value' => $achievement->target_value,
            ];
        });

        // Statistics
        $earnedAchievements = $achievements->where('earned', true);
        $stats = [
            'total_achievements' => $achievements->count(),
            'earned_achievements' => $earnedAchievements->count(),
            'total_points' => $earnedAchievements->sum('points'),
            'completion_rate' => $achievements->count() > 0 ? round(($earnedAchievements->count() / $achievements->count()) * 100, 1) : 0
        ];

        // Categories
        $categories = array_merge(['all' => 'Semua'], $allAchievements->pluck('category', 'category')->map(fn($cat) => ucfirst($cat))->toArray());

        // Recent achievements
        $recentAchievements = $earnedAchievements->sortByDesc('earned_at')->take(3);

        return view('achievements.index', compact('achievements', 'stats', 'categories', 'recentAchievements'));
    }
}