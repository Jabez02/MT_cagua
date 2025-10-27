<!-- Basic Information Section -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="bi bi-info-circle me-2"></i>
                    Basic Information
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Method Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $paymentMethod->name ?? '') }}" 
                                   placeholder="e.g., Credit Card, PayPal, Bank Transfer"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="code" class="form-label">Method Code <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('code') is-invalid @enderror" 
                                   id="code" 
                                   name="code" 
                                   value="{{ old('code', $paymentMethod->code ?? '') }}" 
                                   placeholder="e.g., credit_card, paypal, bank_transfer"
                                   required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Unique identifier for this payment method (lowercase, underscores only)</small>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" 
                              name="description" 
                              rows="3" 
                              placeholder="Brief description of this payment method">{{ old('description', $paymentMethod->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-0">
                    <label for="instructions" class="form-label">Payment Instructions</label>
                    <textarea class="form-control @error('instructions') is-invalid @enderror" 
                              id="instructions" 
                              name="instructions" 
                              rows="4" 
                              placeholder="Instructions for users on how to complete payment using this method">{{ old('instructions', $paymentMethod->instructions ?? '') }}</textarea>
                    @error('instructions')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Processing Fees & Limits Section -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-success">
                    <i class="bi bi-calculator me-2"></i>
                    Processing Fees & Limits
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="processing_fee_percentage" class="form-label">Processing Fee (%)</label>
                            <div class="input-group">
                                <input type="number" 
                                       class="form-control @error('processing_fee_percentage') is-invalid @enderror" 
                                       id="processing_fee_percentage" 
                                       name="processing_fee_percentage" 
                                       value="{{ old('processing_fee_percentage', $paymentMethod->processing_fee_percentage ?? '0') }}" 
                                       min="0" 
                                       max="100" 
                                       step="0.01" 
                                       placeholder="0.00">
                                <span class="input-group-text">%</span>
                                @error('processing_fee_percentage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="processing_fee_fixed" class="form-label">Fixed Fee (₱)</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="number" 
                                       class="form-control @error('processing_fee_fixed') is-invalid @enderror" 
                                       id="processing_fee_fixed" 
                                       name="processing_fee_fixed" 
                                       value="{{ old('processing_fee_fixed', $paymentMethod->processing_fee_fixed ?? '0') }}" 
                                       min="0" 
                                       step="0.01" 
                                       placeholder="0.00">
                                @error('processing_fee_fixed')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="min_amount" class="form-label">Minimum Amount (₱)</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="number" 
                                       class="form-control @error('min_amount') is-invalid @enderror" 
                                       id="min_amount" 
                                       name="min_amount" 
                                       value="{{ old('min_amount', $paymentMethod->min_amount ?? '') }}" 
                                       min="0" 
                                       step="0.01" 
                                       placeholder="No minimum">
                                @error('min_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label for="max_amount" class="form-label">Maximum Amount (₱)</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="number" 
                                       class="form-control @error('max_amount') is-invalid @enderror" 
                                       id="max_amount" 
                                       name="max_amount" 
                                       value="{{ old('max_amount', $paymentMethod->max_amount ?? '') }}" 
                                       min="0" 
                                       step="0.01" 
                                       placeholder="No maximum">
                                @error('max_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Supported Currencies Section -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-info">
                    <i class="bi bi-currency-exchange me-2"></i>
                    Supported Currencies
                </h6>
            </div>
            <div class="card-body">
                <p class="text-muted mb-3">Select the currencies that this payment method supports:</p>
                
                <div class="row">
                    @php
                        $currencies = ['PHP', 'USD', 'EUR', 'GBP', 'JPY', 'AUD', 'CAD', 'CHF', 'CNY', 'SGD'];
                        $selectedCurrencies = old('currencies', $paymentMethod->currencies ?? ['PHP']);
                    @endphp
                    
                    @foreach($currencies as $currency)
                        <div class="col-md-3 col-sm-4 col-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       name="currencies[]" 
                                       value="{{ $currency }}" 
                                       id="currency_{{ $currency }}"
                                       {{ in_array($currency, $selectedCurrencies) ? 'checked' : '' }}>
                                <label class="form-check-label" for="currency_{{ $currency }}">
                                    {{ $currency }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @error('currencies')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

<!-- Method Settings Section -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-warning">
                    <i class="bi bi-gear me-2"></i>
                    Method Settings
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="priority" class="form-label">Priority Order</label>
                            <input type="number" 
                                   class="form-control @error('priority') is-invalid @enderror" 
                                   id="priority" 
                                   name="priority" 
                                   value="{{ old('priority', $paymentMethod->priority ?? '1') }}" 
                                   min="1" 
                                   placeholder="1">
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Lower numbers appear first in the list</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <label class="form-label">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       name="is_active" 
                                       id="is_active" 
                                       value="1"
                                       {{ old('is_active', $paymentMethod->is_active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    <span class="badge badge-success" id="status-badge">Active</span>
                                </label>
                            </div>
                            <small class="form-text text-muted">Only active payment methods are available to users</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Actions -->
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>
                Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg me-2"></i>
                {{ isset($paymentMethod) ? 'Update Payment Method' : 'Create Payment Method' }}
            </button>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Classic Bootstrap Form Styling */
    .card {
        border: 1px solid #e3e6f0;
        border-radius: 0.35rem;
    }

    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }

    .form-control {
        border: 1px solid #d1d3e2;
        border-radius: 0.35rem;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }

    .form-control:focus {
        border-color: #bac8f3;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    .form-control.is-invalid {
        border-color: #e74a3b;
    }

    .form-control.is-invalid:focus {
        border-color: #e74a3b;
        box-shadow: 0 0 0 0.2rem rgba(231, 74, 59, 0.25);
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #e74a3b;
    }

    .form-label {
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #5a5c69;
    }

    .form-text {
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #6c757d;
    }

    .input-group-text {
        background-color: #f8f9fc;
        border: 1px solid #d1d3e2;
        color: #5a5c69;
        font-weight: 500;
    }

    .form-check-input {
        margin-top: 0.25em;
    }

    .form-check-input:checked {
        background-color: #4e73df;
        border-color: #4e73df;
    }

    .form-check-input:focus {
        border-color: #bac8f3;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    .form-switch .form-check-input {
        width: 2em;
        height: 1em;
        margin-top: 0.25em;
        margin-left: -2.5em;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba%280,0,0,0.25%29'/%3e%3c/svg%3e");
        background-position: left center;
        background-size: contain;
        border-radius: 2em;
        transition: background-position .15s ease-in-out;
    }

    .form-switch .form-check-input:checked {
        background-position: right center;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba%28255,255,255,1.0%29'/%3e%3c/svg%3e");
    }

    .badge-success {
        color: #fff;
        background-color: #1cc88a;
    }

    .badge-secondary {
        color: #fff;
        background-color: #858796;
    }

    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
    }

    .btn-primary:hover {
        background-color: #2e59d9;
        border-color: #2653d4;
    }

    .btn-secondary {
        background-color: #858796;
        border-color: #858796;
    }

    .btn-secondary:hover {
        background-color: #717384;
        border-color: #6c757d;
    }

    .text-danger {
        color: #e74a3b !important;
    }

    .text-muted {
        color: #858796 !important;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 1rem;
        }
        
        .d-flex.justify-content-between .btn {
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Status toggle functionality
    const statusToggle = document.getElementById('is_active');
    const statusBadge = document.getElementById('status-badge');
    
    if (statusToggle && statusBadge) {
        statusToggle.addEventListener('change', function() {
            if (this.checked) {
                statusBadge.textContent = 'Active';
                statusBadge.className = 'badge badge-success';
            } else {
                statusBadge.textContent = 'Inactive';
                statusBadge.className = 'badge badge-secondary';
            }
        });
        
        // Set initial state
        if (!statusToggle.checked) {
            statusBadge.textContent = 'Inactive';
            statusBadge.className = 'badge badge-secondary';
        }
    }
    
    // Form validation
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const name = document.getElementById('name');
            const code = document.getElementById('code');
            
            if (!name.value.trim()) {
                e.preventDefault();
                name.focus();
                return false;
            }
            
            if (!code.value.trim()) {
                e.preventDefault();
                code.focus();
                return false;
            }
            
            // Check if at least one currency is selected
            const currencies = document.querySelectorAll('input[name="currencies[]"]:checked');
            if (currencies.length === 0) {
                e.preventDefault();
                alert('Please select at least one supported currency.');
                return false;
            }
        });
    }
});
</script>
@endpush