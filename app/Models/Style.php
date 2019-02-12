<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Style
 *
 * @OA\Schema (schema="Style")
 * @property int $id
 * @property string $type
 * @property string $tuple
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
 * @property string|null $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Style whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Style whereTuple($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Style newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Style newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Style query()
 */
class Style extends Model
{

    public const TYPE_I = 'I';
    public const TYPE_X = 'X';
    public const TYPE_Y = 'Y';
    public const TYPE_V = 'V';
    public const TYPE_O = 'O';

    public const TUPLE_SINGLE = 'Single';
    public const TUPLE_DOUBLE = 'Double';
    public const TUPLE_TRIPLE = 'Triple';

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
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'string',
        'tuple' => 'string',
        'spoke' => 'integer',
        'rotated' => 'boolean',
        'enabled' => 'boolean',
    ];

    /**
     * @return array
     */
    public static function types(): array
    {
        return [
            self::TYPE_I => self::TYPE_I,
            self::TYPE_X => self::TYPE_X,
            self::TYPE_Y => self::TYPE_Y,
            self::TYPE_V => self::TYPE_V,
            self::TYPE_O => self::TYPE_O,
        ];
    }

    /**
     * @return array
     */
    public static function tuples(): array
    {
        return [
            self::TUPLE_SINGLE => self::TUPLE_SINGLE,
            self::TUPLE_DOUBLE => self::TUPLE_DOUBLE,
            self::TUPLE_TRIPLE => self::TUPLE_TRIPLE,
        ];
    }

    /**
     * @return Style[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function options()
    {
        $items = [];
        $styles = self::get();

        foreach ($styles as $style) {
            $items[$style->id] = $style->name;
        }

        return $items;
    }

    /**
     * @return HasMany
     */
    public function wheels(): HasMany
    {
        return $this->hasMany(Wheel::class);
    }

}
