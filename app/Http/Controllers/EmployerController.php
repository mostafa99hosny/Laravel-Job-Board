<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployerController extends Controller
{
    // Employer Dashboard
    public function dashboard()
    {
        $jobs = Job::where('employer_id', Auth::id())->get();
        return view('employer.dashboard', compact('jobs'));
    }

    // Show Employer Profile
    public function profile()
    {
        $employer = Auth::user();
        return view('employer.profile', compact('employer'));
    }

    // Update Employer Profile
    public function updateProfile(Request $request)
    {
        $employer = Auth::user();
        $employer->update($request->only(['name', 'email', 'company_name', 'website', 'bio']));
        return redirect()->back()->with('success', 'Profile updated.');
    }
}
