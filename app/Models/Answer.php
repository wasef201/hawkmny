<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property int review_id
 * @property int standard_id
 * @property int question_id
 * @property int choice_id
 * @property float degree
 * @property Choice choice
 * @property Question question
 * @property Standard standard
 */
class Answer extends Model
{
    protected $fillable = ['review_id', 'standard_id','question_id', 'choice_id', 'degree'];

    protected $casts = [
        'degree' => 'double'
    ];

    public function standard(): BelongsTo
    {
        return $this->belongsTo(Standard::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function choice(): BelongsTo
    {
        return $this->belongsTo(Choice::class);
    }


    public function comments(): HasMany
    {
        return $this->hasMany(AnswerComment::class);
    }
}
