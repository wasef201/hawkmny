<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinancialInputUser extends Model
{
    use HasFactory;

    protected $fillable=['financial_value', 'user_id', 'financial_input_id'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the financial_value
     *
     * @param  string  $value
     * @return string
     */
    public function getFinancialValueAttribute($value)
    {
        return round($value, 2);
    }
}
