<?php
namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobListingController extends Controller
{
    public function __construct()
    {
        // Ensure only employers can create/edit/delete jobs
        $this->middleware('role:employer');
    }

    public function index()
    {
        $jobs = Job::where('status', 'approved')->latest()->paginate(10);
        return view('job-listings.index', compact('jobs'));
    }

    public function create()
    {
        return view('job-listings.create');
    }

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

        return redirect()->route('job-listings.index')->with('success', 'Job posted. Waiting for admin approval.');
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view('job-listings.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        $job->update($request->only(['title', 'description', 'location', 'category', 'salary']));
        return redirect()->route('job-listings.index')->with('success', 'Job updated.');
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return redirect()->route('job-listings.index')->with('success', 'Job deleted.');
    }
}
?>