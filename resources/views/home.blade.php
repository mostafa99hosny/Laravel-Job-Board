@extends('layouts.main')

@section('title', 'Find Your Dream Job')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="mb-4 animate__animated animate__fadeInUp">Find Your Dream Job Today</h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">Thousands of jobs in the <span class="highlight">technology</span>, <span class="highlight">finance</span>, <span class="highlight">education</span>, and <span class="highlight">healthcare</span> sectors are waiting for you.</p>
                    <div class="d-flex flex-wrap mb-4 animate__animated animate__fadeInUp animate__delay-2s">
                        <p class="me-4 mb-2"><i class="fas fa-check-circle text-light me-2"></i> Thousands of jobs</p>
                        <p class="me-4 mb-2"><i class="fas fa-check-circle text-light me-2"></i> Apply with one click</p>
                        <p class="mb-2"><i class="fas fa-check-circle text-light me-2"></i> 100% free</p>
                    </div>
                    <a href="{{ route('job-listings.index') }}" class="btn btn-light btn-lg rounded-pill px-4 animate__animated animate__fadeInUp animate__delay-3s">
                        <i class="fas fa-search me-2"></i> Browse All Jobs
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="search-form animate__animated animate__fadeInRight">
                        <h5 class="mb-3 text-white">Quick Job Search</h5>
                        <form action="{{ route('job-listings.index') }}" method="GET" id="job-search-form">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="search" class="form-label text-white">What</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-0"><i class="fas fa-search text-primary"></i></span>
                                        <input type="text" name="search" id="search" class="form-control form-control-lg border-0" placeholder="Job title, keywords, or company">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="location" class="form-label text-white">Where</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-0"><i class="fas fa-map-marker-alt text-primary"></i></span>
                                        <input type="text" name="location" id="location" class="form-control border-0" placeholder="Location">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="category" class="form-label text-white">Category</label>
                                    <select name="category" id="category" class="form-select border-0">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}">{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-light btn-lg w-100 rounded-pill">
                                        <i class="fas fa-search me-2"></i> Find Jobs
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-shape-divider">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,133.3C672,139,768,181,864,181.3C960,181,1056,139,1152,122.7C1248,107,1344,117,1392,122.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-4">
        <div class="container">
            <div class="stats-container">
                <div class="row text-center">
                    <div class="col-md-3 col-6 stat-item">
                        <span class="stat-value" data-count="15000">0</span>
                        <span class="stat-label">Active Jobs</span>
                    </div>
                    <div class="col-md-3 col-6 stat-item">
                        <span class="stat-value" data-count="8500">0</span>
                        <span class="stat-label">Companies</span>
                    </div>
                    <div class="col-md-3 col-6 stat-item">
                        <span class="stat-value" data-count="45000">0</span>
                        <span class="stat-label">Job Seekers</span>
                    </div>
                    <div class="col-md-3 col-6 stat-item">
                        <span class="stat-value" data-count="12500">0</span>
                        <span class="stat-label">Jobs Filled</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Jobs Section -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-6">
                    <h2 class="fancy-heading mb-4">Featured Job Opportunities</h2>
                    <p class="text-muted">Discover top job opportunities from leading companies</p>
                </div>
                <div class="col-lg-6 text-lg-end d-flex align-items-center justify-content-lg-end">
                    <a href="{{ route('job-listings.index') }}" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-briefcase me-2"></i> View All Jobs
                    </a>
                </div>
            </div>

            <div class="row">
                @forelse($featuredJobs as $index => $job)
                    <div class="col-md-6 col-lg-4">
                        <div class="job-card animate-on-scroll" data-animation="fadeInUp" data-delay="{{ 0.1 * $index }}">
                            @if($index < 2)
                                <span class="featured-badge"><i class="fas fa-star"></i> Featured</span>
                            @endif

                            <div class="d-flex align-items-center mb-3">
                                @if($job->company_logo)
                                    <img src="{{ asset('storage/' . $job->company_logo) }}" alt="{{ $job->employer->company_name ?? $job->employer->name }}" class="company-logo me-3">
                                @else
                                    <div class="company-logo me-3 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-building fa-2x text-primary"></i>
                                    </div>
                                @endif
                                <div>
                                    <h3 class="job-title mb-1">
                                        <a href="{{ route('job-listings.show', $job->id) }}">{{ $job->title }}</a>
                                    </h3>
                                    <p class="company-name mb-0"><i class="fas fa-building me-1"></i> {{ $job->employer->company_name ?? $job->employer->name }}</p>
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

                            @if($job->description)
                                <div class="job-description">
                                    {{ Str::limit(strip_tags($job->description), 120) }}
                                </div>
                            @endif

                            <div class="job-tags">
                                <span class="job-tag">{{ $job->category }}</span>
                                @if($job->remote)
                                    <span class="job-tag">Remote</span>
                                @endif
                            </div>

                            <div class="job-actions">
                                <a href="{{ route('job-listings.show', $job->id) }}" class="btn btn-primary btn-apply">Apply Now <i class="fas fa-arrow-right"></i></a>
                                <div class="job-deadline">
                                    <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($job->deadline)->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info shadow-sm border-0 rounded-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle fa-2x me-3 text-primary"></i>
                                <div>
                                    <h5 class="mb-1">No Featured Jobs</h5>
                                    <p class="mb-0">No featured jobs available at this time. Please check back later or browse all jobs.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <img src="https://img.freepik.com/free-vector/job-interview-concept-illustration_114360-1946.jpg" alt="Job Application" class="img-fluid rounded-custom shadow-sm animate-on-scroll" data-animation="fadeInUp" style="max-width: 400px;">
            </div>
        </div>
    </section>

    <!-- Job Categories Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6 mx-auto text-center">
                    <h2 class="fancy-heading text-center mb-4">Popular Job Categories</h2>
                    <p class="text-muted">Explore jobs in the most popular categories across various industries</p>
                </div>
            </div>

            <div class="row g-4">
                @foreach($popularCategories as $category => $count)
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="feature-card text-center animate-on-scroll" data-animation="fadeInUp">
                            <div class="feature-icon mx-auto">
                                <i class="fas fa-{{ getCategoryIcon($category) }}"></i>
                            </div>
                            <h3 class="h5 mt-4">{{ $category }}</h3>
                            <p class="text-muted">{{ $count }} {{ Str::plural('job', $count) }} available</p>
                            <a href="{{ route('job-listings.index', ['category' => $category]) }}" class="btn btn-sm btn-outline-primary rounded-pill mt-2">
                                Browse Jobs <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="feature-image with-shape animate-on-scroll" data-animation="fadeInLeft">
                        <img src="https://img.freepik.com/free-vector/recruitment-agency-searching-candidates_1262-19920.jpg" alt="Job Categories" class="img-fluid rounded-custom">
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center">
                    <div class="ps-lg-4 animate-on-scroll" data-animation="fadeInRight">
                        <h3 class="mb-4">Find Jobs in Your Specialized Field</h3>
                        <p class="text-muted mb-4">Our job board features opportunities across all major industries and specializations. Whether you're looking for entry-level positions or executive roles, we have the perfect match for your skills and experience.</p>
                        <div class="row g-4 mb-4">
                            <div class="col-6">
                                <div class="d-flex">
                                    <div class="me-3 text-primary">
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Verified Employers</h5>
                                        <p class="text-muted mb-0">All employers are verified</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex">
                                    <div class="me-3 text-primary">
                                        <i class="fas fa-shield-alt fa-2x"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Secure Applications</h5>
                                        <p class="text-muted mb-0">Your data is protected</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('job-listings.index') }}" class="btn btn-primary rounded-pill px-4">
                            Explore All Categories <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Employers Section -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6 mx-auto text-center">
                    <h2 class="fancy-heading text-center mb-4">Featured Employers</h2>
                    <p class="text-muted">Connect with top companies hiring on our platform</p>
                </div>
            </div>

            <div class="row g-4">
                @foreach($featuredEmployers as $index => $employer)
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="employer-card {{ $index < 2 ? 'featured' : '' }} animate-on-scroll" data-animation="fadeInUp" data-delay="{{ 0.1 * $index }}">
                            @if($index < 2)
                                <span class="featured-badge"><i class="fas fa-star"></i> Featured</span>
                            @endif

                            @if($employer->company_logo)
                                <img src="{{ asset('storage/' . $employer->company_logo) }}" alt="{{ $employer->company_name ?? $employer->name }}" class="employer-logo">
                            @else
                                <div class="employer-logo d-flex align-items-center justify-content-center">
                                    <i class="fas fa-building fa-3x text-primary"></i>
                                </div>
                            @endif
                            <h3 class="employer-name">{{ $employer->company_name ?? $employer->name }}</h3>

                            <p class="employer-industry">
                                <i class="fas fa-industry"></i> {{ $employer->industry ?? 'Various Industries' }}
                            </p>

                            <p class="job-count">
                                <i class="fas fa-briefcase"></i> {{ $employer->jobs_count }} {{ Str::plural('job', $employer->jobs_count) }}
                            </p>

                            @if($employer->description)
                                <p class="employer-description">{{ Str::limit($employer->description, 100) }}</p>
                            @endif

                            <p class="employer-location">
                                <i class="fas fa-map-marker-alt"></i> {{ $employer->location ?? 'Multiple Locations' }}
                            </p>

                            <a href="{{ route('job-listings.index', ['employer' => $employer->id]) }}" class="btn btn-outline-primary">
                                View Jobs <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{ url('/employers') }}" class="btn btn-primary rounded-pill px-4 py-2">
                    View All Employers <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5 bg-light testimonial-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6 mx-auto text-center">
                    <h2 class="fancy-heading text-center mb-4">What Our Users Say</h2>
                    <p class="text-muted">Hear from people who found their dream jobs through our platform</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card h-100">
                        <div class="testimonial-content">
                            <p>"I found my dream job within just 2 weeks of using JobBoard. The platform is intuitive and has a great selection of opportunities."</p>
                        </div>
                        <div class="testimonial-author">
                            <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Sarah Johnson" class="author-avatar">
                            <div class="author-info">
                                <h4>Sarah Johnson</h4>
                                <p>Software Developer</p>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card h-100">
                        <div class="testimonial-content">
                            <p>"As an employer, JobBoard has helped us find qualified candidates quickly. The quality of applicants is much higher than other platforms we've used."</p>
                        </div>
                        <div class="testimonial-author">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael Chen" class="author-avatar">
                            <div class="author-info">
                                <h4>Michael Chen</h4>
                                <p>HR Director</p>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mx-auto">
                    <div class="testimonial-card h-100">
                        <div class="testimonial-content">
                            <p>"The job application process is so streamlined. I love how I can track all my applications in one place and communicate directly with employers."</p>
                        </div>
                        <div class="testimonial-author">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Emily Rodriguez" class="author-avatar">
                            <div class="author-info">
                                <h4>Emily Rodriguez</h4>
                                <p>Marketing Specialist</p>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6 mx-auto text-center">
                    <h2 class="fancy-heading text-center mb-4">How It Works</h2>
                    <p class="text-muted">Follow these simple steps to find your dream job</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card text-center animate-on-scroll" data-animation="fadeInUp" data-delay="0.1">
                        <div class="feature-icon mx-auto">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h3 class="h4 mt-4">1. Create an Account</h3>
                        <p class="text-muted">Sign up for free and create your professional profile with your skills and experience.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center animate-on-scroll" data-animation="fadeInUp" data-delay="0.2">
                        <div class="feature-icon mx-auto">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="h4 mt-4">2. Search Jobs</h3>
                        <p class="text-muted">Browse thousands of job listings or use filters to find the perfect match for your skills.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center animate-on-scroll" data-animation="fadeInUp" data-delay="0.3">
                        <div class="feature-icon mx-auto">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <h3 class="h4 mt-4">3. Apply & Get Hired</h3>
                        <p class="text-muted">Submit your application with just a few clicks and start your new career journey.</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <img src="https://img.freepik.com/free-vector/job-interview-process-concept-illustration_114360-2211.jpg" alt="Job Application Process" class="img-fluid rounded-custom shadow-sm animate-on-scroll" data-animation="fadeInUp" style="max-width: 600px;">
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-4">Ready to Start Your Career Journey?</h2>
                    <p>Join thousands of job seekers who have found their dream jobs through our platform. It's free and takes just a minute to get started.</p>
                    <div class="mt-5">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg me-3 mb-3 mb-md-0">
                            <i class="fas fa-user-plus me-2"></i> Create an Account
                        </a>
                        <a href="{{ route('job-listings.index') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-search me-2"></i> Browse Jobs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .hero-shape-divider {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
        transform: rotate(180deg);
    }

    .hero-shape-divider svg {
        position: relative;
        display: block;
        width: calc(100% + 1.3px);
        height: 70px;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation classes to elements
        const animateElements = document.querySelectorAll('.animate-on-scroll');
        if (animateElements.length > 0) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const animationType = entry.target.dataset.animation || 'fadeInUp';
                        const animationDelay = entry.target.dataset.delay || 0;

                        entry.target.style.animationDelay = `${animationDelay}s`;
                        entry.target.classList.add('animate__animated', `animate__${animationType}`);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            animateElements.forEach(element => {
                observer.observe(element);
            });
        }
    });
</script>
@endpush


