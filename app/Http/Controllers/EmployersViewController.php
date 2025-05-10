<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployersViewController extends Controller
{
    /**
     * Display a listing of employers
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'employer')
            ->withCount(['jobs' => function($query) {
                $query->where('is_approved', true);
            }])
            ->having('jobs_count', '>', 0);
        
        // Apply search filters if provided
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
            });
        }
        
        // Filter by industry (from bio or company description)
        if ($request->has('industry') && $request->input('industry')) {
            $query->where('bio', 'like', "%{$request->input('industry')}%");
        }
        
        // Filter by location
        if ($request->has('location') && $request->input('location')) {
            $query->where('location', 'like', "%{$request->input('location')}%");
        }
        
        // Sort results
        $sortBy = $request->input('sort', 'jobs_count');
        $sortOrder = $request->input('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);
        
        $employers = $query->paginate(12);
        
        // Get industries for filter dropdown (simulated from job categories)
        $industries = Job::select('category')
            ->distinct()
            ->pluck('category')
            ->toArray();
        
        // Get featured industries with employer count
        $featuredIndustries = [
            'Technology' => 15,
            'Healthcare' => 12,
            'Finance' => 10,
            'Education' => 8,
            'Retail' => 7,
            'Manufacturing' => 6,
            'Marketing' => 5,
            'Hospitality' => 4
        ];
        
        return view('employers.index', compact('employers', 'industries', 'featuredIndustries'));
    }

    /**
     * Display the specified employer
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $employer = User::where('role', 'employer')
            ->withCount(['jobs' => function($query) {
                $query->where('is_approved', true);
            }])
            ->findOrFail($id);
        
        // Get employer's jobs
        $jobs = Job::where('employer_id', $employer->id)
            ->where('is_approved', true)
            ->latest()
            ->paginate(5);
        
        // Get job categories with count
        $jobCategories = Job::where('employer_id', $employer->id)
            ->where('is_approved', true)
            ->select('category', DB::raw('count(*) as job_count'))
            ->groupBy('category')
            ->orderBy('job_count', 'desc')
            ->pluck('job_count', 'category');
        
        // Get job locations with count
        $jobLocations = Job::where('employer_id', $employer->id)
            ->where('is_approved', true)
            ->select('location', DB::raw('count(*) as job_count'))
            ->groupBy('location')
            ->orderBy('job_count', 'desc')
            ->pluck('job_count', 'location');
        
        // Get similar employers (based on job categories)
        $employerJobCategories = $jobCategories->keys()->toArray();
        
        $similarEmployers = User::where('role', 'employer')
            ->where('id', '!=', $employer->id)
            ->withCount(['jobs' => function($query) use ($employerJobCategories) {
                $query->where('is_approved', true)
                      ->whereIn('category', $employerJobCategories);
            }])
            ->having('jobs_count', '>', 0)
            ->orderBy('jobs_count', 'desc')
            ->take(3)
            ->get();
        
        return view('employers.show', compact('employer', 'jobs', 'jobCategories', 'jobLocations', 'similarEmployers'));
    }
}
