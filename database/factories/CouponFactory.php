<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OfferLike>
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
            'code' => strtoupper(fake()->word()),
            'description' => ucwords(fake()->word()) . ' ' . ucwords(fake()->word()),
            'application_rules' => fake()->optional()->paragraph(2),
        ];
    }
}
