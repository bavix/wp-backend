<?php

namespace App\Observers;

use App\Models\Brand;
use App\Models\Wheel;

class BrandObserver
{

    /**
     * Handle the brand "updated" event.
     *
     * @param  \App\Models\Brand $brand
     * @return void
     */
    public function saving(Brand $brand): void
    {
        /**
         * Если мы выключили бренд, то отключаем и его диски
         */
        if ($brand->getKey() && !$brand->enabled && $brand->enabled !== $brand->getOriginal('enabled')) {
            Wheel::whereEnabled(true)
                ->where('brand_id', $brand->id)
                ->update(['enabled' => false]);
        }
    }

}
