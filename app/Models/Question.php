<?php

namespace App\Models;

use App\Services\FinancialService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

/**
 * @property int id
 * @property int standard_id
 * @property int field_id
 * @property int practice_id
 * @property ?int parent_id
 * @property string name
 * @property string description
 * @property string image
 * @property double degree
 * @property boolean is_active
 * @property Standard standard
 * @property Field field
 * @property Practice practice
 * @property Collection<Choice> choices
 * @property Collection<Question> children
 */
class Question extends Model
{
    protected $fillable = ['standard_id', 'field_id', 'practice_id',
                    'parent_id','name', 'description', 'image', 'degree',
                    'is_active', 'question_type'];


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

    final public function practice(): BelongsTo
    {
        return $this->belongsTo(Practice::class);
    }

    final public function choices(): HasMany
    {
        return $this->hasMany(Choice::class);
    }

    final public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function answer()
    {
        return $this->hasOne(Answer::class);
    }

    // public function files()
    // {
    //     return $this->hasMany(QuestionFile::class);
    // }


    public function verifications()
    {
        return $this->hasMany(Verification::class , 'question_id');
    }

    public function equation($duration_type){
        if ($duration_type=='annual'){
            return $this->name;
        }
        $eq=$this->equations()->firstWhere('duration_type', $duration_type);
        return $eq?$eq->equation:$this->name;

    }

    public function equations(){
        return $this->hasMany(questionDurationType::class, 'question_id');
    }
    public function equationDuration($duration_type){
        return $this->hasOne(questionDurationType::class, 'question_id')
            ->where('duration_type', $duration_type);
    }

    public function scopeEquational($query):void
    {
        $query->where('question_type', 'financial_equation');
    }
    public function scopeChoical($query):void
    {
        $query->whereNull('question_type');
    }

    public function getReadableEquationAttribute()
    {
        return App::make(FinancialService::class)->readableEquation($this->name);
    }

    public function result($inputs)
    {
        return round(App::make(FinancialService::class)->evaluateEquation($this->name, $inputs), 2);
    }

    public function scopeRoot($query)
    {
        $query->whereNull('parent_id');
    }

}
