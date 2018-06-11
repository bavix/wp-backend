<?php

namespace App\Models\Social;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\Social\Favorite
 *
 * @property int $id
 * @property int $user_id
 * @property int $object_id
 * @property string $object_type
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Favorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Favorite whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Favorite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Favorite whereObjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Favorite whereObjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Favorite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social\Favorite whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $object
 */
class Favorite extends Model
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
