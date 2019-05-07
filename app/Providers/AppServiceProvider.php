<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Style;
use App\Models\User;
use App\Observers\BrandObserver;
use App\Observers\StyleObserver;
use App\Observers\UserObserver;
use Encore\Admin\Config\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Brand::observe(BrandObserver::class);
        User::observe(UserObserver::class);
        Style::observe(StyleObserver::class);

        try {
            Config::load();
        } catch (\Throwable $throwable) {

        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
