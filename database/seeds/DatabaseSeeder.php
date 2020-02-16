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
        for ($item=0; $item < 2; $item++){
            $this->call([
                    UsersTableSeeder::class,
                    CameraTableSeeder::class,
                    CategorienTableSeeder::class,
            ]);
        }
    }
}
