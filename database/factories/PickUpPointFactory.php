<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PickUpPoint>
 */
class PickUpPointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'      => fake()->name(),
            'address'   => fake()->address(),
            'phone_one' => fake()->e164PhoneNumber(),
            'phone_two' => fake()->e164PhoneNumber(),
        ];
    }
}
