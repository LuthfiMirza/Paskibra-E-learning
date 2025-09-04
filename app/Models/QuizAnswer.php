<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_attempt_id',
        'quiz_question_id',
        'selected_option_id',
        'selected_answer',
        'is_correct',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    /**
     * Get the attempt that owns the answer.
     */
    public function attempt()
    {
        return $this->belongsTo(QuizAttempt::class, 'quiz_attempt_id');
    }

    /**
     * Get the question that owns the answer.
     */
    public function question()
    {
        return $this->belongsTo(QuizQuestion::class, 'quiz_question_id');
    }

    /**
     * Get the selected option.
     */
    public function selectedOption()
    {
        return $this->belongsTo(QuizQuestionOption::class, 'selected_option_id');
    }
}