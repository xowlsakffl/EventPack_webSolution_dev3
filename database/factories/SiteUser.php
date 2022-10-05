<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Site;
use App\SiteUser;
use App\User;
use Faker\Generator as Faker;

$factory->define(SiteUser::class, function (Faker $faker) {
    return [
        'sdx' => 32,//$sdx = Site::all()->random()->sdx,
        'udx' => $udx = User::all()->random()->udx,
        'name' => User::find($udx)->name,
        'email' => $faker->unique()->safeEmail,
        'email_auth' => $faker->randomElement([SiteUser::VERIFIED, SiteUser::UNVERIFIED]),
        'cell' => $faker->phoneNumber,
        'cell_auth' => $faker->randomElement([SiteUser::VERIFIED, SiteUser::UNVERIFIED]),
        'admin_level' => $faker->randomElement([SiteUser::OWNER, SiteUser::ADMIN, SiteUser::NA]),
        'state' => $faker->randomElement([SiteUser::NORMAL, SiteUser::WAITING, SiteUser::STOP, SiteUser::DELETE])
    ];
});
