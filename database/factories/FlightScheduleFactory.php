<?php

namespace Database\Factories;

use App\Models\FlightSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightScheduleFactory extends Factory
{
    protected $model = FlightSchedule::class;

    public function definition()
    {
        return [
            'slug' => $this->faker->slug,
            'airplane_id' => \App\Models\Airplane::factory(),
            'departure_id' => \App\Models\Airport::factory(),
            'arrival_id' => \App\Models\Airport::factory(),
            'departure_date' => $this->faker->dateTime,
            'arrival_date' => $this->faker->dateTime,
            // add other necessary fields
        ];
    }
}
