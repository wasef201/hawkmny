<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int question_id
 * @property string name
 * @property string description
 * @property string image
 * @property double percentage
 * @property boolean is_active
 * @property boolean is_verify
 */
class Choice extends Model
{
    protected $fillable = ['question_id', 'name', 'description', 'image', 'percentage', 'is_active', 'is_verify'];


    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answers()
    {
       return $this->hasMany(Answer::class, 'choice_id');
    }
}
