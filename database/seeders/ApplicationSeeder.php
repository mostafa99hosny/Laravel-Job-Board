<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Application;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get approved jobs
        $jobs = DB::table('job_posts')->where('is_approved', true)->get();

        if ($jobs->isEmpty()) {
            $this->command->info('No approved jobs found. Please run JobSeeder first.');
            return;
        }

        // Get candidates
        $candidates = User::where('role', 'candidate')->get();

        if ($candidates->isEmpty()) {
            $this->command->info('No candidates found. Please run UserSeeder first.');
            return;
        }

        // Sample cover letters/messages
        $messages = [
            "I am excited to apply for this position as my skills and experience align perfectly with your requirements. I have been working in this field for several years and am confident I can make a significant contribution to your team.",

            "Having followed your company for some time, I'm thrilled about the opportunity to join your innovative team. My background in this area has prepared me well for the challenges of this role, and I'm eager to bring my unique perspective to your projects.",

            "I believe my combination of technical skills and industry knowledge make me an ideal candidate for this position. I'm particularly drawn to your company's mission and would love the opportunity to contribute to your continued success.",

            "With my experience in similar roles and passion for this industry, I am confident I would be a valuable addition to your team. I am particularly impressed by your company's recent projects and would be excited to be part of your future initiatives.",

            "I am writing to express my interest in this position, which aligns perfectly with my career goals and skill set. I am particularly drawn to your company's innovative approach and would welcome the opportunity to contribute to your team."
        ];

        // Create applications
        $applications = [];

        // Each candidate applies to 2-3 random jobs
        foreach ($candidates as $candidate) {
            // Select 2-3 random jobs for each candidate
            $randomJobs = $jobs->random(rand(2, min(3, count($jobs))));

            foreach ($randomJobs as $job) {
                $status = ['pending', 'reviewing', 'interviewed', 'accepted', 'rejected'][rand(0, 4)];

                $applications[] = [
                    'job_id' => $job->id,
                    'candidate_id' => $candidate->id,
                    'resume_path' => 'resumes/sample-resume-' . $candidate->id . '.pdf', // Placeholder
                    'message' => $messages[array_rand($messages)],
                    'status' => $status,
                    'created_at' => now()->subDays(rand(1, 14)),
                    'updated_at' => now()->subDays(rand(0, 7)),
                ];
            }
        }

        // Insert all applications
        DB::table('applications')->insert($applications);
    }
}
