@extends('layouts.main')

@section('title', 'Welcome to Job Board')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" style="background: linear-gradient(rgba(13, 110, 253, 0.8), rgba(13, 110, 253, 0.9)), url('{{ asset('images/hero-bg.jpg') }}');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Find Your Dream Job Today</h1>
                    <p class="lead mb-4">Connect with top employers and find the perfect job opportunity that matches your skills and career goals.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('job-listings.index') }}" class="btn btn-light btn-lg">Browse Jobs</a>
                        @guest
                            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Sign Up</a>
                        @endguest
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('images/job-search.svg') }}" alt="Job Search" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="display-4 fw-bold text-primary mb-2">1000+</div>
                    <p class="h5">Job Opportunities</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="display-4 fw-bold text-primary mb-2">500+</div>
                    <p class="h5">Companies</p>
                </div>
                <div class="col-md-4">
                    <div class="display-4 fw-bold text-primary mb-2">10,000+</div>
                    <p class="h5">Candidates</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Why Choose Our Job Board?</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="mb-4">
                                <i class="fas fa-search fa-3x text-primary"></i>
                            </div>
                            <h3 class="h4">Easy Job Search</h3>
                            <p class="text-muted">Find the perfect job with our advanced search and filtering options.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="mb-4">
                                <i class="fas fa-building fa-3x text-primary"></i>
                            </div>
                            <h3 class="h4">Top Companies</h3>
                            <p class="text-muted">Connect with leading companies across various industries.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="mb-4">
                                <i class="fas fa-mobile-alt fa-3x text-primary"></i>
                            </div>
                            <h3 class="h4">Mobile Friendly</h3>
                            <p class="text-muted">Search and apply for jobs on any device, anytime, anywhere.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">How It Works</h2>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 60px; height: 60px;">
                                <span class="h4 mb-0">1</span>
                            </div>
                            <h3 class="h5">Create an Account</h3>
                            <p class="text-muted small">Sign up as a job seeker or employer to get started.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 60px; height: 60px;">
                                <span class="h4 mb-0">2</span>
                            </div>
                            <h3 class="h5">Complete Your Profile</h3>
                            <p class="text-muted small">Add your resume, skills, and experience to stand out.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 60px; height: 60px;">
                                <span class="h4 mb-0">3</span>
                            </div>
                            <h3 class="h5">Search Jobs</h3>
                            <p class="text-muted small">Browse and filter jobs that match your skills and interests.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 60px; height: 60px;">
                                <span class="h4 mb-0">4</span>
                            </div>
                            <h3 class="h5">Apply & Get Hired</h3>
                            <p class="text-muted small">Submit applications and land your dream job.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">What Our Users Say</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="fas fa-quote-left fa-2x text-primary opacity-50"></i>
                            </div>
                            <p class="mb-4">"I found my dream job within two weeks of signing up. The platform is easy to use and has great job listings."</p>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <span>JS</span>
                                </div>
                                <div>
                                    <h5 class="mb-0">John Smith</h5>
                                    <p class="small text-muted mb-0">Software Developer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="fas fa-quote-left fa-2x text-primary opacity-50"></i>
                            </div>
                            <p class="mb-4">"As an employer, I've found exceptional talent through this platform. The quality of candidates is outstanding."</p>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <span>SJ</span>
                                </div>
                                <div>
                                    <h5 class="mb-0">Sarah Johnson</h5>
                                    <p class="small text-muted mb-0">HR Manager</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="fas fa-quote-left fa-2x text-primary opacity-50"></i>
                            </div>
                            <p class="mb-4">"The job search filters helped me find exactly what I was looking for. I'm now working at my ideal company."</p>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <span>MB</span>
                                </div>
                                <div>
                                    <h5 class="mb-0">Michael Brown</h5>
                                    <p class="small text-muted mb-0">UX Designer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-4">Ready to Find Your Dream Job?</h2>
            <p class="lead mb-4">Join thousands of job seekers who have found success with our platform.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('job-listings.index') }}" class="btn btn-light btn-lg">Browse Jobs</a>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Sign Up Now</a>
                @endguest
            </div>
        </div>
    </section>
@endsection
