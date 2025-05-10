<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display the homepage
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get featured jobs (latest approved jobs)
        $featuredJobs = Job::where('is_approved', true)
            ->with('employer')
            ->latest()
            ->take(6)
            ->get();
        
        // Get popular job categories with job count
        $popularCategories = Job::where('is_approved', true)
            ->select('category', DB::raw('count(*) as job_count'))
            ->groupBy('category')
            ->orderBy('job_count', 'desc')
            ->take(8)
            ->pluck('job_count', 'category')
            ->toArray();
        
        // Get featured employers (employers with most active jobs)
        $featuredEmployers = User::where('role', 'employer')
            ->withCount(['jobs' => function($query) {
                $query->where('is_approved', true);
            }])
            ->having('jobs_count', '>', 0)
            ->orderBy('jobs_count', 'desc')
            ->take(4)
            ->get();
        
        // Get all categories for search form
        $categories = Job::where('is_approved', true)
            ->select('category')
            ->distinct()
            ->pluck('category');
        
        return view('home', compact('featuredJobs', 'popularCategories', 'featuredEmployers', 'categories'));
    }
}
