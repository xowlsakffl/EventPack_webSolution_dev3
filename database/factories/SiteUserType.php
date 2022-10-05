<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Site;
use App\SiteUserType;
use Faker\Generator as Faker;

$factory->define(SiteUserType::class, function (Faker $faker) {
    return [
        'sdx' => $sdx = Site::all()->random()->sdx,
        'name' => $faker->title,   
        'explain' => $faker->sentence,
        'state' => $faker->randomElement([Site::NORMAL, Site::WAITING, Site::STOP, Site::DELETE])
    ];
});
