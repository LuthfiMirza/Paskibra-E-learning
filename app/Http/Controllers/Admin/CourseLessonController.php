<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CourseLessonController extends Controller
{
    /**
     * Display a listing of the lessons for the course.
     */
    public function index(Course $course)
    {
        $lessons = $course->lessons()->orderBy('order')->paginate(12);

        return view('admin.courses.lessons.index', [
            'course' => $course,
            'lessons' => $lessons,
        ]);
    }

    /**
     * Show the form for creating a new lesson.
     */
    public function create(Course $course)
    {
        return view('admin.courses.lessons.create', [
            'course' => $course,
        ]);
    }

    /**
     * Store a newly created lesson in storage.
     */
    public function store(Request $request, Course $course)
    {
        $data = $this->validateLesson($request);

        if (!isset($data['order']) || $data['order'] === null) {
            $data['order'] = ($course->lessons()->max('order') ?? 0) + 1;
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['course_id'] = $course->id;

        if (isset($data['file'])) {
            $data['file_path'] = $data['file']->store('lessons', 'public');
            unset($data['file']);
        }

        $lesson = Lesson::create($data);

        return redirect()
            ->route('admin.courses.lessons.index', $course)
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified lesson.
     */
    public function edit(Course $course, Lesson $lesson)
    {
        abort_unless($lesson->course_id === $course->id, 404);

        return view('admin.courses.lessons.edit', [
            'course' => $course,
            'lesson' => $lesson,
        ]);
    }

    /**
     * Update the specified lesson in storage.
     */
    public function update(Request $request, Course $course, Lesson $lesson)
    {
        abort_unless($lesson->course_id === $course->id, 404);

        $data = $this->validateLesson($request, $lesson);

        if (!isset($data['order']) || $data['order'] === null) {
            $data['order'] = $lesson->order;
        }

        $data['is_active'] = $request->boolean('is_active');

        if (isset($data['file'])) {
            if ($lesson->file_path) {
                Storage::disk('public')->delete($lesson->file_path);
            }
            $data['file_path'] = $data['file']->store('lessons', 'public');
            unset($data['file']);
        }

        $lesson->update($data);

        return redirect()
            ->route('admin.courses.lessons.index', $course)
            ->with('success', 'Materi berhasil diperbarui.');
    }

    /**
     * Remove the specified lesson from storage.
     */
    public function destroy(Course $course, Lesson $lesson)
    {
        abort_unless($lesson->course_id === $course->id, 404);

        if ($lesson->file_path) {
            Storage::disk('public')->delete($lesson->file_path);
        }

        $lesson->delete();

        return redirect()
            ->route('admin.courses.lessons.index', $course)
            ->with('success', 'Materi berhasil dihapus.');
    }

    /**
     * Validate incoming lesson request data.
     */
    private function validateLesson(Request $request, ?Lesson $lesson = null): array
    {
        foreach (['duration_minutes', 'order'] as $numericField) {
            if ($request->input($numericField) === '') {
                $request->merge([$numericField => null]);
            }
        }

        $types = ['text', 'video', 'audio', 'pdf', 'interactive'];
        $type = $request->input('content_type');

        $fileRules = ['nullable', 'file', 'max:102400']; // ~100MB

        if ($type === 'video') {
            $fileRules[] = 'mimetypes:video/mp4,video/quicktime,video/x-msvideo';
        } elseif ($type === 'audio') {
            $fileRules[] = 'mimetypes:audio/mpeg,audio/mp3,audio/wav';
        } elseif ($type === 'pdf') {
            $fileRules[] = 'mimes:pdf';
        } elseif ($type === 'interactive') {
            $fileRules[] = 'mimes:zip,html,htm';
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content_type' => ['required', Rule::in($types)],
            'content' => ['nullable', 'string'],
            'duration_minutes' => ['nullable', 'integer', 'between:1,600'],
            'order' => ['nullable', 'integer', 'min:1'],
            'is_active' => ['nullable', 'boolean'],
            'file' => $fileRules,
        ]);

        return $validated;
    }
}
