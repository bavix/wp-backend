<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Social
 *
 * @property int $id
 * @property string $provider
 * @property string $provider_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Social query()
 */
class Social extends Model
{

    use LogsActivity;

    /**
     * @var array
     */
    protected static $logAttributes = [
        'provider',
        'provider_id',
        'user_id',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider',
        'provider_id',
        'user_id',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'provider' => 'string',
        'provider_id' => 'string',
        'user_id' => 'integer',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
