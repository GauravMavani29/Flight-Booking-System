<?php

namespace Database\Factories;

use App\Models\SeatSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeatScheduleFactory extends Factory
{
    protected $model = SeatSchedule::class;

    public function definition()
    {
        return [
            'flight_schedule_id' => \App\Models\FlightSchedule::factory(),
            'seat_id' => \App\Models\Seat::factory(),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'is_locked' => $this->faker->boolean,
            'is_booked' => $this->faker->boolean,
            // add other necessary fields
        ];
    }
}
