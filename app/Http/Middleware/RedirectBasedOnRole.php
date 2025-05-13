<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If the user is authenticated
        if (Auth::check()) {
            // Check the user's role and redirect accordingly
            $user = Auth::user();
            
            if ($request->is('dashboard')) {
                switch ($user->role) {
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                    case 'employer':
                        return redirect()->route('employer.dashboard');
                    case 'candidate':
                        return redirect()->route('candidate.dashboard');
                    default:
                        // If no specific role, continue to the default dashboard
                        return $next($request);
                }
            }
        }
        
        return $next($request);
    }
}
