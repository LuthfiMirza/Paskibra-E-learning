<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Lesson;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = trim((string) $request->get('q', ''));

        $lessons = collect();
        $quizzes = collect();
        $announcements = collect();

        if ($query !== '') {
            $lessons = Lesson::query()
                ->with('course')
                ->active()
                ->where(function ($builder) use ($query) {
                    $builder->where('title', 'like', "%{$query}%")
                        ->orWhere('content', 'like', "%{$query}%");
                })
                ->orderByDesc('updated_at')
                ->limit(8)
                ->get();

            $quizzes = Quiz::query()
                ->active()
                ->where(function ($builder) use ($query) {
                    $builder->where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                })
                ->where(function ($builder) {
                    $builder->whereNull('published_at')
                        ->orWhere('published_at', '<=', Carbon::now());
                })
                ->orderByDesc('published_at')
                ->orderByDesc('created_at')
                ->limit(8)
                ->get();

            $announcements = Announcement::query()
                ->active()
                ->published()
                ->where(function ($builder) use ($query) {
                    $builder->where('title', 'like', "%{$query}%")
                        ->orWhere('content', 'like', "%{$query}%");
                })
                ->orderByDesc('published_at')
                ->limit(8)
                ->get();
        }

        return view('search.index', [
            'query' => $query,
            'lessons' => $lessons,
            'quizzes' => $quizzes,
            'announcements' => $announcements,
        ]);
    }
}
