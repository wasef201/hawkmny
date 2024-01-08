<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int standard_id
 * @property int field_id
 * @property int practice_id
 * @property int question_id
 * @property ?int choice_id
 * @property string name
 * @property string description
 * @property boolean is_active
 */
class Verification extends Model
{
    protected $fillable = ['standard_id', 'field_id', 'practice_id', 'question_id', 'choice_id',
        'name', 'description', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean'
    ];




    
}
