<?php

namespace App\Providers;

use App\Adapters\CupAdapter;
use App\Helpers\Cup;
use App\Models\Brand;
use App\Models\Style;
use App\Models\User;
use App\Observers\BrandObserver;
use App\Observers\StyleObserver;
use App\Observers\UserObserver;
use Bavix\CupKit\Client;
use Encore\Admin\Config\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;

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
    public function register(): void
    {
        $this->app->singleton(Client::class, function () {
            return new Client(Cup::identity());
        });

        Storage::extend('corundum', function ($app, $config) {
            return new Filesystem(new CupAdapter($app, $config));
        });
    }
}
