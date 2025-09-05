<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('creator')->latest()->paginate(10);
        return view('admin.courses', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:kepaskibraan,baris_berbaris,wawasan,kepemimpinan,protokoler',
            'difficulty' => 'required|in:basic,intermediate,advanced',
            'is_active' => 'required|boolean',
        ]);

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'difficulty' => $request->difficulty,
            'is_active' => $request->is_active,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:kepaskibraan,baris_berbaris,wawasan,kepemimpinan,protokoler',
            'difficulty' => 'required|in:basic,intermediate,advanced',
            'is_active' => 'required|boolean',
        ]);

        $course->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'difficulty' => $request->difficulty,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'Kursus diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Kursus dihapus.');
    }
}
