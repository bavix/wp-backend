<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait UserCanBeFollowed
{

    use \Rennokki\Befriended\Traits\CanBeFollowed;

    /**
     * @return MorphToMany
     */
    public function favorites(): MorphToMany
    {
        return $this->followers(User::class);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeHasFavorited(Builder $query): Builder
    {
        return $query->withCount(['favorites as favorited' => function (Builder $query) {
            return $query
                ->where('follower_id', auth()->id())
                ->where('follower_type', User::class);
        }]);
    }

}
