<?php

namespace App\Models;

use App\Traits\Comment\HasComments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property int $user_id
 * @property string $commentable_type
 * @property int $commentable_id
 * @property string $markdown
 * @property bool $confirmed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $commentable
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read string $html
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereCommentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereCommentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereMarkdown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereUserId($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{

    use LogsActivity;
    use HasComments;

    /**
     * @var array
     */
    protected static $logAttributes = [
        'user_id',
        'commentable_type',
        'commentable_id',
        'markdown',
        'confirmed',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'commentable_type',
        'commentable_id',
        'markdown',
        'confirmed',

        // fixme: remove
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $appends = ['html'];

    /**
     * @var array
     */
    protected $casts = [
        'confirmed' => 'boolean',
    ];

    /**
     * @return string
     */
    public function getHtmlAttribute(): string
    {
        return (new \Parsedown())
            ->setSafeMode(true)
            ->setMarkupEscaped(true)
            ->parse($this->markdown);
    }

    /**
     * @return MorphTo
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
