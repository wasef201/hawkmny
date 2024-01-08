<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
/**
 * @property int id
 * @property string type
 * @property string name
 * @property string email
 * @property string number
 * @property string phone
 * @property string password
 * @property string section
 * @property int area_id
 * @property int city_id
 * @property ?string logo
 * @property City area
 * @property City city
 * @property Collection<User> associations
 * @property ?int supervisor_id
 * @property ?string scope
 * @property User supervisor
 * @property Collection<Review> reviews
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    public const ASSOCIATION = 'association';
    public const SUPERVISOR = 'supervisor';
    public const ADMIN = 'admin';
    public const SCOPE_ALL = 'all';

    public const SCOPE_SECTION = 'section';
    public const SCOPE_LIMIT = 'limit';

    public const SECTIONS = [
        0 => 'غير محدد',
        1 => 'الخدمة الاجتماعية',
        2 => 'الثقافة والترفيه',
        3 => 'التعليم والأبحاث',
        4 => 'الصحة',
        5 => 'البيئة',
        6 => 'التنمية والإسكان',
        7 => 'التأييد والمؤزارة',
        8 => 'منظمات الدعوة والإرشاد والتعليم الديني',
        9 => 'الروابط المهنية',
        10 => 'منظمات دعم العمل الخيري'
    ];

    public const SCOPES = [
        self::SCOPE_ALL => 'كل الجمعيات',
        self::SCOPE_SECTION => 'جمعيات حسب التخصص',
        self::SCOPE_LIMIT => 'جمعيات مختارة',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'name',
        'email',
        'password',
        'section',
        'phone',
        'number',
        'area_id',
        'city_id',
        'is_active',
        'supervisor_id',
        'scope',
        'approved',
        'payment_receipt',
        'logo',
        'featured'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'featured' => 'boolean',
    ];

    protected $appends = ['payment_url'];

    /**
     * @return string
     */
    final public function getSectionTextAttribute(): string
    {
        return self::SECTIONS[(int)($this->section ?? 0)];
    }

    /**
     * @return string
     */
    final public function scopeText(): string
    {
        return $this->scope ? self::SCOPES[$this->scope] : 'غير محدد';
    }

    /**
     * @return BelongsTo
     */
    final public function area(): BelongsTo
    {
        return $this->belongsTo(City::class, 'area_id');
    }

    /**
     * @return BelongsTo
     */
    final public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * @return BelongsTo
     */
    final public function supervisor(): BelongsTo
    {
        return $this->belongsTo(__CLASS__);
    }

    /**
     * @return HasMany
     */
    final public function associations(): HasMany
    {
        return $this->hasMany(__CLASS__, 'supervisor_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class , 'user_id' );
    }
    public function isApproved()
    {
        if ($this->type == self::SUPERVISOR )
            return true;


        if($this->approved == 1) {
            return true;
        }
        return false;
    }

    final public function logoUrl(): ?string
    {
        return $this->logo ? Storage::url('associations'.'/'.$this->logo) : null;
    }

    final public function getPaymentUrlAttribute(): ?string
    {
        return $this->payment_receipt ? Storage::url($this->payment_receipt) : null;
    }

    final public function logoUrl2(): ?string
    {
        return $this->logo ? \Storage::url($this->logo) : null;
    }

     public function scopeFeatured($q):void{
        $q->where('featured', 1);
    }

    public function scopeApproved($q):void{
        $q->where('approved', 1);
    }

    public function getAddressAttribute()
    {
        return $this->city?->name .', ' .$this->city?->area?->name;
    }
}


