<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Approve a job listing.
     */
    public function approve(Request $request, $jobListingId)
    {
        // Logic to approve the job listing
        return response()->json(['message' => 'Job listing approved successfully.']);
    }

    /**
     * Reject a job listing.
     */
    public function reject(Request $request, $jobListingId)
    {
        // Logic to reject the job listing
        return response()->json(['message' => 'Job listing rejected successfully.']);
    }
    /**
     * Display a listing of the job applications.
     */
}
