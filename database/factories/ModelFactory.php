<?php

use App\User;
use App\Channel;
use App\Models\Product\AddOn;
use App\Models\Product\Group;
use App\Models\Product\Product;
use App\Models\Marketing\Video;
use App\Models\Product\AddOnOption;

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
        'list_price' => $faker->numberBetween(500, 50000),
        'description' => $faker->sentence,
        'group_id' => 1
    ];
});


$factory->state(Product::class, 'published', function () {
    return [
        'published' => true
    ];
});

$factory->state(Product::class, 'unpublished', function () {
    return [
        'published' => false
    ];
});


$factory->define(Group::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->title,
    ];
});


$factory->state(Group::class, 'published', function () {
    return [
        'published' => true
    ];
});

$factory->state(Group::class, 'unpublished', function () {
    return [
        'published' => false
    ];
});

$factory->state(Group::class, 'addOnable', function () {
    return [
        'addonable' => true
    ];
});

$factory->state(Group::class, 'unAddOnable', function () {
    return [
        'addonable' => false
    ];
});


$factory->define(AddOn::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->title,
    ];
});

$factory->define(AddOnOption::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->title,
    ];
});

$factory->define(Channel::class, function (Faker\Generator $faker) {
    return [
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

