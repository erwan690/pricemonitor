<?php
$factory->define(App\Url::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'url' => $faker->url
    ];
});
