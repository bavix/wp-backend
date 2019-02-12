<?php

namespace App\Models;

/**
 * App\Models\Permission
 *
 * @OA\Schema (schema="Permission")
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $resource
 * @property int $system
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Yajra\Acl\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\Yajra\Acl\Models\Permission havingRoles($roles)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereResource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission query()
 */
class Permission extends \Yajra\Acl\Models\Permission
{
    // resources
    public const RESOURCE_COLLECTIONS = 'collections';
    public const RESOURCE_ADDRESSES = 'addresses';
    public const RESOURCE_BRANDS = 'brands';
    public const RESOURCE_WHEELS = 'wheels';
    public const RESOURCE_STYLES = 'styles';
    public const RESOURCE_PROFILE = 'profile';
    public const RESOURCE_SWAGGER = 'swagger';
    // collections
    public const COLLECTIONS_VIEW = 'collections.view';
    public const COLLECTIONS_CREATE = 'collections.create';
    public const COLLECTIONS_UPDATE = 'collections.update';
    public const COLLECTIONS_DELETE = 'collections.delete';
    // addresses
    public const ADDRESSES_VIEW = 'addresses.view';
    public const ADDRESSES_CREATE = 'addresses.create';
    public const ADDRESSES_UPDATE = 'addresses.update';
    public const ADDRESSES_DELETE = 'addresses.delete';
    // brands
    public const BRANDS_VIEW = 'brands.view';
    public const BRANDS_CREATE = 'brands.create';
    public const BRANDS_UPDATE = 'brands.update';
    public const BRANDS_DELETE = 'brands.delete';
    // wheels
    public const WHEELS_VIEW = 'wheels.view';
    public const WHEELS_CREATE = 'wheels.create';
    public const WHEELS_UPDATE = 'wheels.update';
    public const WHEELS_DELETE = 'wheels.delete';
    public const WHEELS_LIKE = 'wheels.like';
    public const WHEELS_UNLIKE = 'wheels.unlike';
    public const WHEELS_FOLLOW = 'wheels.follow';
    public const WHEELS_UNFOLLOW = 'wheels.unfollow';
    // styles
    public const STYLES_VIEW = 'styles.view';
    public const STYLES_CREATE = 'styles.create';
    public const STYLES_UPDATE = 'styles.update';
    public const STYLES_DELETE = 'styles.delete';
    // profile
    public const PROFILE_VIEW = 'profile.view';
    public const PROFILE_CREATE = 'profile.create';
    public const PROFILE_UPDATE = 'profile.update';
    public const PROFILE_DELETE = 'profile.delete';
    public const PROFILE_PHOTO = 'profile.photo';
    // swagger
    public const SWAGGER_VIEW = 'swagger.view';
}
