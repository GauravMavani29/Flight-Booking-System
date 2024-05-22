<?php

namespace Database\Factories;

use App\Models\BookingSeat;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingSeatFactory extends Factory
{
    protected $model = BookingSeat::class;

    public function definition()
    {
        return [
            'booking_id' => \App\Models\Booking::factory(),
            'seat_schedule_id' => \App\Models\SeatSchedule::factory(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'dob' => $this->faker->date,
            'discount' => $this->faker->randomFloat(2, 0, 50),
            'final_amount' => $this->faker->randomFloat(2, 50, 500),
            // add other necessary fields
        ];
    }
}
