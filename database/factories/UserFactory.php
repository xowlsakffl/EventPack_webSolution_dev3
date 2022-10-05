<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'uid' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'name' => $faker->unique()->name,
        'email' => $faker->unique()->safeEmail,
        'email_auth' => $faker->randomElement([User::VERIFIED, User::UNVERIFIED]),
        'cell' => $faker->phoneNumber,
        'cell_auth' => $faker->randomElement([User::VERIFIED, User::UNVERIFIED]),
        'tel' => $faker->phoneNumber,
        'country' => $faker->countryCode,
        'join_from' => $faker->randomElement(['home', 'kakao', 'naver', 'facebook', 'google']),
        'super' => User::REGULAR,
        'state' => $faker->randomElement([User::NORMAL, User::WAITING, User::STOP, User::SECESSION, User::DELETE]),
    ];
});
