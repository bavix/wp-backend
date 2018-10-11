<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait UserCanBeFollowed
{
    
    use \Rennokki\Befriended\Traits\CanBeFollowed;

    /**
     * @return MorphToMany
     */
    public function favorites(): MorphToMany
    {
        return $this->followers(User::class);
    }

}
