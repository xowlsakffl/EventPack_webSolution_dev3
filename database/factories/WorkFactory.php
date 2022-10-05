<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Work;
use Faker\Generator as Faker;

$factory->define(Work::class, function (Faker $faker) {
    return [
        'udx' => User::all()->random()->udx,
        'name' => $faker->name,
        'participant' => $faker->randomNumber,
        'duration' => $faker->year.".".$faker->month.".".$faker->dayOfMonth."~".$faker->year.".".$faker->month.".".$faker->dayOfMonth,
        'state' => $faker->randomElement([Work::NORMAL, Work::WAITING, Work::STOP, Work::EXPIRATION, Work::DELETE])
    ];
});
