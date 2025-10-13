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

    /**
     * Get normalized options for rendering regardless of storage strategy.
     */
    public function getOptionCollectionAttribute()
    {
        $relationOptions = $this->relationLoaded('options') ? $this->getRelation('options') : null;

        if ($relationOptions instanceof \Illuminate\Support\Collection && $relationOptions->isNotEmpty()) {
            return $relationOptions->map(function ($option) {
                return (object) [
                    'id' => $option->id,
                    'value' => (string) $option->id,
                    'option_text' => $option->option_text,
                    'is_correct' => (bool) $option->is_correct,
                ];
            });
        }

        $arrayOptions = $this->getAttribute('options');
        if (!is_array($arrayOptions) || empty($arrayOptions)) {
            return collect();
        }

        $correctAnswers = (array) $this->correct_answer;

        return collect($arrayOptions)->map(function ($label, $key) use ($correctAnswers) {
            $value = (string) $key;
            $text = is_array($label) ? json_encode($label) : $label;
            $isCorrect = in_array($key, $correctAnswers, false) || in_array((string) $key, $correctAnswers, false);

            return (object) [
                'id' => $this->id . '_' . $key,
                'value' => $value,
                'option_text' => $text,
                'is_correct' => $isCorrect,
            ];
        });
    }

}
