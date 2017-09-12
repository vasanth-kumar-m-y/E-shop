<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->userName,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'password' => 123456,
        'created_at' => ($created_at =  $faker->dateTimeBetween('-2 years','-6 months')),
        'updated_at' => $created_at,
        
    ];
});

$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    return [
    	//seller_id		
		'title' => str_replace('.', '', $faker->sentence(4)),
		'subtitle' => str_replace('.', '', $faker->sentence(6)),
		'description' => file_get_contents("http://loripsum.net/generate.php?p=5&l=long&d=1&a=1&co=1&ul=1&ol=1&dl=1&bq=1&h=1&ac=0&pr=1"),
		'price' => $faker->randomFloat(2, 1, 400),
		'stock_initial' => ($stock = $faker->numberBetween(1, 15)),
		'stock_available' => $stock,
		'starts' => ($starts = $faker->dateTimeBetween('-3 months','now')),
		'ends' => $faker->dateTimeBetween( $starts ,'+3 month'),
		'is_active' => 1,
        'created_at' => ($created_at = $faker->dateTimeBetween('-3 months', $starts)),
        'updated_at' => $created_at,
    ];
});

