<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * Class User
 *
 * @package App\Models
 * @property int $id
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property string $createdAt
 * @property string $updatedAt
 * @property Collection $contacts
 * @property int $verified
 * @property int $activated
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\User\Info $info
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereActivated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User withRole($role)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{

    public const REL_CONTACTS = 'contacts';

    use EntrustUserTrait;
    use HasApiTokens;
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
     * @param string $identifier
     *
     * @return User|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     */
    public function findForPassport(string $identifier)
    {
        return static::orWhereHas('contacts', function (Builder $query) use ($identifier) {
                return $query
                    ->where('type', Contact::TYPE_EMAIL)
                    ->where('value', $identifier);
            })
            ->orWhere('login', $identifier)
            ->first();
    }

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
