<?php
use Faker\Generator as Faker;
use Modules\Phone\Models\Phone;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Phone::class, function (Faker $faker) {
    return [
        'title'           => $faker->unique(),
        'description'           => $faker->realText(),
        'phone_number'           => $faker->unique(),
        'status'           => null,
        'find_counts'           => null,
        'added_by'           => $faker->randomDigitNotNull,
        'updated_by'           => $faker->randomDigitNotNull,
    ];
});
