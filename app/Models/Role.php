<?php

namespace App\Models;

class Role extends \Yajra\Acl\Models\Role
{
    public const BLOCKED = 'blocked';
    public const REGISTERED = 'registered';
    public const USER = 'user';
    public const DEVELOPER = 'developer';
}
