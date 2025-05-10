@extends('layouts.main')

@section('title', $employer->company_name ?? $employer->name)

@section('content')
    <!-- Page Header -->
    <section class="bg-primary text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="mb-0">Employer Profile</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-md-end mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('employers.index') }}" class="text-white">Employers</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">{{ $employer->company_name ?? $employer->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Employer Profile Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Employer Info -->
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <!-- Company Header -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center mb-3 mb-md-0">
                                    @if($employer->company_logo)
                                        <img src="{{ asset('storage/' . $employer->company_logo) }}" alt="{{ $employer->company_name ?? $employer->name }}" class="img-fluid" style="max-height: 120px;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center mx-auto" style="height: 120px; width: 120px;">
                                            <i class="fas fa-building fa-3x text-secondary"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <h1 class="h3 mb-2">{{ $employer->company_name ?? $employer->name }}</h1>
                                    @if($employer->website)
                                        <p class="mb-2">
                                            <i class="fas fa-globe text-primary me-2"></i>
                                            <a href="{{ $employer->website }}" target="_blank" class="text-decoration-none">{{ $employer->website }}</a>
                                        </p>
                                    @endif
                                    <p class="mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        {{ $employer->location ?? 'Location not specified' }}
                                    </p>
                                    <p class="mb-0">
                                        <i class="fas fa-briefcase text-primary me-2"></i>
                                        {{ $jobs->total() }} {{ Str::plural('job', $jobs->total()) }} available
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Company Description -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h2 class="h4 mb-4">About {{ $employer->company_name ?? $employer->name }}</h2>
                            <div class="company-description">
                                @if($employer->bio)
                                    <p>{{ $employer->bio }}</p>
                                @else
                                    <p class="text-muted">No company description available.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Company Jobs -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2 class="h4 mb-0">Available Jobs</h2>
                                <a href="{{ route('job-listings.index', ['employer' => $employer->id]) }}" class="btn btn-outline-primary btn-sm">View All</a>
                            </div>
                            
                            @if($jobs->count() > 0)
                                <div class="job-listings">
                                    @foreach($jobs as $job)
                                        <div class="job-card mb-4">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class="h5 mb-1">
                                                        <a href="{{ route('job-listings.show', $job->id) }}">{{ $job->title }}</a>
                                                    </h3>
                                                    <div class="job-details">
                                                        <div class="job-detail">
                                                            <i class="fas fa-map-marker-alt"></i> {{ $job->location }}
                                                        </div>
                                                        <div class="job-detail">
                                                            <i class="fas fa-briefcase"></i> {{ ucfirst($job->type) }}
                                                        </div>
                                                        <div class="job-detail">
                                                            <i class="fas fa-money-bill-wave"></i>
                                                            @if($job->salary_min && $job->salary_max)
                                                                ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                                                            @elseif($job->salary_min)
                                                                From ${{ number_format($job->salary_min) }}
                                                            @elseif($job->salary_max)
                                                                Up to ${{ number_format($job->salary_max) }}
                                                            @else
                                                                Not specified
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 d-flex flex-column justify-content-between align-items-end">
                                                    <div class="job-tags text-end">
                                                        <span class="job-tag">{{ $job->category }}</span>
                                                    </div>
                                                    <div class="mt-3">
                                                        <div class="job-deadline mb-2">
                                                            <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($job->deadline)->diffForHumans() }}
                                                        </div>
                                                        <a href="{{ route('job-listings.show', $job->id) }}" class="btn btn-sm btn-primary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <!-- Pagination -->
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $jobs->links() }}
                                </div>
                            @else
                                <div class="alert alert-info">
                                    No jobs available from this employer at the moment.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Company Stats -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h3 class="h5 mb-4">Company Statistics</h3>
                            <div class="row text-center">
                                <div class="col-6 mb-3">
                                    <div class="h3 text-primary mb-1">{{ $jobs->total() }}</div>
                                    <p class="text-muted small mb-0">Active Jobs</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="h3 text-primary mb-1">{{ $employer->created_at->diffInMonths() + 1 }}</div>
                                    <p class="text-muted small mb-0">Months on Job Board</p>
                                </div>
                                <div class="col-6">
                                    <div class="h3 text-primary mb-1">{{ $jobCategories->count() }}</div>
                                    <p class="text-muted small mb-0">Job Categories</p>
                                </div>
                                <div class="col-6">
                                    <div class="h3 text-primary mb-1">{{ $jobLocations->count() }}</div>
                                    <p class="text-muted small mb-0">Locations</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Job Categories -->
                    @if($jobCategories->count() > 0)
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-4">
                                <h3 class="h5 mb-4">Job Categories</h3>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($jobCategories as $category => $count)
                                        <a href="{{ route('job-listings.index', ['category' => $category, 'employer' => $employer->id]) }}" class="badge bg-light text-dark text-decoration-none p-2">
                                            {{ $category }} ({{ $count }})
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Job Locations -->
                    @if($jobLocations->count() > 0)
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-4">
                                <h3 class="h5 mb-4">Job Locations</h3>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($jobLocations as $location => $count)
                                        <a href="{{ route('job-listings.index', ['location' => $location, 'employer' => $employer->id]) }}" class="badge bg-light text-dark text-decoration-none p-2">
                                            {{ $location }} ({{ $count }})
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Similar Employers -->
                    @if($similarEmployers->count() > 0)
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h3 class="h5 mb-4">Similar Employers</h3>
                                @foreach($similarEmployers as $similarEmployer)
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0 me-3">
                                            @if($similarEmployer->company_logo)
                                                <img src="{{ asset('storage/' . $similarEmployer->company_logo) }}" alt="{{ $similarEmployer->company_name ?? $similarEmployer->name }}" class="rounded" style="width: 50px; height: 50px; object-fit: contain;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                    <i class="fas fa-building text-secondary"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="h6 mb-1">
                                                <a href="{{ route('employers.show', $similarEmployer->id) }}" class="text-decoration-none">{{ $similarEmployer->company_name ?? $similarEmployer->name }}</a>
                                            </h4>
                                            <p class="text-muted small mb-0">{{ $similarEmployer->jobs_count }} {{ Str::plural('job', $similarEmployer->jobs_count) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-4">Ready to Join {{ $employer->company_name ?? $employer->name }}?</h2>
            <p class="lead mb-4">Browse all available positions and find the perfect role for your skills and experience.</p>
            <a href="{{ route('job-listings.index', ['employer' => $employer->id]) }}" class="btn btn-light btn-lg">View All Jobs</a>
        </div>
    </section>
@endsection
