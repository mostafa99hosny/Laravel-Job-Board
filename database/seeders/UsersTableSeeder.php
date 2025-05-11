<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'admin',
        ]);

        // Create Employer Users
        $this->createEmployers();

        // Create Candidate Users
        $this->createCandidates();
    }

    /**
     * Create employer users with company details
     */
    private function createEmployers(): void
    {
        // Create a few specific employers
        $employers = [
            [
                'name' => 'Tech Solutions Inc.',
                'email' => 'employer1@example.com',
                'company_name' => 'Tech Solutions Inc.',
                'website' => 'https://techsolutions.example.com',
                'bio' => 'We are a leading technology solutions provider specializing in software development, cloud computing, and IT consulting services.',
            ],
            [
                'name' => 'Global Marketing Group',
                'email' => 'employer2@example.com',
                'company_name' => 'Global Marketing Group',
                'website' => 'https://gmg.example.com',
                'bio' => 'A full-service marketing agency helping businesses grow through strategic marketing campaigns and digital transformation.',
            ],
            [
                'name' => 'Innovative Startups',
                'email' => 'employer3@example.com',
                'company_name' => 'Innovative Startups',
                'website' => 'https://innovativestartups.example.com',
                'bio' => 'We fund and support early-stage startups with innovative ideas and disruptive technologies.',
            ],
        ];

        foreach ($employers as $employer) {
            User::create([
                'name' => $employer['name'],
                'email' => $employer['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role' => 'employer',
                'company_name' => $employer['company_name'],
                'website' => $employer['website'],
                'bio' => $employer['bio'],
            ]);
        }

        // Create additional random employers
        User::factory()->count(7)->create([
            'role' => 'employer',
        ])->each(function ($user) {
            $user->company_name = fake()->company();
            $user->website = 'https://www.' . Str::slug($user->company_name) . '.example.com';
            $user->bio = fake()->paragraph(3);
            $user->save();
        });
    }

    /**
     * Create candidate users with skills and experience
     */
    private function createCandidates(): void
    {
        // Create a few specific candidates
        $candidates = [
            [
                'name' => 'John Developer',
                'email' => 'candidate1@example.com',
                'skills' => 'PHP, Laravel, JavaScript, Vue.js, MySQL',
                'experience' => 'Senior Web Developer at Tech Co. (2018-2023), Full Stack Developer at Web Solutions (2015-2018)',
                'bio' => 'Passionate web developer with 8+ years of experience building scalable web applications.',
                'location' => 'New York, USA',
                'phone' => '+1 (555) 123-4567',
            ],
            [
                'name' => 'Sarah Designer',
                'email' => 'candidate2@example.com',
                'skills' => 'UI/UX Design, Figma, Adobe XD, HTML, CSS',
                'experience' => 'Lead UI/UX Designer at Design Studio (2019-2023), Graphic Designer at Creative Agency (2016-2019)',
                'bio' => 'Creative designer focused on creating beautiful and functional user interfaces.',
                'location' => 'San Francisco, USA',
                'phone' => '+1 (555) 234-5678',
            ],
            [
                'name' => 'Michael Manager',
                'email' => 'candidate3@example.com',
                'skills' => 'Project Management, Agile, Scrum, Team Leadership, Budgeting',
                'experience' => 'Project Manager at Enterprise Solutions (2017-2023), Team Lead at Tech Innovations (2014-2017)',
                'bio' => 'Experienced project manager with a track record of delivering complex projects on time and within budget.',
                'location' => 'Chicago, USA',
                'phone' => '+1 (555) 345-6789',
            ],
        ];

        foreach ($candidates as $candidate) {
            User::create([
                'name' => $candidate['name'],
                'email' => $candidate['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role' => 'candidate',
                'skills' => $candidate['skills'],
                'experience' => $candidate['experience'],
                'bio' => $candidate['bio'],
                'location' => $candidate['location'],
                'phone' => $candidate['phone'],
            ]);
        }

        // Create additional random candidates
        User::factory()->count(17)->create([
            'role' => 'candidate',
        ])->each(function ($user) {
            $skillSets = [
                'PHP, Laravel, MySQL, JavaScript, HTML, CSS',
                'JavaScript, React, Node.js, MongoDB, Express',
                'Python, Django, Flask, PostgreSQL, Docker',
                'Java, Spring Boot, Hibernate, Oracle, AWS',
                'C#, .NET, SQL Server, Azure, Angular',
                'UI/UX Design, Figma, Adobe XD, Sketch, Photoshop',
                'DevOps, Docker, Kubernetes, Jenkins, AWS, CI/CD',
                'Data Science, Python, R, Machine Learning, SQL',
                'Mobile Development, Flutter, React Native, Swift, Kotlin',
                'Project Management, Agile, Scrum, JIRA, Confluence'
            ];

            $locations = [
                'New York, USA',
                'San Francisco, USA',
                'London, UK',
                'Berlin, Germany',
                'Toronto, Canada',
                'Sydney, Australia',
                'Singapore',
                'Tokyo, Japan',
                'Paris, France',
                'Amsterdam, Netherlands'
            ];

            $user->skills = $skillSets[array_rand($skillSets)];
            $user->experience = fake()->paragraph(2);
            $user->bio = fake()->paragraph(3);
            $user->location = $locations[array_rand($locations)];
            $user->phone = '+' . fake()->numberBetween(1, 99) . ' ' . fake()->numerify('(###) ###-####');
            $user->save();
        });
    }
}
