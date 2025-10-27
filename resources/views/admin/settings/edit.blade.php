@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 fw-bold">Edit Setting: {{ $setting->name }}</h3>
                    <a href="{{ route('admin.settings.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Back to Settings
                    </a>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.settings.update', $setting->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="key" class="form-label fw-medium">Setting Key</label>
                                    <input type="text" class="form-control" id="key" name="key" value="{{ $setting->key }}" readonly>
                                    <small class="form-text text-muted">The key cannot be changed after creation.</small>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label fw-medium">Display Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required value="{{ $setting->name }}">
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="value" class="form-label fw-medium">Value</label>
                                    @if($setting->type == 'text')
                                        <input type="text" class="form-control" id="value" name="value" value="{{ $setting->value }}">
                                    @elseif($setting->type == 'email')
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                            <input type="email" class="form-control" id="value" name="value" value="{{ $setting->value }}">
                                        </div>
                                    @elseif($setting->type == 'textarea')
                                        <textarea class="form-control" id="value" name="value" rows="5">{{ $setting->value }}</textarea>
                                    @elseif($setting->type == 'boolean')
                                        <select class="form-select" id="value" name="value">
                                            <option value="1" {{ $setting->value == '1' ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ $setting->value == '0' ? 'selected' : '' }}>No</option>
                                        </select>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="type" class="form-label fw-medium">Type</label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option value="text" {{ $setting->type == 'text' ? 'selected' : '' }}>Text</option>
                                        <option value="textarea" {{ $setting->type == 'textarea' ? 'selected' : '' }}>Text Area</option>
                                        <option value="email" {{ $setting->type == 'email' ? 'selected' : '' }}>Email</option>
                                        <option value="boolean" {{ $setting->type == 'boolean' ? 'selected' : '' }}>Boolean (Yes/No)</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="group" class="form-label fw-medium">Group</label>
                                    <select class="form-select" id="group" name="group" required>
                                        <option value="general" {{ $setting->group == 'general' ? 'selected' : '' }}>General</option>
                                        <option value="about" {{ $setting->group == 'about' ? 'selected' : '' }}>About Section</option>
                                        <option value="contact" {{ $setting->group == 'contact' ? 'selected' : '' }}>Contact Information</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-check form-switch mb-3">
                                    <input type="checkbox" class="form-check-input" id="is_public" name="is_public" value="1" {{ $setting->is_public ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_public">Publicly Accessible</label>
                                    <div class="form-text">If checked, this setting will be accessible on the frontend.</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Update Setting
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize rich text editor if needed
        if(typeof CKEDITOR !== 'undefined' && document.getElementById('value').tagName === 'TEXTAREA') {
            CKEDITOR.replace('value');
        }
    });
</script>
@endpush