<?php

namespace App\Nova;

use App\Nova\Filters\BrandFilter;
use App\Nova\Filters\WheelSwitch;
use Illuminate\Support\Facades\Cache;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Text;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;
use Ramsey\Uuid\Uuid;

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
        'image',
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
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getBrands(): \Illuminate\Database\Eloquent\Collection
    {
        static $data;
        if (!$data) {
            $data = \App\Models\Brand::all();
        }
        return $data;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getStyles(): \Illuminate\Database\Eloquent\Collection
    {
        static $data;
        if (!$data) {
            $data = \App\Models\Style::all();
        }
        return $data;
    }

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

            Avatar::make('Image', 'Picture', 'cdn')->storeAs(function (Request $request) {
                return 'wheels.' . Uuid::uuid4()->toString();
            }),

            MorphToMany::make(
                'Favorites',
                'favorites',
                User::class,
            ),

            MorphToMany::make(
                'Likes',
                'likes',
                User::class,
            ),

            MorphMany::make('Videos'),

            BelongsTo::make('Brand')
                ->onlyOnIndex(),

            NovaBelongsToDepend::make('Brand', 'brand')
                ->hideFromIndex()
                ->optionsResolve([static::class, 'getBrands'])
                ->rules('required'),

            BelongsTo::make('Collection')
                ->onlyOnIndex(),

            NovaBelongsToDepend::make('Collection', 'collection')
                ->hideFromIndex()
                ->optionsResolve(function (\App\Models\Brand $brand) {
                    // Reduce the amount of unnecessary data sent
                    return $brand->collections()->get(['id', 'name']);
                })
                ->dependsOn('Brand')
                ->nullable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            BelongsTo::make('Style')
                ->onlyOnIndex(),

            NovaBelongsToDepend::make('Style', 'style')
                ->hideFromIndex()
                ->optionsResolve([static::class, 'getStyles'])
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

            MorphMany::make('Comments'),
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
            new BrandFilter(),
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
