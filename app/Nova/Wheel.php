<?php

namespace App\Nova;

use App\Nova\Filters\WheelSwitch;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;

class Wheel extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Wheel::class;

    /**
     * @var array
     */
    public static $with = [
        'brand',
        'collection',
        'style'
    ];

    /**
     * @var string
     */
    public static $group = 'Catalogue';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name',
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

            NovaBelongsToDepend::make('Brand')
                ->options(\App\Models\Brand::all())
                ->rules('required'),

            NovaBelongsToDepend::make('Collection')
                ->optionsResolve(function (\App\Models\Brand $brand) {
                    // Reduce the amount of unnecessary data sent
                    return $brand->collections()->get(['id', 'name']);
                })
                ->dependsOn('Brand')
                ->nullable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            NovaBelongsToDepend::make('Style')
                ->options(\App\Models\Style::all())
                ->nullable(),

            Boolean::make('Enabled')
                ->rules('required'),

            Boolean::make('Customized')
                ->hideFromIndex()
                ->rules('required'),

            Boolean::make('Retired')
                ->hideFromIndex()
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
        return [
            new WheelSwitch(),
        ];
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
