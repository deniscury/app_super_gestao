<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Produto;
use Faker\Generator as Faker;

$factory->define(Produto::class, function (Faker $faker) {
    return [
        //
        'nome' => $faker->name,
        'descricao' => $faker->text(200),
        'peso' => $faker->randomFloat(2, 0.00, 10.00),
        'unidade_id' => $faker->numberBetween(1, 100),
    ];
});
