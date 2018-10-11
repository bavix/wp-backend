<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Rennokki\Befriended\Contracts\Follower;
use Rennokki\Befriended\Traits\CanFollow;

class User extends Authenticatable implements Follower
{

    use HasApiTokens;
    use Notifiable;
    use CanFollow;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
