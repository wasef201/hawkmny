<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionVerificationFile extends Model
{
    use HasFactory;

    protected $fillable = ['file' , 'file_name' , 'question_verification_id' , 'review_id' , 'user_id' ];
}
