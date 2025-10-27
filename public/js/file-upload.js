// Enhanced File Upload JavaScript
class FileUploadManager {
    constructor(options = {}) {
        this.fileInput = document.getElementById(options.fileInputId || 'attachments');
        this.fileList = document.getElementById(options.fileListId || 'file-list');
        this.dropZone = options.dropZone || this.fileInput?.closest('.file-upload-zone, .border-dashed');
        this.maxFiles = options.maxFiles || 5;
        this.maxSize = options.maxSize || 10 * 1024 * 1024; // 10MB
        this.allowedTypes = options.allowedTypes || [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'text/plain',
            'image/jpeg',
            'image/jpg',
            'image/png',
            'image/gif',
            'application/zip',
            'application/x-rar-compressed'
        ];
        
        this.selectedFiles = [];
        this.uploadStats = {
            totalFiles: 0,
            totalSize: 0,
            completedFiles: 0
        };
        
        this.init();
    }
    
    init() {
        if (!this.fileInput || !this.fileList || !this.dropZone) {
            console.warn('FileUploadManager: Required elements not found');
            return;
        }
        
        this.setupEventListeners();
        this.createUploadStats();
    }
    
    setupEventListeners() {
        // File input change handler
        this.fileInput.addEventListener('change', (e) => {
            this.handleFiles(e.target.files);
        });
        
        // Drag and drop handlers
        this.dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            this.dropZone.classList.add('drag-over');
        });
        
        this.dropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            // Only remove drag-over if we're leaving the drop zone entirely
            if (!this.dropZone.contains(e.relatedTarget)) {
                this.dropZone.classList.remove('drag-over');
            }
        });
        
        this.dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            this.dropZone.classList.remove('drag-over');
            this.handleFiles(e.dataTransfer.files);
            
            // Add bounce animation
            this.dropZone.classList.add('bounce-animation');
            setTimeout(() => {
                this.dropZone.classList.remove('bounce-animation');
            }, 1000);
        });
        
        // Prevent default drag behaviors on document
        document.addEventListener('dragover', (e) => e.preventDefault());
        document.addEventListener('drop', (e) => e.preventDefault());
    }
    
    handleFiles(files) {
        if (this.selectedFiles.length + files.length > this.maxFiles) {
            this.showNotification(`You can only upload a maximum of ${this.maxFiles} files.`, 'error');
            return;
        }
        
        const validFiles = [];
        
        Array.from(files).forEach(file => {
            if (!this.validateFile(file)) {
                return;
            }
            
            validFiles.push(file);
        });
        
        if (validFiles.length > 0) {
            validFiles.forEach((file, index) => {
                setTimeout(() => {
                    this.addFile(file);
                }, index * 100); // Stagger animations
            });
        }
    }
    
    validateFile(file) {
        if (!this.allowedTypes.includes(file.type)) {
            this.showNotification(`File type not allowed: ${file.name}`, 'error');
            return false;
        }
        
        if (file.size > this.maxSize) {
            this.showNotification(`File too large: ${file.name}. Maximum size is ${this.formatFileSize(this.maxSize)}.`, 'error');
            return false;
        }
        
        // Check for duplicate files
        if (this.selectedFiles.some(f => f.name === file.name && f.size === file.size)) {
            this.showNotification(`File already added: ${file.name}`, 'warning');
            return false;
        }
        
        return true;
    }
    
    addFile(file) {
        this.selectedFiles.push(file);
        this.displayFile(file);
        this.updateFileInput();
        this.updateUploadStats();
        this.showNotification(`Added: ${file.name}`, 'success');
    }
    
    displayFile(file) {
        const fileDiv = document.createElement('div');
        fileDiv.className = 'file-item';
        fileDiv.dataset.fileName = file.name;
        
        const fileType = this.getFileType(file);
        const fileIcon = this.getFileIcon(fileType);
        
        fileDiv.innerHTML = `
            <div class="file-info">
                <div class="file-icon ${fileType}">
                    ${fileIcon}
                </div>
                <div class="file-details">
                    <div class="file-name">${this.truncateFileName(file.name, 30)}</div>
                    <div class="file-size">${this.formatFileSize(file.size)}</div>
                </div>
            </div>
            <div class="file-actions">
                <button type="button" class="remove-file-btn" onclick="fileUploadManager.removeFile('${file.name}')" title="Remove file">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="file-type-badge">${fileType.toUpperCase()}</div>
            <div class="upload-progress" style="width: 0%"></div>
        `;
        
        this.fileList.appendChild(fileDiv);
        
        // Simulate upload progress for visual feedback
        this.simulateUploadProgress(fileDiv);
    }
    
    simulateUploadProgress(fileDiv) {
        const progressBar = fileDiv.querySelector('.upload-progress');
        let progress = 0;
        
        const interval = setInterval(() => {
            progress += Math.random() * 15;
            if (progress >= 100) {
                progress = 100;
                progressBar.classList.add('complete');
                clearInterval(interval);
            }
            progressBar.style.width = `${progress}%`;
        }, 100);
    }
    
    removeFile(fileName) {
        this.selectedFiles = this.selectedFiles.filter(file => file.name !== fileName);
        
        const fileElement = this.fileList.querySelector(`[data-file-name="${fileName}"]`);
        if (fileElement) {
            fileElement.style.animation = 'slideInUp 0.3s ease-out reverse';
            setTimeout(() => {
                fileElement.remove();
            }, 300);
        }
        
        this.updateFileInput();
        this.updateUploadStats();
        this.showNotification(`Removed: ${fileName}`, 'info');
    }
    
    updateFileInput() {
        const dt = new DataTransfer();
        this.selectedFiles.forEach(file => dt.items.add(file));
        this.fileInput.files = dt.files;
    }
    
    createUploadStats() {
        if (document.querySelector('.upload-stats')) return;
        
        const statsDiv = document.createElement('div');
        statsDiv.className = 'upload-stats';
        statsDiv.innerHTML = `
            <div class="upload-stat">
                <div class="upload-stat-value" id="files-count">0</div>
                <div class="upload-stat-label">Files</div>
            </div>
            <div class="upload-stat">
                <div class="upload-stat-value" id="total-size">0 B</div>
                <div class="upload-stat-label">Total Size</div>
            </div>
            <div class="upload-stat">
                <div class="upload-stat-value" id="remaining-slots">${this.maxFiles}</div>
                <div class="upload-stat-label">Remaining</div>
            </div>
        `;
        
        this.fileList.parentNode.insertBefore(statsDiv, this.fileList.nextSibling);
    }
    
    updateUploadStats() {
        const totalSize = this.selectedFiles.reduce((sum, file) => sum + file.size, 0);
        const remainingSlots = this.maxFiles - this.selectedFiles.length;
        
        const filesCountEl = document.getElementById('files-count');
        const totalSizeEl = document.getElementById('total-size');
        const remainingSlotsEl = document.getElementById('remaining-slots');
        
        if (filesCountEl) filesCountEl.textContent = this.selectedFiles.length;
        if (totalSizeEl) totalSizeEl.textContent = this.formatFileSize(totalSize);
        if (remainingSlotsEl) {
            remainingSlotsEl.textContent = remainingSlots;
            remainingSlotsEl.style.color = remainingSlots === 0 ? '#dc2626' : '#059669';
        }
    }
    
    getFileType(file) {
        const extension = file.name.split('.').pop().toLowerCase();
        
        if (['pdf'].includes(extension)) return 'pdf';
        if (['doc', 'docx'].includes(extension)) return 'doc';
        if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) return 'image';
        if (['zip', 'rar'].includes(extension)) return 'zip';
        return 'default';
    }
    
    getFileIcon(fileType) {
        const icons = {
            pdf: `<svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
            </svg>`,
            doc: `<svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
            </svg>`,
            image: `<svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M8.5,13.5L11,16.5L14.5,12L19,18H5M21,19V5C21,3.89 20.1,3 19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19Z" />
            </svg>`,
            zip: `<svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M14,17H12V15H14M14,13H12V11H14M12,9H14V7H12M14,5H12V3H14M10,17H12V15H10M10,13H12V11H10M12,9H10V7H12M10,5H12V3H10M16,1H8A2,2 0 0,0 6,3V21A2,2 0 0,0 8,23H16A2,2 0 0,0 18,21V3A2,2 0 0,0 16,1Z" />
            </svg>`,
            default: `<svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
            </svg>`
        };
        
        return icons[fileType] || icons.default;
    }
    
    truncateFileName(fileName, maxLength) {
        if (fileName.length <= maxLength) return fileName;
        
        const extension = fileName.split('.').pop();
        const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf('.'));
        const truncatedName = nameWithoutExt.substring(0, maxLength - extension.length - 4) + '...';
        
        return `${truncatedName}.${extension}`;
    }
    
    formatFileSize(bytes) {
        if (bytes === 0) return '0 B';
        const k = 1024;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    }
    
    showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 16px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 1000;
            animation: slideInRight 0.3s ease-out;
            max-width: 300px;
            word-wrap: break-word;
        `;
        
        // Set background color based on type
        const colors = {
            success: '#10b981',
            error: '#ef4444',
            warning: '#f59e0b',
            info: '#3b82f6'
        };
        
        notification.style.backgroundColor = colors[type] || colors.info;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            notification.style.animation = 'slideInRight 0.3s ease-out reverse';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }
    
    // Public methods
    clearAllFiles() {
        this.selectedFiles = [];
        this.fileList.innerHTML = '';
        this.updateFileInput();
        this.updateUploadStats();
        this.showNotification('All files cleared', 'info');
    }
    
    getSelectedFiles() {
        return this.selectedFiles;
    }
    
    getTotalSize() {
        return this.selectedFiles.reduce((sum, file) => sum + file.size, 0);
    }
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
`;
document.head.appendChild(style);

// Initialize file upload manager when DOM is loaded
let fileUploadManager;

document.addEventListener('DOMContentLoaded', function() {
    // Initialize with default options
    fileUploadManager = new FileUploadManager();
    
    // Make it globally accessible for onclick handlers
    window.fileUploadManager = fileUploadManager;
    
    // Initialize additional form functionality
    initializeFormEnhancements();
});

// Additional form enhancements for admin compose and user create forms
function initializeFormEnhancements() {
    // Message Type Selection Styling (for admin forms)
    const messageTypeInputs = document.querySelectorAll('input[name="message_type"]');
    if (messageTypeInputs.length > 0) {
        messageTypeInputs.forEach(radio => {
            radio.addEventListener('change', function() {
                // Remove active state from all labels
                messageTypeInputs.forEach(r => {
                    const label = r.closest('label');
                    if (label) {
                        label.classList.remove('ring-2', 'ring-indigo-500', 'border-indigo-500');
                        const svg = label.querySelector('svg');
                        if (svg) {
                            svg.classList.remove('text-indigo-500');
                            svg.classList.add('text-gray-400');
                        }
                    }
                });

                // Add active state to selected label
                if (this.checked) {
                    const label = this.closest('label');
                    if (label) {
                        label.classList.add('ring-2', 'ring-indigo-500', 'border-indigo-500');
                        const svg = label.querySelector('svg');
                        if (svg) {
                            svg.classList.remove('text-gray-400');
                            svg.classList.add('text-indigo-500');
                        }
                    }
                }
            });
        });

        // Initialize message type selection
        const checkedInput = document.querySelector('input[name="message_type"]:checked');
        if (checkedInput) {
            checkedInput.dispatchEvent(new Event('change'));
        }
    }

    // Quick Templates Functionality (for admin forms)
    const templateButtons = document.querySelectorAll('.template-btn');
    if (templateButtons.length > 0) {
        templateButtons.forEach(button => {
            button.addEventListener('click', function() {
                const template = this.dataset.template;
                const contentArea = document.getElementById('content') || document.getElementById('message');
                if (contentArea && template) {
                    contentArea.value = template;
                    contentArea.focus();
                }
            });
        });
    }

    // Character Counter
    const contentArea = document.getElementById('content') || document.getElementById('message');
    const characterCounter = document.querySelector('.character-counter');
    if (contentArea && characterCounter) {
        const maxLength = 1000; // Set your desired maximum length

        contentArea.addEventListener('input', function() {
            const remaining = maxLength - this.value.length;
            characterCounter.textContent = `${remaining} characters remaining`;
            
            // Add visual feedback for character limit
            if (remaining < 50) {
                characterCounter.classList.add('text-red-500');
                characterCounter.classList.remove('text-gray-500');
            } else {
                characterCounter.classList.remove('text-red-500');
                characterCounter.classList.add('text-gray-500');
            }
        });

        // Initialize character counter
        contentArea.dispatchEvent(new Event('input'));
    }

    // Enhanced Form Validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const recipient = document.getElementById('recipient');
            const subject = document.getElementById('subject');
            const content = document.getElementById('content') || document.getElementById('message');

            let isValid = true;
            let errorMessage = '';

            // Check required fields
            if (recipient && !recipient.value.trim()) {
                isValid = false;
                errorMessage = 'Please select a recipient.';
            } else if (subject && !subject.value.trim()) {
                isValid = false;
                errorMessage = 'Please enter a subject.';
            } else if (content && !content.value.trim()) {
                isValid = false;
                errorMessage = 'Please enter a message.';
            }

            if (!isValid) {
                e.preventDefault();
                showNotification(errorMessage, 'error');
                return false;
            }

            // Show loading state
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Sending...
                `;
            }
        });
    });

    // Global notification function for form validation
    if (typeof window.showNotification === 'undefined') {
        window.showNotification = function(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 12px 16px;
                border-radius: 8px;
                color: white;
                font-weight: 500;
                z-index: 1000;
                animation: slideInRight 0.3s ease-out;
                max-width: 300px;
                word-wrap: break-word;
            `;
            
            // Set background color based on type
            const colors = {
                success: '#10b981',
                error: '#ef4444',
                warning: '#f59e0b',
                info: '#3b82f6'
            };
            
            notification.style.backgroundColor = colors[type] || colors.info;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.style.animation = 'slideInRight 0.3s ease-out reverse';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        };
    }
}

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
    module.exports = FileUploadManager;
}