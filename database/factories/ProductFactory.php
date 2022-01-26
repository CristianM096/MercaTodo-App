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
            'name' => $this->faker->company(),
            'price' => $this->faker->randomFloat(1,0,9999999),
            'photo' => '/img/asdasdasdasdasdasdasd.jpg',
            'description' => $this->faker->text(100),
            'stock' => $this->faker->randomNumber(5),
            'color' => $this->faker->colorName(),
            'weight' => $this->faker->randomFloat(2,0,9999),
            'size' => $this->faker->word()
        ];
    }
}
