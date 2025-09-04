<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestionOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_question_id',
        'option_text',
        'is_correct',
        'order',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get the question that owns the option.
     */
    public function question()
    {
        return $this->belongsTo(QuizQuestion::class, 'quiz_question_id');
    }

    /**
     * Get the answers that selected this option.
     */
    public function answers()
    {
        return $this->hasMany(QuizAnswer::class, 'selected_option_id');
    }
}