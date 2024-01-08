<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerComment extends Model
{
    use HasFactory;



    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
