<?php

namespace App\Helpers;

use Bavix\CupKit\ClientCredentials;
use Bavix\CupKit\Identity;

class Cup
{

    /**
     * @var ClientCredentials
     */
    protected static $credentials;

    /**
     * @var Identity
     */
    protected static $identity;

    /**
     * @return Identity
     */
    public static function identity(): Identity
    {
        if (!static::$identity) {
            static::$identity = new Identity(
                static::credentials(),
                \config('cdn.username', ''),
                \config('cdn.password', '')
            );
        }
        return static::$identity;
    }

    /**
     * @return ClientCredentials
     */
    public static function credentials(): ClientCredentials
    {
        if (!static::$credentials) {
            static::$credentials = new ClientCredentials(
                \config('cdn.base_url', ''),
                \config('cdn.client_id', ''),
                \config('cdn.client_secret', '')
            );
        }
        return static::$credentials;
    }

}
