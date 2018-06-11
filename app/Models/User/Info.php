<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\User\Info
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User\User[] $users
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $last_name
 * @property string|null $first_name
 * @property string|null $middle_name
 * @property string|null $about
 * @property int $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Info whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Info whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Info whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Info whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Info whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Info whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Info whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Info whereUserId($value)
 */
class Info extends Model
{

    /**
     * @var string
     */
    protected $table = 'user_info';

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

}
