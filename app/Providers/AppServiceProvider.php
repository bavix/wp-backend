<?php

namespace App\Providers;

use App\Models\Wheel\Wheel;
use Illuminate\Support\ServiceProvider;
use Rinvex\Attributes\Models\Attribute;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Attribute::typeMap([
//            'weight' => \Rinvex\Attributes\Models\Type\Integer::class
//        ]);

        app('rinvex.attributes.entities')
            ->push(Wheel::class);
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
