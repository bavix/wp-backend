<?php

namespace App\Models;

use App\Helpers\CDN\Provider;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Image
 *
 * @OA\Schema (schema="Image")
 * @property int $id
 * @property string $uuid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereImageableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereImageableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereUuid($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $imageable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image query()
 * @property string|null $bucket
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Image whereBucket($value)
 * @property array $thumbnails
 */
class Image extends Model
{

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'uuid' => 'string',
    ];

    /**
     * @var array
     */
    protected $fillable = ['uuid'];

    /**
     * @var array
     */
    protected $appends = ['thumbnails'];

    /**
     * @param string $format
     * @return array
     */
    public function getThumbnailsAttribute(): array
    {
        return Provider::thumbnails($this, 'png');
    }

}
