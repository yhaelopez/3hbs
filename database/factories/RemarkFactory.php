<?php

namespace Database\Factories;

use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

class RemarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $remarkable = Airport::factory()->create();
        return [
            'remarkable_id' => $remarkable->id,
            'remarkable_type' => $remarkable::class,
            'comment' => $this->faker->text(),
        ];
    }
}
