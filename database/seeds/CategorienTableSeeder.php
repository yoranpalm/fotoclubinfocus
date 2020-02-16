<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as faker;

class CategorienTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(faker $faker)
    {
        DB::table('categorien')->insert([
            'categorieNaam' => $faker->lastName,
            'categorieOmschrijving' => $faker->colorName
        ]);
    }
}
