<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class CourseController extends Controller
{
    /**
     * Display a listing of the courses.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $studentLevel = $this->getUserLearningLevel($user);
        $restrictToLevel = $user && $user->role === 'student';

        $query = Course::query()
            ->with(['creator'])
            ->withCount('lessons')
            ->where('is_active', true)
            ->when($restrictToLevel, function ($builder) use ($studentLevel) {
                $builder->where('difficulty', $studentLevel);
            });

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
            ->when($restrictToLevel, function ($builder) use ($studentLevel) {
                $builder->where('difficulty', $studentLevel);
            })
            ->orderByDesc('created_at')
            ->first();

        $categories = Course::query()
            ->select('category')
            ->distinct()
            ->where('is_active', true)
            ->when($restrictToLevel, function ($builder) use ($studentLevel) {
                $builder->where('difficulty', $studentLevel);
            })
            ->pluck('category')
            ->filter()
            ->values();

        $difficultyOptions = [
            'umum' => 'Umum',
            'calon_paskibra' => 'Calon Paskibra',
            'wiramuda' => 'Wiramuda',
            'wiratama' => 'Wiratama',
            'instruktur_muda' => 'Instruktur Muda',
            'instruktur' => 'Instruktur',
        ];

        $difficulties = collect($difficultyOptions);

        if ($restrictToLevel) {
            $difficulties = collect([
                $studentLevel => $difficultyOptions[$studentLevel] ?? ucfirst(str_replace('_', ' ', $studentLevel)),
            ]);
            $difficulty = $studentLevel;
        }

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
            'restrictedLevelLabel' => $restrictToLevel
                ? ($difficultyOptions[$studentLevel] ?? 'Umum')
                : null,
        ]);
    }

    /**
     * Display the specified course detail page.
     */
    public function show(Course $course)
    {
        $user = Auth::user();
        $this->ensureStudentCanAccessCourse($user, $course);

        $course->load(['lessons' => function ($query) {
            $query->orderBy('order')->orderBy('created_at');
        }, 'creator']);

        $lessons = $course->lessons;

        $relatedCourses = Course::query()
            ->where('id', '!=', $course->id)
            ->where('category', $course->category)
            ->where('is_active', true)
            ->when(
                $user && $user->role === 'student',
                function ($builder) use ($course) {
                    $builder->where('difficulty', $course->difficulty);
                }
            )
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
        $user = Auth::user();
        $this->ensureStudentCanAccessCourse($user, $course);

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

    /**
     * Stream or download a lesson attachment.
     */
    public function file(Request $request, Lesson $lesson)
    {
        $user = Auth::user();
        if ($lesson->relationLoaded('course') === false) {
            $lesson->loadMissing('course');
        }
        if ($lesson->course) {
            $this->ensureStudentCanAccessCourse($user, $lesson->course);
        }

        abort_unless($lesson->file_path, 404);

        $disk = Storage::disk('public');

        if (! $disk->exists($lesson->file_path)) {
            abort(404);
        }

        $filename = basename($lesson->file_path);
        $mimeType = $disk->mimeType($lesson->file_path) ?? 'application/octet-stream';
        $disposition = $request->boolean('download') ? 'attachment' : 'inline';

        return $disk->response($lesson->file_path, $filename, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => $disposition . '; filename="' . $filename . '"',
        ]);
    }

    /**
     * Serve media assets referenced from lesson content.
     */
    public function media(Request $request, string $path)
    {
        $normalizedPath = str_replace(['..', '\\'], '', urldecode($path));

        $disk = Storage::disk('public');
        if (! $disk->exists($normalizedPath)) {
            abort(404);
        }

        $filename = basename($normalizedPath);
        $mimeType = $disk->mimeType($normalizedPath) ?? 'application/octet-stream';
        $disposition = $request->boolean('download') ? 'attachment' : 'inline';

        return $disk->response($normalizedPath, $filename, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => $disposition . '; filename="' . $filename . '"',
        ]);
    }

    private function ensureStudentCanAccessCourse($user, Course $course): void
    {
        if ($user && $user->role === 'student' && $course->difficulty !== $this->getUserLearningLevel($user)) {
            abort(403, 'Materi ini hanya tersedia untuk tingkatan ' . $course->difficulty_display . '.');
        }
    }

    private function getUserLearningLevel($user): string
    {
        if (!$user) {
            return 'umum';
        }

        return $user->learning_level ?: 'umum';
    }
}
