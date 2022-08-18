<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->sentence();

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'url' => fake()->url(),
            'price' => fake()->randomFloat(2, 100, 1000),
            'price_old' => fake()->randomFloat(2, 1001, 2000),
            'tags' => fake()->word() . ',' . fake()->word() . ',' . fake()->word(),
            'description' => fake()->paragraph(10),
            'coupon' => strtoupper(fake()->word())
        ];
    }
}
