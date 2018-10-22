<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait UserCanBeLiked
{

    use \Rennokki\Befriended\Traits\CanBeLiked;

    /**
     * @return MorphToMany
     */
    public function likes(): MorphToMany
    {
        return $this->likers(User::class);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeHasLiked(Builder $query): Builder
    {
        return $query->withCount(['likes as liked' => function (Builder $query) {
            return $query
                ->where('liker_id', auth()->id())
                ->where('liker_type', User::class);
        }]);
    }

}
