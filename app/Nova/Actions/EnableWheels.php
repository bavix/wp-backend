<?php

namespace App\Nova\Actions;

use App\Models\Brand;
use App\Models\Wheel;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnableWheels extends Action
{

    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $ids = $models
            ->pluck('id')
            ->toArray();

        Brand::whereKey($ids)
            ->update(['enabled' => 1]);

        \App\Models\Collection::query()
            ->whereIn('brand_id', $ids)
            ->update(['enabled' => 1]);

        Wheel::query()
            ->whereIn('brand_id', $ids)
            ->update(['enabled' => 1]);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }

}
