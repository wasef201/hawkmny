<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentFile extends Model
{
    use HasFactory;

    protected $fillable = ['comment_id' , 'file' , 'file_name' ];



    public function comment()
    {
        return $this->belongsTo(QuestionComment::class);
    }
}
