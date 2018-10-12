<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(schema="styles")
 */
class Style extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'number',
        'spoke',
        'rotated',
    ];

    /**
     * @return HasMany
     */
    public function wheels(): HasMany
    {
        return $this->hasMany(Wheel::class);
    }

}
