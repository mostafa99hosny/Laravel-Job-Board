@extends('layouts.main')

@section('title', 'Post a New Job')

@push('styles')
<style>
    .job-form-container {
        padding: 40px 0;
    }

    .job-form-header {
        margin-bottom: 30px;
    }

    .job-form-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        margin-bottom: 30px;
        overflow: hidden;
    }

    .form-section {
        margin-bottom: 30px;
    }

    .form-section-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e9ecef;
    }

    .form-floating > label {
        font-weight: 500;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .job-type-badge {
        display: inline-block;
        padding: 8px 15px;
        margin: 5px;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid #e9ecef;
        font-weight: 500;
    }

    .job-type-badge.active {
        background-color: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }

    .job-type-radio {
        display: none;
    }

    .category-suggestions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }

    .category-suggestion {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 20px;
        padding: 5px 15px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .category-suggestion:hover {
        background-color: #e9ecef;
    }

    .rich-editor {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 10px;
        min-height: 200px;
    }

    .form-hint {
        font-size: 13px;
        color: #6c757d;
        margin-top: 5px;
    }

    .preview-card {
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
    }

    .preview-header {
        margin-bottom: 15px;
    }

    .preview-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .preview-company {
        font-size: 16px;
        color: #6c757d;
    }

    .preview-details {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 15px;
    }

    .preview-detail {
        display: flex;
        align-items: center;
    }

    .preview-detail i {
        margin-right: 5px;
        color: #0d6efd;
    }
</style>
@endpush

@section('content')
<div class="container job-form-container">
    <div class="job-form-header">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Post a New Job</h1>
            <a href="{{ route('employer.dashboard') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
            </a>
        </div>
        <p class="text-muted">Create a new job listing to attract qualified candidates</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="job-form-card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-briefcase me-2"></i>Job Details</h5>
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

                    <form method="POST" action="{{ route('job-listings.store') }}" id="job-form" enctype="multipart/form-data">
                        @csrf

                        <!-- Basic Information Section -->
                        <div class="form-section">
                            <h5 class="form-section-title">Basic Information</h5>

                            <div class="mb-3">
                                <label for="title" class="form-label">Job Title <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required placeholder="e.g. Senior Laravel Developer">
                                </div>
                                @error('title')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                <div class="form-hint">Be specific and clear about the position</div>
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category') }}" required placeholder="e.g. Web Development">
                                </div>
                                @error('category')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                <div class="category-suggestions">
                                    <span class="category-suggestion" data-category="Web Development">Web Development</span>
                                    <span class="category-suggestion" data-category="Mobile Development">Mobile Development</span>
                                    <span class="category-suggestion" data-category="Data Science">Data Science</span>
                                    <span class="category-suggestion" data-category="Design">Design</span>
                                    <span class="category-suggestion" data-category="Marketing">Marketing</span>
                                    <span class="category-suggestion" data-category="Sales">Sales</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" required placeholder="e.g. New York, NY or Remote">
                                    </div>
                                    @error('location')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="deadline" class="form-label">Application Deadline <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        <input type="date" class="form-control @error('deadline') is-invalid @enderror" id="deadline" name="deadline" value="{{ old('deadline') }}" required min="{{ date('Y-m-d') }}">
                                    </div>
                                    @error('deadline')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Job Type & Experience Section -->
                        <div class="form-section">
                            <h5 class="form-section-title">Job Type & Experience</h5>

                            <div class="mb-3">
                                <label class="form-label d-block">Job Type <span class="text-danger">*</span></label>
                                <div class="job-type-options text-center">
                                    <input type="radio" class="job-type-radio" name="type" id="type-full-time" value="full-time" {{ old('type') == 'full-time' ? 'checked' : '' }} required>
                                    <label for="type-full-time" class="job-type-badge {{ old('type') == 'full-time' ? 'active' : '' }}">
                                        <i class="fas fa-business-time me-1"></i> Full-time
                                    </label>

                                    <input type="radio" class="job-type-radio" name="type" id="type-part-time" value="part-time" {{ old('type') == 'part-time' ? 'checked' : '' }}>
                                    <label for="type-part-time" class="job-type-badge {{ old('type') == 'part-time' ? 'active' : '' }}">
                                        <i class="fas fa-clock me-1"></i> Part-time
                                    </label>

                                    <input type="radio" class="job-type-radio" name="type" id="type-contract" value="contract" {{ old('type') == 'contract' ? 'checked' : '' }}>
                                    <label for="type-contract" class="job-type-badge {{ old('type') == 'contract' ? 'active' : '' }}">
                                        <i class="fas fa-file-signature me-1"></i> Contract
                                    </label>

                                    <input type="radio" class="job-type-radio" name="type" id="type-remote" value="remote" {{ old('type') == 'remote' ? 'checked' : '' }}>
                                    <label for="type-remote" class="job-type-badge {{ old('type') == 'remote' ? 'active' : '' }}">
                                        <i class="fas fa-home me-1"></i> Remote
                                    </label>

                                    <input type="radio" class="job-type-radio" name="type" id="type-internship" value="internship" {{ old('type') == 'internship' ? 'checked' : '' }}>
                                    <label for="type-internship" class="job-type-badge {{ old('type') == 'internship' ? 'active' : '' }}">
                                        <i class="fas fa-graduation-cap me-1"></i> Internship
                                    </label>
                                </div>
                                @error('type')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="experience_level" class="form-label">Experience Level</label>
                                <select id="experience_level" name="experience_level" class="form-select @error('experience_level') is-invalid @enderror">
                                    <option value="">Select Experience Level</option>
                                    <option value="entry" {{ old('experience_level') == 'entry' ? 'selected' : '' }}>Entry Level</option>
                                    <option value="mid" {{ old('experience_level') == 'mid' ? 'selected' : '' }}>Mid Level</option>
                                    <option value="senior" {{ old('experience_level') == 'senior' ? 'selected' : '' }}>Senior Level</option>
                                    <option value="executive" {{ old('experience_level') == 'executive' ? 'selected' : '' }}>Executive</option>
                                </select>
                                @error('experience_level')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="salary_min" class="form-label">Minimum Salary</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        <input type="number" class="form-control @error('salary_min') is-invalid @enderror" id="salary_min" name="salary_min" value="{{ old('salary_min') }}" placeholder="e.g. 50000">
                                    </div>
                                    @error('salary_min')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="salary_max" class="form-label">Maximum Salary</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        <input type="number" class="form-control @error('salary_max') is-invalid @enderror" id="salary_max" name="salary_max" value="{{ old('salary_max') }}" placeholder="e.g. 70000">
                                    </div>
                                    @error('salary_max')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Job Description Section -->
                        <div class="form-section">
                            <h5 class="form-section-title">Job Description</h5>

                            <div class="mb-3">
                                <label for="description" class="form-label">Detailed Description <span class="text-danger">*</span></label>
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="10" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                <div class="form-hint">
                                    <p class="mb-1">Include details about:</p>
                                    <ul class="mb-0">
                                        <li>Job responsibilities</li>
                                        <li>Required skills and qualifications</li>
                                        <li>Benefits and perks</li>
                                        <li>Company culture</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Company Logo Section -->
                        <div class="form-section">
                            <h5 class="form-section-title">Company Logo</h5>

                            <div class="mb-3">
                                <label for="company_logo" class="form-label">Upload Company Logo</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    <input type="file" class="form-control @error('company_logo') is-invalid @enderror" id="company_logo" name="company_logo" accept="image/*">
                                </div>
                                @error('company_logo')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                <div class="form-hint">
                                    <p class="mb-0">Recommended size: 200x200 pixels. Max file size: 2MB. Supported formats: JPEG, PNG, GIF.</p>
                                </div>

                                <div class="mt-3" id="logo-preview-container" style="display: none;">
                                    <p class="mb-2">Logo Preview:</p>
                                    <img id="logo-preview" src="#" alt="Logo Preview" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; border-radius: 4px; padding: 5px;">
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="button" class="btn btn-outline-secondary me-md-2" id="preview-button">
                                <i class="fas fa-eye me-2"></i>Preview
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Post Job
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="job-form-card">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0"><i class="fas fa-info-circle me-2"></i>Tips for a Great Job Post</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="fw-bold"><i class="fas fa-check-circle text-success me-2"></i>Be Specific</h6>
                        <p class="small text-muted">Clearly define the role, responsibilities, and requirements to attract qualified candidates.</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold"><i class="fas fa-check-circle text-success me-2"></i>Highlight Benefits</h6>
                        <p class="small text-muted">Include information about salary, benefits, work environment, and growth opportunities.</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold"><i class="fas fa-check-circle text-success me-2"></i>Be Transparent</h6>
                        <p class="small text-muted">Provide accurate information about the job location, type, and experience level.</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold"><i class="fas fa-check-circle text-success me-2"></i>Use Clear Language</h6>
                        <p class="small text-muted">Avoid jargon and use simple, direct language that candidates can easily understand.</p>
                    </div>

                    <div>
                        <h6 class="fw-bold"><i class="fas fa-check-circle text-success me-2"></i>Set Realistic Expectations</h6>
                        <p class="small text-muted">Be honest about the challenges and opportunities of the role to find the right fit.</p>
                    </div>
                </div>
            </div>

            <!-- Job Preview (will be shown when preview button is clicked) -->
            <div class="job-form-card mt-4" id="preview-container" style="display: none;">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0"><i class="fas fa-eye me-2"></i>Job Preview</h5>
                </div>
                <div class="card-body">
                    <div class="preview-header">
                        <h3 class="preview-title" id="preview-title">Job Title</h3>
                        <p class="preview-company">{{ auth()->user()->company_name ?? auth()->user()->name }}</p>
                    </div>

                    <div class="preview-details">
                        <div class="preview-detail">
                            <i class="fas fa-map-marker-alt"></i>
                            <span id="preview-location">Location</span>
                        </div>

                        <div class="preview-detail">
                            <i class="fas fa-briefcase"></i>
                            <span id="preview-type">Job Type</span>
                        </div>

                        <div class="preview-detail">
                            <i class="fas fa-dollar-sign"></i>
                            <span id="preview-salary">Salary Range</span>
                        </div>
                    </div>

                    <div class="preview-description">
                        <h6 class="fw-bold">Job Description</h6>
                        <div id="preview-description-content" class="small">
                            Description will appear here
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Job type selection
        const jobTypeBadges = document.querySelectorAll('.job-type-badge');
        jobTypeBadges.forEach(badge => {
            badge.addEventListener('click', function() {
                // Remove active class from all badges
                jobTypeBadges.forEach(b => b.classList.remove('active'));
                // Add active class to clicked badge
                this.classList.add('active');

                // Get the corresponding radio button and check it
                const radioId = this.getAttribute('for');
                if (radioId) {
                    const radio = document.getElementById(radioId);
                    if (radio) {
                        radio.checked = true;
                    }
                }
            });
        });

        // Category suggestions
        const categorySuggestions = document.querySelectorAll('.category-suggestion');
        const categoryInput = document.getElementById('category');

        categorySuggestions.forEach(suggestion => {
            suggestion.addEventListener('click', function() {
                categoryInput.value = this.getAttribute('data-category');
            });
        });

        // Logo preview functionality
        const logoInput = document.getElementById('company_logo');
        const logoPreview = document.getElementById('logo-preview');
        const logoPreviewContainer = document.getElementById('logo-preview-container');

        logoInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    logoPreview.src = e.target.result;
                    logoPreviewContainer.style.display = 'block';
                }

                reader.readAsDataURL(this.files[0]);
            } else {
                logoPreviewContainer.style.display = 'none';
            }
        });

        // Preview functionality
        const previewButton = document.getElementById('preview-button');
        const previewContainer = document.getElementById('preview-container');

        previewButton.addEventListener('click', function() {
            // Get form values
            const title = document.getElementById('title').value || 'Job Title';
            const location = document.getElementById('location').value || 'Location';
            const description = document.getElementById('description').value || 'Description will appear here';

            // Get selected job type
            let jobType = 'Job Type';
            document.querySelectorAll('.job-type-radio').forEach(radio => {
                if (radio.checked) {
                    jobType = radio.value.charAt(0).toUpperCase() + radio.value.slice(1);
                }
            });

            // Get salary range
            const salaryMin = document.getElementById('salary_min').value;
            const salaryMax = document.getElementById('salary_max').value;
            let salaryText = 'Not specified';

            if (salaryMin && salaryMax) {
                salaryText = `$${Number(salaryMin).toLocaleString()} - $${Number(salaryMax).toLocaleString()}`;
            } else if (salaryMin) {
                salaryText = `From $${Number(salaryMin).toLocaleString()}`;
            } else if (salaryMax) {
                salaryText = `Up to $${Number(salaryMax).toLocaleString()}`;
            }

            // Update preview
            document.getElementById('preview-title').textContent = title;
            document.getElementById('preview-location').textContent = location;
            document.getElementById('preview-type').textContent = jobType;
            document.getElementById('preview-salary').textContent = salaryText;
            document.getElementById('preview-description-content').textContent = description;

            // Show preview
            previewContainer.style.display = 'block';

            // Scroll to preview
            previewContainer.scrollIntoView({ behavior: 'smooth' });
        });
    });
</script>
@endpush
