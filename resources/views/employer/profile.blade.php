@extends('layouts.main')

@section('title', 'Employer Profile')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Employer Profile</h1>
        <a href="{{ route('employer.dashboard') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
        </a>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <!-- Company Profile Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title mb-0"><i class="fas fa-building me-2 text-primary"></i>Company Profile</h5>
                </div>
                <div class="card-body text-center p-4">
                    <div class="company-logo-wrapper mb-4">
                        @if($employer->company_logo)
                            <img src="{{ asset('storage/' . $employer->company_logo) }}" alt="{{ $employer->company_name }}" class="img-fluid rounded-circle border p-1" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="avatar-placeholder bg-light rounded-circle border d-flex align-items-center justify-content-center mx-auto" style="width: 150px; height: 150px;">
                                <span class="display-4 text-primary fw-bold">{{ substr($employer->company_name ?? $employer->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <h4 class="fw-bold">{{ $employer->company_name ?? $employer->name }}</h4>
                    <p class="text-muted mb-3">
                        <i class="fas fa-envelope me-2"></i>{{ $employer->email }}
                    </p>

                    @if($employer->website)
                        <p class="mb-4">
                            <a href="{{ $employer->website }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                <i class="fas fa-globe me-1"></i> Visit Website
                            </a>
                        </p>
                    @endif

                    @if($employer->bio)
                        <div class="mt-4 text-start p-3 bg-light rounded">
                            <h6 class="border-bottom pb-2 mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>About Us</h6>
                            <p class="text-muted">{{ $employer->bio }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Account Stats Card -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title mb-0"><i class="fas fa-chart-bar me-2 text-primary"></i>Account Stats</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <span><i class="fas fa-briefcase me-2 text-muted"></i>Active Jobs</span>
                            <span class="badge bg-primary rounded-pill">{{ \App\Models\Job::where('employer_id', $employer->id)->where('is_approved', true)->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <span><i class="fas fa-users me-2 text-muted"></i>Total Applications</span>
                            <span class="badge bg-primary rounded-pill">{{ \App\Models\Application::whereHas('job', function($q) use ($employer) { $q->where('employer_id', $employer->id); })->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <span><i class="fas fa-calendar-alt me-2 text-muted"></i>Member Since</span>
                            <span class="text-muted">{{ $employer->created_at->format('M Y') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0"><i class="fas fa-edit me-2 text-primary"></i>Edit Profile</h5>
                    <span class="badge bg-light text-primary">Employer Account</span>
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

                    <form action="{{ route('employer.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Personal Information Section -->
                        <div class="mb-4">
                            <h6 class="text-muted mb-3 pb-2 border-bottom"><i class="fas fa-user me-2"></i>Personal Information</h6>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $employer->name) }}" required>
                                    </div>
                                    @error('name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $employer->email) }}" required>
                                    </div>
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Company Information Section -->
                        <div class="mb-4">
                            <h6 class="text-muted mb-3 pb-2 border-bottom"><i class="fas fa-building me-2"></i>Company Information</h6>

                            <div class="mb-3">
                                <label for="company_name" class="form-label">Company Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-building"></i></span>
                                    <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name', $employer->company_name) }}" required>
                                </div>
                                @error('company_name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="website" class="form-label">Company Website</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                    <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website', $employer->website) }}" placeholder="https://example.com">
                                </div>
                                @error('website')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Enter your company website URL (e.g., https://example.com)</div>
                            </div>

                            <div class="mb-3">
                                <label for="bio" class="form-label">About Your Company</label>
                                <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="4" placeholder="Tell candidates about your company, culture, and what makes you unique...">{{ old('bio', $employer->bio) }}</textarea>
                                @error('bio')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                <div class="form-text">This description will be visible to job seekers. Limit: 1000 characters.</div>
                            </div>
                        </div>

                        <!-- Company Logo Section -->
                        <div class="mb-4">
                            <h6 class="text-muted mb-3 pb-2 border-bottom"><i class="fas fa-image me-2"></i>Company Logo</h6>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="company_logo" class="form-label">Upload Logo</label>
                                        <input type="file" class="form-control @error('company_logo') is-invalid @enderror" id="company_logo" name="company_logo">
                                        @error('company_logo')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            <ul class="mb-0 ps-3 small">
                                                <li>Recommended size: 200x200 pixels</li>
                                                <li>Maximum file size: 2MB</li>
                                                <li>Supported formats: JPG, PNG, GIF</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <div class="logo-preview border rounded p-2 d-flex align-items-center justify-content-center" style="height: 120px; width: 120px; margin: 0 auto;">
                                            @if($employer->company_logo)
                                                <img src="{{ asset('storage/' . $employer->company_logo) }}" alt="Current Logo" class="img-fluid" style="max-height: 100px; max-width: 100px;">
                                            @else
                                                <div class="text-muted small">
                                                    <i class="fas fa-image fa-2x mb-2"></i>
                                                    <p class="mb-0">No logo uploaded</p>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="small text-muted mt-2">Current Logo</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between border-top pt-4 mt-4">
                            <a href="{{ route('employer.dashboard') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Logo preview functionality
    document.addEventListener('DOMContentLoaded', function() {
        const logoInput = document.getElementById('company_logo');
        const logoPreview = document.querySelector('.logo-preview');

        logoInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    logoPreview.innerHTML = `
                        <div class="border rounded p-2 d-flex align-items-center justify-content-center" style="height: 120px; width: 120px; margin: 0 auto;">
                            <img src="${e.target.result}" alt="Logo Preview" class="img-fluid" style="max-height: 100px; max-width: 100px;">
                        </div>
                        <p class="small text-muted mt-2">New Logo Preview</p>
                    `;
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endpush
