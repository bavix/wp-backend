<?php

namespace App\Traits;

use App\Models\Image;

/**
 * Trait HasImage
 * @package App\Traits
 * @property Image $image
 */
trait HasImage
{

    /**
     * @return string|null
     */
    public function getPictureAttribute(): ?string
    {
        return $this->image->thumbnails['xs'] ?? null;
    }

}
