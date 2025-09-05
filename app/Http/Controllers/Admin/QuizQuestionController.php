<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionOption;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    public function index(Quiz $quiz)
    {
        $questions = $quiz->questions()->with('options')->orderBy('order')->paginate(20);
        return view('admin.quizzes.questions.index', compact('quiz', 'questions'));
    }

    public function create(Quiz $quiz)
    {
        return view('admin.quizzes.questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'type' => 'required|in:multiple_choice,true_false',
            'points' => 'nullable|integer|min:1',
            'options' => 'array',
            'options.*' => 'nullable|string',
            'correct_option' => 'nullable',
            'tf_correct' => 'nullable|in:true,false',
        ]);

        $order = ($quiz->questions()->max('order') ?? 0) + 1;
        $question = $quiz->questions()->create([
            'question' => $data['question'],
            'type' => $data['type'],
            'points' => $data['points'] ?? 10,
            'order' => $order,
            'correct_answer' => [],
        ]);

        $correctIds = [];
        if ($data['type'] === 'multiple_choice') {
            $opts = collect($data['options'] ?? [])->filter(fn($t) => filled($t));
            $correctKey = $data['correct_option'] ?? null;
            $i = 1;
            foreach ($opts as $key => $text) {
                $opt = QuizQuestionOption::create([
                    'quiz_question_id' => $question->id,
                    'option_text' => $text,
                    'is_correct' => (string)$key === (string)$correctKey,
                    'order' => $i++,
                ]);
                if ((string)$key === (string)$correctKey) {
                    $correctIds[] = (string)$opt->id;
                }
            }
        } else { // true_false
            $true = QuizQuestionOption::create([
                'quiz_question_id' => $question->id,
                'option_text' => 'True',
                'is_correct' => ($data['tf_correct'] ?? 'true') === 'true',
                'order' => 1,
            ]);
            $false = QuizQuestionOption::create([
                'quiz_question_id' => $question->id,
                'option_text' => 'False',
                'is_correct' => ($data['tf_correct'] ?? 'true') === 'false',
                'order' => 2,
            ]);
            $correctIds[] = ($data['tf_correct'] ?? 'true') === 'true' ? (string)$true->id : (string)$false->id;
        }

        // Store correct answers as array of option IDs for compatibility
        $question->update(['correct_answer' => $correctIds]);

        return redirect()->route('admin.quizzes.questions.index', $quiz)->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function edit(Quiz $quiz, QuizQuestion $question)
    {
        abort_unless($question->quiz_id === $quiz->id, 404);
        $question->load('options');
        return view('admin.quizzes.questions.edit', compact('quiz', 'question'));
    }

    public function update(Request $request, Quiz $quiz, QuizQuestion $question)
    {
        abort_unless($question->quiz_id === $quiz->id, 404);

        $data = $request->validate([
            'question' => 'required|string',
            'type' => 'required|in:multiple_choice,true_false',
            'points' => 'nullable|integer|min:1',
            'options' => 'array',
            'options.*' => 'nullable|string',
            'correct_option' => 'nullable',
            'tf_correct' => 'nullable|in:true,false',
        ]);

        $question->update([
            'question' => $data['question'],
            'type' => $data['type'],
            'points' => $data['points'] ?? 10,
        ]);

        $correctIds = [];
        $question->options()->delete();
        if ($data['type'] === 'multiple_choice') {
            $opts = collect($data['options'] ?? [])->filter(fn($t) => filled($t));
            $correctKey = $data['correct_option'] ?? null;
            $i = 1;
            foreach ($opts as $key => $text) {
                $opt = QuizQuestionOption::create([
                    'quiz_question_id' => $question->id,
                    'option_text' => $text,
                    'is_correct' => (string)$key === (string)$correctKey,
                    'order' => $i++,
                ]);
                if ((string)$key === (string)$correctKey) {
                    $correctIds[] = (string)$opt->id;
                }
            }
        } else {
            $true = QuizQuestionOption::create([
                'quiz_question_id' => $question->id,
                'option_text' => 'True',
                'is_correct' => ($data['tf_correct'] ?? 'true') === 'true',
                'order' => 1,
            ]);
            $false = QuizQuestionOption::create([
                'quiz_question_id' => $question->id,
                'option_text' => 'False',
                'is_correct' => ($data['tf_correct'] ?? 'true') === 'false',
                'order' => 2,
            ]);
            $correctIds[] = ($data['tf_correct'] ?? 'true') === 'true' ? (string)$true->id : (string)$false->id;
        }

        $question->update(['correct_answer' => $correctIds]);

        return redirect()->route('admin.quizzes.questions.index', $quiz)->with('success', 'Pertanyaan diperbarui.');
    }

    public function destroy(Quiz $quiz, QuizQuestion $question)
    {
        abort_unless($question->quiz_id === $quiz->id, 404);
        $question->delete();
        return redirect()->route('admin.quizzes.questions.index', $quiz)->with('success', 'Pertanyaan dihapus.');
    }
}

