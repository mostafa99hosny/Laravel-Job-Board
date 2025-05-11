@extends('layouts.main')

@section('title', 'Candidate Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="container dashboard-container">
    <div class="dashboard-header">
        <h1>Candidate Dashboard</h1>
        <p class="text-muted">Manage your job applications and career profile</p>
    </div>

    <div class="row">
        <div class="col-lg-3 mb-4">
            <!-- Candidate Profile Card -->
            <div class="dashboard-card mb-4">
                <div class="profile-summary">
                    <div class="profile-avatar">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <h5 class="profile-name">{{ auth()->user()->name }}</h5>
                    <p class="profile-email">{{ auth()->user()->email }}</p>
                    <a href="{{ route('candidate.profile') }}" class="btn btn-outline-primary">
                        <i class="fas fa-user-edit me-2"></i>Edit Profile
                    </a>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="dashboard-card">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0"><i class="fas fa-chart-pie me-2"></i>Application Stats</h5>
                </div>
                <div class="card-body p-0">
                    <div class="stats-item">
                        <span class="stats-label">Total Applications</span>
                        <span class="badge bg-primary rounded-pill">{{ $applications->count() }}</span>
                    </div>
                    <div class="stats-item">
                        <span class="stats-label">Pending</span>
                        <span class="badge bg-secondary rounded-pill">{{ $applications->where('status', 'pending')->count() }}</span>
                    </div>
                    <div class="stats-item">
                        <span class="stats-label">Under Review</span>
                        <span class="badge bg-info rounded-pill">{{ $applications->where('status', 'reviewing')->count() + $applications->where('status', 'interviewed')->count() }}</span>
                    </div>
                    <div class="stats-item">
                        <span class="stats-label">Accepted</span>
                        <span class="badge bg-success rounded-pill">{{ $applications->where('status', 'accepted')->count() }}</span>
                    </div>
                    <div class="stats-item">
                        <span class="stats-label">Rejected</span>
                        <span class="badge bg-danger rounded-pill">{{ $applications->where('status', 'rejected')->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <!-- Welcome Message -->
            <div class="welcome-card">
                <h2><i class="fas fa-hand-wave me-2"></i>Welcome, {{ auth()->user()->name }}!</h2>
                <p>
                    Track your job applications and discover new opportunities that match your skills and interests.
                    Your career journey starts here!
                </p>
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('job-listings.index') }}" class="btn btn-light">
                        <i class="fas fa-search me-2"></i>Browse Jobs
                    </a>
                    <a href="{{ route('candidate.profile') }}" class="btn btn-outline-light">
                        <i class="fas fa-user-edit me-2"></i>Complete Profile
                    </a>
                </div>
            </div>

            <!-- Profile Completeness -->
            @php
                $completeness = 0;
                $steps = [];

                if(auth()->user()->name) $completeness += 10;
                else $steps[] = ['icon' => 'user', 'text' => 'Add your full name', 'route' => route('candidate.profile')];

                if(auth()->user()->email) $completeness += 10;
                else $steps[] = ['icon' => 'envelope', 'text' => 'Verify your email', 'route' => route('candidate.profile')];

                if(auth()->user()->phone) $completeness += 15;
                else $steps[] = ['icon' => 'phone', 'text' => 'Add your phone number', 'route' => route('candidate.profile')];

                if(auth()->user()->location) $completeness += 15;
                else $steps[] = ['icon' => 'map-marker-alt', 'text' => 'Add your location', 'route' => route('candidate.profile')];

                if(auth()->user()->skills) $completeness += 15;
                else $steps[] = ['icon' => 'tools', 'text' => 'Add your skills', 'route' => route('candidate.profile')];

                if(auth()->user()->experience) $completeness += 15;
                else $steps[] = ['icon' => 'briefcase', 'text' => 'Add your work experience', 'route' => route('candidate.profile')];

                if(auth()->user()->resume_path) $completeness += 20;
                else $steps[] = ['icon' => 'file-pdf', 'text' => 'Upload your resume', 'route' => route('candidate.profile')];

                // Limit to 3 steps
                $steps = array_slice($steps, 0, 3);
            @endphp

            <div class="dashboard-card mb-4">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0"><i class="fas fa-tasks me-2"></i>Profile Completeness</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="progress flex-grow-1 me-3" style="height: 10px;">
                            <div class="progress-bar {{ $completeness < 50 ? 'bg-danger' : ($completeness < 80 ? 'bg-warning' : 'bg-success') }}"
                                role="progressbar" style="width: {{ $completeness }}%;"
                                aria-valuenow="{{ $completeness }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="fs-5 fw-bold {{ $completeness < 50 ? 'text-danger' : ($completeness < 80 ? 'text-warning' : 'text-success') }}">
                            {{ $completeness }}%
                        </div>
                    </div>

                    @if($completeness < 100 && count($steps) > 0)
                        <p class="text-muted mb-3">Complete these steps to improve your profile:</p>
                        <div class="list-group">
                            @foreach($steps as $step)
                                <a href="{{ $step['route'] }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="fas fa-{{ $step['icon'] }} text-primary me-3"></i>
                                    <span>{{ $step['text'] }}</span>
                                    <i class="fas fa-chevron-right ms-auto"></i>
                                </a>
                            @endforeach
                        </div>
                    @elseif($completeness == 100)
                        <div class="alert alert-success mb-0">
                            <i class="fas fa-check-circle me-2"></i> Your profile is complete! You're ready to apply for jobs.
                        </div>
                    @endif
                </div>
            </div>

            <!-- My Applications -->
            <div class="dashboard-card mb-4">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0"><i class="fas fa-file-alt me-2"></i>Recent Applications</h5>
                    <a href="{{ route('candidate.job-applications.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-external-link-alt me-1"></i>View All
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($applications->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover application-table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Job Title</th>
                                        <th>Company</th>
                                        <th>Applied On</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applications as $application)
                                        <tr>
                                            <td>
                                                <a href="{{ route('job-listings.show', $application->job->id) }}" class="fw-medium text-decoration-none">
                                                    {{ $application->job->title }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-building me-2 text-muted"></i>
                                                    {{ $application->job->employer->company_name ?? $application->job->employer->name }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="far fa-calendar-alt me-2 text-muted"></i>
                                                    {{ $application->created_at->format('M d, Y') }}
                                                </div>
                                            </td>
                                            <td>
                                                <span class="application-status status-{{ $application->status }}">
                                                    {{ ucfirst($application->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if(in_array($application->status, ['pending', 'reviewing']))
                                                    <form action="{{ route('candidate.job-applications.cancel', $application->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to cancel this application?')">
                                                            <i class="fas fa-times me-1"></i>Cancel
                                                        </button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-sm btn-outline-secondary" disabled>
                                                        <i class="fas fa-times me-1"></i>Cancel
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info d-flex align-items-center">
                            <i class="fas fa-info-circle me-3 fa-2x"></i>
                            <div>
                                You haven't applied to any jobs yet. <a href="{{ route('job-listings.index') }}" class="alert-link">Browse available jobs</a> to get started.
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recommended Jobs -->
            @if(isset($recommendedJobs) && $recommendedJobs->count() > 0)
                <div class="dashboard-card">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0"><i class="fas fa-star me-2"></i>Recommended Jobs</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($recommendedJobs as $job)
                                <div class="col-md-6 mb-3">
                                    <div class="job-card">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="{{ route('job-listings.show', $job->id) }}" class="text-decoration-none">
                                                    {{ $job->title }}
                                                </a>
                                            </h5>
                                            <h6 class="card-subtitle mb-2 text-muted">
                                                <i class="fas fa-building me-2"></i>{{ $job->employer->company_name ?? $job->employer->name }}
                                            </h6>
                                            <div class="mb-2">
                                                <span class="badge bg-light text-dark me-1">
                                                    <i class="fas fa-map-marker-alt me-1"></i> {{ $job->location }}
                                                </span>
                                                <span class="badge bg-light text-dark">
                                                    <i class="fas fa-briefcase me-1"></i> {{ ucfirst($job->type) }}
                                                </span>
                                            </div>
                                            <p class="card-text small">
                                                {{ Str::limit(strip_tags($job->description), 100) }}
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="{{ route('job-listings.show', $job->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i>View Details
                                                </a>
                                                <small class="text-muted">
                                                    <i class="far fa-clock me-1"></i> {{ $job->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
