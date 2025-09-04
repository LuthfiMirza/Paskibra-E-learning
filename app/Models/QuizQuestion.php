<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question',
        'type',
        'options',
        'correct_answer',
        'points',
        'order',
        'explanation',
        'image',
    ];

    protected $casts = [
        'options' => 'array',
        'correct_answer' => 'array',
        'points' => 'integer',
        'order' => 'integer',
    ];

    /**
     * Get the quiz that owns the question.
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Get the options for the question.
     */
    public function options()
    {
        return $this->hasMany(QuizQuestionOption::class)->orderBy('order');
    }

    /**
     * Get the correct option for the question.
     */
    public function correctOption()
    {
        return $this->hasOne(QuizQuestionOption::class)->where('is_correct', true);
    }

    /**
     * Get the answers for this question.
     */
    public function answers()
    {
        return $this->hasMany(QuizAnswer::class);
    }
}