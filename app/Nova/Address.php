<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Text;
use Davidpiesse\Map\Map;

class Address extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Rinvex\Addresses\Models\Address::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'label';

    /**
     * @var string
     */
    public static $group = 'Catalogue';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            MorphTo::make('Addressable')
                ->types([Brand::class])
                ->rules('required'),

            Text::make('Given Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Family Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Label')
                ->sortable()
                ->rules('max:255'),

            Text::make('Organization')
                ->rules('max:255'),

            Country::make('Country Code'),

            Text::make('Street')
                ->rules('max:255'),

            Text::make('State')
                ->rules('max:255'),

            Text::make('City')
                ->rules('max:255'),

            Map::make('Point Location')
                ->spatialType('LatLon')
                ->latitude('latitude')
                ->longitude('longitude'),

            Text::make('Postal Code'),

            Boolean::make('Is Primary')
                ->rules('required'),

            Boolean::make('Is Billing')
                ->rules('required'),

            Boolean::make('Is Shipping')
                ->rules('required'),

            DateTime::make('Created At')
                ->hideFromIndex()
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->readonly(true),

            DateTime::make('Updated At')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->readonly(true),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request): array
    {
        return [];
    }

}
