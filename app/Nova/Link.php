<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Text;

class Link extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Link::class;

    /**
     * @var array
     */
    public static $with = ['linkable'];

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'url';

    /**
     * @var string
     */
    public static $group = 'Social Network';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'url',
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

            MorphTo::make('Linkable')
                ->types([Brand::class])
                ->rules('required'),

            Text::make('Url')
                ->rules('required'),

            Boolean::make('Enabled'),

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
