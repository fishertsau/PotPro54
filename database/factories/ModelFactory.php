<?php

use App\Models\Example\Example;
use App\Models\Marketing\Video;
use App\Models\Product\AddOn;
use App\Models\Product\AddOnOption;
use App\Models\Product\GroupCategory;
use App\Models\Product\GroupSubCategory;
use App\Models\Product\Product;
use App\User;
use App\Models\Marketing\Talk;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt('tttaaa'),
        'remember_token' => str_random(10),
//        'avatar' => '',
//        'login_count' => 1,
//        'login_ip' => '0.0.0.0',
//        'login_at' => ''
    ];
});


$factory->define(Video::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->title,
        'body' => $faker->sentence,
        'youtube_url' => $faker->domainName,
        'active' => true,
    ];
});

$factory->state(Video::class, 'inactive', function () {
    return [
        'active' => false
    ];
});

$factory->state(Video::class, 'active', function () {
    return [
        'active' => true
    ];
});

$factory->define(Product::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->title,
    ];
});




//$factory->define(Talk::class, function (Faker\Generator $faker) {
//    return [
//        'title' => $faker->sentence,
//        'body' => $faker->paragraph,
//        'active' => true,
//        'coverPhoto_path'
//    ];
//});
//
//$factory->define(Example::class, function (Faker\Generator $faker) {
//    return [
//        'title' => $faker->sentence,
//        'body' => $faker->paragraph,
//        'activated' => true,
//        'use_result' => '',
//        'use_gear' => ''
//    ];
//});
//
//$factory->define(GroupCategory::class, function (Faker\Generator $faker) {
//    return [
//        'body' => $faker->paragraph,
//        'tag_no' => '',
//        'rank' => 0
//    ];
//});
//
//$factory->define(GroupSubCategory::class, function (Faker\Generator $faker) {
//    return [
//        'body' => $faker->name,
//    ];
//});
//
//$factory->define(AddOn::class, function (Faker\Generator $faker) {
//    return [
//        'body' => '',
//        'coverPhoto_path' => ''
//    ];
//});
//
//$factory->define(AddOnOption::class, function (Faker\Generator $faker) {
//    return [
//        'body' => ''
//    ];
//});

