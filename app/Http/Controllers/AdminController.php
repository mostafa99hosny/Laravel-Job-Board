<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;

class AdminController extends Controller
{
    // Admin Dashboard
    public function dashboard()
    {
        $jobs = Job::latest()->take(10)->get();
        $users = User::latest()->take(10)->get();
        return view('admin.dashboard', compact('jobs', 'users'));
    }

    // Manage Users
    public function manageUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    // Approve/Reject Jobs
    public function pendingJobs()
    {
        $jobs = Job::where('status', 'pending')->get();
        return view('admin.jobs.pending', compact('jobs'));
    }

    public function approveJob($id)
    {
        $job = Job::findOrFail($id);
        $job->status = 'approved';
        $job->save();

        return redirect()->back()->with('success', 'Job approved.');
    }

    public function rejectJob($id)
    {
        $job = Job::findOrFail($id);
        $job->status = 'rejected';
        $job->save();

        return redirect()->back()->with('error', 'Job rejected.');
    }
}
