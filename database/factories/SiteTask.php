<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pack;
use App\Site;
use App\SiteNavigation;
use App\SiteTask;
use Faker\Generator as Faker;

$factory->define(SiteTask::class, function (Faker $faker) {
    return [
        'rstdx' => 0,
        'sdx' => $sdx = Site::all()->random()->sdx,
        'pdx' => $pdx = Pack::all()->random()->pdx,
        'language' => $faker->randomElement(['kor', 'eng']),
        'sndx' => $sndx = SiteNavigation::all()->random()->sndx,
        'parent' => 0,
        'sequence' => "A",
        'name' => $faker->name,
        'use_layout' => $faker->boolean,
        'rewrite' => $faker->url,
        'permissions' => "",
        'state' => $faker->randomElement([SiteTask::NORMAL, SiteTask::WAITING, SiteTask::STOP, SiteTask::DELETE])
    ];
});
