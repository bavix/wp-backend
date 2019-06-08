<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string $key
 * @property string $cast
 * @property mixed|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Setting[] $model
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCast($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereValue($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{

    use LogsActivity;

    /**
     * @var array
     */
    protected static $logAttributes = [
        'model_type',
        'model_id',
        'key',
        'cast',
        'value',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'model_type',
        'model_id',
        'key',
        'cast',
        'value',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'key' => 'string',
        'cast' => 'string',
        'value' => 'custom',
    ];

    /**
     * @param string $key
     * @return string
     */
    protected function getCastType($key): string
    {
        if ($key === 'value') {
            return $this->cast ?? 'string';
        }

        return parent::getCastType($key);
    }

    /**
     * @return MorphTo
     */
    public function model(): MorphTo
    {
        return $this->morphTo();
    }

}
