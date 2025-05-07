<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
// use Auth;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    // Candidate Dashboard
    public function dashboard()
    {
        $applications = Application::where('candidate_id', Auth::id())->with('job')->get();
        return view('candidate.dashboard', compact('applications'));
    }

    // Show Candidate Profile
    public function profile()
    {
        $candidate = Auth::user();
        return view('candidate.profile', compact('candidate'));
    }

    // Update Candidate Profile
    public function updateProfile(Request $request)
    {
        $candidate = Auth::user();
        $candidate->update($request->only(['name', 'email', 'skills', 'experience', 'bio']));
        return redirect()->back()->with('success', 'Profile updated.');
    }

    // Upload Resume
    public function uploadResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $path = $request->file('resume')->store('resumes', 'public');

        $candidate = Auth::user();
        $candidate->resume_path = $path;
        $candidate->save();

        return redirect()->back()->with('success', 'Resume uploaded.');
    }
}
