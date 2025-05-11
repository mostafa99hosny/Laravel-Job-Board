@extends('layouts.main')

@section('title', 'My Job Applications')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="container dashboard-container">
    <div class="dashboard-header">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>My Job Applications</h1>
            <a href="{{ route('candidate.dashboard') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <div class="dashboard-card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0"><i class="fas fa-file-alt me-2"></i>All Applications</h5>
            <a href="{{ route('job-listings.index') }}" class="btn btn-sm btn-light">
                <i class="fas fa-plus me-1"></i>Apply to More Jobs
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
                                <th>Location</th>
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
                                            <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                                            {{ $application->job->location }}
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
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('job-listings.show', $application->job->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye me-1"></i>View Job
                                            </a>

                                            @if(in_array($application->status, ['pending', 'reviewing']))
                                                <form action="{{ route('candidate.job-applications.cancel', $application->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to cancel this application?')">
                                                        <i class="fas fa-times me-1"></i>Cancel
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Application Status Summary -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Application Status Summary</h5>
                                <div class="row text-center">
                                    <div class="col-md-2 col-sm-4 mb-3">
                                        <div class="p-3 rounded bg-white shadow-sm">
                                            <h6 class="text-muted">Total</h6>
                                            <h3 class="mb-0 text-primary">{{ $applications->count() }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 mb-3">
                                        <div class="p-3 rounded bg-white shadow-sm">
                                            <h6 class="text-muted">Pending</h6>
                                            <h3 class="mb-0 text-secondary">{{ $applications->where('status', 'pending')->count() }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 mb-3">
                                        <div class="p-3 rounded bg-white shadow-sm">
                                            <h6 class="text-muted">Reviewing</h6>
                                            <h3 class="mb-0 text-primary">{{ $applications->where('status', 'reviewing')->count() }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 mb-3">
                                        <div class="p-3 rounded bg-white shadow-sm">
                                            <h6 class="text-muted">Interviewed</h6>
                                            <h3 class="mb-0 text-info">{{ $applications->where('status', 'interviewed')->count() }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 mb-3">
                                        <div class="p-3 rounded bg-white shadow-sm">
                                            <h6 class="text-muted">Accepted</h6>
                                            <h3 class="mb-0 text-success">{{ $applications->where('status', 'accepted')->count() }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 mb-3">
                                        <div class="p-3 rounded bg-white shadow-sm">
                                            <h6 class="text-muted">Rejected</h6>
                                            <h3 class="mb-0 text-danger">{{ $applications->where('status', 'rejected')->count() }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info d-flex align-items-center">
                    <i class="fas fa-info-circle me-3 fa-2x"></i>
                    <div>
                        You haven't applied to any jobs yet. <a href="{{ route('job-listings.index') }}" class="alert-link">Browse available jobs</a> to get started.
                    </div>
                </div>

                <div class="text-center py-5">
                    <img src="{{ asset('images/no-applications.svg') }}" alt="No Applications" class="img-fluid mb-4" style="max-width: 250px; opacity: 0.7;">
                    <h4>No Applications Yet</h4>
                    <p class="text-muted">Start your job search journey by applying to positions that match your skills and interests.</p>
                    <a href="{{ route('job-listings.index') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-search me-2"></i>Browse Jobs
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
