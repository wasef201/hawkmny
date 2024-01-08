<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongstoMany;

use Illuminate\Support\Collection;
// use Illuminate\Database\Eloquent\Relations\MorphOne;
/**
 * @property int id
 * @property string name
 * @property string description
 * @property string image
 * @property double percentage
 * @property boolean is_active
 * @property Collection<Field> fields
 * @property Collection<Practice> practices
 * @property Collection<Question> questions
 * @property Review review
 * @property ReviewStandard reviewStandard
 */
class Standard extends Model
{
    protected $fillable = ['name', 'description', 'image', 'percentage', 'is_active'  ];

    protected $casts = [
        'is_active' => 'boolean',
        'percentage' => 'double'
    ];

    public const Financial_ID=3;

    /**
     * @return HasMany
     */
    final public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }

    /**
     * @return HasMany
     */
    final public function practices(): HasMany
    {
        return $this->hasMany(Practice::class);
    }

    /**
     * @return HasMany
     */
    final public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    /**
     * @return HasMany
     */
    final public function reviews(): BelongstoMany
    {
        return $this->belongstoMany(Review::class , 'review_standards')->withPivot([
            'degree',
            'progress',
            'total_standard_questions',
            'answered_question_count',
        ]);
    }

    /**
     * @return HasOne
     */
//    final public function review(): HasOne
//    {
//        return $this->hasOne(Review::class  , 'review_standards' , 'standard_id' )->latestOfMany();
//    }

//    final public function reviewStandard(): HasOne
//    {
//        return $this->hasOne(ReviewStandard::class)->latestOfMany();
//    }


}
