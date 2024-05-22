<?php

namespace Database\Factories;

use App\Models\Airplane;
use Illuminate\Database\Eloquent\Factories\Factory;

class AirportFactory extends Factory
{
    protected $model = Airplane::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'country' => $this->faker->word,
            // Add other necessary fields
        ];
    }
}
