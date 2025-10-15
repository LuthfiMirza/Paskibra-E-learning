<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $query = Quiz::with('course', 'creator');

        $search = trim((string) $request->get('search', ''));
        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $category = (string) $request->get('category', 'all');
        if ($category !== '' && $category !== 'all') {
            $query->where('category', $category);
        }

        $difficulty = (string) $request->get('difficulty', 'all');
        if ($difficulty !== '' && $difficulty !== 'all') {
            $query->where('difficulty', $difficulty);
        }

        $status = (string) $request->get('status', 'all');
        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        $courseId = $request->get('course_id', 'all');
        if ($courseId && $courseId !== 'all') {
            $query->where('course_id', $courseId);
        }

        $quizzes = $query->latest()->paginate(10)->appends($request->query());

        $categories = Quiz::query()->select('category')->distinct()->pluck('category')->filter()->values();
        $difficulties = [
            'umum' => 'Umum',
            'calon_paskibra' => 'Calon Paskibra',
            'wiramuda' => 'Wiramuda',
            'wiratama' => 'Wiratama',
            'instruktur_muda' => 'Instruktur Muda',
            'instruktur' => 'Instruktur',
        ];
        $courses = Course::query()->orderBy('title')->get(['id', 'title']);

        return view('admin.quizzes.index', [
            'quizzes' => $quizzes,
            'categories' => $categories,
            'difficulties' => $difficulties,
            'courseOptions' => $courses,
            'filters' => [
                'search' => $search,
                'category' => $category,
                'difficulty' => $difficulty,
                'status' => $status,
                'course_id' => $courseId,
            ],
        ]);
    }

    public function create()
    {
        $courses = Course::orderBy('title')->get();

        return view('admin.quizzes.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $this->validateQuiz($request);

        Quiz::create($data + ['created_by' => auth()->id()]);

        return redirect()->route('admin.quizzes.index')->with('success', 'Kuis berhasil dibuat.');
    }

    public function show(Quiz $quiz)
    {
        return redirect()->route('admin.quizzes.questions.index', $quiz);
    }

    public function edit(Quiz $quiz)
    {
        $courses = Course::orderBy('title')->get();

        return view('admin.quizzes.edit', compact('quiz', 'courses'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $data = $this->validateQuiz($request, $quiz);

        $quiz->update($data);

        return redirect()->route('admin.quizzes.index')->with('success', 'Kuis berhasil diperbarui.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('admin.quizzes.index')->with('success', 'Kuis berhasil dihapus.');
    }

    private function validateQuiz(Request $request, ?Quiz $quiz = null): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'nullable|exists:courses,id',
            'category' => 'required|in:kepaskibraan,baris_berbaris,wawasan,kepemimpinan,protokoler',
            'difficulty' => 'required|in:umum,calon_paskibra,wiramuda,wiratama,instruktur_muda,instruktur',
            'time_limit' => 'nullable|integer|min:1',
            'passing_score' => 'nullable|integer|min:1|max:100',
            'max_attempts' => 'nullable|integer|min:1|max:10',
            'allow_retake' => 'nullable|boolean',
            'show_results_immediately' => 'nullable|boolean',
            'published_at' => 'nullable|date',
            'is_active' => 'required|boolean',
        ]);

        $data['passing_score'] = $data['passing_score'] ?? 70;
        $data['max_attempts'] = $data['max_attempts'] ?? 3;
        $data['allow_retake'] = $request->boolean('allow_retake');
        $data['show_results_immediately'] = $request->boolean('show_results_immediately');
        $data['is_active'] = $request->boolean('is_active');
        $data['published_at'] = $data['published_at']
            ? Carbon::parse($data['published_at'])
            : ($quiz?->published_at ?? Carbon::now());

        return $data;
    }
}
