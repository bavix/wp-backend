<?php

namespace App\Observers;

use App\Models\Brand;

class BrandObserver
{
    /**
     * Handle the brand "created" event.
     *
     * @param  \App\Models\Brand $brand
     * @return void
     */
    public function created(Brand $brand)
    {
        //
    }

    /**
     * Handle the brand "updated" event.
     *
     * @param  \App\Models\Brand $brand
     * @return void
     */
    public function updated(Brand $brand)
    {
        //
    }

    /**
     * Handle the brand "deleted" event.
     *
     * @param  \App\Models\Brand $brand
     * @return void
     */
    public function deleted(Brand $brand)
    {
        //
    }

    /**
     * Handle the brand "restored" event.
     *
     * @param  \App\Models\Brand $brand
     * @return void
     */
    public function restored(Brand $brand)
    {
        //
    }

    /**
     * Handle the brand "force deleted" event.
     *
     * @param  \App\Models\Brand $brand
     * @return void
     */
    public function forceDeleted(Brand $brand)
    {
        //
    }
}
