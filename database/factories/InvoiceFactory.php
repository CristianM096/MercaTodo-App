<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Constant\PaymentStatus;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total' => $this->faker->randomNumber(5),
            //'payment_status' => $this->faker->randomElement((new PaymentStatus)->toArray()),
        ];
    }
}
