<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all employer IDs
        $employerIds = User::where('role', 'employer')->pluck('id')->toArray();

        if (empty($employerIds)) {
            $this->command->info('No employers found. Please run the UsersTableSeeder first.');
            return;
        }

        // Create predefined job listings
        $this->createPredefinedJobs($employerIds);

        // Create random job listings
        $this->createRandomJobs($employerIds);
    }

    /**
     * Create predefined job listings
     */
    private function createPredefinedJobs(array $employerIds): void
    {
        $jobs = [
            [
                'title' => 'Senior Laravel Developer',
                'description' => '<p>We are looking for an experienced Laravel Developer to join our team. You will be responsible for developing and maintaining web applications using Laravel, PHP, MySQL, and JavaScript.</p>
                <h4>Responsibilities:</h4>
                <ul>
                    <li>Design, build, and maintain efficient, reusable, and reliable PHP code</li>
                    <li>Implement security and data protection measures</li>
                    <li>Integrate data storage solutions</li>
                    <li>Identify bottlenecks and bugs, and devise solutions to mitigate and address these issues</li>
                    <li>Help maintain code quality, organization, and automatization</li>
                </ul>
                <h4>Requirements:</h4>
                <ul>
                    <li>3+ years of experience with Laravel framework</li>
                    <li>Strong knowledge of PHP, MySQL, JavaScript, and HTML/CSS</li>
                    <li>Experience with RESTful APIs</li>
                    <li>Understanding of MVC design patterns</li>
                    <li>Basic understanding of front-end technologies, such as JavaScript, HTML5, and CSS3</li>
                    <li>Knowledge of object-oriented PHP programming</li>
                </ul>',
                'location' => 'New York, USA (Remote Available)',
                'category' => 'Web Development',
                'type' => 'full-time',
                'experience_level' => 'senior',
                'salary_min' => 90000,
                'salary_max' => 120000,
                'is_approved' => true,
            ],
            [
                'title' => 'UI/UX Designer',
                'description' => '<p>We are seeking a talented UI/UX Designer to create amazing user experiences. The ideal candidate should have an eye for clean and artful design, possess superior UI/UX skills, and be able to translate high-level requirements into interaction flows and artifacts.</p>
                <h4>Responsibilities:</h4>
                <ul>
                    <li>Collaborate with product management and engineering to define and implement innovative solutions for product direction, visuals, and experience</li>
                    <li>Execute all visual design stages from concept to final hand-off to engineering</li>
                    <li>Create wireframes, storyboards, user flows, process flows and site maps to effectively communicate interaction and design ideas</li>
                    <li>Present and defend designs and key milestone deliverables to peers and executive level stakeholders</li>
                    <li>Conduct user research and evaluate user feedback</li>
                </ul>
                <h4>Requirements:</h4>
                <ul>
                    <li>2+ years of UI/UX design experience for digital products or services</li>
                    <li>Demonstrable UI design skills with a strong portfolio</li>
                    <li>Solid experience in creating wireframes, storyboards, user flows, process flows and site maps</li>
                    <li>Proficiency in Figma, Sketch, Adobe XD, or similar</li>
                    <li>Knowledge of HTML, CSS, and JavaScript is a plus</li>
                </ul>',
                'location' => 'San Francisco, USA',
                'category' => 'Design',
                'type' => 'full-time',
                'experience_level' => 'mid',
                'salary_min' => 80000,
                'salary_max' => 110000,
                'is_approved' => true,
            ],
            [
                'title' => 'DevOps Engineer',
                'description' => '<p>We are looking for a DevOps Engineer to help us build and maintain our cloud infrastructure. You will be responsible for designing, implementing, and managing our CI/CD pipelines, as well as monitoring and optimizing our cloud resources.</p>
                <h4>Responsibilities:</h4>
                <ul>
                    <li>Design, implement, and manage CI/CD pipelines</li>
                    <li>Automate and optimize deployment processes</li>
                    <li>Monitor and optimize cloud resources</li>
                    <li>Implement security best practices</li>
                    <li>Collaborate with development teams to improve infrastructure</li>
                </ul>
                <h4>Requirements:</h4>
                <ul>
                    <li>3+ years of experience in DevOps or similar role</li>
                    <li>Strong knowledge of AWS, Azure, or GCP</li>
                    <li>Experience with containerization technologies (Docker, Kubernetes)</li>
                    <li>Experience with CI/CD tools (Jenkins, GitLab CI, GitHub Actions)</li>
                    <li>Knowledge of infrastructure as code (Terraform, CloudFormation)</li>
                    <li>Scripting skills (Bash, Python)</li>
                </ul>',
                'location' => 'Remote',
                'category' => 'DevOps',
                'type' => 'full-time',
                'experience_level' => 'senior',
                'salary_min' => 100000,
                'salary_max' => 140000,
                'is_approved' => true,
            ],
            [
                'title' => 'Junior React Developer',
                'description' => '<p>We are looking for a Junior React Developer to join our front-end team. This is a great opportunity for someone who is passionate about React and wants to grow their skills in a supportive environment.</p>
                <h4>Responsibilities:</h4>
                <ul>
                    <li>Develop new user-facing features using React.js</li>
                    <li>Build reusable components and front-end libraries for future use</li>
                    <li>Translate designs and wireframes into high-quality code</li>
                    <li>Optimize components for maximum performance across a vast array of web-capable devices and browsers</li>
                </ul>
                <h4>Requirements:</h4>
                <ul>
                    <li>0-2 years of experience with React.js</li>
                    <li>Basic knowledge of JavaScript, HTML, and CSS</li>
                    <li>Familiarity with RESTful APIs</li>
                    <li>Understanding of React.js and its core principles</li>
                    <li>Knowledge of modern front-end build pipelines and tools</li>
                </ul>',
                'location' => 'Chicago, USA',
                'category' => 'Web Development',
                'type' => 'full-time',
                'experience_level' => 'entry',
                'salary_min' => 60000,
                'salary_max' => 80000,
                'is_approved' => true,
            ],
            [
                'title' => 'Product Manager',
                'description' => '<p>We are seeking an experienced Product Manager to join our team. You will be responsible for the product planning and execution throughout the Product Lifecycle, including gathering and prioritizing product and customer requirements, defining the product vision, and working closely with engineering, sales, marketing, and support to ensure revenue and customer satisfaction goals are met.</p>
                <h4>Responsibilities:</h4>
                <ul>
                    <li>Gather and prioritize product and customer requirements</li>
                    <li>Define the product vision and strategy</li>
                    <li>Work closely with engineering to deliver features</li>
                    <li>Ensure revenue and customer satisfaction goals are met</li>
                    <li>Represent the company by visiting customers to solicit feedback on company products and services</li>
                </ul>
                <h4>Requirements:</h4>
                <ul>
                    <li>3+ years of product management experience</li>
                    <li>Strong technical background</li>
                    <li>Experience with Agile methodologies</li>
                    <li>Excellent written and verbal communication skills</li>
                    <li>Problem-solving aptitude</li>
                    <li>Organizational skills</li>
                </ul>',
                'location' => 'Boston, USA',
                'category' => 'Product Management',
                'type' => 'full-time',
                'experience_level' => 'mid',
                'salary_min' => 90000,
                'salary_max' => 120000,
                'is_approved' => true,
            ],
            [
                'title' => 'Data Scientist',
                'description' => '<p>We are looking for a Data Scientist to help us discover the information hidden in vast amounts of data, and help us make smarter decisions to deliver even better products. Your primary focus will be in applying data mining techniques, doing statistical analysis, and building high quality prediction systems integrated with our products.</p>
                <h4>Responsibilities:</h4>
                <ul>
                    <li>Select features, build and optimize classifiers using machine learning techniques</li>
                    <li>Data mining using state-of-the-art methods</li>
                    <li>Extend company\'s data with third party sources of information when needed</li>
                    <li>Enhance data collection procedures to include information that is relevant for building analytic systems</li>
                    <li>Process, cleanse, and verify the integrity of data used for analysis</li>
                </ul>
                <h4>Requirements:</h4>
                <ul>
                    <li>2+ years of experience in data science</li>
                    <li>Strong knowledge of Python, R, or similar</li>
                    <li>Experience with data visualization tools</li>
                    <li>Proficiency in using query languages such as SQL</li>
                    <li>Good applied statistics skills, such as distributions, statistical testing, regression, etc.</li>
                    <li>Good scripting and programming skills</li>
                </ul>',
                'location' => 'Seattle, USA',
                'category' => 'Data Science',
                'type' => 'full-time',
                'experience_level' => 'mid',
                'salary_min' => 95000,
                'salary_max' => 130000,
                'is_approved' => true,
            ],
            [
                'title' => 'Marketing Intern',
                'description' => '<p>We are seeking a Marketing Intern to assist our marketing team in executing various marketing tasks. This is a great opportunity for a marketing student to gain hands-on experience in a fast-paced environment.</p>
                <h4>Responsibilities:</h4>
                <ul>
                    <li>Assist in the creation of marketing materials</li>
                    <li>Help manage social media accounts</li>
                    <li>Conduct market research</li>
                    <li>Support the marketing team in daily administrative tasks</li>
                    <li>Help organize marketing events</li>
                </ul>
                <h4>Requirements:</h4>
                <ul>
                    <li>Currently pursuing a degree in Marketing, Communications, or related field</li>
                    <li>Basic knowledge of marketing principles</li>
                    <li>Familiarity with social media platforms</li>
                    <li>Good written and verbal communication skills</li>
                    <li>Ability to work in a team environment</li>
                </ul>',
                'location' => 'Remote',
                'category' => 'Marketing',
                'type' => 'internship',
                'experience_level' => 'entry',
                'salary_min' => 20000,
                'salary_max' => 30000,
                'is_approved' => true,
            ],
            [
                'title' => 'Part-time Content Writer',
                'description' => '<p>We are looking for a talented Content Writer to create compelling content for our blog, website, and social media channels. This is a part-time position with flexible hours.</p>
                <h4>Responsibilities:</h4>
                <ul>
                    <li>Create engaging content for various platforms</li>
                    <li>Research industry-related topics</li>
                    <li>Edit and proofread written pieces before publication</li>
                    <li>Conduct keyword research and use SEO best practices</li>
                    <li>Collaborate with marketing and design teams</li>
                </ul>
                <h4>Requirements:</h4>
                <ul>
                    <li>Previous experience as a Content Writer or similar role</li>
                    <li>Portfolio of published articles</li>
                    <li>Excellent writing and editing skills</li>
                    <li>Good time management skills</li>
                    <li>Knowledge of SEO best practices</li>
                </ul>',
                'location' => 'Remote',
                'category' => 'Content Creation',
                'type' => 'part-time',
                'experience_level' => 'mid',
                'salary_min' => 25000,
                'salary_max' => 35000,
                'is_approved' => true,
            ],
            [
                'title' => 'Mobile App Developer (iOS)',
                'description' => '<p>We are seeking an iOS Developer responsible for the development and maintenance of applications aimed at a range of iOS devices including mobile phones and tablet computers. Your primary focus will be development of iOS applications and their integration with back-end services.</p>
                <h4>Responsibilities:</h4>
                <ul>
                    <li>Design and build applications for the iOS platform</li>
                    <li>Ensure the performance, quality, and responsiveness of applications</li>
                    <li>Collaborate with a team to define, design, and ship new features</li>
                    <li>Identify and correct bottlenecks and fix bugs</li>
                    <li>Help maintain code quality, organization, and automatization</li>
                </ul>
                <h4>Requirements:</h4>
                <ul>
                    <li>2+ years of iOS development experience</li>
                    <li>Proficient with Swift and Objective-C</li>
                    <li>Experience with iOS frameworks such as Core Data, Core Animation, etc.</li>
                    <li>Experience with offline storage, threading, and performance tuning</li>
                    <li>Familiarity with RESTful APIs to connect iOS applications to back-end services</li>
                    <li>Knowledge of other web technologies and UI/UX standards</li>
                </ul>',
                'location' => 'Austin, USA',
                'category' => 'Mobile Development',
                'type' => 'full-time',
                'experience_level' => 'mid',
                'salary_min' => 85000,
                'salary_max' => 115000,
                'is_approved' => true,
            ],
            [
                'title' => 'Network Administrator',
                'description' => '<p>We are looking for a Network Administrator to maintain and administer our company\'s computer networks. Your primary responsibility will be to ensure our network infrastructure remains up-to-date and operates smoothly.</p>
                <h4>Responsibilities:</h4>
                <ul>
                    <li>Install and support LANs, WANs, network segments, Internet, and intranet systems</li>
                    <li>Install and maintain network hardware and software</li>
                    <li>Monitor networks to ensure security and availability to specific users</li>
                    <li>Evaluate and modify system performance</li>
                    <li>Identify and solve network problems</li>
                </ul>
                <h4>Requirements:</h4>
                <ul>
                    <li>2+ years of experience in network administration</li>
                    <li>Experience with firewalls, proxies, DHCP, DNS, and WINS</li>
                    <li>Knowledge of network security protocols and standards</li>
                    <li>Familiarity with network monitoring tools</li>
                    <li>Relevant certifications (CCNA, CompTIA Network+, etc.)</li>
                </ul>',
                'location' => 'Denver, USA',
                'category' => 'IT & Networking',
                'type' => 'full-time',
                'experience_level' => 'mid',
                'salary_min' => 70000,
                'salary_max' => 90000,
                'is_approved' => true,
            ],
            [
                'title' => 'Customer Support Specialist',
                'description' => '<p>We are seeking a Customer Support Specialist to join our team. You will be responsible for providing exceptional customer service to our clients, addressing their inquiries, and resolving their issues in a timely manner.</p>
                <h4>Responsibilities:</h4>
                <ul>
                    <li>Respond to customer inquiries via phone, email, and chat</li>
                    <li>Troubleshoot and resolve customer issues</li>
                    <li>Document customer interactions in our CRM system</li>
                    <li>Escalate complex issues to the appropriate teams</li>
                    <li>Provide feedback to improve customer experience</li>
                </ul>
                <h4>Requirements:</h4>
                <ul>
                    <li>1+ years of customer support experience</li>
                    <li>Excellent communication skills</li>
                    <li>Problem-solving aptitude</li>
                    <li>Patience and empathy</li>
                    <li>Basic technical knowledge</li>
                </ul>',
                'location' => 'Remote',
                'category' => 'Customer Support',
                'type' => 'full-time',
                'experience_level' => 'entry',
                'salary_min' => 45000,
                'salary_max' => 55000,
                'is_approved' => true,
            ],
        ];

        foreach ($jobs as $index => $job) {
            // Assign each job to a different employer, cycling through the available employers
            $employerId = $employerIds[$index % count($employerIds)];

            // Set a deadline between 2 weeks and 2 months from now
            $deadline = Carbon::now()->addDays(rand(14, 60));

            Job::create([
                'title' => $job['title'],
                'description' => $job['description'],
                'location' => $job['location'],
                'category' => $job['category'],
                'type' => $job['type'],
                'experience_level' => $job['experience_level'],
                'salary_min' => $job['salary_min'],
                'salary_max' => $job['salary_max'],
                'deadline' => $deadline,
                'is_approved' => $job['is_approved'],
                'employer_id' => $employerId,
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);
        }
    }

    /**
     * Create random job listings
     */
    private function createRandomJobs(array $employerIds): void
    {
        $jobTitles = [
            'Software Engineer', 'Web Developer', 'Data Analyst', 'Project Manager',
            'UX Designer', 'Product Manager', 'Marketing Specialist', 'Content Writer',
            'Sales Representative', 'Customer Success Manager', 'HR Specialist',
            'Financial Analyst', 'Business Analyst', 'QA Engineer', 'DevOps Engineer',
            'System Administrator', 'Network Engineer', 'Security Analyst',
            'Mobile Developer', 'Frontend Developer', 'Backend Developer',
            'Full Stack Developer', 'Database Administrator', 'Cloud Engineer',
            'AI/ML Engineer', 'Technical Writer', 'Graphic Designer', 'UI Designer',
            'SEO Specialist', 'Social Media Manager'
        ];

        $categories = [
            'Web Development', 'Mobile Development', 'Data Science', 'Design',
            'Product Management', 'Marketing', 'Sales', 'Customer Support',
            'Human Resources', 'Finance', 'Business', 'Quality Assurance',
            'DevOps', 'IT & Networking', 'Security', 'Content Creation'
        ];

        $locations = [
            'New York, USA', 'San Francisco, USA', 'Chicago, USA', 'Austin, USA',
            'Seattle, USA', 'Boston, USA', 'Los Angeles, USA', 'Denver, USA',
            'Atlanta, USA', 'Miami, USA', 'Dallas, USA', 'Remote'
        ];

        $jobTypes = ['full-time', 'part-time', 'contract', 'internship', 'remote'];
        $experienceLevels = ['entry', 'mid', 'senior', 'executive'];

        // Create 20 random jobs
        for ($i = 0; $i < 20; $i++) {
            $employerId = $employerIds[array_rand($employerIds)];
            $title = $jobTitles[array_rand($jobTitles)];
            $category = $categories[array_rand($categories)];
            $type = $jobTypes[array_rand($jobTypes)];
            $experienceLevel = $experienceLevels[array_rand($experienceLevels)];

            // Set salary range based on experience level
            switch ($experienceLevel) {
                case 'entry':
                    $salaryMin = rand(40000, 60000);
                    $salaryMax = rand($salaryMin + 10000, $salaryMin + 20000);
                    break;
                case 'mid':
                    $salaryMin = rand(60000, 90000);
                    $salaryMax = rand($salaryMin + 10000, $salaryMin + 30000);
                    break;
                case 'senior':
                    $salaryMin = rand(90000, 120000);
                    $salaryMax = rand($salaryMin + 20000, $salaryMin + 50000);
                    break;
                case 'executive':
                    $salaryMin = rand(120000, 150000);
                    $salaryMax = rand($salaryMin + 30000, $salaryMin + 100000);
                    break;
                default:
                    $salaryMin = rand(50000, 100000);
                    $salaryMax = rand($salaryMin + 10000, $salaryMin + 50000);
            }

            // Generate a random description
            $description = '<p>' . fake()->paragraph(5) . '</p>';
            $description .= '<h4>Responsibilities:</h4><ul>';
            for ($j = 0; $j < 5; $j++) {
                $description .= '<li>' . fake()->sentence() . '</li>';
            }
            $description .= '</ul><h4>Requirements:</h4><ul>';
            for ($j = 0; $j < 5; $j++) {
                $description .= '<li>' . fake()->sentence() . '</li>';
            }
            $description .= '</ul>';

            // Set a deadline between 2 weeks and 2 months from now
            $deadline = Carbon::now()->addDays(rand(14, 60));

            // Some jobs are pending approval
            $isApproved = rand(0, 10) < 8; // 80% chance of being approved

            // Create the job
            Job::create([
                'title' => $title . ' - ' . $experienceLevel . ' level',
                'description' => $description,
                'location' => $locations[array_rand($locations)],
                'category' => $category,
                'type' => $type,
                'experience_level' => $experienceLevel,
                'salary_min' => $salaryMin,
                'salary_max' => $salaryMax,
                'deadline' => $deadline,
                'is_approved' => $isApproved,
                'employer_id' => $employerId,
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
