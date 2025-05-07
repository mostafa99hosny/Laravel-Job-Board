<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobListingController; // Ensure this controller exists in the specified namespace
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;

Route::get('/employer/dashboard', [EmployerController::class, 'dashboard'])->name('employer.dashboard');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users.manage');
        Route::get('/admin/jobs/pending', [AdminController::class, 'pendingJobs'])->name('admin.jobs.pending');
        Route::put('/admin/job/{id}/approve', [AdminController::class, 'approveJob'])->name('admin.job.approve');
        Route::put('/admin/job/{id}/reject', [AdminController::class, 'rejectJob'])->name('admin.job.reject');
    });

    Route::middleware('role:candidate')->group(function () {
        Route::get('/candidate/dashboard', [CandidateController::class, 'dashboard'])->name('candidate.dashboard');
        Route::get('/candidate/profile', [CandidateController::class, 'profile'])->name('candidate.profile');
        Route::patch('/candidate/profile', [CandidateController::class, 'updateProfile'])->name('candidate.profile.update');
        Route::post('/candidate/resume', [CandidateController::class, 'uploadResume'])->name('candidate.resume.upload');
        Route::post('/job-listings/{jobId}/apply', [JobApplicationController::class, 'apply'])->name('job-listings.apply');
        Route::get('/candidate/job-applications', [JobApplicationController::class, 'index'])->name('candidate.job-applications.index');
        Route::delete('/candidate/job-applications/{applicationId}', [JobApplicationController::class, 'cancel'])->name('candidate.job-applications.cancel');
    });

    Route::middleware('role:employer')->group(function () {
        Route::get('/employer/dashboard', [EmployerController::class, 'dashboard'])->name('employer.dashboard');
        Route::get('/employer/profile', [EmployerController::class, 'profile'])->name('employer.profile');
        Route::patch('/employer/profile', [EmployerController::class, 'updateProfile'])->name('employer.profile.update');
        
        Route::resource('job-listings', JobListingController::class)->except(['show']);
        
        Route::get('/employer/job/{jobId}/applications', [JobApplicationController::class, 'viewApplications'])->name('employer.job-applications.view');
    });
    
    Route::get('/job-listings', [JobListingController::class, 'index'])->name('job-listings.index'); // View all approved jobs
    Route::get('/job-listings/{id}', [JobListingController::class, 'show'])->name('job-listings.show'); // View single job
});
require __DIR__.'/auth.php';
