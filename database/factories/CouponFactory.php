<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'coupon_code'   => fake()->userName(),
            'valid_date'    => fake()->date($format = 'm-d-Y', $max = 'now'),
            'type'          => 'Fixed',
            'coupon_amount' => fake()->numberBetween($min = 1500, $max = 6000),
            'status'        => 'Active',
        ];
    }
}
