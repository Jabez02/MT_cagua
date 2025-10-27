/**
 * Enhanced Message Details UX JavaScript
 */

class MessageDetailsUX {
    constructor() {
        this.init();
    }

    init() {
        this.setupImageLightbox();
        this.setupCopyToClipboard();
        this.setupPrintFunctionality();
        this.setupKeyboardShortcuts();
        this.setupTooltips();
        this.setupSmoothScrolling();
        this.setupLoadingStates();
        this.setupAccessibility();
        this.animateOnLoad();
    }

    // Enhanced Image Lightbox Modal
    setupImageLightbox() {
        // Create modal HTML
        const modalHTML = `
            <div id="imageLightbox" class="modal fade" tabindex="-1" aria-labelledby="imageLightboxLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content bg-dark">
                        <div class="modal-header border-0">
                            <h5 class="modal-title text-white" id="imageLightboxLabel">Image Preview</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center p-0">
                            <div class="image-container position-relative">
                                <img id="lightboxImage" class="img-fluid" alt="Preview" style="max-height: 70vh; object-fit: contain;">
                                <div class="image-loading position-absolute top-50 start-50 translate-middle">
                                    <div class="spinner-border text-light" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 justify-content-between">
                            <div class="image-info text-white-50">
                                <small id="imageInfo"></small>
                            </div>
                            <div class="image-actions">
                                <button type="button" class="btn btn-outline-light btn-sm me-2" onclick="messageUX.downloadImage()">
                                    <i class="bi bi-download me-1"></i>Download
                                </button>
                                <button type="button" class="btn btn-outline-light btn-sm" onclick="messageUX.copyImageUrl()">
                                    <i class="bi bi-clipboard me-1"></i>Copy URL
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Add modal to body if it doesn't exist
        if (!document.getElementById('imageLightbox')) {
            document.body.insertAdjacentHTML('beforeend', modalHTML);
        }

        // Setup global preview function
        window.previewImage = (filename, url) => {
            const modal = new bootstrap.Modal(document.getElementById('imageLightbox'));
            const img = document.getElementById('lightboxImage');
            const info = document.getElementById('imageInfo');
            const loading = document.querySelector('.image-loading');

            // Show loading
            loading.style.display = 'block';
            img.style.display = 'none';

            // Set image info
            info.textContent = filename;
            
            // Store current image data
            this.currentImage = { filename, url };

            // Load image
            img.onload = () => {
                loading.style.display = 'none';
                img.style.display = 'block';
                img.style.animation = 'fadeIn 0.3s ease-out';
            };

            img.onerror = () => {
                loading.style.display = 'none';
                img.style.display = 'block';
                img.src = 'data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><rect width="200" height="200" fill="%23f8f9fa"/><text x="100" y="100" text-anchor="middle" dy=".3em" fill="%236c757d">Image not found</text></svg>';
            };

            img.src = url;
            modal.show();
        };
    }

    // Download current image
    downloadImage() {
        if (this.currentImage) {
            const link = document.createElement('a');
            link.href = this.currentImage.url;
            link.download = this.currentImage.filename;
            link.click();
        }
    }

    // Copy image URL to clipboard
    copyImageUrl() {
        if (this.currentImage) {
            navigator.clipboard.writeText(this.currentImage.url).then(() => {
                this.showNotification('Image URL copied to clipboard!', 'success');
            }).catch(() => {
                this.showNotification('Failed to copy URL', 'error');
            });
        }
    }

    // Copy to Clipboard functionality
    setupCopyToClipboard() {
        // Add copy buttons to message content
        const messageBody = document.querySelector('.message-body');
        if (messageBody) {
            const copyBtn = document.createElement('button');
            copyBtn.className = 'btn btn-outline-secondary btn-sm position-absolute top-0 end-0 m-2';
            copyBtn.innerHTML = '<i class="bi bi-clipboard"></i>';
            copyBtn.title = 'Copy message content';
            copyBtn.style.opacity = '0';
            copyBtn.style.transition = 'opacity 0.3s ease';

            copyBtn.addEventListener('click', () => {
                const text = messageBody.textContent.trim();
                navigator.clipboard.writeText(text).then(() => {
                    copyBtn.innerHTML = '<i class="bi bi-check2"></i>';
                    this.showNotification('Message copied to clipboard!', 'success');
                    setTimeout(() => {
                        copyBtn.innerHTML = '<i class="bi bi-clipboard"></i>';
                    }, 2000);
                }).catch(() => {
                    this.showNotification('Failed to copy message', 'error');
                });
            });

            messageBody.style.position = 'relative';
            messageBody.appendChild(copyBtn);

            // Show/hide copy button on hover
            messageBody.addEventListener('mouseenter', () => {
                copyBtn.style.opacity = '1';
            });

            messageBody.addEventListener('mouseleave', () => {
                copyBtn.style.opacity = '0';
            });
        }
    }

    // Print functionality
    setupPrintFunctionality() {
        // Add print button to header actions
        const headerActions = document.querySelector('.message-actions');
        if (headerActions) {
            const printBtn = document.createElement('button');
            printBtn.className = 'action-btn';
            printBtn.innerHTML = '<i class="bi bi-printer"></i> Print';
            printBtn.addEventListener('click', () => {
                window.print();
            });
            headerActions.appendChild(printBtn);
        }
    }

    // Keyboard shortcuts
    setupKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            // Ctrl/Cmd + P for print
            if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
                e.preventDefault();
                window.print();
            }

            // Ctrl/Cmd + C for copy (when message is focused)
            if ((e.ctrlKey || e.metaKey) && e.key === 'c' && e.target.closest('.message-body')) {
                const messageBody = document.querySelector('.message-body');
                if (messageBody) {
                    const text = messageBody.textContent.trim();
                    navigator.clipboard.writeText(text);
                    this.showNotification('Message copied to clipboard!', 'success');
                }
            }

            // Escape to close modal
            if (e.key === 'Escape') {
                const modal = bootstrap.Modal.getInstance(document.getElementById('imageLightbox'));
                if (modal) {
                    modal.hide();
                }
            }
        });
    }

    // Enhanced tooltips
    setupTooltips() {
        // Initialize Bootstrap tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }

        // Add custom tooltips
        const elements = document.querySelectorAll('.status-indicator, .attachment-icon, .action-btn');
        elements.forEach(el => {
            if (!el.hasAttribute('title') && !el.hasAttribute('data-bs-original-title')) {
                let tooltipText = '';
                
                if (el.classList.contains('status-indicator')) {
                    tooltipText = `Message status: ${el.textContent.trim()}`;
                } else if (el.classList.contains('attachment-icon')) {
                    tooltipText = 'File attachment';
                } else if (el.classList.contains('action-btn')) {
                    tooltipText = el.textContent.trim();
                }

                if (tooltipText) {
                    el.setAttribute('data-bs-toggle', 'tooltip');
                    el.setAttribute('title', tooltipText);
                    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                        new bootstrap.Tooltip(el);
                    }
                }
            }
        });
    }

    // Smooth scrolling
    setupSmoothScrolling() {
        const links = document.querySelectorAll('a[href^="#"]');
        links.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(link.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // Loading states for buttons
    setupLoadingStates() {
        const buttons = document.querySelectorAll('.btn-download, .action-btn');
        buttons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                if (btn.classList.contains('btn-download')) {
                    const originalText = btn.innerHTML;
                    btn.innerHTML = '<i class="bi bi-arrow-clockwise spin"></i> Downloading...';
                    btn.disabled = true;

                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    }, 2000);
                }
            });
        });
    }

    // Accessibility enhancements
    setupAccessibility() {
        // Add ARIA labels
        const attachmentCards = document.querySelectorAll('.attachment-card');
        attachmentCards.forEach((card, index) => {
            const filename = card.querySelector('h6')?.textContent || `Attachment ${index + 1}`;
            card.setAttribute('aria-label', `Attachment: ${filename}`);
            card.setAttribute('role', 'article');
        });

        // Add focus management
        const modal = document.getElementById('imageLightbox');
        if (modal) {
            modal.addEventListener('shown.bs.modal', () => {
                const closeBtn = modal.querySelector('.btn-close');
                if (closeBtn) closeBtn.focus();
            });
        }

        // Add skip links
        const skipLink = document.createElement('a');
        skipLink.href = '#main-content';
        skipLink.className = 'sr-only sr-only-focusable btn btn-primary position-absolute top-0 start-0 z-index-1050';
        skipLink.textContent = 'Skip to main content';
        skipLink.style.zIndex = '1050';
        document.body.insertBefore(skipLink, document.body.firstChild);
    }

    // Animate elements on load
    animateOnLoad() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe elements for animation
        const elementsToAnimate = document.querySelectorAll('.attachment-card, .reply-section, .message-body');
        elementsToAnimate.forEach(el => {
            observer.observe(el);
        });
    }

    // Notification system
    showNotification(message, type = 'info') {
        // Remove existing notifications
        const existing = document.querySelector('.notification-toast');
        if (existing) {
            existing.remove();
        }

        const toast = document.createElement('div');
        toast.className = `notification-toast alert alert-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'info'} position-fixed`;
        toast.style.cssText = `
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            animation: slideInRight 0.3s ease-out;
        `;
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="bi bi-${type === 'error' ? 'exclamation-triangle' : type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
            </div>
        `;

        document.body.appendChild(toast);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (toast.parentElement) {
                toast.style.animation = 'slideOutRight 0.3s ease-out';
                setTimeout(() => toast.remove(), 300);
            }
        }, 5000);
    }

    // File size formatter
    formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
}

// CSS animations for notifications
const notificationStyles = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    .spin {
        animation: spin 1s linear infinite;
    }
`;

// Add styles to head
const styleSheet = document.createElement('style');
styleSheet.textContent = notificationStyles;
document.head.appendChild(styleSheet);

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.messageUX = new MessageDetailsUX();
});

// Export for global access
window.MessageDetailsUX = MessageDetailsUX;