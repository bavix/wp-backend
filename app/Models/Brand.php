<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Rennokki\Befriended\Contracts\Followable;
use Rennokki\Befriended\Contracts\Likeable;
use Rennokki\Befriended\Traits\CanBeFollowed;
use Rennokki\Befriended\Traits\CanBeLiked;
use Rinvex\Addresses\Traits\Addressable;

class Brand extends Model implements Followable, Likeable
{

    use Addressable;
    use CanBeFollowed;
    use CanBeLiked;

    /**
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'image_id',
        'name',
        'activated',
    ];

    /**
     * @return HasMany
     */
    public function collections(): HasMany
    {
        return $this->hasMany(Collection::class);
    }

    /**
     * @return HasMany
     */
    public function wheels(): HasMany
    {
        return $this->hasMany(Wheel::class);
    }

}
