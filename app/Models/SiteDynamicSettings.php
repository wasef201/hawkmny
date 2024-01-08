<?php

namespace App\Models;

//use App\Traits\FilterScopeModelTrait;
use App\Traits\FilterScopeModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Spatie\Translatable\HasTranslations;

class SiteDynamicSettings extends Model
{
    use HasFactory,
        FilterScopeModelTrait;

//    public $translatable = ['title', 'description'];

    protected $fillable = [
        'title',
        'description',
        'image',
        'active',
        'type',
    ];

    public const SLIDER1 = 1;
    public const PARTNERS = 2;
    public const HOKMNY_ADVANTAGES = 3;


    public static array $status = [
        1, // active
        0, // not active
    ];
    public function getImageAttribute()
    {
        return ($this->attributes['image'] ?? false) ? asset('storage/images/site-settings/' . $this->attributes['image']) : '';
    }

    public function scopeActive($query)
    {
        $query->where('active',1);
    }


}
