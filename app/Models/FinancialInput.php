<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialInput extends Model
{
    use HasFactory;

    public $timestamps =false;

    protected $fillable=['label', 'key', 'type', 'equation', 'accept_zero'];


    public function userInputs()
    {
        return $this->hasMany(FinancialInputUser::class, 'financial_input_id');
    }
}
