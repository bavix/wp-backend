<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Rennokki\Befriended\Contracts\Follower;
use Rennokki\Befriended\Contracts\Liker;
use Rennokki\Befriended\Traits\CanFollow;
use Rennokki\Befriended\Traits\CanLike;
use Yajra\Acl\Traits\HasRole;

/**
 * App\Models\User
 *
 * @OA\Schema (schema="User")
 * @property int $id
 * @property string $login
 * @property string|null $name
 * @property string|null $email
 * @property string $password
 * @property int $enabled
 * @property string|null $remember_token
 * @property string|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements Follower, Liker
{

    use HasApiTokens;
    use Notifiable;
    use CanFollow;
    use CanLike;
    use HasRole;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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

    /**
     * @param string $password
     */
    public function setPasswordAttribute(string $password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * @param string $username
     * @return User|null
     */
    public function findForPassport(string $username): ?self
    {
        return User::query()
            ->where('login', $username)
            ->orWhere('email', $username)
            ->first();
    }

    /**
     * @param $password
     * @return bool
     */
    public function validateForPassportPasswordGrant($password): bool
    {
        return $this->enabled && Hash::check($password, $this->getAuthPassword());
    }

}
