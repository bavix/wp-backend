<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\Social\Subscription
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property string $object_type
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Subscription whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Subscription whereObjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Subscription whereObjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Subscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Subscription whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $object
 */
class Subscription extends Model
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
