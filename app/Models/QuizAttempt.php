<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'answers',
        'score',
        'total_questions',
        'correct_answers',
        'started_at',
        'completed_at',
        'time_taken',
        'is_passed',
        'attempt_number',
    ];

    protected $casts = [
        'answers' => 'array',
        'score' => 'integer',
        'total_questions' => 'integer',
        'correct_answers' => 'integer',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'time_taken' => 'integer',
        'is_passed' => 'boolean',
        'attempt_number' => 'integer',
    ];

    /**
     * Get the user that owns the attempt.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the quiz that owns the attempt.
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Get the answers for the attempt.
     */
    public function answers()
    {
        return $this->hasMany(QuizAnswer::class);
    }

    /**
     * Scope a query to only include passed attempts.
     */
    public function scopePassed($query)
    {
        return $query->where('is_passed', true);
    }

    /**
     * Scope a query to only include completed attempts.
     */
    public function scopeCompleted($query)
    {
        return $query->whereNotNull('completed_at');
    }

    /**
     * Get the duration of the attempt in minutes.
     */
    public function getDurationAttribute()
    {
        if ($this->started_at && $this->completed_at) {
            return $this->started_at->diffInMinutes($this->completed_at);
        }
        return $this->time_taken ? round($this->time_taken / 60) : 0;
    }

    /**
     * Get the grade letter based on score.
     */
    public function getGradeAttribute()
    {
        if ($this->score >= 90) return 'A';
        if ($this->score >= 80) return 'B';
        if ($this->score >= 70) return 'C';
        if ($this->score >= 60) return 'D';
        return 'E';
    }

    /**
     * Get passed status (alias for is_passed).
     */
    public function getPassedAttribute()
    {
        return $this->is_passed;
    }
}