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
    public function index(Request $request)
    {
        $query = Course::with('creator');

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

        $courses = $query->latest()->paginate(10)->appends($request->query());

        $categories = Course::query()->select('category')->distinct()->pluck('category')->filter()->values();
        $difficulties = [
            'umum' => 'Umum',
            'calon_paskibra' => 'Calon Paskibra',
            'wiramuda' => 'Wiramuda',
            'wiratama' => 'Wiratama',
            'instruktur_muda' => 'Instruktur Muda',
            'instruktur' => 'Instruktur',
        ];

        return view('admin.courses', [
            'courses' => $courses,
            'categories' => $categories,
            'difficulties' => $difficulties,
            'filters' => [
                'search' => $search,
                'category' => $category,
                'difficulty' => $difficulty,
                'status' => $status,
            ],
        ]);
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
            'difficulty' => 'required|in:umum,calon_paskibra,wiramuda,wiratama,instruktur_muda,instruktur',
            'is_active' => 'required|boolean',
        ]);

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'difficulty' => $request->difficulty,
            'is_active' => $request->boolean('is_active'),
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
            'difficulty' => 'required|in:umum,calon_paskibra,wiramuda,wiratama,instruktur_muda,instruktur',
            'is_active' => 'required|boolean',
        ]);

        $course->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'difficulty' => $request->difficulty,
            'is_active' => $request->boolean('is_active'),
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
