<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all approved jobs
        $jobs = Job::where('is_approved', true)->get();

        if ($jobs->isEmpty()) {
            $this->command->info('No approved jobs found. Please run the JobsTableSeeder first.');
            return;
        }

        // Get all candidates
        $candidates = User::where('role', 'candidate')->get();

        if ($candidates->isEmpty()) {
            $this->command->info('No candidates found. Please run the UsersTableSeeder first.');
            return;
        }

        // Create applications
        $this->createApplications($jobs, $candidates);
    }

    /**
     * Create job applications
     */
    private function createApplications($jobs, $candidates): void
    {
        // Application status options
        $statuses = ['pending', 'reviewing', 'interviewed', 'accepted', 'rejected'];

        // Sample cover letters
        $coverLetters = [
            "I am excited to apply for this position as I believe my skills and experience make me a strong candidate. I have been working in this field for several years and have developed expertise in the required areas.",

            "I was thrilled to see your job posting for this role. With my background in this industry and passion for innovation, I believe I would be a valuable addition to your team. I am particularly impressed with your company's commitment to quality and customer satisfaction.",

            "Please consider my application for this position. My experience includes working on similar projects and developing solutions that align with your company's goals. I am eager to bring my skills to your organization and contribute to your continued success.",

            "I am writing to express my interest in this position. My background in this field has prepared me well for this role, and I am excited about the opportunity to join your team. I am particularly drawn to your company's mission and values.",

            "Thank you for considering my application. I have attached my resume which details my relevant experience and skills. I am confident that my background makes me a strong fit for this position, and I look forward to the opportunity to discuss how I can contribute to your team.",

            "I am applying for this position because I am passionate about this field and believe my skills align well with your requirements. I have experience in similar roles and am excited about the opportunity to bring my expertise to your company.",

            "I am interested in this position because it aligns perfectly with my career goals and skill set. I have been following your company for some time and am impressed with your innovative approach and industry leadership.",
        ];

        // For each candidate, apply to 1-5 random jobs
        foreach ($candidates as $candidate) {
            // Randomly select 1-5 jobs to apply for
            $numApplications = rand(1, 5);
            $selectedJobs = $jobs->random(min($numApplications, $jobs->count()));

            foreach ($selectedJobs as $job) {
                // Randomly decide whether to include a cover letter
                $includeCoverLetter = (bool) rand(0, 1);
                $message = $includeCoverLetter ? $coverLetters[array_rand($coverLetters)] : null;

                // Randomly select a status, with higher probability for pending and reviewing
                $statusRand = rand(1, 10);
                if ($statusRand <= 4) { // 40% chance for pending
                    $status = 'pending';
                } elseif ($statusRand <= 7) { // 30% chance for reviewing
                    $status = 'reviewing';
                } elseif ($statusRand <= 8) { // 10% chance for interviewed
                    $status = 'interviewed';
                } elseif ($statusRand <= 9) { // 10% chance for accepted
                    $status = 'accepted';
                } else { // 10% chance for rejected
                    $status = 'rejected';
                }

                // Create the application with a random created_at date in the past 30 days
                Application::create([
                    'job_id' => $job->id,
                    'candidate_id' => $candidate->id,
                    'status' => $status,
                    'message' => $message,
                    'created_at' => Carbon::now()->subDays(rand(1, 30)),
                ]);
            }
        }

        // Add some specific applications for the predefined candidates to ensure they have applications
        $specificCandidates = User::where('role', 'candidate')
            ->whereIn('email', ['candidate1@example.com', 'candidate2@example.com', 'candidate3@example.com'])
            ->get();

        // Get some specific jobs (first 5)
        $specificJobs = $jobs->take(5);

        foreach ($specificCandidates as $candidate) {
            foreach ($specificJobs as $index => $job) {
                // Different status for each application to show variety
                $status = $statuses[$index % count($statuses)];

                // Only create if the candidate doesn't already have an application for this job
                $existingApplication = Application::where('job_id', $job->id)
                    ->where('candidate_id', $candidate->id)
                    ->first();

                if (!$existingApplication) {
                    Application::create([
                        'job_id' => $job->id,
                        'candidate_id' => $candidate->id,
                        'status' => $status,
                        'message' => $coverLetters[array_rand($coverLetters)],
                        'created_at' => Carbon::now()->subDays(rand(1, 15)),
                    ]);
                }
            }
        }
    }
}
