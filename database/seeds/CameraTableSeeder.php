<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as faker;

class CameraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(faker $faker)
    {
        DB::table('cameras')->insert([
            'cameraMerk' => $faker->colorName,
            'cameraType' => $faker->streetName
        ]);
    }
}
