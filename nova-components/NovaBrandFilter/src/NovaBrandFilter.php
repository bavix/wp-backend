<?php

namespace Bavix\NovaBrandFilter;

use App\Nova\Wheel;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class NovaBrandFilter extends Filter
{

    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'nova-brand-filter';

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
        return $query->where('brand_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request): array
    {
        $brands = Wheel::getBrands();
        $brands->loadCount('wheels');

        $results = [];
        foreach ($brands as $brand) {
            $results[$brand->id] = [
                'name' => $brand->name,
                'enabled' => $brand->enabled,
                'wheels_count' => $brand->wheels_count,
            ];
        }

        return $results;
    }

}
