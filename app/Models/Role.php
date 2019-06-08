<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Role
 *
 * @OA\Schema (schema="Role")
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property int $system
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Yajra\Acl\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role query()
 */
class Role extends \Yajra\Acl\Models\Role
{

    use LogsActivity;

    public const REGISTERED = 'registered';
    public const USER = 'user';
    public const DEVELOPER = 'developer';

    /**
     * @var array
     */
    protected static $logAttributes = [
        'name',
        'slug',
        'description',
        'system',
    ];
}
