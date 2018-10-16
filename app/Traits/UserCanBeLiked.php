<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait UserCanBeLiked
{

    use \Rennokki\Befriended\Traits\CanBeLiked;

    /**
     * @return MorphToMany
     */
    public function likes(): MorphToMany
    {
        return $this->likers(User::class);
    }

}
