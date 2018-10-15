<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Link
 *
 * @OA\Schema (schema="links")
 */
class Link extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'url',
        'enabled',
    ];

}
