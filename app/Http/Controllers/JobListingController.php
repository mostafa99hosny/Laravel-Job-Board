<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobListingController extends Controller
{
    /**
     * Display a listing of the resource.
     * http://127.0.0.1:8000/job-listings/
     */ 
    public function index()
    {
        return "Iam in the index method of JobListingController";
    }

    /**
     * Show the form for creating a new resource.
     * http://127.0.0.1:8000/job-listings/create
     */
    public function create()
    {
        return "iam in the create method of JobListingController";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return "iam in the store method of JobListingController";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "iam in the show method of JobListingController";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return  "iam in the edit method of JobListingController";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "iam in the update method of JobListingController";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "iam in the destroy method of JobListingController";
    }
}
