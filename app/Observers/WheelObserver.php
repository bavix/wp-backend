<?php

namespace App\Observers;

use App\Models\Wheel;

class WheelObserver
{
    /**
     * Handle the wheel "created" event.
     *
     * @param  \App\Models\Wheel  $wheel
     * @return void
     */
    public function created(Wheel $wheel)
    {
        //
    }

    /**
     * Handle the wheel "updated" event.
     *
     * @param  \App\Models\Wheel  $wheel
     * @return void
     */
    public function updated(Wheel $wheel)
    {
        //
    }

    /**
     * Handle the wheel "deleted" event.
     *
     * @param  \App\Models\Wheel  $wheel
     * @return void
     */
    public function deleted(Wheel $wheel)
    {
        //
    }

    /**
     * Handle the wheel "restored" event.
     *
     * @param  \App\Models\Wheel  $wheel
     * @return void
     */
    public function restored(Wheel $wheel)
    {
        //
    }

    /**
     * Handle the wheel "force deleted" event.
     *
     * @param  \App\Models\Wheel  $wheel
     * @return void
     */
    public function forceDeleted(Wheel $wheel)
    {
        //
    }
}
