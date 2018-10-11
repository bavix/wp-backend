<?php

use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::query()->each(function (\App\Models\User $user) {

            $wheels = \App\Models\Wheel::query()
                ->inRandomOrder()
                ->limit(10)
                ->get();

            foreach ($wheels as $wheel) {
                $user->like($wheel);
            }

            $brands = \App\Models\Brand::query()
                ->inRandomOrder()
                ->limit(10)
                ->get();

            foreach ($brands as $brand) {
                $user->like($brand);
            }

        });
    }

}
