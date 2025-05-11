<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StyledJobController extends Controller
{
    /**
     * Constructor to apply middleware
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:employer']);
    }

    /**
     * Show the styled job creation form
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('job-listings.create-styled');
    }
}
