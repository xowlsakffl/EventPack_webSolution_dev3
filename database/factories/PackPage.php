<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PackPage;
use App\SiteTask;
use App\User;
use Faker\Generator as Faker;

$factory->define(PackPage::class, function (Faker $faker) {
    return [
        'stdx' => SiteTask::all()->random()->stdx,
        'title' => $faker->title,
        'content' => $faker->sentence,
        'files' => PackPage::DEFAULT,
        'udx' => $udx = User::all()->random()->udx,
        'name' => User::find($udx)->name,
        'ip' => $faker->ipv4,
        'show_this' => $faker->boolean,
        'state' => $faker->randomElement([PackPage::NORMAL, PackPage::STOP, PackPage::DELETE])
    ];
});
