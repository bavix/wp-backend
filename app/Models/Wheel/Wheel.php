<?php

namespace App\Models\Wheel;

use App\Http\Controllers\HomeController;
use App\Models\Social\Comment;
use App\Models\Social\Favorite;
use App\Models\Social\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
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
 * @property mixed $entity
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Social\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Social\Favorite[] $favorites
 * @property-read \App\Models\Social\Like $liked
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Social\Like[] $likes
 */
class Wheel extends Model
{
    /**
     * rating https://habr.com/company/darudar/blog/143188/
     */

    use Attributable;

    protected $fillable = [
        'brand_id',
        'collection_id',
        'style_id',
        'image_id',
        'name',
    ];

    /**
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'object')
            ->where('activated', 1);
    }

    /**
     * Wheel::query()
     *   ->withCount('commented as commented')
     *   ->get();
     *
     * @return MorphOne
     */
    public function commented(): MorphOne
    {
        return $this
            ->morphOne(Comment::class, 'object')
            ->where('user_id', \Auth::id());
    }

    /**
     * @return MorphMany
     */
    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'object');
    }

    /**
     * Wheel::query()
     *   ->withCount('favored as favored')
     *   ->get();
     *
     * @return MorphOne
     */
    public function favored(): MorphOne
    {
        return $this
            ->morphOne(Favorite::class, 'object')
            ->where('user_id', \Auth::id());
    }

    /**
     * @return MorphMany
     */
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'object');
    }

    /**
     * Wheel::query()
     *   ->withCount('liked as liked')
     *   ->get();
     *
     * @return MorphOne
     */
    public function liked(): MorphOne
    {
        return $this
            ->morphOne(Like::class, 'object')
            ->where('user_id', \Auth::id());
    }

}
