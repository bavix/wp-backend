<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\User\Contact
 *
 * @property int $id
 * @property string $type
 * @property string $value
 * @property int $notify
 * @property int $confirmed
 * @property int $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\User\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Contact whereConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Contact whereNotify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Contact whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Contact whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\Contact whereValue($value)
 * @mixin \Eloquent
 */
class Contact extends Model
{

    public const TYPE_EMAIL = 'email';
    public const TYPE_PHONE = 'phone';

    protected $fillable = ['type', 'value', 'user_id'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
