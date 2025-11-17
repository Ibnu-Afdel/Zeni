<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(3),
            'price' => null,
            'original_price' => null,
            'level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced']),
            'duration' => $this->faker->numberBetween(60, 600),
            'status' => $this->faker->randomElement(['draft', 'published']),
            'is_pro' => $this->faker->boolean(30), // 30% chance of being premium
            'discount' => false,
            'discount_type' => null,
            'discount_value' => null,
            'rating' => $this->faker->optional(0.7)->randomFloat(1, 3.5, 5.0), // 70% have ratings
            'requirements' => $this->faker->optional()->sentence(),
            'syllabus' => $this->faker->optional()->paragraph(),
            'start_date' => now(),
            'end_date' => now()->addMonths(6),
            'enrollment_limit' => $this->faker->optional()->numberBetween(10, 100),
            'instructor_id' => User::factory()->create([
                'role' => 'instructor',
                'status' => 'approved'
            ])->id,
        ];
    }

    /**
     * Indicate that the course is published.
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'published',
        ]);
    }

    /**
     * Indicate that the course is premium.
     */
    public function premium(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_pro' => true,
        ]);
    }

    /**
     * Indicate that the course is free (not premium).
     */
    public function free(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_pro' => false,
        ]);
    }
}
