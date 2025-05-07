<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class JobListingController extends Controller
{
    // Show all jobs (public)
    public function index()
    {
        $jobs = Job::where('status', 'approved')->latest()->paginate(10);
        return view('jobs.index', compact('jobs'));
    }

    // Show single job
    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.show', compact('job'));
    }

    // Employer: Create job form
    public function create()
    {
        return view('employer.jobs.create');
    }

    // Employer: Store new job
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'category' => 'required',
            'salary' => 'nullable|numeric',
        ]);

        Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'category' => $request->category,
            'salary' => $request->salary,
            'status' => 'pending',
            'employer_id' => Auth::id(),
        ]);

        return redirect()->route('employer.dashboard')->with('success', 'Job posted. Waiting for admin approval.');
    }

    // Employer: Edit job
    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view('employer.jobs.edit', compact('job'));
    }

    // Employer: Update job
    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        $job->update($request->only(['title', 'description', 'location', 'category', 'salary']));
        return redirect()->route('employer.dashboard')->with('success', 'Job updated.');
    }

    // Employer: Delete job
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return redirect()->route('employer.dashboard')->with('success', 'Job deleted.');
    }
}
