<?php

namespace App\Helpers\CDN;

use App\Models\Image;

class Provider
{

    /**
     * @return string
     */
    protected static function cdnUri(): string
    {
        static $cdnUri;
        if (!$cdnUri) {
            $cdnUri = \config('cdn.base_url', '');
            $cdnUri = \rtrim($cdnUri, '/');
        }
        return $cdnUri;
    }

    /**
     * @param string $bucket
     * @return array
     */
    protected static function views(string $bucket): array
    {
        static $views = [];

        if (empty($views[$bucket])) {
            $views[$bucket] = \config('cdn.buckets.' . $bucket, []);
        }

        return $views[$bucket];
    }

    /**
     * @param Image $image
     * @return array
     */
    public static function thumbnails(Image $image, string $format): array
    {
        $results = [];
        $views = static::views($image->bucket);

        foreach ($views as $view) {
            $results[$view['name']] = static::thumbnail($image, $view['name'], $format);
        }

        return $results;
    }

    /**
     * @param Image $image
     * @param string $view
     * @param string $format
     * @return string
     */
    public static function thumbnail(Image $image, string $view, string $format): string
    {
        return \sprintf(
            '%s/%s/%s/%s.%s',
            static::cdnUri(),
            $image->bucket,
            $view,
            $image->uuid,
            $format
        );
    }

}
