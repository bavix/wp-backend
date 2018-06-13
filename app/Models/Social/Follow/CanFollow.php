<?php

namespace App\Models\Social\Follow;

use App\Models\Social\Follow\Exceptions\AlreadyFollowingException;
use App\Models\Social\Follow\Exceptions\CannotBeFollowedException;
use App\Models\Social\Follow\Exceptions\FollowerNotFoundException;
use Illuminate\Support\Facades\Cache;

trait CanFollow
{

    public function followables()
    {
        return $this->morphMany(Follower::class, 'follower');
    }

    public function follow($followable)
    {

        if (!$this->isFollowing($followable))
        {
            throw new AlreadyFollowingException(
                \get_class($this) . '::' . $this->id .
                ' is already following ' .
                \get_class($followable) . '::' . $followable->id);
        }

        if ($followable->follower())
        {
            Cache::forget($this->getFollowingCacheKey());

            return Follower::create([
                'follower_id'     => $this->id,
                'follower_type'   => \get_class($this),
                'followable_id'   => $followable->id,
                'followable_type' => \get_class($followable),
            ]);
        }

        throw new CannotBeFollowedException(\get_class($followable) . '::' . $followable->id . ' cannot be followed.');
    }

    public function flout($followable)
    {
        if ($this->isFollowing($followable) === true)
        {
            Cache::forget($this->getFollowingCacheKey());

            return Follower::following($followable)
                ->followedBy($this)
                ->delete();
        }

        throw new FollowerNotFoundException(\get_class($this) . '::' . $this->id . ' is not following ' . \get_class($followable) . '::' . $followable->id);
    }

    public function isFollowing($followable)
    {
        $query = Follower::following($followable)
            ->followedBy($this);

        return (bool)$query->count() > 0;
    }

    public function getFollowingCount()
    {
        $key = $this->getFollowingCacheKey();

        return cache()->remember($key, config('lecturize.followers.cache.expiry', 10), function () {
            $count = 0;
            Follower::where('follower_id', $this->id)
                ->where('follower_type', \get_class($this))
                ->chunk(1000, function ($models) use (&$count) {
                    $count = $count + count($models);
                });

            return $count;
        });
    }

    public function getFollowing($limit = 0, $type = '')
    {
        if ($type)
        {
            $followables = $this->followables()->where('followable_type', $type)->get();
        }
        else
        {
            $followables = $this->followables()->get();
        }

        $return = [];
        foreach ($followables as $followable)
        {
            $return[] = $followable->followable()->first();
        }

        $collection = collect($return)->shuffle();

        if ($limit == 0)
        {
            return $collection;
        }

        return $collection->take($limit);
    }

    private function getFollowingCacheKey()
    {
        $model = \get_class($this);
        $model = substr($model, strrpos($model, '\\') + 1);
        $model = strtolower($model);

        return 'followers.' . $model . '.' . $this->id . '.following.count';
    }

    public function scopeFollows($query)
    {
        return $query->whereHas('followables', function ($q) {
            $q->where('follower_id', $this->id);
            $q->where('follower_type', \get_class($this));
        });
    }
}
