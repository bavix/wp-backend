<?php

namespace App\Models\Wheel;

use App\Models\Social\Commentable;
use App\Models\Social\Likeable;
use Illuminate\Database\Eloquent\Model;
use Rinvex\Attributes\Traits\Attributable;

/**
 * App\Models\Wheel\Wheel
 *
 * @property int $id
 * @property int $brand_id
 * @property int|null $collection_id
 * @property int|null $style_id
 * @property int|null $image_id
 * @property string $name
 * @property int $popular
 * @property int $customized
 * @property int $retired
 * @property int $activated
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Social\Comment $commented
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Social\Comment[] $comments
 * @property mixed $entity
 * @property-read \App\Models\Social\Like $liked
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Social\Like[] $likes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel\Wheel hasAttribute($key, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel\Wheel whereActivated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel\Wheel whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel\Wheel whereCollectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel\Wheel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel\Wheel whereCustomized($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel\Wheel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel\Wheel whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel\Wheel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel\Wheel wherePopular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel\Wheel whereRetired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel\Wheel whereStyleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wheel\Wheel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Wheel extends Model
{
    /**
     * rating https://habr.com/company/darudar/blog/143188/
     */

    use Attributable;
    use Commentable;
    use Likeable;

    protected $fillable = [
        'brand_id',
        'collection_id',
        'style_id',
        'image_id',
        'name',
    ];

}
