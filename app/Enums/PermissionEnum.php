<?php

namespace App\Enums;

class PermissionEnum
{

    // swagger
    public const SWAGGER_VIEW = 'swagger.view';

    // nova
    public const NOVA_VIEW = 'nova.view';

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

    // collections
    public const COLLECTIONS_VIEW = 'collections.view';
    public const COLLECTIONS_CREATE = 'collections.create';
    public const COLLECTIONS_UPDATE = 'collections.update';
    public const COLLECTIONS_DELETE = 'collections.delete';

    // styles
    public const STYLES_VIEW = 'styles.view';
    public const STYLES_CREATE = 'styles.create';
    public const STYLES_UPDATE = 'styles.update';
    public const STYLES_DELETE = 'styles.delete';

    // wheels
    public const WHEELS_VIEW = 'wheels.view';
    public const WHEELS_CREATE = 'wheels.create';
    public const WHEELS_UPDATE = 'wheels.update';
    public const WHEELS_DELETE = 'wheels.delete';
    public const WHEELS_LIKE = 'wheels.like';
    public const WHEELS_UNLIKE = 'wheels.unlike';
    public const WHEELS_FOLLOW = 'wheels.follow';
    public const WHEELS_UNFOLLOW = 'wheels.unfollow';

    // profile
    public const PROFILE_VIEW = 'profile.view';
    public const PROFILE_CREATE = 'profile.create';
    public const PROFILE_UPDATE = 'profile.update';
    public const PROFILE_DELETE = 'profile.delete';
    public const PROFILE_PHOTO = 'profile.photo';

}
