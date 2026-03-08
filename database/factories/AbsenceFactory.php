<?php

namespace Database\Factories;

use App\Models\Absence;
use Illuminate\Database\Eloquent\Factories\Factory;

class AbsenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Absence>
     */
    protected $model = Absence::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'absences_type' => $this->faker->randomElement(['late', 'absent', 'leaving']),
            'absences_date' => $this->faker->date(),
            'absences_reason' => $this->faker->text(),
            'absences_duration' => $this->faker->numberBetween(1, 8),
            'student_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}

