<?php

namespace App\Models;

use App\Traits\UserCanBeFollowed;
use App\Traits\UserCanBeLiked;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
 */
class Wheel extends Model implements Followable, Likeable
{

    use UserCanBeFollowed;
    use UserCanBeLiked;
    use Attributable;

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

}
