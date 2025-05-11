@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <a href="{{ route('employer.dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
        </a>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Company Profile</h5>
                </div>
                <div class="card-body text-center">
                    @if($employer->company_logo)
                        <img src="{{ asset('storage/' . $employer->company_logo) }}" alt="{{ $employer->company_name }}" class="img-fluid rounded mb-3" style="max-height: 150px;">
                    @else
                        <div class="avatar-placeholder bg-light text-primary rounded d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 150px; height: 150px; font-size: 4rem;">
                            {{ substr($employer->company_name ?? $employer->name, 0, 1) }}
                        </div>
                    @endif
                    <h4>{{ $employer->company_name ?? $employer->name }}</h4>
                    <p class="text-muted">{{ $employer->email }}</p>
                    
                    @if($employer->website)
                        <p>
                            <a href="{{ $employer->website }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-globe me-1"></i> Visit Website
                            </a>
                        </p>
                    @endif
                    
                    @if($employer->bio)
                        <div class="mt-3 text-start">
                            <h6>About Us</h6>
                            <p>{{ $employer->bio }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Edit Profile</h5>
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
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $employer->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $employer->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name', $employer->company_name) }}" required>
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="website" class="form-label">Company Website</label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website', $employer->website) }}" placeholder="https://example.com">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="company_logo" class="form-label">Company Logo</label>
                            <input type="file" class="form-control @error('company_logo') is-invalid @enderror" id="company_logo" name="company_logo">
                            <div class="form-text">Upload a square image for best results. Max size: 2MB.</div>
                            @error('company_logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="bio" class="form-label">About Your Company</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="4">{{ old('bio', $employer->bio) }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
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
