<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'job_id' => JobPost::factory(),
            'candidate_id' => User::factory()->create(['role' => 'candidate'])->id,
            'resume_path' => 'resumes/' . $this->faker->uuid . '.pdf',
            'message' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
        ];
    }
    
}
