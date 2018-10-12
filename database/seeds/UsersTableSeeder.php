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
        factory(\App\Models\User::class, 100)->create();

        $output = $this->command->getOutput();
        $progressBar = $output->createProgressBar(
            \App\Models\User::query()->count()
        );

        \App\Models\User::query()->each(function (\App\Models\User $user) use ($progressBar) {

            /**
             * @var $role \Yajra\Acl\Models\Role
             */
            $role = \Yajra\Acl\Models\Role::query()
                ->inRandomOrder()
                ->first();

            $user->attachRole($role);
            $progressBar->advance();
        });

        $output->newLine();
    }

}
