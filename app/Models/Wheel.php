<?php

namespace App\Models;

use App\Traits\UserCanBeFollowed;
use App\Traits\UserCanBeLiked;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Rennokki\Befriended\Contracts\Followable;
use Rennokki\Befriended\Contracts\Likeable;
use Rinvex\Attributes\Traits\Attributable;

/**
 * App\Models\Wheel
 *
 * @OA\Schema (schema="Wheel")
 * @property int $id
 * @property string $name
 * @property int $brand_id
 * @property int|null $collection_id
 * @property int|null $style_id
 * @property int|null $image_id
 * @property int $popular
 * @property int $customized
 * @property int $enabled
 * @property int $retired
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Brand $brand
 * @property-read \App\Models\Collection|null $collection
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel whereCollectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel whereCustomized($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel wherePopular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel whereRetired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel whereStyleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property mixed $entity
 * @property-read \App\Models\Image|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read \App\Models\Style|null $style
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Video[] $videos
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel hasAttribute($key, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel hasFavorited()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel hasLiked()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel query()
 */
class Wheel extends Model implements Followable, Likeable
{

    use UserCanBeFollowed;
    use UserCanBeLiked;
    use Attributable;

    /**
     * @var array
     */
    protected $with = ['eav'];

    /**
     * @var array
     */
    protected $withCount = ['likes', 'favorites'];

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'brand_id',
        'collection_id',
        'style_id',
        'image_id',
        'customized',
        'enabled',
        'retired',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'brand_id' => 'integer',
        'collection_id' => 'integer',
        'style_id' => 'integer',
        'image_id' => 'integer',
        'popular' => 'integer',
        'customized' => 'boolean',
        'enabled' => 'boolean',
        'retired' => 'boolean',
        'favorited' => 'boolean',
        'liked' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return BelongsTo
     */
    public function style(): BelongsTo
    {
        return $this->belongsTo(Style::class);
    }

    /**
     * @return BelongsTo
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    /**
     * @return BelongsTo
     */
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

    /**
     * @return MorphMany
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * @return MorphMany
     */
    public function videos(): MorphMany
    {
        return $this->morphMany(Video::class, 'videoable');
    }

}
