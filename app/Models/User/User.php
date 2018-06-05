<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * Class User
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Collection $contacts
 */
class User extends Authenticatable
{

    public const REL_CONTACTS = 'contacts';

    use EntrustUserTrait;
    use Notifiable;

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

    /**
     * @param string $password
     */
    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = \bcrypt($password);
    }

    /**
     * @return BelongsTo
     */
    public function info(): BelongsTo
    {
        return $this->belongsTo(Info::class);
    }

    /**
     * @return HasMany
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

}
