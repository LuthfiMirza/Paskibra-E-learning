<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    /**
     * Display the user's grade dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        $attempts = QuizAttempt::with(['quiz.course'])
            ->where('user_id', $user->id)
            ->whereNotNull('completed_at')
            ->orderByDesc('completed_at')
            ->get();

        $scoreHistory = $attempts
            ->sortBy('completed_at')
            ->values()
            ->map(function (QuizAttempt $attempt) {
                return [
                    'label' => optional($attempt->completed_at)->format('d M'),
                    'score' => $attempt->score,
                    'quiz' => $attempt->quiz->title ?? 'Quiz',
                ];
            });

        $stats = [
            'total_attempts' => $attempts->count(),
            'passed_attempts' => $attempts->where('is_passed', true)->count(),
            'failed_attempts' => $attempts->where('is_passed', false)->count(),
            'average_score' => $attempts->avg('score') ? round($attempts->avg('score'), 1) : 0,
            'best_score' => $attempts->max('score') ?? 0,
            'latest_attempt_at' => optional($attempts->first()?->completed_at)->format('d M Y'),
        ];

        $categorySummary = $attempts
            ->groupBy(function (QuizAttempt $attempt) {
                return $attempt->quiz->category ?? 'lainnya';
            })
            ->map(function ($items) {
                return [
                    'count' => $items->count(),
                    'average' => $items->avg('score') ? round($items->avg('score'), 1) : 0,
                    'passed' => $items->where('is_passed', true)->count(),
                ];
            });

        $recentAttempts = $attempts->take(5);

        return view('grades.index', [
            'attempts' => $attempts,
            'stats' => $stats,
            'scoreHistory' => $scoreHistory,
            'categorySummary' => $categorySummary,
            'recentAttempts' => $recentAttempts,
        ]);
    }

    /**
     * Display details for a specific quiz attempt.
     */
    public function show(QuizAttempt $grade)
    {
        abort_if($grade->user_id !== Auth::id(), 403);

        $grade->load(['quiz.questions.options', 'answers.question', 'answers.selectedOption']);

        $questionBreakdown = $grade->quiz?->questions
            ->map(function ($question) use ($grade) {
                $answer = $grade->answers->firstWhere('quiz_question_id', $question->id);

                return [
                    'question' => $question,
                    'answer' => $answer,
                    'is_correct' => $answer?->is_correct ?? false,
                    'selected_value' => $answer?->selected_answer,
                ];
            }) ?? collect();

        return view('grades.show', [
            'attempt' => $grade,
            'questionBreakdown' => $questionBreakdown,
        ]);
    }
}
