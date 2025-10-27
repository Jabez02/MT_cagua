@push('styles')
<style>
    :root {
        --primary-color: #4f46e5;
        --primary-hover: #4338ca;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --danger-color: #ef4444;
        --info-color: #3b82f6;
        --secondary-color: #6b7280;
        --light-bg: #f8fafc;
        --border-color: #e5e7eb;
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --text-muted: #9ca3af;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --border-radius: 0.75rem;
        --border-radius-sm: 0.5rem;
    }

    .profile-edit-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .page-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-lg);
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }

    .page-title i {
        color: var(--primary-color);
        font-size: 1.75rem;
    }

    .page-subtitle {
        color: var(--text-secondary);
        font-size: 1rem;
        margin-top: 0.5rem;
        margin-bottom: 0;
    }

    .profile-form-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-lg);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
    }

    .form-section {
        padding: 2rem;
    }

    .section-header {
        margin-bottom: 2rem;
        text-align: center;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--border-color);
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 0.5rem 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .section-title i {
        color: var(--primary-color);
        font-size: 1.25rem;
    }

    .section-description {
        color: var(--text-secondary);
        font-size: 0.95rem;
        margin: 0;
    }

    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-label {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .form-label i {
        color: var(--primary-color);
        font-size: 0.875rem;
    }

    .form-control {
        border: 2px solid var(--border-color);
        border-radius: var(--border-radius-sm);
        padding: 0.875rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: white;
        color: var(--text-primary);
        width: 100%;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        outline: none;
        transform: translateY(-1px);
    }

    .form-control.is-invalid {
        border-color: var(--danger-color);
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .form-control.is-valid {
        border-color: var(--success-color);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    .invalid-feedback {
        color: var(--danger-color);
        font-size: 0.875rem;
        margin-top: 0.375rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .invalid-feedback::before {
        content: "⚠";
        font-weight: bold;
    }

    .form-actions {
        background: rgba(248, 250, 252, 0.8);
        padding: 1.5rem 2rem;
        border-top: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    .btn-primary {
        background: var(--primary-color);
        border: 2px solid var(--primary-color);
        color: white;
        padding: 0.875rem 2rem;
        border-radius: var(--border-radius-sm);
        font-weight: 600;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary:hover {
        background: var(--primary-hover);
        border-color: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-primary:focus {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .success-message {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success-color);
        padding: 0.75rem 1rem;
        border-radius: var(--border-radius-sm);
        border: 1px solid rgba(16, 185, 129, 0.2);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        animation: fadeIn 0.5s ease;
    }

    .success-message i {
        font-size: 1.125rem;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .form-group-full {
        grid-column: 1 / -1;
    }

    /* Field Icons */
    .field-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        pointer-events: none;
        transition: color 0.3s ease;
    }

    .form-control:focus + .field-icon {
        color: var(--primary-color);
    }

    /* Accessibility Improvements */
    .form-control:focus,
    .btn-primary:focus {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }

    /* Screen Reader Only Content */
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }

    /* High Contrast Mode Support */
    @media (prefers-contrast: high) {
        .form-control {
            border-width: 3px;
        }
        
        .btn-primary {
            border-width: 3px;
        }
        
        .success-message {
            border-width: 2px;
        }
    }

    /* Reduced Motion Support */
    @media (prefers-reduced-motion: reduce) {
        .form-control,
        .btn-primary,
        .success-message {
            transition: none;
        }
        
        .form-control:focus,
        .btn-primary:hover {
            transform: none;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .profile-edit-container {
            padding: 1rem 0;
        }
        
        .page-header {
            padding: 1.5rem;
        }
        
        .page-title {
            font-size: 1.75rem;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .form-section {
            padding: 1.5rem;
        }
        
        .form-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .form-actions {
            padding: 1rem 1.5rem;
            flex-direction: column;
            align-items: stretch;
        }
        
        .btn-primary {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .page-header {
            padding: 1rem;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
        
        .form-section {
            padding: 1rem;
        }
        
        .section-title {
            font-size: 1.25rem;
            flex-direction: column;
            gap: 0.25rem;
        }
        
        .form-control {
            padding: 0.75rem;
        }
        
        .btn-primary {
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
        }
    }

    /* Print Styles */
    @media print {
        .profile-edit-container {
            background: white;
        }
        
        .form-actions {
            display: none !important;
        }
        
        .form-control {
            border: 1px solid #000;
            background: transparent;
        }
        
        .success-message {
            border: 1px solid #000;
            background: transparent !important;
            color: #000 !important;
        }
    }
</style>
@endpush

<x-app-layout>
    <div class="profile-edit-container">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="bi bi-person-gear" aria-hidden="true"></i>
                    {{ __('Edit Profile') }}
                </h1>
                <p class="page-subtitle">{{ __('Update your personal information and preferences') }}</p>
            </div>

            <!-- Session Messages -->
            @if (session('success'))
                <div class="alert alert-success mb-4 shadow-sm" role="alert">
                    <i class="bi bi-check-circle me-2" aria-hidden="true"></i>{{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger mb-4 shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle me-2" aria-hidden="true"></i>{{ session('error') }}
                </div>
            @endif

            <!-- Profile Form -->
            <div class="profile-form-card">
                <section class="form-section">
                    <header class="section-header">
                        <h2 class="section-title">
                            <i class="bi bi-person-circle" aria-hidden="true"></i>
                            {{ __('Profile Information') }}
                        </h2>
                        <p class="section-description">
                            {{ __("Update your account's profile information and contact details.") }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('user.profile.update') }}" novalidate>
                        @csrf
                        @method('patch')

                        <div class="form-grid">
                            <!-- Name Field -->
                            <div class="form-group">
                                <label for="name" class="form-label">
                                    <i class="bi bi-person" aria-hidden="true"></i>
                                    {{ __('Full Name') }}
                                    <span class="sr-only">{{ __('(Required)') }}</span>
                                </label>
                                <div class="position-relative">
                                    <input id="name" 
                                           name="name" 
                                           type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name', $user->name) }}" 
                                           required 
                                           autofocus 
                                           autocomplete="name"
                                           aria-describedby="name-error"
                                           placeholder="{{ __('Enter your full name') }}" />
                                    <i class="bi bi-person-check field-icon" aria-hidden="true"></i>
                                </div>
                                @error('name')
                                    <div class="invalid-feedback" id="name-error" role="alert">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope" aria-hidden="true"></i>
                                    {{ __('Email Address') }}
                                    <span class="sr-only">{{ __('(Required)') }}</span>
                                </label>
                                <div class="position-relative">
                                    <input id="email" 
                                           name="email" 
                                           type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email', $user->email) }}" 
                                           required 
                                           autocomplete="username"
                                           aria-describedby="email-error"
                                           placeholder="{{ __('Enter your email address') }}" />
                                    <i class="bi bi-envelope-check field-icon" aria-hidden="true"></i>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback" id="email-error" role="alert">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Contact Number Field -->
                            <div class="form-group">
                                <label for="contact_number" class="form-label">
                                    <i class="bi bi-telephone" aria-hidden="true"></i>
                                    {{ __('Contact Number') }}
                                    <span class="sr-only">{{ __('(Required)') }}</span>
                                </label>
                                <div class="position-relative">
                                    <input id="contact_number" 
                                           name="contact_number" 
                                           type="tel" 
                                           class="form-control @error('contact_number') is-invalid @enderror" 
                                           value="{{ old('contact_number', $user->contact_number) }}" 
                                           required
                                           autocomplete="tel"
                                           aria-describedby="contact-number-error"
                                           placeholder="{{ __('Enter your phone number') }}" />
                                    <i class="bi bi-telephone-check field-icon" aria-hidden="true"></i>
                                </div>
                                @error('contact_number')
                                    <div class="invalid-feedback" id="contact-number-error" role="alert">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Address Field -->
                            <div class="form-group">
                                <label for="address" class="form-label">
                                    <i class="bi bi-geo-alt" aria-hidden="true"></i>
                                    {{ __('Address') }}
                                    <span class="sr-only">{{ __('(Required)') }}</span>
                                </label>
                                <div class="position-relative">
                                    <input id="address" 
                                           name="address" 
                                           type="text" 
                                           class="form-control @error('address') is-invalid @enderror" 
                                           value="{{ old('address', $user->address) }}" 
                                           required
                                           autocomplete="street-address"
                                           aria-describedby="address-error"
                                           placeholder="{{ __('Enter your address') }}" />
                                    <i class="bi bi-geo-alt-fill field-icon" aria-hidden="true"></i>
                                </div>
                                @error('address')
                                    <div class="invalid-feedback" id="address-error" role="alert">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Emergency Contact Name Field -->
                            <div class="form-group">
                                <label for="emergency_contact_name" class="form-label">
                                    <i class="bi bi-person-exclamation" aria-hidden="true"></i>
                                    {{ __('Emergency Contact Name') }}
                                    <span class="sr-only">{{ __('(Required)') }}</span>
                                </label>
                                <div class="position-relative">
                                    <input id="emergency_contact_name" 
                                           name="emergency_contact_name" 
                                           type="text" 
                                           class="form-control @error('emergency_contact_name') is-invalid @enderror" 
                                           value="{{ old('emergency_contact_name', $user->emergency_contact_name) }}" 
                                           required
                                           aria-describedby="emergency-contact-name-error"
                                           placeholder="{{ __('Enter emergency contact name') }}" />
                                    <i class="bi bi-person-plus field-icon" aria-hidden="true"></i>
                                </div>
                                @error('emergency_contact_name')
                                    <div class="invalid-feedback" id="emergency-contact-name-error" role="alert">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Emergency Contact Number Field -->
                            <div class="form-group">
                                <label for="emergency_contact_number" class="form-label">
                                    <i class="bi bi-telephone-plus" aria-hidden="true"></i>
                                    {{ __('Emergency Contact Number') }}
                                    <span class="sr-only">{{ __('(Required)') }}</span>
                                </label>
                                <div class="position-relative">
                                    <input id="emergency_contact_number" 
                                           name="emergency_contact_number" 
                                           type="tel" 
                                           class="form-control @error('emergency_contact_number') is-invalid @enderror" 
                                           value="{{ old('emergency_contact_number', $user->emergency_contact_number) }}" 
                                           required
                                           autocomplete="tel"
                                           aria-describedby="emergency-contact-number-error"
                                           placeholder="{{ __('Enter emergency contact number') }}" />
                                    <i class="bi bi-telephone-forward field-icon" aria-hidden="true"></i>
                                </div>
                                @error('emergency_contact_number')
                                    <div class="invalid-feedback" id="emergency-contact-number-error" role="alert">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nationality Field -->
                            <div class="form-group">
                                <label for="nationality" class="form-label">
                                    <i class="bi bi-flag" aria-hidden="true"></i>
                                    {{ __('Nationality') }}
                                    <span class="sr-only">{{ __('(Required)') }}</span>
                                </label>
                                <div class="position-relative">
                                    <input id="nationality" 
                                           name="nationality" 
                                           type="text" 
                                           class="form-control @error('nationality') is-invalid @enderror" 
                                           value="{{ old('nationality', $user->nationality) }}" 
                                           required
                                           autocomplete="country"
                                           aria-describedby="nationality-error"
                                           placeholder="{{ __('Enter your nationality') }}" />
                                    <i class="bi bi-flag-fill field-icon" aria-hidden="true"></i>
                                </div>
                                @error('nationality')
                                    <div class="invalid-feedback" id="nationality-error" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-actions">
                            <div>
                                @if (session('status') === 'profile-updated')
                                    <div class="success-message" role="status" aria-live="polite">
                                        <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                                        {{ __('Profile updated successfully!') }}
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn-primary">
                                <i class="bi bi-check-lg" aria-hidden="true"></i>
                                {{ __('Save Changes') }}
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>