<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'emp_id' => $faker->emp_id,
        'epm_name' => $faker->epm_name,
        'ip_address' =>  $faker->unique()->ip_address,
    ];
});
