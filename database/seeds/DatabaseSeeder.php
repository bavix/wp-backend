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
         $this->call(UsersTableSeeder::class);
         $this->call(WheelsTableSeeder::class);
         $this->call(LikesTableSeeder::class);
         $this->call(FollowersTableSeeder::class);
         $this->call(RolesTableSeeder::class);
    }
}
