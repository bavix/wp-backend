<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Activitylog\Traits\LogsActivity;

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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link query()
 */
class Link extends Model
{

    use LogsActivity;

    /**
     * @var array
     */
    protected static $logAttributes = [
        'linkable_type',
        'linkable_id',
        'url',
        'enabled',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'url',
        'enabled',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'url' => 'string',
        'linkable_type' => 'string',
        'linkable_id' => 'integer',
        'enabled' => 'boolean',
    ];

    /**
     * @return MorphTo
     */
    public function linkable(): MorphTo
    {
        return $this->morphTo();
    }

}
