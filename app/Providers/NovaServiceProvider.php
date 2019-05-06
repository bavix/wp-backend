<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use App\Nova\Metrics\BrandsPerDay;
use App\Nova\Metrics\BrandsPerEnabled;
use App\Nova\Metrics\CollectionsPerDay;
use App\Nova\Metrics\CollectionsPerEnabled;
use App\Nova\Metrics\NewBrands;
use App\Nova\Metrics\NewCollections;
use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\NewWheels;
use App\Nova\Metrics\UsersPerDay;
use App\Nova\Metrics\UsersPerEnabled;
use App\Nova\Metrics\WheelsPerDay;
use App\Nova\Metrics\WheelsPerEnabled;
use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes(): void
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate(): void
    {
        Gate::define('viewNova', function (User $user) {
            return $user->hasRole(Role::DEVELOPER);
        });
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards(): array
    {
        return [
            new UsersPerEnabled(),
            new UsersPerDay(),
            new NewUsers(),

            new BrandsPerEnabled(),
            new BrandsPerDay(),
            new NewBrands(),

            new CollectionsPerEnabled(),
            new CollectionsPerDay(),
            new NewCollections(),

            new WheelsPerEnabled(),
            new WheelsPerDay(),
            new NewWheels(),
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools(): array
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
}
