<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property string type
 * @property int parent_id
 * @property string name
 * @property Collection<User> users
 * @property Collection<City> cities
 */
class City extends Model
{
    protected $fillable = ['type', 'parent_id', 'name'];

    public const AREA = 'area';
    public const CITY = 'city';

    public const TYPES = [
        self::AREA => 'منطقة',
        self::CITY => 'مدينة'
    ];

    /**
     * @return BelongsTo
     */
    final public function area(): BelongsTo
      {
        return $this->belongsTo(__CLASS__,'parent_id')->withDefault();
    }

    /**
     * @return HasMany
     */
    final public function cities(): HasMany
    {
        return  $this->hasMany(__CLASS__, 'parent_id');
    }

    /**
     * @return HasMany
     */
    final public function users():HasMany
    {
        return $this->hasMany(User::class);
    }
}
