<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(schema="images")
 */
class Image extends Model
{

    protected $fillable = [
        'uuid',
    ];

}
