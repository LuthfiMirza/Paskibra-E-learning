<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'course_id',
        'category',
        'difficulty',
        'time_limit',
        'passing_score',
        'max_attempts',
        'allow_retake',
        'randomize_questions',
        'show_results_immediately',
        'is_active',
        'published_at',
        'created_by',
    ];

    protected $casts = [
        'time_limit' => 'integer',
        'passing_score' => 'integer',
        'max_attempts' => 'integer',
        'allow_retake' => 'boolean',
        'randomize_questions' => 'boolean',
        'show_results_immediately' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Get the course that owns the quiz.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the user who created the quiz.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the questions for the quiz.
     */
    public function questions()
    {
        return $this->hasMany(QuizQuestion::class)->orderBy('order');
    }

    /**
     * Get the attempts for the quiz.
     */
    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    /**
     * Get the category display name.
     */
    public function getCategoryDisplayAttribute()
    {
        $categories = [
            'kepaskibraan' => 'Dasar Kepaskibraan',
            'baris_berbaris' => 'Baris Berbaris',
            'wawasan' => 'Pengetahuan Umum',
            'kepemimpinan' => 'Kepemimpinan',
            'protokoler' => 'Protokoler',
        ];

        return $categories[$this->category] ?? $this->category;
    }

    /**
     * Get the difficulty display name.
     */
    public function getDifficultyDisplayAttribute()
    {
        $difficulties = [
            'basic' => 'Dasar',
            'intermediate' => 'Menengah',
            'advanced' => 'Lanjutan',
        ];

        return $difficulties[$this->difficulty] ?? $this->difficulty;
    }

    /**
     * Scope a query to only include active quizzes.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get user's attempts for this quiz.
     */
    public function userAttempts($userId)
    {
        return $this->attempts()->where('user_id', $userId);
    }

    /**
     * Check if user can take this quiz.
     */
    public function canUserTake($userId)
    {
        $attemptCount = $this->userAttempts($userId)->count();
        return $attemptCount < $this->max_attempts;
    }

    /**
     * Get user's best score for this quiz.
     */
    public function userBestScore($userId)
    {
        return $this->userAttempts($userId)->max('score') ?? 0;
    }
}