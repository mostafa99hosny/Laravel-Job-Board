<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@jobboard.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create Employer Users
        $employers = [
            [
                'name' => 'Tech Solutions Inc.',
                'email' => 'employer1@jobboard.com',
                'company_name' => 'Tech Solutions Inc.',
                'website' => 'https://techsolutions.example.com',
                'bio' => 'A leading technology company specializing in software development and IT consulting.',
            ],
            [
                'name' => 'Global Marketing Group',
                'email' => 'employer2@jobboard.com',
                'company_name' => 'Global Marketing Group',
                'website' => 'https://gmg.example.com',
                'bio' => 'An international marketing agency helping businesses grow their brand presence.',
            ],
            [
                'name' => 'Healthcare Innovations',
                'email' => 'employer3@jobboard.com',
                'company_name' => 'Healthcare Innovations',
                'website' => 'https://healthinnovate.example.com',
                'bio' => 'Revolutionizing healthcare through innovative technology solutions.',
            ],
        ];

        foreach ($employers as $employer) {
            User::create([
                'name' => $employer['name'],
                'email' => $employer['email'],
                'password' => Hash::make('password'),
                'role' => 'employer',
                'email_verified_at' => now(),
            ]);
        }

        // Create Candidate Users
        $candidates = [
            [
                'name' => 'John Smith',
                'email' => 'candidate1@jobboard.com',
                'skills' => 'PHP, Laravel, MySQL, JavaScript, Vue.js',
                'experience' => '5 years of web development experience',
                'bio' => 'Full-stack developer with a passion for creating efficient and user-friendly applications.',
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'candidate2@jobboard.com',
                'skills' => 'Python, Django, React, AWS, Docker',
                'experience' => '3 years in software engineering',
                'bio' => 'Software engineer focused on cloud-native applications and microservices architecture.',
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'candidate3@jobboard.com',
                'skills' => 'UI/UX Design, Figma, Adobe XD, HTML, CSS',
                'experience' => '4 years in UI/UX design',
                'bio' => 'Creative designer with a keen eye for detail and user experience.',
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'candidate4@jobboard.com',
                'skills' => 'Data Analysis, SQL, Python, Tableau, Excel',
                'experience' => '2 years in data analytics',
                'bio' => 'Data analyst with experience in transforming complex data into actionable insights.',
            ],
            [
                'name' => 'David Wilson',
                'email' => 'candidate5@jobboard.com',
                'skills' => 'Project Management, Agile, Scrum, JIRA, Confluence',
                'experience' => '6 years in project management',
                'bio' => 'Certified project manager with a track record of delivering projects on time and within budget.',
            ],
        ];

        foreach ($candidates as $candidate) {
            User::create([
                'name' => $candidate['name'],
                'email' => $candidate['email'],
                'password' => Hash::make('password'),
                'role' => 'candidate',
                'email_verified_at' => now(),
            ]);
        }
    }
}
