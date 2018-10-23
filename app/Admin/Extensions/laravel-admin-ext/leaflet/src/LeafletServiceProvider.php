<?php

namespace Encore\Leaflet;

use Encore\Admin\Form;
use Illuminate\Support\ServiceProvider;

class LeafletServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Leaflet $extension)
    {
        if (! Leaflet::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'laravel-admin-leaflet');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/leaflet')],
                'leaflet'
            );
        }

        $this->app->booted(function () {
            Form::extend('leaflet', LeafletMap::class);
        });
    }
}
