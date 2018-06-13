<?php

namespace App\Models\Social\Follow;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Follower extends Model
{

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'follower_id',
        'follower_type',
        'followable_id',
        'followable_type',
    ];

    /**
     * @inheritdoc
     */
    protected $with = ['followable', 'follower'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function followable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function follower(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @param  object $query
     * @param  Model  $followable
     *
     * @return $this
     */
    public function scopeFollowing($query, Model $followable): self
    {
        return $query
            ->where('followable_id', $followable->id)
            ->where('followable_type', \get_class($followable));
    }

    /**
     * @param  object $query
     * @param  Model  $follower
     *
     * @return $this
     */
    public function scopeFollowedBy($query, Model $follower): self
    {
        return $query
            ->where('follower_id', $follower->id)
            ->where('follower_type', \get_class($follower));
    }

}
