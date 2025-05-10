<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Common fields
            $table->text('bio')->nullable();
            
            // Employer fields
            $table->string('company_name')->nullable();
            $table->string('website')->nullable();
            $table->string('company_logo')->nullable();
            
            // Candidate fields
            $table->text('skills')->nullable();
            $table->text('experience')->nullable();
            $table->string('resume_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bio',
                'company_name',
                'website',
                'company_logo',
                'skills',
                'experience',
                'resume_path'
            ]);
        });
    }
};
