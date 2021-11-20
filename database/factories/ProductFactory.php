<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->text(20),
            'category'      => $this->faker->text(10),
            'description'   => $this->faker->text(30),
            'datetime'      => now(),
        ];
    }
}
