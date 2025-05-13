// Custom JavaScript for Job Board

/**
 * Performance optimized JavaScript with debouncing and throttling
 * for better user experience and reduced resource usage
 */

// Debounce function to limit how often a function can be called
function debounce(func, wait, immediate) {
    let timeout;
    return function() {
        const context = this, args = arguments;
        const later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

// Throttle function to limit the rate at which a function can fire
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

document.addEventListener('DOMContentLoaded', function() {
    // Add CSS color variables as RGB values for opacity support
    const colorVars = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];

    // Process all color variables at once to reduce reflows
    const cssVarUpdates = colorVars.reduce((acc, color) => {
        const colorValue = getComputedStyle(document.documentElement).getPropertyValue(`--${color}`).trim();
        if (colorValue) {
            const rgb = hexToRgb(colorValue);
            if (rgb) {
                acc[`--${color}-rgb`] = `${rgb.r}, ${rgb.g}, ${rgb.b}`;
            }
        }
        return acc;
    }, {});

    // Apply all CSS variable updates at once
    Object.entries(cssVarUpdates).forEach(([prop, value]) => {
        document.documentElement.style.setProperty(prop, value);
    });

    // Auto-hide alerts after 5 seconds with animation
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.classList.add('animate__fadeOut');
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 500);
        }, 5000);
    });

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
            animation: true,
            delay: { show: 100, hide: 100 }
        });
    });

    // Initialize popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl, {
            trigger: 'focus',
            html: true
        });
    });

    // Job search form handling with animation
    const jobSearchForm = document.getElementById('job-search-form');
    if (jobSearchForm) {
        // Add animation to form fields
        const formFields = jobSearchForm.querySelectorAll('.form-control, .form-select, .btn');
        formFields.forEach(function(field, index) {
            field.classList.add('animate__animated', 'animate__fadeInUp');
            field.style.animationDelay = `${0.1 * (index + 1)}s`;
        });

        jobSearchForm.addEventListener('submit', function(e) {
            // Remove empty fields from form submission
            const inputs = jobSearchForm.querySelectorAll('input, select');
            inputs.forEach(function(input) {
                if (input.value === '') {
                    input.disabled = true;
                }
            });
        });
    }

    // Salary range slider with improved UI
    const salaryRange = document.getElementById('salary-range');
    const salaryValue = document.getElementById('salary-value');
    if (salaryRange && salaryValue) {
        // Initialize with current value
        salaryValue.textContent = '$' + formatNumber(salaryRange.value);

        salaryRange.addEventListener('input', function() {
            salaryValue.textContent = '$' + formatNumber(this.value);

            // Add animation effect
            salaryValue.classList.add('animate__animated', 'animate__pulse');
            setTimeout(function() {
                salaryValue.classList.remove('animate__animated', 'animate__pulse');
            }, 500);
        });
    }

    // Job application form validation with improved UX
    const applicationForm = document.getElementById('job-application-form');
    if (applicationForm) {
        // Add file name display for resume upload
        const resumeInput = document.getElementById('resume');
        const resumeLabel = document.querySelector('label[for="resume"]');
        const resumeError = document.getElementById('resume-error');

        if (resumeInput && resumeLabel) {
            resumeInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    const fileName = this.files[0].name;
                    const fileSize = (this.files[0].size / 1024 / 1024).toFixed(2); // in MB
                    resumeLabel.innerHTML = `<i class="fas fa-file-alt me-2"></i>${fileName} (${fileSize} MB)`;
                    resumeLabel.classList.add('text-primary');
                } else {
                    resumeLabel.innerHTML = '<i class="fas fa-upload me-2"></i>Choose file';
                    resumeLabel.classList.remove('text-primary');
                }
            });
        }

        applicationForm.addEventListener('submit', function(e) {
            let isValid = true;

            // Resume validation
            if (resumeInput && resumeError) {
                if (resumeInput.files.length === 0) {
                    resumeError.textContent = 'Please upload your resume';
                    resumeError.style.display = 'block';
                    resumeInput.classList.add('is-invalid');
                    isValid = false;
                } else {
                    const fileSize = resumeInput.files[0].size / 1024 / 1024; // in MB
                    const fileType = resumeInput.files[0].type;
                    const validTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

                    if (fileSize > 2) {
                        resumeError.textContent = 'File size should be less than 2MB';
                        resumeError.style.display = 'block';
                        resumeInput.classList.add('is-invalid');
                        isValid = false;
                    } else if (!validTypes.includes(fileType)) {
                        resumeError.textContent = 'Only PDF and Word documents are allowed';
                        resumeError.style.display = 'block';
                        resumeInput.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        resumeError.style.display = 'none';
                        resumeInput.classList.remove('is-invalid');
                    }
                }
            }

            if (!isValid) {
                e.preventDefault();

                // Scroll to first error
                const firstError = applicationForm.querySelector('.is-invalid');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            } else {
                // Show loading state on submit button
                const submitBtn = applicationForm.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Submitting...';
                    submitBtn.disabled = true;
                }
            }
        });
    }

    // Character counter for text areas with improved UI
    const textAreas = document.querySelectorAll('textarea[data-max-chars]');
    textAreas.forEach(function(textArea) {
        const maxChars = textArea.getAttribute('data-max-chars');
        const counterElement = document.createElement('div');
        counterElement.className = 'text-muted small mt-1 d-flex justify-content-between';

        const counterText = document.createElement('span');
        counterText.textContent = `0/${maxChars} characters`;

        const progressContainer = document.createElement('div');
        progressContainer.className = 'progress ms-2';
        progressContainer.style.width = '100px';
        progressContainer.style.height = '6px';

        const progressBar = document.createElement('div');
        progressBar.className = 'progress-bar';
        progressBar.style.width = '0%';

        progressContainer.appendChild(progressBar);
        counterElement.appendChild(counterText);
        counterElement.appendChild(progressContainer);

        textArea.parentNode.insertBefore(counterElement, textArea.nextSibling);

        textArea.addEventListener('input', function() {
            const currentChars = this.value.length;
            const percentage = Math.min((currentChars / maxChars) * 100, 100);

            counterText.textContent = `${currentChars}/${maxChars} characters`;
            progressBar.style.width = `${percentage}%`;

            if (currentChars > maxChars) {
                counterElement.classList.add('text-danger');
                progressBar.className = 'progress-bar bg-danger';
                this.classList.add('is-invalid');
            } else if (currentChars > maxChars * 0.8) {
                counterElement.classList.remove('text-danger');
                counterElement.classList.add('text-warning');
                progressBar.className = 'progress-bar bg-warning';
                this.classList.remove('is-invalid');
            } else {
                counterElement.classList.remove('text-danger', 'text-warning');
                progressBar.className = 'progress-bar bg-primary';
                this.classList.remove('is-invalid');
            }
        });
    });

    // Toggle password visibility with improved UI
    const togglePasswordButtons = document.querySelectorAll('.toggle-password');
    togglePasswordButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const passwordInput = document.querySelector(this.getAttribute('data-target'));
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle icon with animation
            const icon = this.querySelector('i');
            icon.style.transform = 'scale(0)';

            setTimeout(function() {
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
                icon.style.transform = 'scale(1)';
            }, 150);
        });
    });

    // Back to top button with throttled scroll event
    const backToTopBtn = document.querySelector('.btn-back-to-top');
    if (backToTopBtn) {
        // Use throttled scroll event to improve performance
        window.addEventListener('scroll', throttle(function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        }, 100)); // Throttle to once every 100ms

        backToTopBtn.addEventListener('click', function() {
            // Check for smooth scroll support
            if ('scrollBehavior' in document.documentElement.style) {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            } else {
                // Fallback for browsers that don't support smooth scrolling
                window.scrollTo(0, 0);
            }
        });
    }

    // Animate elements on scroll with different animations
    const animateElements = document.querySelectorAll('.animate-on-scroll');
    if (animateElements.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Get animation type from data attribute or default to fadeInUp
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

    // Add hover effect to job cards with enhanced interactions
    const jobCards = document.querySelectorAll('.job-card');
    jobCards.forEach(function(card, index) {
        // Add animation delay for initial load
        card.style.animationDelay = `${0.1 * index}s`;
        card.classList.add('animate__animated', 'animate__fadeInUp');

        card.addEventListener('mouseenter', function() {
            this.classList.add('shadow-lg');

            // Animate the company logo
            const logo = this.querySelector('.company-logo');
            if (logo) {
                logo.style.transform = 'scale(1.05) rotate(3deg)';
            }

            // Highlight the job title
            const title = this.querySelector('.job-title');
            if (title) {
                title.style.color = 'var(--primary)';
            }
        });

        card.addEventListener('mouseleave', function() {
            this.classList.remove('shadow-lg');

            // Reset the company logo
            const logo = this.querySelector('.company-logo');
            if (logo) {
                logo.style.transform = '';
            }

            // Reset the job title
            const title = this.querySelector('.job-title');
            if (title) {
                title.style.color = '';
            }
        });

        // Add click animation
        card.addEventListener('click', function() {
            this.classList.add('animate__pulse');
            setTimeout(() => {
                this.classList.remove('animate__pulse');
            }, 500);
        });
    });

    // Add hover effect to employer cards with enhanced interactions
    const employerCards = document.querySelectorAll('.employer-card');
    employerCards.forEach(function(card, index) {
        // Add animation delay for initial load
        card.style.animationDelay = `${0.1 * index}s`;
        card.classList.add('animate__animated', 'animate__fadeInUp');

        card.addEventListener('mouseenter', function() {
            this.classList.add('shadow-lg');

            // Animate the employer logo
            const logo = this.querySelector('.employer-logo');
            if (logo) {
                logo.style.transform = 'scale(1.05) rotate(5deg)';
            }

            // Highlight the employer name
            const name = this.querySelector('.employer-name');
            if (name) {
                name.style.color = 'var(--primary)';
            }

            // Animate the button
            const btn = this.querySelector('.btn');
            if (btn) {
                btn.classList.add('btn-primary');
                btn.classList.remove('btn-outline-primary');
            }
        });

        card.addEventListener('mouseleave', function() {
            this.classList.remove('shadow-lg');

            // Reset the employer logo
            const logo = this.querySelector('.employer-logo');
            if (logo) {
                logo.style.transform = '';
            }

            // Reset the employer name
            const name = this.querySelector('.employer-name');
            if (name) {
                name.style.color = '';
            }

            // Reset the button
            const btn = this.querySelector('.btn');
            if (btn && btn.classList.contains('btn-primary') && !btn.classList.contains('btn-apply')) {
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-outline-primary');
            }
        });
    });

    // Add animation to testimonial cards
    const testimonialCards = document.querySelectorAll('.testimonial-card');
    testimonialCards.forEach(function(card, index) {
        card.style.animationDelay = `${0.2 * index}s`;
        card.classList.add('animate__animated', 'animate__fadeIn');
    });

    // Add animation to feature cards
    const featureCards = document.querySelectorAll('.feature-card');
    featureCards.forEach(function(card, index) {
        card.style.animationDelay = `${0.15 * index}s`;
        card.classList.add('animate__animated', 'animate__fadeInUp');

        // Animate the feature icon on hover
        card.addEventListener('mouseenter', function() {
            const icon = this.querySelector('.feature-icon');
            if (icon) {
                icon.style.transform = 'scale(1.1) rotate(10deg)';
            }
        });

        card.addEventListener('mouseleave', function() {
            const icon = this.querySelector('.feature-icon');
            if (icon) {
                icon.style.transform = '';
            }
        });
    });

    // Add counter animation to statistics
    const statValues = document.querySelectorAll('.stat-value');
    if (statValues.length > 0) {
        const statObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = entry.target;
                    const countTo = parseInt(target.getAttribute('data-count'), 10);

                    if (!isNaN(countTo)) {
                        let count = 0;
                        const duration = 2000; // 2 seconds
                        const increment = Math.ceil(countTo / (duration / 16)); // 60fps

                        const timer = setInterval(() => {
                            count += increment;
                            if (count >= countTo) {
                                target.textContent = formatNumber(countTo);
                                clearInterval(timer);
                            } else {
                                target.textContent = formatNumber(count);
                            }
                        }, 16);
                    }

                    statObserver.unobserve(target);
                }
            });
        }, { threshold: 0.5 });

        statValues.forEach(value => {
            // Store the target number as a data attribute
            const targetNumber = value.textContent;
            value.setAttribute('data-count', targetNumber);
            value.textContent = '0';

            statObserver.observe(value);
        });
    }

    // Helper function to format numbers with commas
    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Helper function to convert hex to rgb
    function hexToRgb(hex) {
        // Remove # if present
        hex = hex.replace('#', '');

        // Parse the hex values
        const r = parseInt(hex.substring(0, 2), 16);
        const g = parseInt(hex.substring(2, 4), 16);
        const b = parseInt(hex.substring(4, 6), 16);

        // Check if parsing was successful
        if (isNaN(r) || isNaN(g) || isNaN(b)) {
            return null;
        }

        return { r, g, b };
    }

    // Enhanced job application form with interactive elements
    const jobApplicationForm = document.querySelector('.job-application-form');
    if (jobApplicationForm) {
        // Add animation to form elements
        const formElements = jobApplicationForm.querySelectorAll('.form-group, .form-check, .btn-submit');
        formElements.forEach(function(element, index) {
            element.style.animationDelay = `${0.1 * index}s`;
            element.classList.add('animate__animated', 'animate__fadeInUp');
        });

        // Resume upload preview
        const resumeInput = jobApplicationForm.querySelector('input[type="file"]');
        const resumePreview = document.createElement('div');
        resumePreview.className = 'resume-preview mt-2 d-none';

        if (resumeInput) {
            const resumeLabel = resumeInput.nextElementSibling;
            resumeInput.parentNode.insertBefore(resumePreview, resumeInput.nextSibling);

            resumeInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    const file = this.files[0];
                    const fileSize = (file.size / 1024 / 1024).toFixed(2); // in MB
                    const fileType = file.type;

                    // Update label
                    if (resumeLabel) {
                        resumeLabel.innerHTML = `<i class="fas fa-file-alt me-2"></i>${file.name}`;
                        resumeLabel.classList.add('text-primary');
                    }

                    // Show preview
                    let fileIcon = 'fa-file-alt';
                    if (fileType.includes('pdf')) {
                        fileIcon = 'fa-file-pdf';
                    } else if (fileType.includes('word') || fileType.includes('document')) {
                        fileIcon = 'fa-file-word';
                    }

                    resumePreview.innerHTML = `
                        <div class="card p-3 bg-light">
                            <div class="d-flex align-items-center">
                                <i class="fas ${fileIcon} fa-2x text-primary me-3"></i>
                                <div>
                                    <h6 class="mb-0">${file.name}</h6>
                                    <small class="text-muted">${fileSize} MB</small>
                                </div>
                            </div>
                        </div>
                    `;
                    resumePreview.classList.remove('d-none');
                } else {
                    // Reset label
                    if (resumeLabel) {
                        resumeLabel.innerHTML = '<i class="fas fa-upload me-2"></i>Choose file';
                        resumeLabel.classList.remove('text-primary');
                    }

                    // Hide preview
                    resumePreview.classList.add('d-none');
                }
            });
        }

        // Cover letter character counter with visual feedback
        const coverLetterTextarea = jobApplicationForm.querySelector('textarea[name="cover_letter"]');
        if (coverLetterTextarea) {
            const maxLength = 500; // Set your desired max length
            coverLetterTextarea.setAttribute('maxlength', maxLength);

            const counterContainer = document.createElement('div');
            counterContainer.className = 'mt-2 d-flex align-items-center justify-content-between';

            const counterText = document.createElement('small');
            counterText.className = 'text-muted';
            counterText.textContent = `0/${maxLength} characters`;

            const progressContainer = document.createElement('div');
            progressContainer.className = 'progress ms-3';
            progressContainer.style.width = '100px';
            progressContainer.style.height = '6px';

            const progressBar = document.createElement('div');
            progressBar.className = 'progress-bar bg-primary';
            progressBar.style.width = '0%';

            progressContainer.appendChild(progressBar);
            counterContainer.appendChild(counterText);
            counterContainer.appendChild(progressContainer);

            coverLetterTextarea.parentNode.insertBefore(counterContainer, coverLetterTextarea.nextSibling);

            coverLetterTextarea.addEventListener('input', function() {
                const currentLength = this.value.length;
                const percentage = Math.min((currentLength / maxLength) * 100, 100);

                counterText.textContent = `${currentLength}/${maxLength} characters`;
                progressBar.style.width = `${percentage}%`;

                if (currentLength > maxLength * 0.9) {
                    progressBar.className = 'progress-bar bg-danger';
                    counterText.className = 'text-danger small';
                } else if (currentLength > maxLength * 0.7) {
                    progressBar.className = 'progress-bar bg-warning';
                    counterText.className = 'text-warning small';
                } else {
                    progressBar.className = 'progress-bar bg-primary';
                    counterText.className = 'text-muted small';
                }
            });
        }

        // Form submission animation
        jobApplicationForm.addEventListener('submit', function(e) {
            if (this.checkValidity()) {
                const submitBtn = this.querySelector('.btn-submit');
                if (submitBtn) {
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Submitting Application...';
                    submitBtn.disabled = true;
                }

                // Add success message (for demo purposes)
                setTimeout(() => {
                    const formContainer = this.parentNode;
                    this.classList.add('animate__animated', 'animate__fadeOutUp');

                    setTimeout(() => {
                        this.style.display = 'none';

                        const successMessage = document.createElement('div');
                        successMessage.className = 'text-center py-5 animate__animated animate__fadeInUp';
                        successMessage.innerHTML = `
                            <div class="mb-4">
                                <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                            </div>
                            <h2 class="mb-3">Application Submitted!</h2>
                            <p class="lead mb-4">Your job application has been successfully submitted. We'll review it and get back to you soon.</p>
                            <a href="/" class="btn btn-primary btn-lg">Back to Home</a>
                        `;

                        formContainer.appendChild(successMessage);
                    }, 500);
                }, 2000);
            }
        });
    }
});
