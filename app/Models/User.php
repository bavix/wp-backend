<?php

namespace App\Models;

use App\Traits\HasImage;
use App\Traits\HasSettings;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use Rennokki\Befriended\Contracts\Follower;
use Rennokki\Befriended\Contracts\Liker;
use Rennokki\Befriended\Traits\CanFollow;
use Rennokki\Befriended\Traits\CanLike;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

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
 * @property int|null $image_id
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-write mixed $password_hash
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Social[] $socials
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User havingRoles($roles)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereImageId($value)
 * @property-read string|null $picture
 * @property-read \App\Models\Image|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Brand[] $followingBrands
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wheel[] $followingWheels
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Brand[] $likingBrands
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Wheel[] $likingWheels
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Setting[] $settings
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User role($roles, $guard = null)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 */
class User extends Authenticatable implements Follower, Liker, MustVerifyEmail
{

    use LogsActivity;
    use HasImage;
    use HasApiTokens;
    use Notifiable;
    use CanFollow;
    use CanLike;
    use HasRoles;
    use HasSettings;

    /**
     * @var array
     */
    protected static $logAttributes = [
        'name',
        'login',
        'email',
        'email_verified_at',
        'enabled',
    ];

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
        'enabled',
        'email_verified_at',

        // fixme: remove
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'login' => 'string',
        'email' => 'string',
        'name' => 'string',
        'password' => 'string',
        'enabled' => 'boolean',
        'remember_token' => 'string',
        'email_verified_at' => 'datetime',
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
     * @param string $hash
     */
    public function setPasswordAttribute(string $hash)
    {
        $this->attributes['password'] = $hash;
    }

    /**
     * @param string $value
     */
    public function setNameAttribute(string $value)
    {
        $this->attributes['name'] = Str::title($value);
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

    /**
     * @return HasMany
     */
    public function socials(): HasMany
    {
        return $this->hasMany(Social::class);
    }

    /**
     * @return BelongsTo
     */
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

    /**
     * @return MorphToMany
     */
    public function followingBrands(): MorphToMany
    {
        return $this->following(Brand::class);
    }

    /**
     * @return MorphToMany
     */
    public function likingBrands(): MorphToMany
    {
        return $this->liking(Brand::class);
    }

    /**
     * @return MorphToMany
     */
    public function followingWheels(): MorphToMany
    {
        return $this->following(Wheel::class);
    }

    /**
     * @return MorphToMany
     */
    public function likingWheels(): MorphToMany
    {
        return $this->liking(Wheel::class);
    }

}
