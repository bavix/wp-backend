<?php

namespace App\Nova;

use App\Nova\Filters\UserActive;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Password;
use R64\NovaImageCropper\ImageCropper;
use Ramsey\Uuid\Uuid;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

    /**
     * @var array
     */
    public static $with = ['image'];

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'login';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'login', 'email',
    ];

    /**
     * @var string
     */
    public static $group = 'User management';

    /**
     * @return string|null
     */
    public function subtitle(): ?string
    {
        return $this->name;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Avatar::make('Image', 'Picture', 'cdn')
                ->exceptOnForms(),

            ImageCropper::make('Photo', 'Picture', 'cdn')->onlyOnForms()->aspectRatio(1)->storeAs(function (Request $request) {
                return 'users.' . Uuid::uuid4()->toString();
            }),

            BelongsToMany::make('Roles'),
            MorphMany::make('Settings'),

            MorphToMany::make(
                'Following Brands',
                'followingBrands',
                Brand::class,
            ),

            MorphToMany::make(
                'Liking Brands',
                'likingBrands',
                Brand::class,
            ),

            MorphToMany::make(
                'Following Wheels',
                'followingWheels',
                Wheel::class,
            ),

            MorphToMany::make(
                'Liking Wheels',
                'likingWheels',
                Wheel::class,
            ),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Login')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:users,login')
                ->updateRules('unique:users,login,{{resourceId}}'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:255')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:6')
                ->updateRules('nullable', 'string', 'min:6'),

            Boolean::make('Enabled')
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
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new UserActive(),
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
