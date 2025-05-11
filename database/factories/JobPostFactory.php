<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPost>
 */
class JobPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(5),
            'location' => $this->faker->city(),
            'type' => $this->faker->randomElement(['full-time', 'part-time', 'remote']),
            'salary_min' => 3000,
            'salary_max' => 10000,
            'deadline' => now()->addDays(rand(10, 30)),
            'category' => $this->faker->randomElement(['IT', 'Marketing', 'Sales']),
            'employer_id' => User::factory()->create(['role' => 'employer'])->id,
            'is_approved' => true,
            'company_logo' => 'https://via.placeholder.com/150'
        ];
    }
    
}
