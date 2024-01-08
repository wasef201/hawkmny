<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property int user_id
 * @property int standard_id
 * @property int field_id
 * @property int practice_id
 * @property int question_id
 * @property float degree
 * @property string status
 * @property int progress
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Collection<Answer> answers
 * @property Collection<Standard> standards
 */
class Review extends Model
{
    protected $fillable = ['user_id', 'standard_id', 'field_id', 'practice_id', 'question_id',
    'degree', 'status', 'progress'];

    protected $casts = [
        'degree' => 'double',
        'progress' => 'int'
    ];

    public const STARTED = 'started';
    public const PAUSED = 'paused';
    public const IN_PROGRESS = 'in progress';
    public const CANCELED = 'canceled';
    public const COMPLETED = 'completed';

    /**
     * @return BelongsTo
     */
    final public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    final public function standards(): HasMany
    {
        return $this->hasMany(ReviewStandard::class);
    }

    /**
     * @return HasMany
     */
    final public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }



    public function governance_meter()
    {
        $this->load(['standards']);
        $result  = 0;
        foreach ($this->standards as $review_standard) {
            $result  += (( ($review_standard->degree) * (optional($review_standard->standard)->percentage/100) ) );
        }

        return $result;
    }
}
