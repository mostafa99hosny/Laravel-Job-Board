@extends('layouts.main')

@section('title', $job->title)

@section('content')
    <!-- Page Header -->
    <section class="job-detail-hero py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('job-listings.index') }}">Jobs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($job->title, 30) }}</li>
                        </ol>
                    </nav>
                    <h1 class="display-5 fw-bold mb-3 text-white">{{ $job->title }}</h1>
                    <p class="lead text-white-50 mb-4">{{ $job->employer->company_name ?? $job->employer->name }}</p>

                    <div class="d-flex flex-wrap mb-4">
                        <div class="job-detail-badge me-3 mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i> {{ $job->location }}
                        </div>
                        <div class="job-detail-badge me-3 mb-2">
                            <i class="fas fa-briefcase me-2"></i> {{ ucfirst($job->type) }}
                        </div>
                        <div class="job-detail-badge me-3 mb-2">
                            <i class="fas fa-money-bill-wave me-2"></i>
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

                    <div class="d-flex flex-wrap">
                        <span class="badge bg-primary me-2 mb-2 py-2 px-3">{{ $job->category }}</span>
                        <span class="badge bg-danger me-2 mb-2 py-2 px-3">
                            <i class="fas fa-clock me-1"></i> Deadline: {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}
                        </span>
                        @if($job->remote)
                            <span class="badge bg-success me-2 mb-2 py-2 px-3">
                                <i class="fas fa-home me-1"></i> Remote
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block text-center">
                    <img src="https://img.freepik.com/free-vector/job-interview-concept-illustration_114360-2156.jpg" alt="Job Application" class="img-fluid job-detail-hero-image animate__animated animate__fadeInRight">
                </div>
            </div>
        </div>
        <div class="job-detail-hero-shape-divider">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,133.3C672,139,768,181,864,181.3C960,181,1056,139,1152,122.7C1248,107,1344,117,1392,122.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>

    <!-- Job Detail Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Job Details -->
                <div class="col-lg-8">
                    <!-- Job Header -->
                    <div class="job-detail-header mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-2 text-center mb-3 mb-md-0">
                                @if($job->company_logo)
                                    <img src="{{ asset('storage/' . $job->company_logo) }}" alt="{{ $job->employer->company_name ?? $job->employer->name }}" class="company-logo">
                                @else
                                    <div class="company-logo d-flex align-items-center justify-content-center">
                                        <i class="fas fa-building fa-3x text-secondary"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-10">
                                <h1 class="h2 mb-2">{{ $job->title }}</h1>
                                <p class="mb-3 text-muted">{{ $job->employer->company_name ?? $job->employer->name }}</p>

                                <div class="d-flex flex-wrap">
                                    <div class="me-4 mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-1"></i> {{ $job->location }}
                                    </div>
                                    <div class="me-4 mb-2">
                                        <i class="fas fa-briefcase text-primary me-1"></i> {{ ucfirst($job->type) }}
                                    </div>
                                    <div class="me-4 mb-2">
                                        <i class="fas fa-money-bill-wave text-primary me-1"></i>
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
                                    <div class="mb-2">
                                        <i class="fas fa-calendar-alt text-primary me-1"></i> Posted {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <span class="badge bg-primary">{{ $job->category }}</span>
                                    <span class="badge bg-danger ms-2">Deadline: {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Description -->
                    <div class="job-detail-content mb-4">
                        <div class="row">
                            <div class="col-md-8">
                                <h3 class="mb-4">Job Description</h3>
                                <div class="job-description">
                                    {!! nl2br(e($job->description)) !!}
                                </div>

                                <!-- Job Requirements Section -->
                                <div class="job-requirements mt-5">
                                    <h4 class="mb-3"><i class="fas fa-clipboard-list text-primary me-2"></i> Requirements</h4>
                                    <ul class="job-requirements-list">
                                        <li>Bachelor's degree in relevant field</li>
                                        <li>{{ rand(2, 5) }}+ years of experience in similar role</li>
                                        <li>Strong communication and teamwork skills</li>
                                        <li>Problem-solving abilities and attention to detail</li>
                                        <li>Ability to work independently and meet deadlines</li>
                                    </ul>
                                </div>

                                <!-- Job Benefits Section -->
                                <div class="job-benefits mt-5">
                                    <h4 class="mb-3"><i class="fas fa-gift text-primary me-2"></i> Benefits</h4>
                                    <ul class="job-benefits-list">
                                        <li>Competitive salary package</li>
                                        <li>Health insurance and retirement plans</li>
                                        <li>Flexible working hours</li>
                                        <li>Professional development opportunities</li>
                                        <li>Friendly and collaborative work environment</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 d-none d-md-block">
                                <img src="https://img.freepik.com/free-vector/employees-cv-candidates-resume-corporate_335657-4370.jpg" alt="Job Application Process" class="img-fluid rounded-custom shadow-sm mt-5">
                                <div class="text-center mt-4">
                                    <h5 class="text-primary">Ready to Apply?</h5>
                                    <p class="text-muted">Submit your application today and take the next step in your career journey.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Apply Section -->
                        <div class="apply-section mt-5">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <h3 class="text-white mb-3">Ready to Apply for This Position?</h3>
                                    <p class="text-white-50 mb-0">Submit your application now and take the next step in your career journey. Our hiring team reviews all applications promptly.</p>
                                </div>
                                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                                    <a href="#apply-now" class="btn btn-light btn-lg px-4">Apply Now <i class="fas fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Similar Jobs -->
                    @if(isset($similarJobs) && $similarJobs->count() > 0)
                        <div class="similar-jobs mt-5">
                            <h3 class="mb-4">Similar Jobs</h3>
                            <div class="row">
                                @foreach($similarJobs as $similarJob)
                                    <div class="col-md-6 mb-4">
                                        <div class="job-card h-100">
                                            <div class="d-flex align-items-center mb-3">
                                                @if($similarJob->company_logo)
                                                    <img src="{{ asset('storage/' . $similarJob->company_logo) }}" alt="{{ $similarJob->employer->company_name ?? $similarJob->employer->name }}" class="company-logo me-3" style="width: 50px; height: 50px;">
                                                @else
                                                    <div class="company-logo me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                        <i class="fas fa-building text-secondary"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h4 class="h6 mb-1">
                                                        <a href="{{ route('job-listings.show', $similarJob->id) }}">{{ $similarJob->title }}</a>
                                                    </h4>
                                                    <p class="small text-muted mb-0">{{ $similarJob->employer->company_name ?? $similarJob->employer->name }}</p>
                                                </div>
                                            </div>
                                            <div class="small mb-2">
                                                <i class="fas fa-map-marker-alt text-primary me-1"></i> {{ $similarJob->location }}
                                            </div>
                                            <a href="{{ route('job-listings.show', $similarJob->id) }}" class="btn btn-sm btn-outline-primary">View Job</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Apply Button -->
                    <div class="job-detail-sidebar mb-4" id="apply-now">
                        <div class="text-center mb-4">
                            <img src="https://img.freepik.com/free-vector/online-resume-concept-illustration_114360-5164.jpg" alt="Apply Now" class="img-fluid rounded-custom mb-3" style="max-width: 200px;">
                            <h3 class="h5 mb-2">Apply for this Job</h3>
                            <p class="text-muted small">Application takes less than 5 minutes</p>
                        </div>

                        @auth
                            @if(auth()->user()->role === 'candidate')
                                @php
                                    $hasApplied = auth()->user()->applications()->where('job_id', $job->id)->exists();
                                @endphp

                                @if($hasApplied)
                                    <div class="alert alert-info border-0 shadow-sm">
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <i class="fas fa-check-circle fa-2x text-primary"></i>
                                            </div>
                                            <div>
                                                <h5 class="alert-heading mb-1">Application Submitted</h5>
                                                <p class="mb-0">You have already applied for this job. You can check the status in your dashboard.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid mt-3">
                                        <a href="{{ route('candidate.job-applications.index') }}" class="btn btn-outline-primary">
                                            <i class="fas fa-clipboard-list me-2"></i> View My Applications
                                        </a>
                                    </div>
                                @else
                                    @if(\Carbon\Carbon::now()->gt($job->deadline))
                                        <div class="alert alert-warning border-0 shadow-sm">
                                            <div class="d-flex">
                                                <div class="me-3">
                                                    <i class="fas fa-exclamation-circle fa-2x text-warning"></i>
                                                </div>
                                                <div>
                                                    <h5 class="alert-heading mb-1">Deadline Passed</h5>
                                                    <p class="mb-0">The application deadline for this job has passed on {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-grid mt-3">
                                            <a href="{{ route('job-listings.index') }}" class="btn btn-outline-primary">
                                                <i class="fas fa-search me-2"></i> Browse Similar Jobs
                                            </a>
                                        </div>
                                    @else
                                        @if(!auth()->user()->resume_path)
                                            <div class="alert alert-warning border-0 shadow-sm mb-3">
                                                <div class="d-flex">
                                                    <div class="me-3">
                                                        <i class="fas fa-exclamation-circle fa-2x text-warning"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="alert-heading mb-1">Resume Required</h5>
                                                        <p class="mb-0">You need to upload your resume before applying for this job.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('candidate.profile.update') }}" method="POST" enctype="multipart/form-data" class="job-application-form">
                                                @csrf
                                                @method('PATCH')
                                                <div class="mb-3">
                                                    <label for="resume" class="form-label">Upload Resume</label>
                                                    <div class="custom-file-upload">
                                                        <input type="file" class="form-control" id="resume" name="resume" required hidden>
                                                        <label for="resume" class="custom-file-label">
                                                            <i class="fas fa-upload me-2"></i> Choose file
                                                        </label>
                                                    </div>
                                                    <div class="form-text">Upload your resume in PDF format. Max size: 5MB.</div>
                                                </div>
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary btn-lg">
                                                        <i class="fas fa-file-upload me-2"></i> Upload Resume
                                                    </button>
                                                </div>
                                                <div class="text-center mt-3">
                                                    <a href="{{ route('candidate.profile') }}" class="text-primary">
                                                        <i class="fas fa-user-edit me-1"></i> Go to profile to upload more details
                                                    </a>
                                                </div>
                                            </form>
                                        @else
                                            <form action="{{ route('job-listings.apply', $job->id) }}" method="POST" id="job-application-form" class="job-application-form">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="message" class="form-label">Cover Letter (Optional)</label>
                                                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Tell the employer why you're a good fit for this position..." data-max-chars="1000"></textarea>
                                                </div>
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary btn-lg btn-submit">
                                                        <i class="fas fa-paper-plane me-2"></i> Submit Application
                                                    </button>
                                                </div>
                                                <div class="mt-3 p-3 bg-light rounded-3">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-file-pdf fa-2x text-danger me-3"></i>
                                                        <div>
                                                            <h6 class="mb-1">Your Resume</h6>
                                                            <p class="mb-0 small">Your resume will be attached to this application</p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2 d-flex justify-content-between">
                                                        <a href="{{ asset('storage/' . auth()->user()->resume_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-eye me-1"></i> View Resume
                                                        </a>
                                                        <a href="{{ route('candidate.profile') }}" class="btn btn-sm btn-outline-secondary">
                                                            <i class="fas fa-edit me-1"></i> Update Resume
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="application-tips mt-4">
                                                    <h5><i class="fas fa-lightbulb me-2"></i> Application Tips</h5>
                                                    <ul>
                                                        <li>Tailor your cover letter to the job description</li>
                                                        <li>Highlight relevant skills and experience</li>
                                                        <li>Keep your application concise and professional</li>
                                                        <li>Proofread before submitting</li>
                                                    </ul>
                                                </div>
                                            </form>
                                        @endif
                                    @endif
                                @endif
                            @elseif(auth()->user()->role === 'employer')
                                <div class="alert alert-info border-0 shadow-sm">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="fas fa-info-circle fa-2x text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="alert-heading mb-1">Employer Account</h5>
                                            <p class="mb-0">You are logged in as an employer and cannot apply for jobs.</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-info border-0 shadow-sm">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="fas fa-info-circle fa-2x text-primary"></i>
                                        </div>
                                        <div>
                                            <h5 class="alert-heading mb-1">Admin Account</h5>
                                            <p class="mb-0">You are logged in as an admin and cannot apply for jobs.</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="alert alert-info border-0 shadow-sm mb-4">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <i class="fas fa-info-circle fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h5 class="alert-heading mb-1">Login Required</h5>
                                        <p class="mb-0">You need to login as a candidate to apply for this job.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-3">
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i> Login to Apply
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-user-plus me-2"></i> Register as Candidate
                                </a>
                            </div>

                            <div class="mt-4 text-center">
                                <img src="https://img.freepik.com/free-vector/sign-concept-illustration_114360-5267.jpg" alt="Sign Up" class="img-fluid rounded-custom" style="max-width: 200px;">
                            </div>
                        @endauth
                    </div>

                    <!-- Company Info -->
                    <div class="job-detail-sidebar mb-4">
                        <div class="company-info">
                            <div class="text-center mb-4">
                                @if($job->company_logo)
                                    <img src="{{ asset('storage/' . $job->company_logo) }}" alt="{{ $job->employer->company_name ?? $job->employer->name }}" class="company-logo mb-3">
                                @else
                                    <div class="company-logo-placeholder mb-3">
                                        <i class="fas fa-building text-primary"></i>
                                    </div>
                                @endif
                                <h4 class="h5 mb-2">{{ $job->employer->company_name ?? $job->employer->name }}</h4>
                                <p class="text-muted small mb-3">{{ $job->employer->industry ?? 'Technology' }}</p>

                                <div class="company-social-links mb-3">
                                    <a href="#" class="social-link" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#" class="social-link" title="Twitter"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="social-link" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                                    @if($job->employer->website)
                                        <a href="{{ $job->employer->website }}" target="_blank" class="social-link" title="Website"><i class="fas fa-globe"></i></a>
                                    @endif
                                </div>
                            </div>

                            @if($job->employer->bio)
                                <div class="company-description mb-4">
                                    <h5 class="mb-3"><i class="fas fa-info-circle text-primary me-2"></i> About the Company</h5>
                                    <p>{{ $job->employer->bio }}</p>
                                </div>
                            @endif

                            <div class="company-details mb-4">
                                <div class="company-detail-item">
                                    <div class="icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="content">
                                        <h6>Location</h6>
                                        <p>{{ $job->employer->location ?? $job->location }}</p>
                                    </div>
                                </div>

                                <div class="company-detail-item">
                                    <div class="icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="content">
                                        <h6>Company Size</h6>
                                        <p>{{ rand(50, 500) }}+ Employees</p>
                                    </div>
                                </div>

                                <div class="company-detail-item">
                                    <div class="icon">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <div class="content">
                                        <h6>Open Positions</h6>
                                        <p>{{ rand(3, 15) }} Jobs</p>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid">
                                <a href="{{ route('job-listings.index', ['employer' => $job->employer_id]) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-briefcase me-2"></i> View All Jobs by this Employer
                                </a>
                            </div>

                            <div class="mt-4 text-center">
                                <img src="https://img.freepik.com/free-vector/company-concept-illustration_114360-2581.jpg" alt="Company" class="img-fluid rounded-custom" style="max-width: 200px;">
                            </div>
                        </div>
                    </div>

                    <!-- Job Details Summary -->
                    <div class="job-detail-sidebar">
                        <h3 class="h5 mb-4">Job Details</h3>

                        <div class="mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-calendar-alt text-primary fa-fw fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Date Posted</h6>
                                    <p class="text-muted">{{ \Carbon\Carbon::parse($job->created_at)->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-hourglass-end text-primary fa-fw fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Application Deadline</h6>
                                    <p class="text-muted">{{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-map-marker-alt text-primary fa-fw fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Location</h6>
                                    <p class="text-muted">{{ $job->location }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-briefcase text-primary fa-fw fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Job Type</h6>
                                    <p class="text-muted">{{ ucfirst($job->type) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-money-bill-wave text-primary fa-fw fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Salary Range</h6>
                                    <p class="text-muted">
                                        @if($job->salary_min && $job->salary_max)
                                            ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                                        @elseif($job->salary_min)
                                            From ${{ number_format($job->salary_min) }}
                                        @elseif($job->salary_max)
                                            Up to ${{ number_format($job->salary_max) }}
                                        @else
                                            Not specified
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-tag text-primary fa-fw fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Category</h6>
                                    <p class="text-muted">{{ $job->category }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
