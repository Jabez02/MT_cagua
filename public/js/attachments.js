// Enhanced Attachment JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize attachment animations
    initializeAttachmentAnimations();
    
    // Initialize image preview modal
    initializeImagePreview();
    
    // Initialize download progress
    initializeDownloadProgress();
});

function initializeAttachmentAnimations() {
    // Add staggered animation to attachment cards
    const attachmentCards = document.querySelectorAll('.attachment-card');
    attachmentCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('fade-in');
    });
}

function previewImage(filename, downloadUrl) {
    // Create modal if it doesn't exist
    let modal = document.getElementById('imagePreviewModal');
    if (!modal) {
        modal = createImageModal();
    }
    
    // Show loading state
    showImageLoading(modal);
    
    // Create image element
    const img = new Image();
    img.onload = function() {
        showImageInModal(modal, this, filename);
    };
    img.onerror = function() {
        showImageError(modal, filename);
    };
    img.src = downloadUrl;
    
    // Show modal
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

function createImageModal() {
    const modal = document.createElement('div');
    modal.id = 'imagePreviewModal';
    modal.className = 'image-modal';
    modal.innerHTML = `
        <div class="image-modal-content">
            <button class="image-modal-close" onclick="closeImageModal()">
                <i class="bi bi-x-lg"></i>
            </button>
            <div class="image-modal-body">
                <!-- Content will be inserted here -->
            </div>
        </div>
    `;
    
    // Close on background click
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeImageModal();
        }
    });
    
    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('show')) {
            closeImageModal();
        }
    });
    
    document.body.appendChild(modal);
    return modal;
}

function showImageLoading(modal) {
    const body = modal.querySelector('.image-modal-body');
    body.innerHTML = `
        <div class="text-center text-white p-4">
            <div class="loading-spinner mb-3"></div>
            <div>Loading image...</div>
        </div>
    `;
}

function showImageInModal(modal, img, filename) {
    const body = modal.querySelector('.image-modal-body');
    body.innerHTML = `
        <div class="text-center">
            <img src="${img.src}" alt="${filename}" class="img-fluid">
            <div class="text-white mt-3">
                <h6>${filename}</h6>
            </div>
        </div>
    `;
}

function showImageError(modal, filename) {
    const body = modal.querySelector('.image-modal-body');
    body.innerHTML = `
        <div class="text-center text-white p-4">
            <i class="bi bi-exclamation-triangle fs-1 mb-3"></i>
            <h6>Unable to load image</h6>
            <p class="mb-0">${filename}</p>
        </div>
    `;
}

function closeImageModal() {
    const modal = document.getElementById('imagePreviewModal');
    if (modal) {
        modal.classList.remove('show');
        document.body.style.overflow = '';
        
        // Clean up after animation
        setTimeout(() => {
            const body = modal.querySelector('.image-modal-body');
            if (body) {
                body.innerHTML = '';
            }
        }, 300);
    }
}

function initializeImagePreview() {
    // Add click handlers to image preview areas
    document.querySelectorAll('.attachment-preview').forEach(preview => {
        preview.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
        });
        
        preview.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
}

function initializeDownloadProgress() {
    // Enhanced download button interactions
    document.querySelectorAll('.btn-download').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const originalText = this.innerHTML;
            const loadingText = '<span class="loading-spinner me-2"></span>Downloading...';
            
            // Show loading state
            this.innerHTML = loadingText;
            this.disabled = true;
            
            // Reset after delay (simulated download start)
            setTimeout(() => {
                this.innerHTML = originalText;
                this.disabled = false;
            }, 2000);
        });
    });
}

// Utility function for smooth scrolling to attachments
function scrollToAttachments() {
    const attachmentsSection = document.querySelector('.attachment-card').closest('.mt-4');
    if (attachmentsSection) {
        attachmentsSection.scrollIntoView({ 
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// File size formatter (client-side utility)
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Add tooltip functionality
function initializeTooltips() {
    document.querySelectorAll('[title]').forEach(element => {
        element.addEventListener('mouseenter', function() {
            const tooltip = document.createElement('div');
            tooltip.className = 'custom-tooltip';
            tooltip.textContent = this.getAttribute('title');
            document.body.appendChild(tooltip);
            
            // Position tooltip
            const rect = this.getBoundingClientRect();
            tooltip.style.left = rect.left + 'px';
            tooltip.style.top = (rect.top - tooltip.offsetHeight - 5) + 'px';
        });
        
        element.addEventListener('mouseleave', function() {
            const tooltip = document.querySelector('.custom-tooltip');
            if (tooltip) {
                tooltip.remove();
            }
        });
    });
}