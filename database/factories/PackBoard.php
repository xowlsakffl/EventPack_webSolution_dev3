<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PackBoard;
use App\SiteTask;
use App\User;
use Faker\Generator as Faker;

$factory->define(PackBoard::class, function (Faker $faker) {
    return [
        'stdx' => SiteTask::all()->random()->stdx,
        'title' => $faker->title,
        'content' => $faker->sentence,
        'files' => 0,
        'udx' => $udx = User::all()->random()->udx,
        'name' => User::find($udx)->name,
        'password' => $faker->password,
        'ip' => $faker->ipv4,
        'show_this' => $faker->boolean,
        'secret' => $faker->boolean,
        'notice' => $faker->boolean,
        'state' => $faker->randomElement([PackBoard::NORMAL, PackBoard::STOP, PackBoard::DELETE])
    ];
});
