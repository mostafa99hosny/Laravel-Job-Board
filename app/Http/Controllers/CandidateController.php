<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    /**
     * Display the candidate dashboard with their applications
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Get the candidate's job applications with job details
        $applications = Application::where('candidate_id', Auth::id())
            ->with(['job' => function($query) {
                $query->with('employer');
            }])
            ->latest()
            ->get();

        // Get some recommended jobs based on the candidate's applications
        $recommendedJobs = Job::where('is_approved', true)
            ->whereNotIn('id', $applications->pluck('job_id')->toArray())
            ->latest()
            ->take(3)
            ->get();

        return view('candidate.dashboard', compact('applications', 'recommendedJobs'));
    }

    /**
     * Show the candidate's profile
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $candidate = Auth::user();
        return view('candidate.profile', compact('candidate'));
    }

    /**
     * Update the candidate's profile information
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'skills' => 'nullable|string',
            'experience' => 'nullable|string',
            'bio' => 'nullable|string|max:1000',
        ]);

        $candidate = Auth::user();
        $candidate->update($request->only(['name', 'email', 'skills', 'experience', 'bio']));

        return redirect()->route('candidate.profile')
            ->with('success', 'Your profile has been updated successfully.');
    }

    /**
     * Upload a resume for the candidate
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ]);

        // Delete old resume if exists
        $candidate = Auth::user();
        if ($candidate->resume_path) {
            Storage::disk('public')->delete($candidate->resume_path);
        }

        // Store new resume
        $path = $request->file('resume')->store('resumes', 'public');
        $candidate->resume_path = $path;
        $candidate->save();

        return redirect()->route('candidate.profile')
            ->with('success', 'Your resume has been uploaded successfully.');
    }
}
