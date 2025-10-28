<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-semibold">
            {{ __('Write a Review') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <!-- Booking Details Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-mountain text-success me-2 fs-4"></i>
                                <h3 class="fs-5 fw-medium mb-0">{{ $booking->trail ?? 'Custom Trail' }}</h3>
                            </div>
                            <div class="row text-muted small">
                                <div class="col-sm-6 mb-1">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ \Carbon\Carbon::parse($booking->trek_date)->format('M d, Y') }}
                                </div>
                                <div class="col-sm-6 mb-1">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }}
                                </div>
                                <div class="col-sm-6 mb-1">
                                    <i class="bi bi-people me-1"></i>
                                    {{ $booking->local_tourists + $booking->foreign_tourists }} {{ Str::plural('person', $booking->local_tourists + $booking->foreign_tourists) }}
                                </div>
                                <div class="col-sm-6 mb-1">
                                    <i class="bi bi-check-circle text-success me-1"></i>
                                    {{ ucfirst($booking->status) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="bg-light rounded p-3 text-center">
                                <div class="text-muted small">Booking ID</div>
                                <div class="fw-bold">#{{ $booking->id }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review Form Card -->
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-star me-2"></i>Share Your Experience
                    </h4>
                    <small class="opacity-75">Help other hikers by sharing your honest review</small>
                </div>
                <div class="card-body p-4">

                    <form method="POST" action="{{ route('user.reviews.store', $booking) }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        
                        <!-- Review Guidelines -->
                        <div class="alert alert-info border-0 mb-4" style="background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-lightbulb text-primary me-3 mt-1" style="font-size: 1.2rem;"></i>
                                <div>
                                    <h6 class="alert-heading mb-2">
                                        <i class="bi bi-star-fill text-warning me-1"></i>
                                        Tips for Writing a Great Review
                                    </h6>
                                    <ul class="mb-0 small">
                                        <li><strong>Be specific:</strong> Mention trail conditions, difficulty level, and scenery</li>
                                        <li><strong>Guide feedback:</strong> Comment on your guide's knowledge and helpfulness</li>
                                        <li><strong>Photos help:</strong> Add images to show the trail and views</li>
                                        <li><strong>Be honest:</strong> Your review helps other hikers make informed decisions</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-star-fill text-warning me-1"></i>
                                How would you rate your experience?
                            </label>
                            <div class="rating-container bg-light rounded p-3">
                                <div class="d-flex justify-content-center gap-2 mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <label class="star-label cursor-pointer" data-rating="{{ $i }}">
                                            <input type="radio" name="rating" value="{{ $i }}" class="d-none" {{ old('rating') == $i ? 'checked' : '' }}>
                                            <svg class="star-icon text-secondary" 
                                                width="40" height="40" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </label>
                                    @endfor
                                </div>
                                <div class="text-center">
                                    <span id="rating-label" class="text-muted small">Click a star to rate</span>
                                </div>
                            </div>
                            @error('rating')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="comment" class="form-label fw-semibold">
                                <i class="bi bi-chat-text text-primary me-1"></i>
                                Tell us about your experience
                            </label>
                            <div class="position-relative">
                                <textarea id="comment" name="comment" rows="5" 
                                    class="form-control form-control-lg"
                                    placeholder="Share details about the trail, guide, scenery, difficulty level, and any memorable moments from your trek..."
                                    maxlength="1000">{{ old('comment') }}</textarea>
                                <div class="position-absolute bottom-0 end-0 p-2">
                                    <small class="text-muted">
                                        <span id="char-count">{{ strlen(old('comment', '')) }}</span>/1000
                                    </small>
                                </div>
                            </div>
                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>
                                Your review will help other hikers and will be visible after moderation.
                            </div>
                            @error('comment')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="images" class="form-label fw-semibold">
                                <i class="bi bi-camera text-primary me-1"></i>
                                Add Photos (Optional)
                            </label>
                            <div class="upload-area border-2 border-dashed rounded-3 p-4 text-center position-relative" 
                                 id="upload-area"
                                 ondrop="dropHandler(event);" 
                                 ondragover="dragOverHandler(event);" 
                                 ondragleave="dragLeaveHandler(event);">
                                <div class="upload-content">
                                    <i class="bi bi-cloud-upload display-6 text-muted mb-2"></i>
                                    <p class="mb-2 fw-medium">Drag & drop your photos here</p>
                                    <p class="text-muted small mb-3">or</p>
                                    <input type="file" id="images" name="images[]" multiple accept="image/*" class="d-none">
                                    <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('images').click()">
                                        <i class="bi bi-plus-circle me-1"></i>Choose Files
                                    </button>
                                </div>
                            </div>
                            <div class="form-text mt-2">
                                <i class="bi bi-info-circle me-1"></i>
                                Upload up to 5 photos (max 2MB each). Supported formats: JPG, PNG, GIF, WebP
                            </div>
                            @error('images')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                            @error('images.*')
                                <div class="text-danger small mt-2">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <div id="image-preview" class="mt-3"></div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center gap-3">
                            <a href="{{ route('user.bookings.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Back to Bookings
                            </a>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-light" onclick="resetForm()">
                                    <i class="bi bi-arrow-clockwise me-1"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-primary btn-lg px-4" id="submit-btn">
                                    <span class="submit-text">
                                        <i class="bi bi-send me-1"></i>Submit Review
                                    </span>
                                    <span class="submit-loading d-none">
                                        <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                        Submitting...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .booking-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        }
        
        .booking-card .card-body {
            backdrop-filter: blur(10px);
        }
        
        .info-item {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        
        .info-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }
        
        .rating-container {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 1.5rem;
            border: 2px solid #e9ecef;
            transition: border-color 0.3s ease;
        }
        
        .rating-container:focus-within {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        
        .star-rating {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 1rem;
        }
        
        .star {
            cursor: pointer;
            transition: all 0.2s ease;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }
        
        .star:hover {
            transform: scale(1.1);
        }
        
        .star.active {
            color: #ffc107;
            transform: scale(1.05);
        }
        
        .star.hover {
            color: #ffc107;
            transform: scale(1.1);
        }
        
        .rating-label {
            font-weight: 600;
            font-size: 1.1rem;
            color: #495057;
            text-align: center;
            min-height: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .upload-area {
            border-color: #dee2e6;
            background: #f8f9fa;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .upload-area:hover {
            border-color: #0d6efd;
            background: #e7f1ff;
        }
        
        .upload-area.drag-over {
            border-color: #0d6efd;
            background: #e7f1ff;
            transform: scale(1.02);
        }
        
        .image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 15px;
        }
        
        .preview-item {
            position: relative;
            width: 120px;
            height: 120px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }
        
        .preview-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        
        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.2s ease;
        }
        
        .remove-btn:hover {
            background: #dc3545;
            transform: scale(1.1);
        }
        
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(13, 110, 253, 0.3);
        }
        
        .progress-bar {
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #0d6efd, #0056b3);
            border-radius: 2px;
            transition: width 0.3s ease;
        }
        
        .char-counter {
            transition: color 0.3s ease;
        }
        
        .char-counter.warning {
            color: #fd7e14;
        }
        
        .char-counter.danger {
            color: #dc3545;
        }
        
        .star-icon {
            cursor: pointer;
            transition: color 0.2s;
        }
        .star-icon:hover {
            color: var(--bs-warning) !important;
        }
        input[type="radio"]:checked + .star-icon {
            color: var(--bs-warning) !important;
        }
        
        .image-preview {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            background: #f8f9fa;
        }
        
        .image-preview img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }
        
        .image-preview .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(220, 53, 69, 0.8);
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            font-size: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .image-preview .remove-image:hover {
            background: rgba(220, 53, 69, 1);
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        let selectedFiles = [];
        let currentRating = 0;
        
        // Star rating functionality
        const ratingLabels = {
            0: 'Click a star to rate',
            1: 'Poor - Very disappointing',
            2: 'Fair - Below expectations',
            3: 'Good - Met expectations',
            4: 'Very Good - Exceeded expectations',
            5: 'Excellent - Outstanding experience!'
        };
        
        document.addEventListener('DOMContentLoaded', function() {
            const starLabels = document.querySelectorAll('.star-label');
            const ratingLabel = document.getElementById('rating-label');
            
            starLabels.forEach((label, index) => {
                const input = label.querySelector('input[type="radio"]');
                const icon = label.querySelector('.star-icon');
                
                label.addEventListener('mouseenter', () => {
                    highlightStars(index + 1);
                    ratingLabel.textContent = ratingLabels[index + 1];
                });
                
                label.addEventListener('mouseleave', () => {
                    highlightStars(currentRating);
                    ratingLabel.textContent = ratingLabels[currentRating];
                });
                
                label.addEventListener('click', () => {
                    currentRating = index + 1;
                    input.checked = true;
                    highlightStars(currentRating);
                    ratingLabel.textContent = ratingLabels[currentRating];
                });
            });
            
            function highlightStars(rating) {
                starLabels.forEach((label, index) => {
                    const icon = label.querySelector('.star-icon');
                    if (index < rating) {
                        icon.classList.remove('text-secondary');
                        icon.classList.add('text-warning');
                    } else {
                        icon.classList.remove('text-warning');
                        icon.classList.add('text-secondary');
                    }
                });
            }
            
            // Character counter functionality
            const commentTextarea = document.getElementById('comment');
            const charCount = document.getElementById('char-count');
            
            commentTextarea.addEventListener('input', function() {
                const currentLength = this.value.length;
                charCount.textContent = currentLength;
                
                // Update counter color based on character count
                charCount.className = 'text-muted';
                if (currentLength > 800) {
                    charCount.className = 'char-counter warning';
                }
                if (currentLength > 950) {
                    charCount.className = 'char-counter danger';
                }
            });
            
            // Image upload preview functionality
            const imageInput = document.getElementById('images');
            
            imageInput.addEventListener('change', function(e) {
                handleFiles(e.target.files);
            });
        });
        
        // Drag and drop functionality
        function dragOverHandler(ev) {
            ev.preventDefault();
            document.getElementById('upload-area').classList.add('drag-over');
        }
        
        function dragLeaveHandler(ev) {
            ev.preventDefault();
            document.getElementById('upload-area').classList.remove('drag-over');
        }
        
        function dropHandler(ev) {
            ev.preventDefault();
            document.getElementById('upload-area').classList.remove('drag-over');
            
            const files = ev.dataTransfer.files;
            handleFiles(files);
        }
        
        function handleFiles(files) {
            const maxFiles = 5;
            const maxSize = 2 * 1024 * 1024; // 2MB
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
            
            // Clear previous selections
            selectedFiles = [];
            document.getElementById('image-preview').innerHTML = '';
            
            if (files.length > maxFiles) {
                alert(`You can only upload a maximum of ${maxFiles} images.`);
                return;
            }
            
            Array.from(files).forEach((file, index) => {
                if (!allowedTypes.includes(file.type)) {
                    alert(`${file.name} is not a supported image format.`);
                    return;
                }
                
                if (file.size > maxSize) {
                    alert(`${file.name} is too large. Maximum file size is 2MB.`);
                    return;
                }
                
                selectedFiles.push(file);
                displayImagePreview(file, index);
            });
            
            updateFileInput();
        }
        
        function displayImagePreview(file, index) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.getElementById('image-preview');
                
                const previewItem = document.createElement('div');
                previewItem.className = 'preview-item';
                previewItem.innerHTML = `
                    <img src="${e.target.result}" alt="Preview ${index + 1}">
                    <button type="button" class="remove-btn" onclick="removeImage(${index})">
                        <i class="bi bi-x"></i>
                    </button>
                `;
                
                previewContainer.appendChild(previewItem);
            };
            reader.readAsDataURL(file);
        }
        
        function removeImage(index) {
            selectedFiles.splice(index, 1);
            updateImagePreviews();
            updateFileInput();
        }
        
        function updateImagePreviews() {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = '';
            
            selectedFiles.forEach((file, index) => {
                displayImagePreview(file, index);
            });
        }
        
        function updateFileInput() {
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            document.getElementById('images').files = dt.files;
        }
        
        // Form submission with loading state
        document.querySelector('form').addEventListener('submit', function() {
            const submitBtn = document.getElementById('submit-btn');
            const submitText = submitBtn.querySelector('.submit-text');
            const submitLoading = submitBtn.querySelector('.submit-loading');
            
            submitText.classList.add('d-none');
            submitLoading.classList.remove('d-none');
            submitBtn.disabled = true;
        });
        
        // Reset form function
        function resetForm() {
            if (confirm('Are you sure you want to reset the form? All entered data will be lost.')) {
                document.querySelector('form').reset();
                selectedFiles = [];
                currentRating = 0;
                document.getElementById('image-preview').innerHTML = '';
                document.getElementById('char-count').textContent = '0';
                document.getElementById('rating-label').textContent = ratingLabels[0];
                
                // Reset star colors
                const starIcons = document.querySelectorAll('.star-icon');
                starIcons.forEach(icon => {
                    icon.classList.remove('text-warning');
                    icon.classList.add('text-secondary');
                });
            }
        }
    </script>
    @endpush
</x-app-layout>