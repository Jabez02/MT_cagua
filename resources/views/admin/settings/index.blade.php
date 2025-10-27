@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">
                <i class="bi bi-gear-fill me-2 text-primary"></i>System Settings
            </h1>
            <p class="text-muted mb-0">Configure your application settings and preferences</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-light text-dark px-3 py-2">
                <i class="bi bi-clock me-1"></i>Last Updated: {{ now()->format('M d, Y H:i') }}
            </span>
        </div>
    </div>
    
    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4 d-flex align-items-center" role="alert">
            <div class="flex-shrink-0 me-3">
                <div class="bg-success bg-opacity-10 rounded-circle p-2">
                    <i class="bi bi-check-circle-fill text-success fs-5"></i>
                </div>
            </div>
            <div>
                <h6 class="alert-heading mb-1">Success!</h6>
                <p class="mb-0">{{ session('success') }}</p>
            </div>
        </div>
    @endif
    
    <!-- Settings Navigation -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    <ul class="nav nav-pills nav-fill gap-2 p-3" id="settingsTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-3 px-4 py-3 fw-semibold" id="general-tab" 
                                    data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">
                                <i class="bi bi-gear me-2"></i>General Settings
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-3 px-4 py-3 fw-semibold" id="about-tab" 
                                    data-bs-toggle="tab" data-bs-target="#about" type="button" role="tab">
                                <i class="bi bi-info-circle me-2"></i>About Section
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-3 px-4 py-3 fw-semibold" id="contact-tab" 
                                    data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab">
                                <i class="bi bi-envelope me-2"></i>Contact & FAQ
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Content -->
    <div class="tab-content" id="settingsTabsContent">
        <!-- General Settings Tab -->
        <div class="tab-pane fade show active" id="general" role="tabpanel">
            <form action="{{ route('admin.settings.bulk-update') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                
                <!-- Site Configuration Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-header bg-gradient-primary text-white border-0 rounded-top-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white bg-opacity-20 rounded-3 p-2 me-3">
                                        <i class="bi bi-globe fs-5"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-0 fw-bold">Site Configuration</h5>
                                        <small class="opacity-90">Basic website settings and information</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    @foreach($generalSettings as $setting)
                                        <div class="col-lg-{{ $setting->type == 'textarea' ? '12' : '6' }}">
                                            <div class="form-group">
                                                @if($setting->type == 'text')
                                                    <label for="{{ $setting->key }}" class="form-label fw-semibold text-dark mb-2">
                                                        {{ $setting->name }}
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light border-end-0">
                                                            @if(str_contains($setting->key, 'name'))
                                                                <i class="bi bi-building text-primary"></i>
                                                            @elseif(str_contains($setting->key, 'email'))
                                                                <i class="bi bi-envelope text-primary"></i>
                                                            @elseif(str_contains($setting->key, 'phone'))
                                                                <i class="bi bi-telephone text-primary"></i>
                                                            @elseif(str_contains($setting->key, 'address'))
                                                                <i class="bi bi-geo-alt text-primary"></i>
                                                            @else
                                                                <i class="bi bi-info-circle text-primary"></i>
                                                            @endif
                                                        </span>
                                                        <input type="text" class="form-control border-start-0" 
                                                               id="{{ $setting->key }}" name="{{ $setting->key }}" 
                                                               value="{{ $setting->value }}" placeholder="Enter {{ strtolower($setting->name) }}">
                                                    </div>
                                                @elseif($setting->type == 'textarea')
                                                    <label for="{{ $setting->key }}" class="form-label fw-semibold text-dark mb-2">
                                                        {{ $setting->name }}
                                                    </label>
                                                    <textarea class="form-control" id="{{ $setting->key }}" 
                                                              name="{{ $setting->key }}" rows="4" 
                                                              placeholder="Enter {{ strtolower($setting->name) }}">{{ $setting->value }}</textarea>
                                                @elseif($setting->type == 'boolean')
                                                    <div class="form-check form-switch mt-2">
                                                        <input class="form-check-input" type="checkbox" role="switch" 
                                                               id="{{ $setting->key }}" name="{{ $setting->key }}" value="1" 
                                                               {{ $setting->value ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-semibold" for="{{ $setting->key }}">
                                                            {{ $setting->name }}
                                                        </label>
                                                    </div>
                                                @endif
                                                <small class="form-text text-muted mt-1">
                                                    <i class="bi bi-info-circle me-1"></i>{{ $setting->key }}
                                                </small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                    
                <!-- Hero Image Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-header bg-gradient-success text-white border-0 rounded-top-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white bg-opacity-20 rounded-3 p-2 me-3">
                                        <i class="bi bi-image-fill fs-5"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-0 fw-bold">Hero Image Management</h5>
                                        <small class="opacity-90">Upload and manage your website's hero background image</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-4">
                                                    <div class="col-12">
                                                        <label for="file_hero_image" class="form-label fw-semibold text-dark mb-3">
                                                            Upload New Hero Image
                                                        </label>
                                                        <div class="upload-area border-2 border-dashed rounded-4 p-4 text-center position-relative">
                                                            <input type="file" class="form-control position-absolute w-100 h-100 opacity-0" 
                                                                   id="file_hero_image" name="file_hero_image" accept="image/*" 
                                                                   style="cursor: pointer; top: 0; left: 0;">
                                                            <div class="upload-content">
                                                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                                                                    <i class="bi bi-cloud-upload text-primary fs-2"></i>
                                                                </div>
                                                                <h5 class="fw-semibold mb-2">Drop your image here or click to browse</h5>
                                                                <p class="text-muted mb-0">
                                                                    Recommended size: 1920x1080px<br>
                                                                    Supported formats: JPG, PNG, WebP (Max: 5MB)
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    @php
                                                        $heroImage = App\Models\HeroImage::getActive();
                                                    @endphp
                                                    
                                                    @if($heroImage)
                                                    <div class="col-12">
                                                        <label class="form-label fw-semibold text-dark mb-3">Current Hero Image</label>
                                                        <div class="current-image-card border rounded-4 p-4 bg-light">
                                                            <div class="row align-items-center">
                                                                <div class="col-md-4 col-lg-3">
                                                                    <div class="image-preview rounded-3 overflow-hidden shadow-sm">
                                                                        <img src="{{ asset('storage/' . $heroImage->file_path) }}" 
                                                                             alt="Current Hero Image" 
                                                                             class="img-fluid w-100"
                                                                             style="height: 150px; object-fit: cover;">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 col-lg-9 mt-3 mt-md-0">
                                                                    <div class="d-flex justify-content-between align-items-start">
                                                                        <div>
                                                                            <h5 class="fw-bold mb-2">{{ $heroImage->name }}</h5>
                                                                            <div class="d-flex flex-wrap gap-3 text-muted mb-3">
                                                                                <small class="d-flex align-items-center">
                                                                                    <i class="bi bi-file-earmark me-1"></i>{{ $heroImage->mime_type }}
                                                                                </small>
                                                                                <small class="d-flex align-items-center">
                                                                                    <i class="bi bi-calendar me-1"></i>{{ $heroImage->created_at->format('M d, Y') }}
                                                                                </small>
                                                                            </div>
                                                                            <span class="badge bg-success fs-6 px-3 py-2">
                                                                                <i class="bi bi-check-circle me-1"></i>Currently Active
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="col-12">
                                                        <div class="alert alert-info border-0 rounded-4 d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="bg-info bg-opacity-10 rounded-circle p-2">
                                                                    <i class="bi bi-info-circle-fill text-info fs-5"></i>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <h6 class="alert-heading mb-1">No Hero Image Set</h6>
                                                                <p class="mb-0">Upload an image above to set your hero background and enhance your website's visual appeal.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Save Button -->
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-lg px-5 py-3 rounded-3 shadow-sm">
                                <i class="bi bi-save me-2"></i>Save All Changes
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- About Section Settings Tab -->
        <div class="tab-pane fade" id="about" role="tabpanel">
            <form action="{{ route('admin.settings.bulk-update') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <!-- About Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-header bg-gradient-info text-white border-0 rounded-top-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white bg-opacity-20 rounded-3 p-2 me-3">
                                        <i class="bi bi-info-circle-fill fs-5"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-0 fw-bold">About Section Settings</h5>
                                        <small class="opacity-90">Configure your website's about section content and information</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    @foreach($aboutSettings as $setting)
                                        <div class="col-lg-{{ $setting->type == 'textarea' ? '12' : '6' }}">
                                            <div class="form-group">
                                                @if($setting->type == 'text')
                                                    <label for="{{ $setting->key }}" class="form-label fw-semibold text-dark mb-2">
                                                        {{ $setting->name }}
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light border-end-0">
                                                            <i class="bi bi-pencil text-primary"></i>
                                                        </span>
                                                        <input type="text" class="form-control border-start-0" 
                                                               id="{{ $setting->key }}" name="{{ $setting->key }}" 
                                                               value="{{ $setting->value }}" placeholder="Enter {{ strtolower($setting->name) }}">
                                                    </div>
                                                @elseif($setting->type == 'textarea')
                                                    <label for="{{ $setting->key }}" class="form-label fw-semibold text-dark mb-2">
                                                        {{ $setting->name }}
                                                    </label>
                                                    <textarea class="form-control" id="{{ $setting->key }}" 
                                                              name="{{ $setting->key }}" rows="5" 
                                                              placeholder="Enter {{ strtolower($setting->name) }}">{{ $setting->value }}</textarea>
                                                @endif
                                                <small class="form-text text-muted mt-1">
                                                    <i class="bi bi-info-circle me-1"></i>{{ $setting->key }}
                                                </small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Save Button -->
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-lg px-5 py-3 rounded-3 shadow-sm">
                                <i class="bi bi-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Contact Information Tab -->
        <div class="tab-pane fade" id="contact" role="tabpanel">
            <form action="{{ route('admin.settings.bulk-update') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <!-- Contact Information Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-header bg-gradient-warning text-white border-0 rounded-top-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white bg-opacity-20 rounded-3 p-2 me-3">
                                        <i class="bi bi-envelope-fill fs-5"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-0 fw-bold">Contact Information</h5>
                                        <small class="opacity-90">Manage your contact details and business hours</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    @foreach($contactSettings as $setting)
                                        @if(!str_contains($setting->key, 'faq'))
                                            <div class="col-lg-{{ $setting->type == 'textarea' ? '12' : '6' }}">
                                                <div class="form-group">
                                                    <label for="{{ $setting->key }}" class="form-label fw-semibold text-dark mb-2">
                                                        {{ $setting->name }}
                                                    </label>
                                                    @if($setting->type == 'textarea')
                                                        <textarea class="form-control" id="{{ $setting->key }}" 
                                                                  name="{{ $setting->key }}" rows="4" 
                                                                  placeholder="Enter {{ strtolower($setting->name) }}">{{ $setting->value }}</textarea>
                                                    @else
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light border-end-0">
                                                                @if(str_contains($setting->key, 'hours'))
                                                                    <i class="bi bi-clock text-primary"></i>
                                                                @elseif(str_contains($setting->key, 'phone'))
                                                                    <i class="bi bi-telephone text-primary"></i>
                                                                @elseif(str_contains($setting->key, 'email'))
                                                                    <i class="bi bi-envelope text-primary"></i>
                                                                @elseif(str_contains($setting->key, 'address'))
                                                                    <i class="bi bi-geo-alt text-primary"></i>
                                                                @else
                                                                    <i class="bi bi-info-circle text-primary"></i>
                                                                @endif
                                                            </span>
                                                            <input type="text" class="form-control border-start-0" 
                                                                   id="{{ $setting->key }}" name="{{ $setting->key }}" 
                                                                   value="{{ $setting->value }}" placeholder="Enter {{ strtolower($setting->name) }}">
                                                        </div>
                                                    @endif
                                                    <small class="form-text text-muted mt-1">
                                                        <i class="bi bi-info-circle me-1"></i>{{ $setting->key }}
                                                    </small>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-header bg-gradient-purple text-white border-0 rounded-top-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white bg-opacity-20 rounded-3 p-2 me-3">
                                        <i class="bi bi-question-circle-fill fs-5"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-0 fw-bold">Frequently Asked Questions</h5>
                                        <small class="opacity-90">Manage your FAQ section content</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    @foreach($contactSettings as $setting)
                                        @if(str_contains($setting->key, 'faq') && $setting->key != 'faq_title')
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="{{ $setting->key }}" class="form-label fw-semibold text-dark mb-2">
                                                        <i class="bi bi-{{ str_contains($setting->key, '_answer') ? 'chat-left-text' : 'chat-left-quote' }} me-2 text-purple"></i>
                                                        {{ $setting->name }}
                                                    </label>
                                                    @if(str_contains($setting->key, '_answer'))
                                                        <textarea class="form-control" id="{{ $setting->key }}" 
                                                                  name="{{ $setting->key }}" rows="4" 
                                                                  placeholder="Enter the answer to this question">{{ $setting->value }}</textarea>
                                                    @else
                                                        <div class="input-group">
                                                            <span class="input-group-text bg-light border-end-0">
                                                                <i class="bi bi-chat-left-quote text-purple"></i>
                                                            </span>
                                                            <input type="text" class="form-control border-start-0" 
                                                                   id="{{ $setting->key }}" name="{{ $setting->key }}" 
                                                                   value="{{ $setting->value }}" placeholder="Enter the question">
                                                        </div>
                                                    @endif
                                                    <small class="form-text text-muted mt-1">
                                                        <i class="bi bi-info-circle me-1"></i>{{ $setting->key }}
                                                    </small>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Save Button -->
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-lg px-5 py-3 rounded-3 shadow-sm">
                                <i class="bi bi-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #198754 0%, #146c43 100%);
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #0dcaf0 0%, #087990 100%);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #ffc107 0%, #cc9a06 100%);
    }
    
    .bg-gradient-purple {
        background: linear-gradient(135deg, #6f42c1 0%, #59359a 100%);
    }
    
    .text-purple {
        color: #6f42c1 !important;
    }
    
    .nav-pills .nav-link {
        background-color: transparent;
        border: 2px solid transparent;
        color: #6c757d;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .nav-pills .nav-link:hover {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        transform: translateY(-2px);
    }
    
    .nav-pills .nav-link.active {
        background-color: #0d6efd;
        color: white;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        transform: translateY(-2px);
    }
    
    .upload-area {
        border-color: #dee2e6;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }
    
    .upload-area:hover {
        border-color: #0d6efd;
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.05) 0%, #ffffff 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(13, 110, 253, 0.15);
    }
    
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
    
    .input-group-text {
        border-color: #dee2e6;
    }
    
    .form-control:focus + .input-group-text,
    .input-group-text + .form-control:focus {
        border-color: #0d6efd;
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
    }
    
    .btn {
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
    }
    
    .form-switch .form-check-input {
        width: 3rem;
        height: 1.5rem;
    }
    
    .form-switch-lg .form-check-input {
        width: 3.5rem;
        height: 1.75rem;
    }
    
    .current-image-card {
        transition: all 0.3s ease;
    }
    
    .current-image-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .image-preview {
        transition: all 0.3s ease;
    }
    
    .image-preview:hover {
        transform: scale(1.02);
    }
    
    @media (max-width: 768px) {
        .nav-pills .nav-link {
            padding: 0.75rem 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File upload preview functionality
        const fileInput = document.getElementById('file_hero_image');
        const uploadArea = document.querySelector('.upload-area');
        
        if (fileInput && uploadArea) {
            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, preventDefaults, false);
            });
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            ['dragenter', 'dragover'].forEach(eventName => {
                uploadArea.addEventListener(eventName, highlight, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, unhighlight, false);
            });
            
            function highlight(e) {
                uploadArea.classList.add('border-primary', 'bg-primary', 'bg-opacity-10');
            }
            
            function unhighlight(e) {
                uploadArea.classList.remove('border-primary', 'bg-primary', 'bg-opacity-10');
            }
            
            uploadArea.addEventListener('drop', handleDrop, false);
            
            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;
                handleFiles(files);
            }
            
            fileInput.addEventListener('change', function(e) {
                handleFiles(e.target.files);
            });
            
            function handleFiles(files) {
                if (files.length > 0) {
                    const file = files[0];
                    const uploadContent = uploadArea.querySelector('.upload-content');
                    uploadContent.innerHTML = `
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                            <i class="bi bi-check-circle text-success fs-2"></i>
                        </div>
                        <h5 class="fw-semibold mb-2 text-success">File Selected: ${file.name}</h5>
                        <p class="text-muted mb-0">
                            Size: ${(file.size / 1024 / 1024).toFixed(2)} MB<br>
                            Click "Save All Changes" to upload
                        </p>
                    `;
                }
            }
        }
        
        // Form validation
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
        
        // Tab switching animation
        const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');
        tabButtons.forEach(button => {
            button.addEventListener('shown.bs.tab', function(e) {
                const targetPane = document.querySelector(e.target.getAttribute('data-bs-target'));
                if (targetPane) {
                    targetPane.style.opacity = '0';
                    targetPane.style.transform = 'translateY(20px)';
                    
                    setTimeout(() => {
                        targetPane.style.transition = 'all 0.3s ease';
                        targetPane.style.opacity = '1';
                        targetPane.style.transform = 'translateY(0)';
                    }, 50);
                }
            });
        });
        
        // Success message auto-hide
        const successAlert = document.querySelector('.alert-success');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.transition = 'all 0.5s ease';
                successAlert.style.opacity = '0';
                successAlert.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    successAlert.remove();
                }, 500);
            }, 5000);
        }
    });
</script>
@endpush