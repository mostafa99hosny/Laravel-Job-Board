@extends('layouts.main')

@section('title', 'Browse Jobs')

@section('content')
    <!-- Page Header -->
    <section class="bg-primary text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="mb-0">Browse Jobs</h1>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-md-end mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Home</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Jobs</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Job Listings Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Filters Sidebar -->
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Filter Jobs</h5>
                            <form action="{{ route('job-listings.index') }}" method="GET">
                                <div class="mb-3">
                                    <label for="search" class="form-label">Keywords</label>
                                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Job title or keywords">
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" value="{{ request('location') }}" placeholder="City or remote">
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select" id="category" name="category">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="type" class="form-label">Job Type</label>
                                    <select class="form-select" id="type" name="type">
                                        <option value="">All Types</option>
                                        @foreach($jobTypes as $type)
                                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="sort" class="form-label">Sort By</label>
                                    <select class="form-select" id="sort" name="sort">
                                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Newest</option>
                                        <option value="deadline" {{ request('sort') == 'deadline' ? 'selected' : '' }}>Deadline</option>
                                        <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title</option>
                                    </select>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                                </div>

                                @if(request()->anyFilled(['search', 'location', 'category', 'type', 'sort']))
                                    <div class="d-grid mt-2">
                                        <a href="{{ route('job-listings.index') }}" class="btn btn-outline-secondary">Clear Filters</a>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Job Listings -->
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <p class="mb-0">Showing {{ $jobs->firstItem() ?? 0 }} - {{ $jobs->lastItem() ?? 0 }} of {{ $jobs->total() }} jobs</p>

                        <div class="btn-group">
                            <a href="{{ request()->fullUrlWithQuery(['view' => 'grid']) }}" class="btn btn-outline-primary {{ request('view') != 'list' ? 'active' : '' }}">
                                <i class="fas fa-th-large"></i>
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['view' => 'list']) }}" class="btn btn-outline-primary {{ request('view') == 'list' ? 'active' : '' }}">
                                <i class="fas fa-list"></i>
                            </a>
                        </div>
                    </div>

                    @if(request('view') == 'list')
                        <!-- List View -->
                        <div class="job-listings-list">
                            @forelse($jobs as $job)
                                <div class="job-card mb-4">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="d-flex">
                                                @if($job->company_logo)
                                                    <img src="{{ asset('storage/' . $job->company_logo) }}" alt="{{ $job->employer->company_name ?? $job->employer->name }}" class="company-logo me-3">
                                                @else
                                                    <div class="company-logo me-3 d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-building fa-2x text-secondary"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h3 class="job-title mb-1">
                                                        <a href="{{ route('job-listings.show', $job->id) }}">{{ $job->title }}</a>
                                                    </h3>
                                                    <p class="company-name mb-2">{{ $job->employer->company_name ?? $job->employer->name }}</p>

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
                                                <a href="{{ route('job-listings.show', $job->id) }}" class="btn btn-primary">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info">
                                    No jobs found matching your criteria. Try adjusting your filters.
                                </div>
                            @endforelse
                        </div>
                    @else
                        <!-- Grid View -->
                        <div class="row">
                            @forelse($jobs as $job)
                                <div class="col-md-6 mb-4">
                                    <div class="job-card h-100">
                                        <div class="d-flex align-items-center mb-3">
                                            @if($job->company_logo)
                                                <img src="{{ asset('storage/' . $job->company_logo) }}" alt="{{ $job->employer->company_name ?? $job->employer->name }}" class="company-logo me-3">
                                            @else
                                                <div class="company-logo me-3 d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-building fa-2x text-secondary"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h3 class="job-title mb-1">
                                                    <a href="{{ route('job-listings.show', $job->id) }}">{{ $job->title }}</a>
                                                </h3>
                                                <p class="company-name mb-0">{{ $job->employer->company_name ?? $job->employer->name }}</p>
                                            </div>
                                        </div>

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

                                        <div class="job-tags">
                                            <span class="job-tag">{{ $job->category }}</span>
                                        </div>

                                        <div class="job-actions">
                                            <a href="{{ route('job-listings.show', $job->id) }}" class="btn btn-sm btn-primary">View Details</a>
                                            <div class="job-deadline">
                                                <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($job->deadline)->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        No jobs found matching your criteria. Try adjusting your filters.
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    @endif

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $jobs->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
