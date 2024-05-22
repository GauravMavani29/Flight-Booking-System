<?php

namespace Database\Factories;

use App\Models\Seat;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeatFactory extends Factory
{
    protected $model = Seat::class;

    public function definition()
    {
        return [
            'airplane_id' => \App\Models\Airplane::factory(),
            'class' => $this->faker->randomElement(['First Class', 'Business Class', 'Economy Class']),
            'number' => $this->faker->numberBetween(1, 30),
            'alphabet' => $this->faker->randomElement(['A', 'B', 'C', 'D', 'E', 'F']),
            'is_near_exit' => $this->faker->boolean,
            // add other necessary fields
        ];
    }
}
