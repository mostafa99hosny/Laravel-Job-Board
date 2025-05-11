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
        Schema::table('applications', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['job_id']);

            // Add the new foreign key constraint referencing job_posts table
            $table->foreign('job_id')->references('id')->on('job_posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Drop the new foreign key constraint
            $table->dropForeign(['job_id']);

            // Add back the original foreign key constraint
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
        });
    }
};
