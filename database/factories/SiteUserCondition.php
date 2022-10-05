<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Site;
use App\SiteUserCondition;
use Faker\Generator as Faker;

$factory->define(SiteUserCondition::class, function (Faker $faker) {
    return [
        'sdx' => $sdx = Site::all()->random()->sdx,
        'name' => $faker->name,
        'explain' => $faker->sentence,
        'state' => $faker->randomElement([SiteUserCondition::NORMAL, SiteUserCondition::WAITING, SiteUserCondition::STOP, SiteUserCondition::DELETE])
    ];
});
