<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipes>
 */
class RecipesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'ingredients' => $this->faker->text,
            'instructions' => $this->faker->text,
            'prep_time' => $this->faker->numberBetween(0,120),
            'cook_time' => $this->faker->numberBetween(0,240),
            'total_time' => function (array $attributes) {
                return $attributes['prep_time'] + $attributes['cook_time'];
            },
            'servings' => $this->faker->numberBetween(1,10),
            'calories' => $this->faker->numberBetween(100,1000),
        ];
    }
}
