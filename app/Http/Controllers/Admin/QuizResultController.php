<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;

class QuizResultController extends Controller
{
    /**
     * Display a listing of quiz attempts for admin.
     */
    public function index(Request $request)
    {
        $query = QuizAttempt::with(['user', 'quiz.course'])
            ->completed();

        $search = trim((string) $request->get('search', ''));
        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })->orWhereHas('quiz', function ($quizQuery) use ($search) {
                    $quizQuery->where('title', 'like', "%{$search}%");
                });
            });
        }

        $quizId = $request->get('quiz_id', 'all');
        if ($quizId && $quizId !== 'all') {
            $query->where('quiz_id', $quizId);
        }

        $status = (string) $request->get('status', 'all');
        if ($status === 'passed') {
            $query->where('is_passed', true);
        } elseif ($status === 'failed') {
            $query->where('is_passed', false);
        }

        $sort = (string) $request->get('sort', 'latest');
        if ($sort === 'highest') {
            $query->orderByDesc('score');
        } elseif ($sort === 'lowest') {
            $query->orderBy('score');
        } else {
            $query->orderByDesc('completed_at');
        }

        $summaryQuery = clone $query;
        $attempts = $query->paginate(12)->appends($request->query());

        $totalAttempts = (clone $summaryQuery)->count();
        $passedAttempts = (clone $summaryQuery)->where('is_passed', true)->count();
        $averageScore = (clone $summaryQuery)->avg('score');
        $passRate = $totalAttempts > 0 ? round(($passedAttempts / $totalAttempts) * 100, 1) : 0;

        return view('admin.quiz-results.index', [
            'attempts' => $attempts,
            'quizzes' => Quiz::orderBy('title')->get(['id', 'title']),
            'filters' => [
                'search' => $search,
                'quiz_id' => $quizId,
                'status' => $status,
                'sort' => $sort,
            ],
            'summary' => [
                'total' => $totalAttempts,
                'passed' => $passedAttempts,
                'average_score' => $averageScore ? round($averageScore, 1) : 0,
                'pass_rate' => $passRate,
            ],
        ]);
    }

    /**
     * Display the specified quiz attempt details.
     */
    public function show(QuizAttempt $quizResult)
    {
        $quizResult->load([
            'quiz.questions.options',
            'answers.question.options',
            'answers.selectedOption',
            'user',
        ]);

        $answers = $quizResult->getRelation('answers');
        $answerCollection = $answers instanceof \Illuminate\Support\Collection ? $answers : collect($answers);

        $questionBreakdown = $quizResult->quiz?->questions
            ->map(function ($question) use ($answerCollection) {
                $answer = $answerCollection->firstWhere('quiz_question_id', $question->id);

                return [
                    'question' => $question,
                    'answer' => $answer,
                    'is_correct' => $answer?->is_correct ?? false,
                    'selected_value' => $answer?->selected_answer ?? $answer?->selectedOption?->option_text,
                ];
            }) ?? collect();

        return view('admin.quiz-results.show', [
            'attempt' => $quizResult,
            'questionBreakdown' => $questionBreakdown,
        ]);
    }
}
