@extends('layouts.main')

@section('title', 'About Us')

@section('content')
    <!-- Page Header -->
    <section class="bg-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 fw-bold mb-4">About Us</h1>
                    <p class="lead mb-0">Learn more about our mission to connect talented professionals with great companies.</p>
                </div>
                <div class="col-md-6 d-none d-md-block text-end">
                    <i class="fas fa-users fa-5x text-white-50"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('images/about-us.jpg') }}" alt="Our Team" class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-6">
                    <h2 class="section-title">Our Story</h2>
                    <p class="mb-4">Job Board was founded in 2023 with a simple mission: to make the job search process easier and more efficient for both job seekers and employers.</p>
                    <p class="mb-4">What started as a small project has grown into a comprehensive platform that connects thousands of talented professionals with companies across various industries.</p>
                    <p>Our team of dedicated professionals works tirelessly to ensure that our platform provides the best possible experience for all users, whether they're looking for their dream job or searching for the perfect candidate.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Mission Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title text-center">Our Mission</h2>
                    <p class="lead">To create a seamless connection between job seekers and employers, making the recruitment process more efficient and effective for everyone involved.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                                <i class="fas fa-handshake fa-2x"></i>
                            </div>
                            <h3 class="h4 mb-3">Connect</h3>
                            <p class="text-muted">We connect talented professionals with companies that value their skills and experience.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                                <i class="fas fa-rocket fa-2x"></i>
                            </div>
                            <h3 class="h4 mb-3">Innovate</h3>
                            <p class="text-muted">We continuously improve our platform to provide the best possible experience for our users.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                            <h3 class="h4 mb-3">Empower</h3>
                            <p class="text-muted">We empower job seekers and employers with the tools and resources they need to succeed.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Meet Our Team</h2>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle overflow-hidden mx-auto mb-4" style="width: 150px; height: 150px;">
                                <img src="{{ asset('images/team-1.jpg') }}" alt="Team Member" class="img-fluid">
                            </div>
                            <h3 class="h5 mb-1">Omar Mahmoud</h3>
                            <p class="text-muted mb-3">CEO & Founder</p>
                            <div class="social-icons">
                                <a href="#" class="text-primary me-2"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="text-primary me-2"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="text-primary"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle overflow-hidden mx-auto mb-4" style="width: 150px; height: 150px;">
                                <img src="{{ asset('images/team-2.jpg') }}" alt="Team Member" class="img-fluid">
                            </div>
                            <h3 class="h5 mb-1">Mohamed Mustafa</h3>
                            <p class="text-muted mb-3">CTO</p>
                            <div class="social-icons">
                                <a href="#" class="text-primary me-2"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="text-primary me-2"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="text-primary"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle overflow-hidden mx-auto mb-4" style="width: 150px; height: 150px;">
                                <img src="{{ asset('images/team-3.jpg') }}" alt="Team Member" class="img-fluid">
                            </div>
                            <h3 class="h5 mb-1">Mostafa Hosny</h3>
                            <p class="text-muted mb-3">Head of Marketing</p>
                            <div class="social-icons">
                                <a href="#" class="text-primary me-2"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="text-primary me-2"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="text-primary"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle overflow-hidden mx-auto mb-4" style="width: 150px; height: 150px;">
                                <img src="{{ asset('images/team-4.jpg') }}" alt="Team Member" class="img-fluid">
                            </div>
                            <h3 class="h5 mb-1">Fady Ezzat</h3>
                            <p class="text-muted mb-3">Head of Operations</p>
                            <div class="social-icons">
                                <a href="#" class="text-primary me-2"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#" class="text-primary me-2"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="text-primary"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="display-4 fw-bold text-primary mb-2">5+</div>
                    <p class="h5">Years of Experience</p>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="display-4 fw-bold text-primary mb-2">10k+</div>
                    <p class="h5">Job Placements</p>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <div class="display-4 fw-bold text-primary mb-2">500+</div>
                    <p class="h5">Partner Companies</p>
                </div>
                <div class="col-md-3">
                    <div class="display-4 fw-bold text-primary mb-2">20+</div>
                    <p class="h5">Industry Sectors</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-4">Join Our Growing Community</h2>
            <p class="lead mb-4">Whether you're looking for your next career opportunity or searching for top talent, we're here to help.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('job-listings.index') }}" class="btn btn-light btn-lg">Browse Jobs</a>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">Sign Up Now</a>
                @endguest
            </div>
        </div>
    </section>
@endsection
