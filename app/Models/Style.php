<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Style extends Model
{

    /**
     * @return HasMany
     */
    public function wheels(): HasMany
    {
        return $this->hasMany(Wheel::class);
    }

}
