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
        $output = $this->command->getOutput();
        $progressBar = $output->createProgressBar(
            \App\Models\User::query()->count()
        );

        \App\Models\User::query()->each(function (\App\Models\User $user) use ($progressBar) {

            $wheels = \App\Models\Wheel::query()
                ->inRandomOrder()
                ->limit(random_int(1, 10))
                ->get();

            foreach ($wheels as $wheel) {
                $user->like($wheel);
            }

            $brands = \App\Models\Brand::query()
                ->inRandomOrder()
                ->limit(random_int(1, 10))
                ->get();

            foreach ($brands as $brand) {
                $user->like($brand);
            }

            $progressBar->advance();

        });

        $output->newLine();
    }

}
