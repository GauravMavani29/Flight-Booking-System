<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'flight_schedule_id' => \App\Models\FlightSchedule::factory(),
            'booking_number' => $this->faker->unique()->numberBetween(100000, 999999),
            'amount' => $this->faker->randomFloat(2, 100, 1000),
            'total_discount' => $this->faker->randomFloat(2, 10, 100),
            'booking_time' => $this->faker->dateTime,
            'is_random' => $this->faker->boolean,
            // add other necessary fields
        ];
    }
}
