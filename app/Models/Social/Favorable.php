<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Auth;

trait Favorable
{

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
            ->where('user_id', Auth::id());
    }

}
