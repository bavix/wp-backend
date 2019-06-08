<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Activitylog\Traits\LogsActivity;

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
