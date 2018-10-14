<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Collection
 *
 * @OA\Schema (schema="collections")
 * @property int $id
 * @property int $brand_id
 * @property string $name
 * @property int $enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Brand $brand
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wheel[] $wheels
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Collection whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Collection extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'brand_id',
        'name',
        'enabled',
    ];

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return HasMany
     */
    public function wheels(): HasMany
    {
        return $this->hasMany(Wheel::class);
    }

}
