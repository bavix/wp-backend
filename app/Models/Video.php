<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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

}
