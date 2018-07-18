<?php

use Faker\Generator as Faker;

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

$factory->define(App\Common\Models\User::class, function (Faker $faker) {
    $firstName = $faker->firstName;

    return [
        'uid' => strtolower($firstName) . rand(0,100),
        'last_name' => $faker->lastName,
        'first_name' => $firstName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'active' => rand(0,1)
    ];
});
