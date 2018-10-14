<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Style
 *
 * @OA\Schema (schema="styles")
 * @property int $id
 * @property string $type
 * @property string $number
 * @property int $spoke
 * @property int $rotated
 * @property int $enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wheel[] $wheels
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Style whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Style whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Style whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Style whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Style whereRotated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Style whereSpoke($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Style whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Style whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Style extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'number',
        'spoke',
        'rotated',
    ];

    /**
     * @return HasMany
     */
    public function wheels(): HasMany
    {
        return $this->hasMany(Wheel::class);
    }

}
