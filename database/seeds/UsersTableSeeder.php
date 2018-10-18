<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $batchSize = 250;
        $output = $this->command->getOutput();
        $progressBar = $output->createProgressBar($batchSize);

        factory(\App\Models\User::class, $batchSize)
            ->create()
            ->each(function (\App\Models\User $user) use ($progressBar) {

            /**
             * @var $role \App\Models\Role
             */
            $role = \App\Models\Role::query()
                ->inRandomOrder()
                ->first();

            if (!$user->hasRole(collect($role))) {
                $user->attachRole($role);
            }

            $progressBar->advance();
        });

        $output->newLine();
    }

}
