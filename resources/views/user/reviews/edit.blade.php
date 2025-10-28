<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h2 class="fs-4 fw-semibold mb-1">
                    {{ __('Edit Review') }}
                </h2>
                <p class="text-muted mb-0 small">Update your review and share your updated experience</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('user.reviews.show', $review) }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back to Review
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <!-- Booking Details Card -->
            <div class="card shadow-sm mb-4 booking-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-mountain text-success me-2"></i>
                                <h4 class="mb-0 fw-bold text-dark">{{ $review->booking->trail }}</h4>
                            </div>
                            <div class="row text-muted small">
                                <div class="col-sm-6 mb-1">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ \Carbon\Carbon::parse($review->booking->trek_date)->format('M d, Y') }}
                                </div>
                                <div class="col-sm-6 mb-1">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ \Carbon\Carbon::parse($review->booking->start_time)->format('h:i A') }}
                                </div>
                                <div class="col-sm-6 mb-1">
                                    <i class="fas fa-users me-1"></i>
                                    {{ $review->booking->number_of_participants }} participant(s)
                                </div>
                                <div class="col-sm-6 mb-1">
                                    <i class="fas fa-tag me-1"></i>
                                    Booking #{{ $review->booking->id }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <span class="badge bg-success-subtle text-success px-3 py-2">
                                <i class="fas fa-check-circle me-1"></i>
                                {{ ucfirst($review->booking->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Form -->
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-edit text-primary me-2"></i>
                        Update Your Review
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('user.reviews.update', $review) }}" enctype="multipart/form-data" id="editReviewForm">
                        @csrf
                        @method('PATCH')

                        <!-- Star Rating Section -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold mb-3">
                                <i class="fas fa-star text-warning me-1"></i>
                                Rate Your Experience
                            </label>
                            <div class="rating-container text-center">
                                <div class="d-flex justify-content-center gap-2 mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <label class="star-label">
                                            <input type="radio" name="rating" value="{{ $i }}" class="d-none star-input" 
                                                {{ (old('rating', $review->rating) == $i) ? 'checked' : '' }}>
                                            <svg class="star-icon {{ (old('rating', $review->rating) >= $i) ? 'text-warning' : 'text-muted' }}" 
                                                width="40" height="40" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        </label>
                                    @endfor
                                </div>
                                <div class="rating-label text-muted small" id="ratingLabel">
                                    @if(old('rating', $review->rating))
                                        @switch(old('rating', $review->rating))
                                            @case(1) Poor @break
                                            @case(2) Fair @break
                                            @case(3) Good @break
                                            @case(4) Very Good @break
                                            @case(5) Excellent @break
                                        @endswitch
                                    @else
                                        Click to rate your experience
                                    @endif
                                </div>
                            </div>
                            @error('rating')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Comment Section -->
                        <div class="mb-4">
                            <label for="comment" class="form-label fw-semibold">
                                <i class="fas fa-comment text-info me-1"></i>
                                Your Updated Review
                            </label>
                            <textarea id="comment" name="comment" rows="5" 
                                class="form-control form-control-lg"
                                placeholder="Share your updated thoughts about this trek experience. What made it special? How was the guide? What would you recommend to other trekkers?"
                                maxlength="1000">{{ old('comment', $review->comment) }}</textarea>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Your review will need to be moderated again after editing.
                            </div>
                                <div class="character-counter text-muted small">
                                    <span id="charCount">{{ strlen(old('comment', $review->comment)) }}</span>/1000
                                </div>
                            </div>
                            @error('comment')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Image Upload Section -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-camera text-success me-1"></i>
                                Update Photos
                            </label>
                            
                            <!-- Current Images -->
                            @if($review->images && count($review->images) > 0)
                                <div class="current-images mb-3">
                                    <p class="text-muted small mb-2">Current images (click to remove):</p>
                                    <div class="row g-2">
                                        @foreach($review->images as $image)
                                            <div class="col-md-3 col-sm-4 col-6">
                                                <div class="position-relative current-image-container">
                                                    <img src="{{ asset('storage/' . $image) }}" 
                                                         class="img-fluid rounded shadow-sm current-image" 
                                                         style="height: 120px; width: 100%; object-fit: cover;">
                                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 remove-current-image" 
                                                            data-image="{{ $image }}">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="removed_images" id="removedImages" value="">
                                </div>
                            @endif

                            <!-- New Image Upload -->
                            <div class="upload-area border-2 border-dashed rounded p-4 text-center" id="uploadArea">
                                <div class="upload-content">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                    <h6 class="mb-2">Add New Photos</h6>
                                    <p class="text-muted mb-3">Drag and drop images here, or click to browse</p>
                                    <button type="button" class="btn btn-outline-primary btn-sm" id="browseBtn">
                                        <i class="fas fa-folder-open me-1"></i>
                                        Choose Files
                                    </button>
                                </div>
                                <input type="file" name="images[]" id="imageInput" multiple accept="image/*" class="d-none">
                            </div>
                            <div class="form-text mt-2">
                                <i class="fas fa-info-circle me-1"></i>
                                You can upload up to 5 images. Supported formats: JPG, PNG, GIF (max 2MB each)
                            </div>
                            @error('images')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                            @error('images.*')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror

                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-3 d-none">
                                <p class="text-muted small mb-2">New images to upload:</p>
                                <div class="row g-2" id="previewContainer"></div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-outline-secondary" id="resetBtn">
                                    <i class="fas fa-undo me-1"></i>
                                    Reset Changes
                                </button>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('user.reviews.show', $review) }}" 
                                   class="btn btn-light">
                                    <i class="fas fa-times me-1"></i>
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                    <span class="submit-text">
                                        <i class="fas fa-save me-1"></i>
                                        Update Review
                                    </span>
                                    <span class="loading-text d-none">
                                        <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                                        Updating...
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
        /* Booking Card Styles */
        .booking-card {
            border-left: 4px solid #28a745;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }

        /* Star Rating Styles */
        .rating-container {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin: 10px 0;
        }

        .star-label {
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .star-label:hover {
            transform: scale(1.1);
        }

        .star-icon {
            cursor: pointer;
            transition: all 0.3s ease;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }

        .star-icon:hover {
            color: #ffc107 !important;
            transform: scale(1.1);
        }

        .star-input:checked + .star-icon {
            color: #ffc107 !important;
            animation: starPulse 0.3s ease;
        }

        @keyframes starPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .rating-label {
            font-weight: 500;
            min-height: 20px;
        }

        /* Comment Textarea Styles */
        #comment {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            transition: border-color 0.3s ease;
            resize: vertical;
        }

        #comment:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .character-counter {
            font-weight: 500;
        }

        /* Image Upload Styles */
        .upload-area {
            border-color: #dee2e6;
            background: #f8f9fa;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .upload-area:hover {
            border-color: #0d6efd;
            background: #e7f3ff;
        }

        .upload-area.dragover {
            border-color: #28a745;
            background: #d4edda;
        }

        .current-image-container {
            transition: transform 0.2s ease;
        }

        .current-image-container:hover {
            transform: scale(1.02);
        }

        .current-image {
            transition: opacity 0.2s ease;
        }

        .current-image-container:hover .current-image {
            opacity: 0.8;
        }

        .remove-current-image {
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .current-image-container:hover .remove-current-image {
            opacity: 1;
        }

        .preview-image-container {
            position: relative;
            transition: transform 0.2s ease;
        }

        .preview-image-container:hover {
            transform: scale(1.02);
        }

        .remove-preview {
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .preview-image-container:hover .remove-preview {
            opacity: 1;
        }

        /* Button Styles */
        .btn {
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
        }

        /* Form Enhancements */
        .form-control-lg {
            font-size: 1rem;
            padding: 12px 16px;
        }

        .form-label {
            color: #495057;
            margin-bottom: 8px;
        }

        .card-header {
            border-bottom: 2px solid #e9ecef;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .rating-container {
                padding: 15px;
            }
            
            .star-icon {
                width: 32px;
                height: 32px;
            }
            
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 10px;
            }
            
            .d-flex.gap-2 {
                justify-content: center;
            }
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Star Rating Functionality
            const stars = document.querySelectorAll('input[name="rating"]');
            const ratingLabel = document.getElementById('ratingLabel');
            const ratingLabels = ['', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];

            stars.forEach((star, index) => {
                star.addEventListener('change', function() {
                    const value = parseInt(this.value);
                    updateStars(value);
                    ratingLabel.textContent = ratingLabels[value];
                });

                // Add hover effects
                star.parentElement.addEventListener('mouseenter', function() {
                    const value = parseInt(star.value);
                    updateStars(value);
                    ratingLabel.textContent = ratingLabels[value];
                });
            });

            // Reset stars on mouse leave
            document.querySelector('.rating-container').addEventListener('mouseleave', function() {
                const checkedStar = document.querySelector('input[name="rating"]:checked');
                if (checkedStar) {
                    const value = parseInt(checkedStar.value);
                    updateStars(value);
                    ratingLabel.textContent = ratingLabels[value];
                } else {
                    updateStars(0);
                    ratingLabel.textContent = 'Click to rate your experience';
                }
            });

            function updateStars(rating) {
                stars.forEach((star, index) => {
                    const svg = star.nextElementSibling;
                    if (index < rating) {
                        svg.classList.remove('text-muted');
                        svg.classList.add('text-warning');
                    } else {
                        svg.classList.remove('text-warning');
                        svg.classList.add('text-muted');
                    }
                });
            }

            // Character Counter
            const commentTextarea = document.getElementById('comment');
            const charCount = document.getElementById('charCount');

            commentTextarea.addEventListener('input', function() {
                const count = this.value.length;
                charCount.textContent = count;
                
                if (count > 900) {
                    charCount.parentElement.classList.add('text-warning');
                } else if (count > 950) {
                    charCount.parentElement.classList.add('text-danger');
                } else {
                    charCount.parentElement.classList.remove('text-warning', 'text-danger');
                }
            });

            // Image Upload Functionality
            const uploadArea = document.getElementById('uploadArea');
            const imageInput = document.getElementById('imageInput');
            const browseBtn = document.getElementById('browseBtn');
            const imagePreview = document.getElementById('imagePreview');
            const previewContainer = document.getElementById('previewContainer');
            let selectedFiles = [];

            // Browse button click
            browseBtn.addEventListener('click', () => imageInput.click());
            uploadArea.addEventListener('click', () => imageInput.click());

            // Drag and drop functionality
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('dragover');
            });

            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
                const files = Array.from(e.dataTransfer.files);
                handleFiles(files);
            });

            // File input change
            imageInput.addEventListener('change', function() {
                const files = Array.from(this.files);
                handleFiles(files);
            });

            function handleFiles(files) {
                const validFiles = files.filter(file => {
                    return file.type.startsWith('image/') && file.size <= 2 * 1024 * 1024; // 2MB limit
                });

                if (selectedFiles.length + validFiles.length > 5) {
                    alert('You can only upload up to 5 images.');
                    return;
                }

                selectedFiles = selectedFiles.concat(validFiles);
                updateImagePreview();
                updateFileInput();
            }

            function updateImagePreview() {
                if (selectedFiles.length === 0) {
                    imagePreview.classList.add('d-none');
                    return;
                }

                imagePreview.classList.remove('d-none');
                previewContainer.innerHTML = '';

                selectedFiles.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewDiv = document.createElement('div');
                        previewDiv.className = 'col-md-3 col-sm-4 col-6';
                        previewDiv.innerHTML = `
                            <div class="position-relative preview-image-container">
                                <img src="${e.target.result}" class="img-fluid rounded shadow-sm" 
                                     style="height: 120px; width: 100%; object-fit: cover;">
                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 remove-preview" 
                                        data-index="${index}">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        `;
                        previewContainer.appendChild(previewDiv);
                    };
                    reader.readAsDataURL(file);
                });
            }

            function updateFileInput() {
                const dt = new DataTransfer();
                selectedFiles.forEach(file => dt.items.add(file));
                imageInput.files = dt.files;
            }

            // Remove preview image
            previewContainer.addEventListener('click', function(e) {
                if (e.target.closest('.remove-preview')) {
                    const index = parseInt(e.target.closest('.remove-preview').dataset.index);
                    selectedFiles.splice(index, 1);
                    updateImagePreview();
                    updateFileInput();
                }
            });

            // Remove current images
            let removedImages = [];
            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-current-image')) {
                    const imageContainer = e.target.closest('.current-image-container').parentElement;
                    const imagePath = e.target.closest('.remove-current-image').dataset.image;
                    
                    removedImages.push(imagePath);
                    document.getElementById('removedImages').value = JSON.stringify(removedImages);
                    
                    imageContainer.style.opacity = '0.5';
                    imageContainer.style.pointerEvents = 'none';
                    e.target.closest('.remove-current-image').innerHTML = '<i class="fas fa-check"></i>';
                    e.target.closest('.remove-current-image').classList.remove('btn-danger');
                    e.target.closest('.remove-current-image').classList.add('btn-success');
                }
            });

            // Form submission
            const form = document.getElementById('editReviewForm');
            const submitBtn = document.getElementById('submitBtn');

            form.addEventListener('submit', function() {
                const submitText = submitBtn.querySelector('.submit-text');
                const loadingText = submitBtn.querySelector('.loading-text');
                
                submitText.classList.add('d-none');
                loadingText.classList.remove('d-none');
                submitBtn.disabled = true;
            });

            // Reset form
            document.getElementById('resetBtn').addEventListener('click', function() {
                if (confirm('Are you sure you want to reset all changes?')) {
                    form.reset();
                    selectedFiles = [];
                    removedImages = [];
                    updateImagePreview();
                    document.getElementById('removedImages').value = '';
                    
                    // Reset current images display
                    document.querySelectorAll('.current-image-container').forEach(container => {
                        container.parentElement.style.opacity = '1';
                        container.parentElement.style.pointerEvents = 'auto';
                        const btn = container.querySelector('.remove-current-image');
                        btn.innerHTML = '<i class="fas fa-times"></i>';
                        btn.classList.remove('btn-success');
                        btn.classList.add('btn-danger');
                    });
                    
                    // Reset star rating
                    const checkedStar = document.querySelector('input[name="rating"]:checked');
                    if (checkedStar) {
                        updateStars(parseInt(checkedStar.value));
                        ratingLabel.textContent = ratingLabels[parseInt(checkedStar.value)];
                    }
                    
                    // Reset character counter
                    charCount.textContent = commentTextarea.value.length;
                }
            });
        });
    </script>
    @endpush
</x-app-layout>