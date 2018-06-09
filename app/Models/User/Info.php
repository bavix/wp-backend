<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\User\Info
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User\User[] $users
 * @mixin \Eloquent
 */
class Info extends Model
{

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

}
