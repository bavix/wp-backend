<?php

namespace App\Models;

use App\Traits\Comment\HasComments;
use Embed\Embed;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\Video
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $url
 * @property array $tags
 * @property string $image
 * @property int $image_width
 * @property int $image_height
 * @property string $author_name
 * @property string $author_url
 * @property string $provider_name
 * @property string|null $videoable_type
 * @property int|null $videoable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read null|string $identifier
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $videoable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereAuthorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereAuthorUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereImageHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereImageWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereProviderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereVideoableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereVideoableType($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video query()
 */
class Video extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'url',
        'tags',
        'image',
        'image_width',
        'image_height',
        'author_name',
        'author_url',
        'provider_name',

        // fixme: remove
        'created_at',
        'updated_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'url' => 'string',
        'tags' => 'array',
        'image' => 'string',
        'image_width' => 'integer',
        'image_height' => 'integer',
        'author_name' => 'string',
        'author_url' => 'string',
        'provider_name' => 'string',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'identifier'
    ];

    /**
     * @return null|string
     */
    public function getIdentifierAttribute(): ?string
    {
        \preg_match(
            '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
            $this->url,
            $match
        );

        return $match[1] ?? null;
    }

    /**
     * @return MorphTo
     */
    public function videoable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @param string $url
     * @return Video
     */
    public static function fromUrl(string $url): self
    {
        try {
            $model = self::whereUrl($url)->firstOrFail();
        } catch (\Throwable $throwable) {
            $info = Embed::create($url);
            $model = new static();
            $model->url = $url;
            $model->title = $info->title;
            $model->description = $info->description;
            $model->url = $info->url;
            $model->tags = $info->tags;
            $model->image = $info->image;
            $model->image_width = $info->imageWidth;
            $model->image_height = $info->imageHeight;
            $model->author_name = $info->authorName;
            $model->author_url = $info->authorUrl;
            $model->provider_name = $info->providerName;
            $model->save();
        }

        return $model;
    }

}
