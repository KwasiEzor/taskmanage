<?php

namespace Database\Factories;

use App\Enums\ProjectStatus;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(3, true),
            'status' => fake()->randomElement(ProjectStatus::cases())->value,
            'description' => fake()->sentences(3, true),
            'is_active' => fake()->boolean(),
            'category_id' => Category::factory(),
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
        ];
    }
}
