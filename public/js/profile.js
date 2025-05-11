// Profile page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Handle file input display for profile picture
    const profilePictureInput = document.getElementById('profile_picture');
    if (profilePictureInput) {
        profilePictureInput.addEventListener('change', function() {
            updateFileInputLabel(this, 'Choose Profile Picture');
        });
    }

    // Handle file input display for resume
    const resumeInput = document.getElementById('resume');
    if (resumeInput) {
        resumeInput.addEventListener('change', function() {
            updateFileInputLabel(this, 'Upload Resume');
        });
    }

    // Reset button should also reset custom file input labels
    const resetButton = document.querySelector('button[type="reset"]');
    if (resetButton) {
        resetButton.addEventListener('click', function() {
            const fileInputs = document.querySelectorAll('.custom-file-upload input[type="file"]');
            fileInputs.forEach(input => {
                const defaultText = input.id === 'profile_picture' ? 
                    'Choose Profile Picture' : 'Upload Resume';
                
                const btnElement = input.parentElement.querySelector('.file-upload-btn');
                if (btnElement) {
                    const icon = btnElement.querySelector('i').outerHTML;
                    btnElement.innerHTML = icon + ' ' + defaultText;
                }
            });
        });
    }
});

// Helper function to update file input label
function updateFileInputLabel(input, defaultText) {
    const fileName = input.files[0]?.name;
    const btnElement = input.parentElement.querySelector('.file-upload-btn');
    
    if (btnElement) {
        const icon = btnElement.querySelector('i').outerHTML;
        
        if (fileName) {
            btnElement.innerHTML = icon + ' ' + fileName;
        } else {
            btnElement.innerHTML = icon + ' ' + defaultText;
        }
    }
}
