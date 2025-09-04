<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Course;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::with('course', 'creator')->latest()->paginate(10);
        return view('admin.quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('admin.quizzes.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'nullable|exists:courses,id',
            'category' => 'required|in:kepaskibraan,baris_berbaris,wawasan,kepemimpinan,protokoler',
            'difficulty' => 'required|in:basic,intermediate,advanced',
            'time_limit' => 'nullable|integer|min:1',
            'is_active' => 'required|boolean',
        ]);

        Quiz::create($request->all() + ['created_by' => auth()->id()]);

        return redirect()->route('admin.quizzes.index')->with('success', 'Kuis berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        // Later for showing questions
        return redirect()->route('admin.quizzes.questions.index', $quiz);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        $courses = Course::all();
        return view('admin.quizzes.edit', compact('quiz', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'nullable|exists:courses,id',
            'category' => 'required|in:kepaskibraan,baris_berbaris,wawasan,kepemimpinan,protokoler',
            'difficulty' => 'required|in:basic,intermediate,advanced',
            'time_limit' => 'nullable|integer|min:1',
            'is_active' => 'required|boolean',
        ]);

        $quiz->update($request->all());

        return redirect()->route('admin.quizzes.index')->with('success', 'Kuis berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quizzes.index')->with('success', 'Kuis berhasil dihapus.');
    }
}
