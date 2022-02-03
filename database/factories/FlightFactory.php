<?php

namespace Database\Factories;

use App\Models\Airline;
use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'airline_id' => Airline::factory()->create(),
            'code' => $this->faker->word(),
            'type' => (rand(1, 2) % 2 == 0) ? 'PASSENGER' : 'FREIGHT',
            'departure_id' => Airport::factory()->create(),
            'destination_id' => Airport::factory()->create(),
            'departure_time' => $this->faker->dateTimeBetween('-2 days', '-1 days'),
            'arrival_time' => $this->faker->dateTimeBetween('-1 days', '+1 days'),
        ];
    }
}
