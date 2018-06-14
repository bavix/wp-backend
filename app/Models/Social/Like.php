<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\Social\Like
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property string $object_type
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $object
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Like whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Like whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Like whereObjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Like whereObjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Like whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Like whereUserId($value)
 * @mixin \Eloquent
 */
class Like extends Model
{

    protected $hidden = ['object_id', 'object_type'];

    /**
     * @return MorphTo
     */
    public function object(): MorphTo
    {
        return $this->morphTo();
    }

}
