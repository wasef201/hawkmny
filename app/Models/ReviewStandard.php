<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Collection\Collection;

/**
 * @property int id
 * @property int review_id
 * @property Review review
 * @property Collection<Question> questions
 * @property Collection<Answer> answers
 */
class ReviewStandard extends Model
{
    use HasFactory;

 protected $fillable = ['progress' ,'review_id', 'percentage' , 'field_id'  , 'standard_id' , 'degree' , 'question_id' , 'total_standard_questions' , 'answered_question_count' ];

    public function standard(): BelongsTo
    {
        return $this->belongsTo(Standard::class);
    }

    /**
     * @return BelongsTo
     */
    final public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }

    /**
     * @return BelongsTo
     */
    final public function practice(): BelongsTo
    {
        return $this->belongsTo(Practice::class);
    }

    /**
     * @return BelongsTo
     */
    final public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * @return BelongsTo
     */
    final public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class);
    }

    final public function answers(): HasMany
    {
        return $this->hasMany(Answer::class, 'standard_id', 'standard_id');
    }

    final public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'standard_id', 'standard_id');
    }


}
