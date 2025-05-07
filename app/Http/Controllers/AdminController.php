<?php 
namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Kernel;

class AdminController extends Controller
{
    public function __construct()
    {
        // Ensure only admins can access
        $this->middleware('role:admin');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.users.manage', compact('users'));
    }

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

        return redirect()->route('admin.jobs.pending')->with('success', 'Job approved.');
    }

    public function rejectJob($id)
    {
        $job = Job::findOrFail($id);
        $job->status = 'rejected';
        $job->save();

        return redirect()->route('admin.jobs.pending')->with('error', 'Job rejected.');
    }
}
?>