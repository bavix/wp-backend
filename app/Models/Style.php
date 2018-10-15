<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

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

    public const TYPE_I = 'I';
    public const TYPE_X = 'X';
    public const TYPE_Y = 'Y';
    public const TYPE_V = 'V';
    public const TYPE_O = 'O';

    public const NUMBER_SIMPLE = 'Simple';
    public const NUMBER_DOUBLE = 'Double';
    public const NUMBER_TRIPLE = 'Triple';

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
    protected $appends = [
        'name'
    ];

    /**
     * @return HasMany
     */
    public function wheels(): HasMany
    {
        return $this->hasMany(Wheel::class);
    }

    /**
     * @return string
     */
    public function getNameAttribute(): string
    {
        return \sprintf(
            '%s %s %s%s',
            $this->type,
            $this->number,
            $this->spoke,
            $this->rotated ? ' Rotated' : ''
        );
    }

    /**
     * @return array
     */
    public static function types(): array
    {
        return [
            self::TYPE_I,
            self::TYPE_X,
            self::TYPE_Y,
            self::TYPE_V,
            self::TYPE_O,
        ];
    }

    /**
     * @return array
     */
    public static function numbers(): array
    {
        return [
            self::NUMBER_SIMPLE,
            self::NUMBER_DOUBLE,
            self::NUMBER_TRIPLE,
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

}
