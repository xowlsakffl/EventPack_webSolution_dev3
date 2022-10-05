<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pack;
use Faker\Generator as Faker;

$factory->define(Pack::class, function (Faker $faker) {
    return [
        'kor_name' => $faker->name,
        'kor_explain' => $faker->sentence,
        'eng_name' => $faker->name,
        'eng_explain' => $faker->sentence,
        'path' => $faker->randomElement(["kor/page_v1", "eng/page_v1"]),
        'state' => $faker->randomElement([Pack::NORMAL, Pack::STOP, Pack::DELETE])
    ];
});
