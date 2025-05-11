<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks to avoid constraint issues
        Schema::disableForeignKeyConstraints();

        // Clear existing data
        $this->command->info('Clearing existing data...');
        \App\Models\Application::truncate();
        \App\Models\Job::truncate();
        \App\Models\User::truncate();

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();

        $this->command->info('Seeding users...');
        $this->call(UsersTableSeeder::class);

        $this->command->info('Seeding jobs...');
        $this->call(JobsTableSeeder::class);

        $this->command->info('Seeding applications...');
        $this->call(ApplicationsTableSeeder::class);

        $this->command->info('Database seeding completed successfully!');
    }
}
