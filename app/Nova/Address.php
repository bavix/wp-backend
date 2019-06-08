<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Place;
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
     * @var array
     */
    public static $with = ['addressable'];

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
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make('Family Name')
                ->sortable()
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make('Label')
                ->sortable()
                ->rules('max:255')
                ->hideFromIndex(),

            Text::make('Organization')
                ->sortable()
                ->rules('max:255')
                ->hideFromIndex(),

            Country::make('Country Code')
                ->sortable()
                ->hideFromIndex()
                ->hideFromIndex(),

            Text::make('State')
                ->sortable()
                ->hideFromIndex(),

            Text::make('City')
                ->sortable(),

            Place::make('Address', 'street')
                ->city('city')
                ->state('state')
                ->postalCode('postal_code')
                ->country('country_code')
                ->latitude('latitude')
                ->longitude('longitude')
                ->rules('required')
                ->hideFromIndex(),

            Text::make('Postal Code')
                ->sortable()
                ->hideFromIndex(),

            Text::make('Latitude')
                ->hideFromIndex(),

            Text::make('Longitude')
                ->hideFromIndex(),

            Map::make('Point Location')
                ->spatialType('LatLon')
                ->latitude('latitude')
                ->longitude('longitude')
                ->onlyOnDetail(),

            Boolean::make('Is Primary')
                ->rules('required')
                ->hideFromIndex(),

            Boolean::make('Is Billing')
                ->rules('required')
                ->hideFromIndex(),

            Boolean::make('Is Shipping')
                ->rules('required')
                ->hideFromIndex(),

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
