<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminTableSeeder::class);

        if (app()->environment('local')) {
            $this->call(UsersTableSeeder::class);
            $this->call(WheelsTableSeeder::class);
            $this->call(LikesTableSeeder::class);
            $this->call(FollowersTableSeeder::class);
        }
    }
}
