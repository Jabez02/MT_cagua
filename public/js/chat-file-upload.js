class ChatFileUploadManager {
    constructor(chatApp) {
        this.chatApp = chatApp;
        this.maxFileSize = 10 * 1024 * 1024; // 10MB
        this.allowedTypes = {
            images: ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'],
            documents: ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain', 'text/csv'],
            archives: ['application/zip', 'application/x-rar-compressed', 'application/x-7z-compressed']
        };
        this.selectedFiles = [];
        
        this.init();
    }

    init() {
        this.setupDragAndDrop();
        this.setupFileInput();
        this.setupPasteHandler();
    }

    setupDragAndDrop() {
        const chatArea = document.getElementById('chatArea');
        const messageInput = document.getElementById('messageInput');
        
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            chatArea.addEventListener(eventName, this.preventDefaults, false);
            document.body.addEventListener(eventName, this.preventDefaults, false);
        });

        // Highlight drop area
        ['dragenter', 'dragover'].forEach(eventName => {
            chatArea.addEventListener(eventName, () => this.highlight(chatArea), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            chatArea.addEventListener(eventName, () => this.unhighlight(chatArea), false);
        });

        // Handle dropped files
        chatArea.addEventListener('drop', (e) => this.handleDrop(e), false);
        messageInput.addEventListener('drop', (e) => this.handleDrop(e), false);
    }

    setupFileInput() {
        const fileInput = document.getElementById('fileInput');
        fileInput.addEventListener('change', (e) => {
            this.handleFileSelection(Array.from(e.target.files));
        });

        // Allow multiple file selection
        fileInput.setAttribute('multiple', 'true');
    }

    setupPasteHandler() {
        const messageInput = document.getElementById('messageInput');
        messageInput.addEventListener('paste', (e) => {
            const items = Array.from(e.clipboardData.items);
            const files = items
                .filter(item => item.kind === 'file')
                .map(item => item.getAsFile())
                .filter(file => file !== null);

            if (files.length > 0) {
                e.preventDefault();
                this.handleFileSelection(files);
            }
        });
    }

    preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    highlight(element) {
        element.classList.add('drag-over');
    }

    unhighlight(element) {
        element.classList.remove('drag-over');
    }

    handleDrop(e) {
        const dt = e.dataTransfer;
        const files = Array.from(dt.files);
        
        if (files.length > 0) {
            this.handleFileSelection(files);
        }
    }

    handleFileSelection(files) {
        // Validate files
        const validFiles = files.filter(file => this.validateFile(file));
        
        if (validFiles.length === 0) {
            this.chatApp.showError('No valid files selected');
            return;
        }

        // Add to selected files
        this.selectedFiles = [...this.selectedFiles, ...validFiles];
        
        // Update UI
        this.updateFilePreview();
        
        // Limit to 5 files at once
        if (this.selectedFiles.length > 5) {
            this.selectedFiles = this.selectedFiles.slice(0, 5);
            this.chatApp.showError('Maximum 5 files allowed at once');
            this.updateFilePreview();
        }
    }

    validateFile(file) {
        // Check file size
        if (file.size > this.maxFileSize) {
            this.chatApp.showError(`File "${file.name}" is too large. Maximum size is 10MB.`);
            return false;
        }

        // Check file type
        const allAllowedTypes = [
            ...this.allowedTypes.images,
            ...this.allowedTypes.documents,
            ...this.allowedTypes.archives
        ];

        if (!allAllowedTypes.includes(file.type)) {
            this.chatApp.showError(`File type "${file.type}" is not allowed for "${file.name}".`);
            return false;
        }

        return true;
    }

    updateFilePreview() {
        const container = document.querySelector('.message-input-container');
        let previewContainer = container.querySelector('.files-preview-container');
        
        if (!previewContainer) {
            previewContainer = document.createElement('div');
            previewContainer.className = 'files-preview-container';
            container.insertBefore(previewContainer, container.querySelector('.message-form'));
        }

        if (this.selectedFiles.length === 0) {
            previewContainer.remove();
            return;
        }

        previewContainer.innerHTML = `
            <div class="files-preview-header">
                <span class="files-count">${this.selectedFiles.length} file(s) selected</span>
                <button type="button" class="btn-clear-all" title="Clear all files">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <div class="files-preview-list">
                ${this.selectedFiles.map((file, index) => this.createFilePreviewItem(file, index)).join('')}
            </div>
        `;

        // Add event listeners
        previewContainer.querySelector('.btn-clear-all').addEventListener('click', () => {
            this.clearAllFiles();
        });

        previewContainer.querySelectorAll('.btn-remove-file').forEach((btn, index) => {
            btn.addEventListener('click', () => {
                this.removeFile(index);
            });
        });

        previewContainer.querySelectorAll('.file-preview-item').forEach((item, index) => {
            item.addEventListener('click', () => {
                this.previewFile(this.selectedFiles[index]);
            });
        });
    }

    createFilePreviewItem(file, index) {
        const isImage = this.allowedTypes.images.includes(file.type);
        const fileIcon = this.getFileIcon(file.type);
        const fileSize = this.formatFileSize(file.size);

        let preview = '';
        if (isImage) {
            const objectURL = URL.createObjectURL(file);
            preview = `<img src="${objectURL}" alt="${file.name}" class="file-thumbnail">`;
        } else {
            preview = `<i class="bi ${fileIcon} file-icon"></i>`;
        }

        return `
            <div class="file-preview-item" data-index="${index}">
                <div class="file-preview-content">
                    <div class="file-preview-thumbnail">
                        ${preview}
                    </div>
                    <div class="file-preview-info">
                        <div class="file-name" title="${file.name}">${this.truncateFileName(file.name)}</div>
                        <div class="file-size">${fileSize}</div>
                    </div>
                </div>
                <button type="button" class="btn-remove-file" title="Remove file">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        `;
    }

    getFileIcon(mimeType) {
        if (this.allowedTypes.images.includes(mimeType)) {
            return 'bi-image';
        } else if (mimeType === 'application/pdf') {
            return 'bi-file-earmark-pdf';
        } else if (mimeType.includes('word') || mimeType.includes('document')) {
            return 'bi-file-earmark-word';
        } else if (mimeType.includes('text')) {
            return 'bi-file-earmark-text';
        } else if (this.allowedTypes.archives.includes(mimeType)) {
            return 'bi-file-earmark-zip';
        } else {
            return 'bi-file-earmark';
        }
    }

    truncateFileName(name, maxLength = 25) {
        if (name.length <= maxLength) return name;
        
        const extension = name.split('.').pop();
        const nameWithoutExt = name.substring(0, name.lastIndexOf('.'));
        const truncatedName = nameWithoutExt.substring(0, maxLength - extension.length - 4) + '...';
        
        return truncatedName + '.' + extension;
    }

    formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    removeFile(index) {
        // Revoke object URL if it's an image
        const file = this.selectedFiles[index];
        if (this.allowedTypes.images.includes(file.type)) {
            const previewItem = document.querySelector(`[data-index="${index}"]`);
            const img = previewItem?.querySelector('img');
            if (img) {
                URL.revokeObjectURL(img.src);
            }
        }

        this.selectedFiles.splice(index, 1);
        this.updateFilePreview();
    }

    clearAllFiles() {
        // Revoke all object URLs
        this.selectedFiles.forEach(file => {
            if (this.allowedTypes.images.includes(file.type)) {
                const objectURL = document.querySelector(`img[alt="${file.name}"]`)?.src;
                if (objectURL && objectURL.startsWith('blob:')) {
                    URL.revokeObjectURL(objectURL);
                }
            }
        });

        this.selectedFiles = [];
        this.updateFilePreview();
        
        // Clear file input
        document.getElementById('fileInput').value = '';
    }

    previewFile(file) {
        if (this.allowedTypes.images.includes(file.type)) {
            this.showImagePreview(file);
        } else {
            // For non-images, show file info
            this.showFileInfo(file);
        }
    }

    showImagePreview(file) {
        const modal = document.getElementById('filePreviewModal');
        const title = document.getElementById('filePreviewTitle');
        const content = document.getElementById('filePreviewContent');
        const downloadBtn = document.getElementById('downloadFileBtn');

        const objectURL = URL.createObjectURL(file);
        
        title.textContent = file.name;
        content.innerHTML = `<img src="${objectURL}" alt="${file.name}" style="max-width: 100%; height: auto;">`;
        downloadBtn.href = objectURL;
        downloadBtn.download = file.name;

        const modalInstance = new bootstrap.Modal(modal);
        modalInstance.show();

        // Clean up object URL when modal is closed
        modal.addEventListener('hidden.bs.modal', () => {
            URL.revokeObjectURL(objectURL);
        }, { once: true });
    }

    showFileInfo(file) {
        const modal = document.getElementById('filePreviewModal');
        const title = document.getElementById('filePreviewTitle');
        const content = document.getElementById('filePreviewContent');
        const downloadBtn = document.getElementById('downloadFileBtn');

        const objectURL = URL.createObjectURL(file);
        const fileIcon = this.getFileIcon(file.type);
        
        title.textContent = file.name;
        content.innerHTML = `
            <div class="file-info-preview">
                <i class="bi ${fileIcon}" style="font-size: 4rem; color: #007bff; margin-bottom: 20px;"></i>
                <h5>${file.name}</h5>
                <p><strong>Size:</strong> ${this.formatFileSize(file.size)}</p>
                <p><strong>Type:</strong> ${file.type}</p>
                <p><strong>Last Modified:</strong> ${new Date(file.lastModified).toLocaleString()}</p>
            </div>
        `;
        downloadBtn.href = objectURL;
        downloadBtn.download = file.name;

        const modalInstance = new bootstrap.Modal(modal);
        modalInstance.show();

        // Clean up object URL when modal is closed
        modal.addEventListener('hidden.bs.modal', () => {
            URL.revokeObjectURL(objectURL);
        }, { once: true });
    }

    getSelectedFiles() {
        return this.selectedFiles;
    }

    hasFiles() {
        return this.selectedFiles.length > 0;
    }
}

// Add CSS for file upload features
const chatFileUploadStyles = document.createElement('style');
chatFileUploadStyles.textContent = `
    .drag-over {
        background-color: rgba(0, 123, 255, 0.1) !important;
        border: 2px dashed #007bff !important;
    }

    .files-preview-container {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        margin-bottom: 15px;
        overflow: hidden;
    }

    .files-preview-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 15px;
        background: #e9ecef;
        border-bottom: 1px solid #dee2e6;
    }

    .files-count {
        font-size: 0.9rem;
        font-weight: 500;
        color: #495057;
    }

    .btn-clear-all {
        background: none;
        border: none;
        color: #dc3545;
        cursor: pointer;
        padding: 2px;
        border-radius: 4px;
        transition: background-color 0.2s ease;
    }

    .btn-clear-all:hover {
        background: rgba(220, 53, 69, 0.1);
    }

    .files-preview-list {
        padding: 10px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        max-height: 200px;
        overflow-y: auto;
    }

    .file-preview-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 12px;
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .file-preview-item:hover {
        background: #f8f9fa;
        border-color: #007bff;
    }

    .file-preview-content {
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
        min-width: 0;
    }

    .file-preview-thumbnail {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        overflow: hidden;
        background: #f8f9fa;
    }

    .file-thumbnail {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .file-icon {
        font-size: 1.5rem;
        color: #007bff;
    }

    .file-preview-info {
        flex: 1;
        min-width: 0;
    }

    .file-name {
        font-weight: 500;
        color: #2c3e50;
        font-size: 0.9rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .file-size {
        font-size: 0.8rem;
        color: #6c757d;
        margin-top: 2px;
    }

    .btn-remove-file {
        background: none;
        border: none;
        color: #6c757d;
        cursor: pointer;
        padding: 4px;
        border-radius: 4px;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .btn-remove-file:hover {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    .file-info-preview {
        text-align: center;
        padding: 20px;
    }

    .file-info-preview h5 {
        margin: 15px 0 20px;
        word-break: break-word;
    }

    .file-info-preview p {
        margin-bottom: 10px;
        text-align: left;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .files-preview-list {
            max-height: 150px;
        }
        
        .file-preview-item {
            padding: 6px 10px;
        }
        
        .file-preview-thumbnail {
            width: 35px;
            height: 35px;
        }
        
        .file-name {
            font-size: 0.85rem;
        }
        
        .file-size {
            font-size: 0.75rem;
        }
    }
`;

document.head.appendChild(chatFileUploadStyles);

// Export for use in chat.js
window.ChatFileUploadManager = ChatFileUploadManager;