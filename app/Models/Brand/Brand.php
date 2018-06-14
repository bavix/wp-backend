<?php

namespace App\Models\Brand;

use App\Models\Social\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * App\Models\Brand\Brand
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Social\Comment[] $comments
 * @mixin \Eloquent
 */
class Brand extends Model
{

    /**
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'object');
    }

}
