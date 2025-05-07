<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
class JobApplicationController extends Controller
{
    // Candidate: Apply to a job
    public function apply(Request $request, $jobId)
    {
        $job = Job::findOrFail($jobId);

        $request->validate([
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $resumePath = $request->file('resume') 
            ? $request->file('resume')->store('resumes', 'public') 
            : Auth::user()->resume_path;

        Application::create([
            'job_id' => $job->id,
            'candidate_id' => Auth::id(),
            'resume_path' => $resumePath,
        ]);

        return back()->with('success', 'Application submitted.');
    }

    // Employer: View applications for a job
    public function viewApplications($jobId)
    {
        $job = Job::with('applications.candidate')->findOrFail($jobId);
        return view('employer.jobs.applications', compact('job'));
    }

    // Candidate: Cancel application
    public function cancel($applicationId)
    {
        $application = Application::where('id', $applicationId)->where('candidate_id', Auth::id())->firstOrFail();
        $application->delete();
        return back()->with('success', 'Application canceled.');
    }
}
