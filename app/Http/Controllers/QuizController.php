<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    /**
     * Display a listing of quizzes.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = trim((string) $request->get('search', ''));

        // Get available quizzes
        $quizzes = Quiz::with(['course', 'questions'])
            ->where('is_active', true)
            ->where(function ($builder) {
                $builder->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            })
            ->when($search !== '', function ($builder) use ($search) {
                $builder->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('published_at')->orderByDesc('created_at')
            ->get();

        // If no quizzes in database, create dummy data for demo
        if ($quizzes->isEmpty() && $search === '') {
            $quizzes = collect([
                (object) [
                    'id' => 1,
                    'title' => 'Quiz Dasar Kepaskibraan',
                    'description' => 'Uji pemahaman Anda tentang sejarah, filosofi, dan nilai-nilai dasar PASKIBRA.',
                    'category' => 'kepaskibraan',
                    'category_display' => 'Kepaskibraan',
                    'difficulty' => 'basic',
                    'difficulty_display' => 'Pemula',
                    'time_limit' => 15,
                    'passing_score' => 70,
                    'allow_retake' => true,
                    'max_attempts' => 3,
                    'is_active' => true,
                    'published_at' => now(),
                    'questions' => collect(range(1, 10)), // 10 questions
                ],
                (object) [
                    'id' => 2,
                    'title' => 'Quiz Teknik Baris Berbaris',
                    'description' => 'Tes kemampuan Anda dalam memahami teknik-teknik baris berbaris yang benar.',
                    'category' => 'baris_berbaris',
                    'category_display' => 'Baris Berbaris',
                    'difficulty' => 'intermediate',
                    'difficulty_display' => 'Menengah',
                    'time_limit' => 20,
                    'passing_score' => 75,
                    'allow_retake' => true,
                    'max_attempts' => 3,
                    'is_active' => true,
                    'published_at' => now(),
                    'questions' => collect(range(1, 15)), // 15 questions
                ],
                (object) [
                    'id' => 3,
                    'title' => 'Quiz Kepemimpinan PASKIBRA',
                    'description' => 'Evaluasi pemahaman Anda tentang prinsip-prinsip kepemimpinan dalam PASKIBRA.',
                    'category' => 'kepemimpinan',
                    'category_display' => 'Kepemimpinan',
                    'difficulty' => 'advanced',
                    'difficulty_display' => 'Lanjutan',
                    'time_limit' => 30,
                    'passing_score' => 80,
                    'allow_retake' => true,
                    'max_attempts' => 3,
                    'is_active' => true,
                    'published_at' => now(),
                    'questions' => collect(range(1, 20)), // 20 questions
                ],
            ]);
        }

        // Get user's quiz attempts
        $userAttempts = QuizAttempt::where('user_id', $user->id)
            ->with('quiz')
            ->get()
            ->keyBy('quiz_id');

        // Create dummy attempts for demo
        if ($userAttempts->isEmpty()) {
            $userAttempts = collect([
                1 => (object) [
                    'id' => 1,
                    'quiz_id' => 1,
                    'score' => 85,
                    'correct_answers' => 8,
                    'total_questions' => 10,
                    'is_passed' => true,
                ],
            ])->keyBy('quiz_id');
        }

        return view('quizzes.index', [
            'quizzes' => $quizzes,
            'userAttempts' => $userAttempts,
            'search' => $search,
        ]);
    }

    /**
     * Show the quiz taking interface.
     */
    public function show($quizId)
    {
        $user = Auth::user();
        
        // Try to find real quiz first
        $quiz = Quiz::find($quizId);
        
        if (!$quiz) {
            // If no real quiz found, create demo quiz for testing
            $quiz = (object) [
                'id' => $quizId,
                'title' => 'Quiz Demo PASKIBRA',
                'description' => 'Demo quiz untuk testing sistem',
                'time_limit' => 15,
                'passing_score' => 70,
                'allow_retake' => true,
            ];
            
            return view('quizzes.take', compact('quiz'));
        }
        
        // Check if quiz is active and published
        if (!$quiz->is_active || $quiz->published_at > now()) {
            abort(404, 'Quiz tidak tersedia');
        }

        // Check if user has already completed this quiz
        $existingAttempt = QuizAttempt::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->where('completed_at', '!=', null)
            ->first();

        if ($existingAttempt && !$quiz->allow_retake) {
            return redirect()->route('quizzes.result', $existingAttempt->id);
        }

        // Get quiz questions with options
        $questions = $quiz->questions()
            ->with('options')
            ->orderBy('order')
            ->get();

        return view('quizzes.take', compact('quiz', 'questions'));
    }

    /**
     * Submit quiz answers and calculate score.
     */
    public function submit(Request $request, Quiz $quiz)
    {
        $user = Auth::user();
        
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required',
        ]);

        DB::beginTransaction();
        
        try {
            $totalQuestions = $quiz->questions()->count();
            $correctAnswers = 0;
            $processedAnswers = [];

            // Process each answer first to calculate score
            foreach ($request->answers as $questionId => $selectedAnswer) {
                $question = QuizQuestion::find($questionId);
                
                // Check if answer is correct
                $isCorrect = false;
                $selectedOptionId = null;
                
                if ($question->correct_answer && is_array($question->correct_answer)) {
                    // Using JSON correct_answer field
                    $isCorrect = in_array($selectedAnswer, $question->correct_answer);
                    $selectedOptionId = null; // No option ID for JSON-based questions
                } else {
                    // Using relationship options
                    $selectedOption = $question->options()->find($selectedAnswer);
                    $isCorrect = $selectedOption && $selectedOption->is_correct;
                    $selectedOptionId = $selectedAnswer;
                }
                
                if ($isCorrect) {
                    $correctAnswers++;
                }

                $processedAnswers[$questionId] = [
                    'selected_answer' => $selectedAnswer,
                    'selected_option_id' => $selectedOptionId,
                    'is_correct' => $isCorrect,
                ];
            }

            // Calculate score
            $score = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;
            $passed = $score >= $quiz->passing_score;

            // Get attempt number
            $attemptNumber = QuizAttempt::where('user_id', $user->id)
                ->where('quiz_id', $quiz->id)
                ->count() + 1;

            // Create quiz attempt
            $attempt = QuizAttempt::create([
                'user_id' => $user->id,
                'quiz_id' => $quiz->id,
                'answers' => $request->answers, // Store raw answers as JSON
                'score' => $score,
                'total_questions' => $totalQuestions,
                'correct_answers' => $correctAnswers,
                'started_at' => now(),
                'completed_at' => now(),
                'time_taken' => 0, // You can calculate this if needed
                'is_passed' => $passed,
                'attempt_number' => $attemptNumber,
            ]);

            // Save individual answers to quiz_answers table for detailed analysis
            foreach ($processedAnswers as $questionId => $answerData) {
                QuizAnswer::create([
                    'quiz_attempt_id' => $attempt->id,
                    'quiz_question_id' => $questionId,
                    'selected_option_id' => $answerData['selected_option_id'], // This can be null now
                    'selected_answer' => $answerData['selected_answer'],
                    'is_correct' => $answerData['is_correct'],
                ]);
            }

            DB::commit();

            // Return JSON response for AJAX
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'attempt_id' => $attempt->id,
                    'score' => $score,
                    'correct_answers' => $correctAnswers,
                    'total_questions' => $totalQuestions,
                    'passed' => $passed,
                    'passing_score' => $quiz->passing_score,
                    'redirect_url' => route('quizzes.result', $attempt->id)
                ]);
            }

            return redirect()->route('quizzes.result', $attempt->id);

        } catch (\Exception $e) {
            DB::rollback();
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menyimpan jawaban: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Terjadi kesalahan saat menyimpan jawaban.');
        }
    }

    /**
     * Show quiz result.
     */
    public function result(QuizAttempt $attempt)
    {
        $user = Auth::user();
        
        // Check if this attempt belongs to the current user
        if ($attempt->user_id !== $user->id) {
            abort(403);
        }

        $attempt->load(['quiz.questions.options', 'answers.question.options', 'answers.selectedOption']);

        return view('quizzes.result', compact('attempt'));
    }

    /**
     * Show quiz history for current user.
     */
    public function history()
    {
        $user = Auth::user();
        
        $attempts = QuizAttempt::where('user_id', $user->id)
            ->with(['quiz'])
            ->where('completed_at', '!=', null)
            ->orderBy('completed_at', 'desc')
            ->paginate(10);

        return view('quizzes.history', compact('attempts'));
    }
}
