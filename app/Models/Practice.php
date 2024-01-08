<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property int standard_id
 * @property int field_id
 * @property string name
 * @property string description
 * @property string image
 * @property double degree
 * @property boolean is_active
 * @property Field field
 * @property Standard standard
 * @property Collection<Question> questions
 */
class Practice extends Model
{
    protected $fillable = ['standard_id', 'field_id', 'name', 'description', 'image', 'degree', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'degree' => 'double'
    ];

    final public function standard(): BelongsTo
    {
        return $this->belongsTo(Standard::class);
    }

    final public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }

    final public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
