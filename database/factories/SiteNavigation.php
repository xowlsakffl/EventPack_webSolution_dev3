<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Site;
use App\SiteNavigation;
use Faker\Generator as Faker;

$factory->define(SiteNavigation::class, function (Faker $faker) {
    return [
        'sdx' => $sdx = Site::all()->random()->sdx,
        'parent' => 0,
        'sequence' => "A",
        'name' => $faker->name,
        'destination_stdx' => 0,
        'destination_url' => $faker->sentence,
        'new_window' => $faker->boolean,
        'state' => $faker->randomElement([SiteNavigation::NORMAL, SiteNavigation::STOP, SiteNavigation::DELETE])
    ];
});
