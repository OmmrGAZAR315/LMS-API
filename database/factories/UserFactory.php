<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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

$factory->define(App\User::class, function (Faker $faker) {
    $role = $faker->randomElement([
//               'Admin',
        'Student',
        'Teacher',
//            'SuperVisor'
    ]);
    if ($role == 'Student')
        return [
            'first_name' => 'Student' . $faker->randomNumber(2),
            'last_name' => $faker->lastName,
            'email' => $faker->unique()->safeEmail,
            'password' => Hash::make("123"), // secret
            'role' => 'Student',
        ];
    else  return [
        'first_name' => 'Teacher' . $faker->randomNumber(2),
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make("123"), // secret
        'role' => 'Teacher',
    ];
});
