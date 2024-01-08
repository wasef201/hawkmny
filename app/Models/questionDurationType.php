<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questionDurationType extends Model
{
    protected $fillable=[
        'question_id',
        'duration_type',
        'equation',
    ];
    use HasFactory;
}
