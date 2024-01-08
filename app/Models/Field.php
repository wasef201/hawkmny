<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property int standard_id
 * @property string name
 * @property string description
 * @property string image
 * @property double degree
 * @property boolean is_active
 * @property Standard standard
 */
class Field extends Model
{
    protected $fillable = ['standard_id', 'name', 'description', 'image', 'degree', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'degree' => 'double'
    ];

    final public function standard(): BelongsTo
    {
        return $this->belongsTo(Standard::class);
    }

    final public function practices(): HasMany
    {
        return $this->hasMany(Practice::class);
    }

    final public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
