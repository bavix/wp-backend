<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Support\Facades\DB;

/**
 * Trait HasImage
 * @package App\Traits
 * @property Image $image
 */
trait HasImage
{

    /**
     * @param string $path
     * @throws
     */
    public function setPictureAttribute(string $path): void
    {
        [$bucket, $uuid] = \explode('.', $path, 2);

        DB::transaction(function () use ($bucket, $uuid) {
            $image = $this->image()
                ->create(compact('bucket', 'uuid'));

            $this->image()->associate($image);
        });
    }

    /**
     * @return string|null
     */
    public function getPictureAttribute(): ?string
    {
        return $this->image->thumbnails['m'] ?? null;
    }

}
