<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\LayoutEtc;
use Faker\Generator as Faker;

$factory->define(LayoutEtc::class, function (Faker $faker) {
    return [
        'category' => 0,
        'name_ko' => $faker->name,
        'name_en' => $faker->name,
        'code' => $faker->randomNumber,
        'display_type' => $faker->randomElement(['direct', 'fadeIn', 'slideDown']),
        'display_duration' => $faker->numberBetween(0, 1000),
        'font_default' => "\"Nanum Gothic\", arial, sans-serif",
        'font_resource' => "@import url(\"https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;800&display=swap\")",
        'state' => $faker->randomElement([LayoutEtc::NORMAL, LayoutEtc::UNPRINT, LayoutEtc::STOP, LayoutEtc::DELETE])
    ];
});
