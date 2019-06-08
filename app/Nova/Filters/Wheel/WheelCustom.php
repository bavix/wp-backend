<?php

namespace App\Nova\Filters\Wheel;

use Illuminate\Http\Request;
use rcknr\Nova\Filters\MultiselectFilter;

class WheelCustom extends MultiselectFilter
{

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->whereIn('customized', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request): array
    {
        return [
            'Customized' => 1,
            'OEM' => 0,
        ];
    }

}
