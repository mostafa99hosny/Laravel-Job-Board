@extends('layouts.main')

@section('title', 'Contact Us')

@section('content')
    <!-- Page Header -->
    <section class="bg-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 fw-bold mb-4">Contact Us</h1>
                    <p class="lead mb-0">Have questions or feedback? We'd love to hear from you.</p>
                </div>
                <div class="col-md-6 d-none d-md-block text-end">
                    <i class="fas fa-envelope fa-5x text-white-50"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="h3 mb-4">Send Us a Message</h2>
                            
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            
                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Your Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" required>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h3 class="h4 mb-4">Contact Information</h3>
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-map-marker-alt text-primary fa-fw fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Address</h6>
                                    <p class="text-muted mb-0">123 Job Street, Employment City, 12345</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-phone text-primary fa-fw fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Phone</h6>
                                    <p class="text-muted mb-0">(123) 456-7890</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-envelope text-primary fa-fw fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Email</h6>
                                    <p class="text-muted mb-0">info@jobboard.com</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-clock text-primary fa-fw fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Working Hours</h6>
                                    <p class="text-muted mb-0">Monday - Friday: 9:00 AM - 5:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="h4 mb-4">Connect With Us</h3>
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 40px; height: 40px;">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 40px; height: 40px;">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 40px; height: 40px;">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 40px; height: 40px;">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="ratio ratio-21x9">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.30591910525!2d-74.25986432970718!3d40.697149422113014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1625124127903!5m2!1sen!2s" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Frequently Asked Questions</h2>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item border-0 mb-3 shadow-sm">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    How do I create an account?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    To create an account, click on the "Register" button in the top right corner of the page. You'll be asked to provide some basic information and choose whether you're a job seeker or an employer.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-3 shadow-sm">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    How do I post a job listing?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    To post a job listing, you need to register as an employer. Once logged in, go to your dashboard and click on "Post a Job". Fill out the job details form and submit it for review.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 mb-3 shadow-sm">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    How do I apply for a job?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    To apply for a job, you need to register as a job seeker. Once logged in, browse the job listings and click on "Apply" for the job you're interested in. You'll need to upload your resume and possibly answer some additional questions.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 shadow-sm">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Is it free to use this platform?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, our platform is free for job seekers. Employers can post a limited number of job listings for free, with premium options available for additional features and visibility.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
