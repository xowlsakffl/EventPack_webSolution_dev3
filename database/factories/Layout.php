<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Layout;
use App\LayoutBottom;
use App\LayoutEtc;
use App\LayoutMiddle;
use App\LayoutNavigation;
use App\LayoutTop;
use Faker\Generator as Faker;

$factory->define(Layout::class, function (Faker $faker) {
    return [
        'category' => 0,
        'name_ko' => $faker->name,
        'name_en' => $faker->name,
        'descript_ko' => $faker->sentence,
        'descript_en' => $faker->sentence,
        'lotdx' => LayoutTop::all()->random()->lotdx,
        'londx' => LayoutNavigation::all()->random()->londx,
        'lomdx' => LayoutMiddle::all()->random()->lomdx,
        'lobdx' => LayoutBottom::all()->random()->lobdx,
        'loedx' => LayoutEtc::all()->random()->loedx,
        'default' => $faker->boolean,
        'state' => $faker->randomElement([Layout::NORMAL, Layout::UNPRINT, Layout::STOP, Layout::DELETE])
    ];
});
