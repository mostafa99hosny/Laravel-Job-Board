@extends('layouts.main')

@section('title', 'Post a New Job')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h1 class="h3 mb-0">Post a New Job</h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('job-listings.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <!-- Job Details Section -->
                                <h5 class="mb-3">Job Details</h5>

                                <div class="mb-3">
                                    <label for="title" class="form-label">Job Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required autofocus>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Job Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Describe the responsibilities, requirements, benefits, and any other relevant information about the position.</div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" required>
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category') }}" required>
                                        @error('category')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">E.g., Web Development, Marketing, Finance, etc.</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="type" class="form-label">Job Type <span class="text-danger">*</span></label>
                                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                            <option value="">Select Job Type</option>
                                            <option value="full-time" {{ old('type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                                            <option value="part-time" {{ old('type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                                            <option value="remote" {{ old('type') == 'remote' ? 'selected' : '' }}>Remote</option>
                                            <option value="contract" {{ old('type') == 'contract' ? 'selected' : '' }}>Contract</option>
                                            <option value="internship" {{ old('type') == 'internship' ? 'selected' : '' }}>Internship</option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="experience_level" class="form-label">Experience Level</label>
                                        <select class="form-select @error('experience_level') is-invalid @enderror" id="experience_level" name="experience_level">
                                            <option value="">Select Experience Level</option>
                                            <option value="entry" {{ old('experience_level') == 'entry' ? 'selected' : '' }}>Entry Level</option>
                                            <option value="mid" {{ old('experience_level') == 'mid' ? 'selected' : '' }}>Mid Level</option>
                                            <option value="senior" {{ old('experience_level') == 'senior' ? 'selected' : '' }}>Senior Level</option>
                                            <option value="executive" {{ old('experience_level') == 'executive' ? 'selected' : '' }}>Executive</option>
                                        </select>
                                        @error('experience_level')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="salary_min" class="form-label">Minimum Salary</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control @error('salary_min') is-invalid @enderror" id="salary_min" name="salary_min" value="{{ old('salary_min') }}">
                                        </div>
                                        @error('salary_min')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="salary_max" class="form-label">Maximum Salary</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control @error('salary_max') is-invalid @enderror" id="salary_max" name="salary_max" value="{{ old('salary_max') }}">
                                        </div>
                                        @error('salary_max')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="deadline" class="form-label">Application Deadline <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('deadline') is-invalid @enderror" id="deadline" name="deadline" value="{{ old('deadline') }}" required>
                                    @error('deadline')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Company Logo Section -->
                                <h5 class="mb-3">Company Logo</h5>

                                <div class="mb-3">
                                    <label for="company_logo" class="form-label">Upload Logo (Optional)</label>
                                    <input type="file" class="form-control @error('company_logo') is-invalid @enderror" id="company_logo" name="company_logo">
                                    @error('company_logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Recommended size: 200x200px. Max file size: 2MB. Supported formats: JPG, PNG, GIF.</div>
                                </div>

                                <div class="logo-preview mt-3 text-center">
                                    <div class="border rounded p-3 bg-light">
                                        <div id="logoPreviewContainer" class="mb-2" style="display: none;">
                                            <img id="logoPreview" src="#" alt="Logo Preview" class="img-fluid" style="max-height: 150px;">
                                        </div>
                                        <div id="logoPlaceholder" class="text-muted">
                                            <i class="fas fa-image fa-3x mb-2"></i>
                                            <p>Logo preview will appear here</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Job Posting Tips -->
                                <div class="card mt-4 border-0 bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title"><i class="fas fa-lightbulb text-warning me-2"></i>Tips for a Great Job Post</h6>
                                        <ul class="card-text small ps-3">
                                            <li>Be specific about responsibilities and requirements</li>
                                            <li>Include salary information to attract more candidates</li>
                                            <li>Highlight company benefits and culture</li>
                                            <li>Use clear, concise language</li>
                                            <li>Specify if the position is remote-friendly</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('employer.dashboard') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i> Post Job
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Logo preview functionality
    document.addEventListener('DOMContentLoaded', function() {
        const logoInput = document.getElementById('company_logo');
        const logoPreview = document.getElementById('logoPreview');
        const logoPreviewContainer = document.getElementById('logoPreviewContainer');
        const logoPlaceholder = document.getElementById('logoPlaceholder');

        logoInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    logoPreview.src = e.target.result;
                    logoPreviewContainer.style.display = 'block';
                    logoPlaceholder.style.display = 'none';
                }

                reader.readAsDataURL(this.files[0]);
            } else {
                logoPreviewContainer.style.display = 'none';
                logoPlaceholder.style.display = 'block';
            }
        });
    });
</script>
@endpush

@endsection
