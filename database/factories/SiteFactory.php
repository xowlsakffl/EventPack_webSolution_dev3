<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Site;
use App\User;
use App\Work;
use Faker\Generator as Faker;

$factory->define(Site::class, function (Faker $faker) {
    return [
        'wdx' => $wdx = Work::all()->random()->wdx,
        'name' => $faker->name,
        'domain' => "http://".$faker->sentence.".com",   
        'title' => $faker->title,
        'description' => $faker->sentence,
        'keyword' => $faker->word,
        'state' => $faker->randomElement([Site::NORMAL, Site::WAITING, Site::STOP, Site::DELETE])
    ];
});
