<?php

namespace App\Observers;

use App\Models\Style;

class StyleObserver
{
    /**
     * Handle the style "created" event.
     *
     * @param  \App\Models\Style $style
     * @return void
     */
    public function created(Style $style)
    {
        //
    }

    /**
     * Handle the style "updated" event.
     *
     * @param  \App\Models\Style $style
     * @return void
     */
    public function updated(Style $style)
    {
        //
    }

    /**
     * Handle the style "deleted" event.
     *
     * @param  \App\Models\Style $style
     * @return void
     */
    public function deleted(Style $style)
    {
        //
    }

    /**
     * Handle the style "restored" event.
     *
     * @param  \App\Models\Style $style
     * @return void
     */
    public function restored(Style $style)
    {
        //
    }

    /**
     * Handle the style "force deleted" event.
     *
     * @param  \App\Models\Style $style
     * @return void
     */
    public function forceDeleted(Style $style)
    {
        //
    }
}
