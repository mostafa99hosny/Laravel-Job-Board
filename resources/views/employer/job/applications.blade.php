@extends('layouts.main')

@section('title', 'Job Applications')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/job-applications.css') }}">
@endpush

@section('content')
<div class="container applications-container">
    <div class="applications-header">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Applications for Job</h1>
            <a href="{{ route('employer.dashboard') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <div class="applications-card">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0"><i class="fas fa-briefcase me-2"></i>{{ $job->title }}</h5>
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

            <!-- Job Details -->
            <div class="job-details">
                <div class="job-details-header">
                    <h5 class="job-details-title">Job Details</h5>
                    <span class="job-status {{ $job->is_approved ? 'status-approved' : 'status-pending' }}">
                        {{ $job->is_approved ? 'Approved' : 'Pending Approval' }}
                    </span>
                </div>
                <div class="job-details-grid">
                    <div class="job-detail-item">
                        <span class="job-detail-label">Location</span>
                        <span class="job-detail-value"><i class="fas fa-map-marker-alt text-primary me-2"></i>{{ $job->location }}</span>
                    </div>
                    <div class="job-detail-item">
                        <span class="job-detail-label">Job Type</span>
                        <span class="job-detail-value"><i class="fas fa-briefcase text-primary me-2"></i>{{ ucfirst($job->type) }}</span>
                    </div>
                    <div class="job-detail-item">
                        <span class="job-detail-label">Category</span>
                        <span class="job-detail-value"><i class="fas fa-tag text-primary me-2"></i>{{ $job->category }}</span>
                    </div>
                    <div class="job-detail-item">
                        <span class="job-detail-label">Salary Range</span>
                        <span class="job-detail-value">
                            <i class="fas fa-money-bill-wave text-primary me-2"></i>
                            @if($job->salary_min && $job->salary_max)
                                ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                            @elseif($job->salary_min)
                                From ${{ number_format($job->salary_min) }}
                            @elseif($job->salary_max)
                                Up to ${{ number_format($job->salary_max) }}
                            @else
                                Not specified
                            @endif
                        </span>
                    </div>
                    <div class="job-detail-item">
                        <span class="job-detail-label">Deadline</span>
                        <span class="job-detail-value">
                            <i class="fas fa-calendar-alt text-primary me-2"></i>
                            {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}
                        </span>
                    </div>
                    <div class="job-detail-item">
                        <span class="job-detail-label">Posted On</span>
                        <span class="job-detail-value">
                            <i class="fas fa-clock text-primary me-2"></i>
                            {{ $job->created_at->format('M d, Y') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Application Filters -->
            <div class="application-filters">
                <div class="application-filter active" data-filter="all">All ({{ $job->applications->count() }})</div>
                <div class="application-filter" data-filter="pending">Pending ({{ $job->applications->where('status', 'pending')->count() }})</div>
                <div class="application-filter" data-filter="reviewing">Reviewing ({{ $job->applications->where('status', 'reviewing')->count() }})</div>
                <div class="application-filter" data-filter="interviewed">Interviewed ({{ $job->applications->where('status', 'interviewed')->count() }})</div>
                <div class="application-filter" data-filter="accepted">Accepted ({{ $job->applications->where('status', 'accepted')->count() }})</div>
                <div class="application-filter" data-filter="rejected">Rejected ({{ $job->applications->where('status', 'rejected')->count() }})</div>
            </div>

            <!-- Applications List -->
            @if($job->applications->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover application-table">
                        <thead class="table-light">
                            <tr>
                                <th>Candidate</th>
                                <th>Applied On</th>
                                <th>Resume</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($job->applications as $application)
                                <tr class="application-row" data-status="{{ $application->status }}">
                                    <td>
                                        <div class="candidate-info">
                                            <span class="candidate-name">{{ $application->candidate->name }}</span>
                                            <span class="candidate-email">{{ $application->candidate->email }}</span>
                                            @if($application->candidate->phone)
                                                <span class="candidate-phone small text-muted">
                                                    <i class="fas fa-phone me-1"></i>{{ $application->candidate->phone }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="far fa-calendar-alt me-2 text-muted"></i>
                                            {{ $application->created_at->format('M d, Y') }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($application->resume_path)
                                            <a href="{{ asset('storage/' . $application->resume_path) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                                <i class="fas fa-file-pdf me-1"></i> View Resume
                                            </a>
                                        @else
                                            <span class="text-muted">No resume</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="application-status status-{{ $application->status }}">
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown status-dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton{{ $application->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                Update Status
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $application->id }}">
                                                <li>
                                                    <form action="{{ route('employer.application.update-status', $application->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="reviewing">
                                                        <button type="submit" class="dropdown-item status-reviewing">
                                                            <i class="fas fa-search"></i> Mark as Reviewing
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('employer.application.update-status', $application->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="interviewed">
                                                        <button type="submit" class="dropdown-item status-interviewed">
                                                            <i class="fas fa-user-tie"></i> Mark as Interviewed
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('employer.application.update-status', $application->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="accepted">
                                                        <button type="submit" class="dropdown-item status-accepted">
                                                            <i class="fas fa-check-circle"></i> Accept Application
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('employer.application.update-status', $application->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit" class="dropdown-item status-rejected">
                                                            <i class="fas fa-times-circle"></i> Reject Application
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @if($application->message)
                                    <tr class="application-row-detail" data-status="{{ $application->status }}">
                                        <td colspan="5">
                                            <div class="cover-letter">
                                                <h6 class="cover-letter-header"><i class="fas fa-quote-left me-2"></i>Cover Letter</h6>
                                                <p class="cover-letter-content">{{ $application->message }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info d-flex align-items-center">
                    <i class="fas fa-info-circle me-3 fa-2x"></i>
                    <div>
                        No applications have been submitted for this job yet. Check back later or promote your job listing to attract more candidates.
                    </div>
                </div>

                <div class="text-center py-5">
                    <img src="{{ asset('images/no-applications.svg') }}" alt="No Applications" class="img-fluid mb-4" style="max-width: 250px; opacity: 0.7;">
                    <h4>No Applications Yet</h4>
                    <p class="text-muted">Share your job listing on social media or consider updating the job description to attract more candidates.</p>
                    <a href="{{ route('job-listings.edit', $job->id) }}" class="btn btn-primary mt-3">
                        <i class="fas fa-edit me-2"></i>Edit Job Listing
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Application filters
        const filters = document.querySelectorAll('.application-filter');
        const applicationRows = document.querySelectorAll('.application-row, .application-row-detail');

        filters.forEach(filter => {
            filter.addEventListener('click', function() {
                // Remove active class from all filters
                filters.forEach(f => f.classList.remove('active'));

                // Add active class to clicked filter
                this.classList.add('active');

                // Get filter value
                const filterValue = this.getAttribute('data-filter');

                // Show/hide application rows based on filter
                applicationRows.forEach(row => {
                    if (filterValue === 'all' || row.getAttribute('data-status') === filterValue) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection
