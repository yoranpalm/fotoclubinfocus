<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(faker $faker)
    {
        DB::table('users')->insert([
            'email' => $faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'userAvatar' => $faker->userName,
            'userVoornaam' => $faker->firstname,
            'userAchternaam' => $faker->lastname,
            'beheerderAkkoord' => '1',
            'beheerderStatus' => '0',
            'blokkeerStatus' => '0',
            'birthdate' => $faker->dateTimeBetween('1980-01-01', 'now')->format('Y/m/d')
        ]);
    }
}
