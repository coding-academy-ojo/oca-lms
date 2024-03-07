<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Absence;
use Faker\Generator as Faker;

// Static counter for student IDs
$studentIdCounter = 0;

$factory->define(Absence::class, function (Faker $faker) use (&$studentIdCounter) {
    $studentIdCounter++;

    return [
        'absences_type' => $faker->randomElement(['late', 'absent', 'leaving']),
        'absences_date' => $faker->date(),
        'absences_reason' => $faker->text,
        'absences_duration' => $faker->numberBetween(1, 8), // Assuming duration in hours
        'student_id' => $studentIdCounter, // Assign the incremented ID as student_id
    ];
});
