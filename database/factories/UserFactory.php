<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $faker->addProvider(new Ottaviano\Faker\Gravatar($faker));
    return [
        'first_name' => $faker->firstName,
        'middle_name' => $faker->name,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'avatar' => $faker->gravatarUrl(),
        'phone' => $faker->phoneNumber,
        'username' => $faker->unique()->userName,
        'password' =>  Hash::make('vimmak'), //'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
        'confirmed' => false,
        'enabled' => false,
        'locked' => false,
        'remember_token' => Str::random(10),
    ];
});
