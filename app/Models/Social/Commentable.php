<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Auth;

trait Commentable
{

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
            ->where('user_id', Auth::id());
    }

}
