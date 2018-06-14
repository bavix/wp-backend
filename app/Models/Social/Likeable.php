<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Auth;

/**
 * Trait Likeable
 *
 * @package App\Models\Social
 * @property Like $liked
 */
trait Likeable
{

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
            ->where('user_id', Auth::id());
    }

    /**
     * @return bool
     */
    public function like(): bool
    {
        if ($this->liked)
        {
            throw new \InvalidArgumentException('You put me like this record');
        }

        $like          = new Like();
        $like->user_id = Auth::id();
        $like->object()->associate($this);

        return $like->save();
    }

    /**
     * @return bool
     * @throws
     */
    public function dislike(): bool
    {
        if (!$this->liked)
        {
            throw new \InvalidArgumentException('This entry does not have your likes');
        }

        return $this->liked->delete();
    }

}
