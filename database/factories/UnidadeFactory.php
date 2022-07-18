<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Unidade;
use Faker\Generator as Faker;

$factory->define(Unidade::class, function (Faker $faker) {
    
    return [
        //
        'unidade' => $faker->text(5),
        'descricao' => $faker->text(30),
    ];
});
