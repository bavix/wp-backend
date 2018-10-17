<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Link
 *
 * @OA\Schema (schema="Link")
 * @property int $id
 * @property string $url
 * @property int $enabled
 * @property string $linkable_type
 * @property int $linkable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereLinkableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereLinkableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereUrl($value)
 * @mixin \Eloquent
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
