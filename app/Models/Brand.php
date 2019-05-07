<?php

namespace App\Models;

use App\Traits\HasImage;
use App\Traits\UserCanBeFollowed;
use App\Traits\UserCanBeLiked;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Rennokki\Befriended\Contracts\Followable;
use Rennokki\Befriended\Contracts\Likeable;
use Rinvex\Addresses\Traits\Addressable;

/**
 * App\Models\Brand
 *
 * @OA\Schema (schema="Brand")
 * @OA\Property (
 *     property="parent_id",
 *     type="int"
 * )
 * @OA\Property (
 *     property="image_id",
 *     type="int"
 * )
 * @OA\Property (
 *     property="name",
 *     type="string"
 * )
 * @OA\Property (
 *     property="enabled",
 *     type="bool"
 * )
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $image_id
 * @property string $name
 * @property int $enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Rinvex\Addresses\Models\Address[] $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Collection[] $collections
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Image|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Link[] $links
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wheel[] $wheels
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand hasFavorited()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand hasLiked()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brand query()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $favorites
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $likes
 */
class Brand extends Model implements Followable, Likeable
{

    use UserCanBeFollowed;
    use UserCanBeLiked;
    use Addressable;
    use HasImage;

    /**
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'image_id',
        'name',
        'enabled',

        // fixme: remove
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'name' => 'string',
        'enabled' => 'boolean',
    ];

    /**
     * @return HasMany
     */
    public function collections(): HasMany
    {
        return $this->hasMany(Collection::class);
    }

    /**
     * @return MorphMany
     */
    public function links(): MorphMany
    {
        return $this->morphMany(Link::class, 'linkable');
    }

    /**
     * @return HasMany
     */
    public function wheels(): HasMany
    {
        return $this->hasMany(Wheel::class);
    }

    /**
     * @return BelongsTo
     */
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

}
