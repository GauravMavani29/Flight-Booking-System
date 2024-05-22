<?php

namespace Database\Factories;

use App\Models\Airplane;
use Illuminate\Database\Eloquent\Factories\Factory;

class AirplaneFactory extends Factory
{
    protected $model = Airplane::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'flight_number' => $this->faker->regexify('[A-Z0-9]{1,10}'),
            'country' => $this->faker->word,
            // Add other necessary fields
        ];
    }
}
