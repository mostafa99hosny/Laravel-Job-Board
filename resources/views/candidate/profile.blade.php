@extends('layouts.main')

@section('title', 'My Profile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/profile.js') }}"></script>
@endpush

@section('content')
<div class="container profile-container">
    <div class="profile-header">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>My Profile</h1>
            <a href="{{ route('candidate.dashboard') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <!-- Profile Card -->
            <div class="profile-card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-user me-2"></i>Profile Information</h5>
                </div>
                <div class="card-body text-center">
                    <div class="profile-image-container">
                        @if($candidate->profile_picture)
                            <img src="{{ asset('storage/' . $candidate->profile_picture) }}" alt="{{ $candidate->name }}" class="profile-image">
                        @else
                            <div class="avatar-placeholder">
                                {{ substr($candidate->name, 0, 1) }}
                            </div>
                        @endif
                        <label for="profile_picture_quick" class="profile-image-edit" title="Change profile picture">
                            <i class="fas fa-camera"></i>
                            <input type="file" id="profile_picture_quick" name="profile_picture_quick" style="display: none;"
                                onchange="document.getElementById('profile_picture').files = this.files; document.getElementById('profile_form').submit();">
                        </label>
                    </div>
                    <h4 class="profile-name">{{ $candidate->name }}</h4>
                    <p class="profile-email">{{ $candidate->email }}</p>

                    <div class="profile-info">
                        @if($candidate->phone)
                            <div class="profile-info-item">
                                <i class="fas fa-phone"></i>
                                <span>{{ $candidate->phone }}</span>
                            </div>
                        @endif

                        @if($candidate->location)
                            <div class="profile-info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $candidate->location }}</span>
                            </div>
                        @endif
                    </div>

                    @if($candidate->resume_path)
                        <div class="profile-actions">
                            <a href="{{ asset('storage/' . $candidate->resume_path) }}" class="btn btn-outline-primary" target="_blank">
                                <i class="fas fa-file-pdf me-2"></i> View Resume
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Skills Card -->
            @if($candidate->skills)
                <div class="profile-card">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0"><i class="fas fa-tools me-2"></i>Skills</h5>
                    </div>
                    <div class="card-body">
                        <div class="skills-container">
                            @foreach(explode(',', $candidate->skills) as $skill)
                                <span class="skill-badge">{{ trim($skill) }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Experience Preview -->
            @if($candidate->experience)
                <div class="profile-card">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0"><i class="fas fa-briefcase me-2"></i>Experience</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $candidate->experience }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-8">
            <div class="profile-card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-edit me-2"></i>Edit Profile</h5>
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

                    <form id="profile_form" action="{{ route('candidate.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Personal Information Section -->
                        <div class="form-section">
                            <h5 class="form-section-title">Personal Information</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $candidate->name) }}" required>
                                    </div>
                                    @error('name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $candidate->email) }}" required>
                                    </div>
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $candidate->phone) }}">
                                    </div>
                                    @error('phone')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="location" class="form-label">Location</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $candidate->location) }}" placeholder="City, Country">
                                    </div>
                                    @error('location')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Profile Media Section -->
                        <div class="form-section">
                            <h5 class="form-section-title">Profile Media</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="profile_picture" class="form-label">Profile Picture</label>
                                    <div class="custom-file-upload">
                                        <input type="file" class="@error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture">
                                        <div class="file-upload-btn">
                                            <i class="fas fa-cloud-upload-alt me-2"></i> Choose Profile Picture
                                        </div>
                                        <div class="file-upload-text">Upload a square image for best results. Max size: 2MB.</div>
                                    </div>
                                    @error('profile_picture')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="resume" class="form-label">Resume</label>
                                    <div class="custom-file-upload">
                                        <input type="file" class="@error('resume') is-invalid @enderror" id="resume" name="resume">
                                        <div class="file-upload-btn">
                                            <i class="fas fa-file-pdf me-2"></i> Upload Resume
                                        </div>
                                        <div class="file-upload-text">Upload your resume in PDF format. Max size: 5MB.</div>
                                    </div>
                                    @error('resume')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Professional Information Section -->
                        <div class="form-section">
                            <h5 class="form-section-title">Professional Information</h5>
                            <div class="mb-3">
                                <label for="skills" class="form-label">Skills (comma separated)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-tools"></i></span>
                                    <input type="text" class="form-control @error('skills') is-invalid @enderror" id="skills" name="skills" value="{{ old('skills', $candidate->skills) }}" placeholder="e.g. JavaScript, PHP, Laravel, React">
                                </div>
                                @error('skills')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="experience" class="form-label">Work Experience</label>
                                <textarea class="form-control @error('experience') is-invalid @enderror" id="experience" name="experience" rows="4" placeholder="Describe your work experience...">{{ old('experience', $candidate->experience) }}</textarea>
                                @error('experience')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bio" class="form-label">About Me</label>
                                <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="4" placeholder="Tell employers about yourself...">{{ old('bio', $candidate->bio) }}</textarea>
                                @error('bio')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="reset" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-undo me-2"></i> Reset
                            </button>
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
