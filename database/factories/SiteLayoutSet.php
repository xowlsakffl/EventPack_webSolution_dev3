<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Layout;
use App\LayoutBottom;
use App\LayoutEtc;
use App\LayoutMiddle;
use App\LayoutNavigation;
use App\LayoutTop;
use App\Site;
use App\SiteLayoutSet;
use App\SiteUser;
use Faker\Generator as Faker;

$factory->define(SiteLayoutSet::class, function (Faker $faker) {
    return [
        'sdx' => $sdx = Site::all()->random()->sdx,
        'lodx' => $lodx = Layout::all()->random()->lodx,
        'lotdx' => LayoutTop::all()->random()->lotdx,
        'top_html' => "
                    <html>
                        <head></head>
                        <body></body>
                    </html>
                    ",
        'top_css' => "body{background:black}",
        'londx' => LayoutNavigation::all()->random()->londx,
        'navigation_html' => "
                    <html>
                        <head></head>
                        <body></body>
                    </html>
                    ",
        'navigation_css' => "body{background:black}",
        'use_site_menu' => $faker->boolean,
        'lomdx' => LayoutMiddle::all()->random()->lomdx,
        'middle_html' => "
                    <html>
                        <head></head>
                        <body></body>
                    </html>
                    ",
        'middle_css' => "body{background:black}",
        'lobdx' => LayoutBottom::all()->random()->lobdx,
        'bottom_html' => "
                    <html>
                        <head></head>
                        <body></body>
                    </html>
                    ",
        'bottom_css' => "body{background:black}",
        'loedx' => LayoutEtc::all()->random()->loedx,
        'display_type' => $faker->randomElement(['direct', 'fadeIn', 'slideDown']),
        'display_duration' => $faker->numberBetween(0, 1000),
        'font_default' => "\"Nanum Gothic\", arial, sans-serif",
        'font_resource' => "@import url(\"https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;800&display=swap\")",
        'state' => $faker->randomElement([SiteLayoutSet::NORMAL, SiteLayoutSet::WAITING, SiteLayoutSet::STOP, SiteLayoutSet::DELETE])
    ];
});
