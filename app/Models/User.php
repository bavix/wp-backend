<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Rennokki\Befriended\Contracts\Follower;
use Rennokki\Befriended\Contracts\Liker;
use Rennokki\Befriended\Traits\CanFollow;
use Rennokki\Befriended\Traits\CanLike;

class User extends Authenticatable implements Follower, Liker
{

    use HasApiTokens;
    use Notifiable;
    use CanFollow;
    use CanLike;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

}
