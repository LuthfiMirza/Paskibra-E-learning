<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
class CourseController extends Controller
{
    /**
     * Display a listing of the courses.
     */
    public function index(Request $request)
    {
        $query = Course::query()
            ->with(['creator'])
            ->withCount('lessons')
            ->where('is_active', true);

        $search = trim((string) $request->get('search', ''));
        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $category = (string) $request->get('category', '');
        if ($category !== '' && $category !== 'all') {
            $query->where('category', $category);
        }

        $difficulty = (string) $request->get('difficulty', '');
        if ($difficulty !== '' && $difficulty !== 'all') {
            $query->where('difficulty', $difficulty);
        }

        $courses = $query
            ->orderByDesc('created_at')
            ->paginate(9)
            ->withQueryString();

        $featuredCourse = Course::query()
            ->withCount('lessons')
            ->where('is_active', true)
            ->orderByDesc('created_at')
            ->first();

        $categories = Course::query()
            ->select('category')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->values();

        $difficulties = collect([
            'umum' => 'Umum',
            'calon_paskibra' => 'Calon Paskibra',
            'wiramuda' => 'Wiramuda',
            'wiratama' => 'Wiratama',
            'instruktur_muda' => 'Instruktur Muda',
            'instruktur' => 'Instruktur',
        ]);

        return view('courses.index', [
            'courses' => $courses,
            'featuredCourse' => $featuredCourse,
            'categories' => $categories,
            'difficulties' => $difficulties,
            'activeFilters' => [
                'search' => $search,
                'category' => $category,
                'difficulty' => $difficulty,
            ],
        ]);
    }

    /**
     * Display the specified course detail page.
     */
    public function show(Course $course)
    {
        $course->load(['lessons' => function ($query) {
            $query->orderBy('order')->orderBy('created_at');
        }, 'creator']);

        $lessons = $course->lessons;

        $relatedCourses = Course::query()
            ->where('id', '!=', $course->id)
            ->where('category', $course->category)
            ->where('is_active', true)
            ->withCount('lessons')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        return view('courses.show', [
            'course' => $course,
            'lessons' => $lessons,
            'relatedCourses' => $relatedCourses,
        ]);
    }

    /**
     * Display a specific lesson within a course.
     */
    public function lesson(Course $course, Lesson $module)
    {
        abort_if($module->course_id !== $course->id, 404);

        $course->load(['lessons' => function ($query) {
            $query->orderBy('order')->orderBy('created_at');
        }]);

        $lessons = $course->lessons;
        $currentIndex = $lessons->search(fn ($lesson) => $lesson->id === $module->id);
        $previousLesson = $currentIndex !== false ? $lessons->get($currentIndex - 1) : null;
        $nextLesson = $currentIndex !== false ? $lessons->get($currentIndex + 1) : null;

        return view('courses.lesson', [
            'course' => $course,
            'lesson' => $module,
            'lessons' => $lessons,
            'currentIndex' => $currentIndex === false ? 0 : $currentIndex,
            'previousLesson' => $previousLesson,
            'nextLesson' => $nextLesson,
        ]);
    }
}
