<?php

namespace App\Models;

use App\Traits\UserCanBeFollowed;
use App\Traits\UserCanBeLiked;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Rennokki\Befriended\Contracts\Followable;
use Rennokki\Befriended\Contracts\Likeable;
use Rinvex\Addresses\Traits\Addressable;

class Brand extends Model implements Followable, Likeable
{

    use UserCanBeFollowed;
    use UserCanBeLiked;
    use Addressable;

    /**
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'image_id',
        'name',
        'enabled',
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
