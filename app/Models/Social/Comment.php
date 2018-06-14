<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\Social\Comment
 *
 * @property int $id
 * @property string $text
 * @property int $user_id
 * @property int $object_id
 * @property string $object_type
 * @property int $activated
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $object
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Comment whereActivated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Comment whereObjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Comment whereObjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Comment whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Comment whereUserId($value)
 * @mixin \Eloquent
 */
class Comment extends Model
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
