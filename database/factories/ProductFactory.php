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
            'name' => $this->faker->sentence(3),
            'price' => $this->faker->randomNumber(5),
            'photo' => $this->faker->image('public/storage/productImages', 400, 300),
            'discount' => 0,
            'description' => $this->faker->text(100),
            'stock' => $this->faker->randomNumber(5, 20),
            'color' => $this->faker->colorName(),
            'weight' => $this->faker->randomFloat(2, 0, 9999),
            'size' => $this->faker->word()
        ];
    }
}
