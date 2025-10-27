<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h2 class="fs-4 fw-semibold mb-1">
                    {{ __('Complete Your Payment') }}
                </h2>
                <p class="text-muted mb-0">Secure your booking with a quick payment</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="payment-progress-indicator">
                    <div class="progress-step completed">
                        <div class="step-circle">
                            <i class="bi bi-check"></i>
                        </div>
                        <span class="step-label">Booking</span>
                    </div>
                    <div class="progress-line"></div>
                    <div class="progress-step active">
                        <div class="step-circle">
                            <i class="bi bi-credit-card"></i>
                        </div>
                        <span class="step-label">Payment</span>
                    </div>
                    <div class="progress-line"></div>
                    <div class="progress-step">
                        <div class="step-circle">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <span class="step-label">Confirmation</span>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <style>
        .payment-progress-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.25rem;
        }
        
        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .progress-step.completed .step-circle {
            background: #198754;
            color: white;
        }
        
        .progress-step.active .step-circle {
            background: #0d6efd;
            color: white;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.2);
        }
        
        .progress-step .step-circle {
            background: #e9ecef;
            color: #6c757d;
        }
        
        .step-label {
            font-size: 0.75rem;
            font-weight: 500;
            color: #6c757d;
        }
        
        .progress-step.completed .step-label,
        .progress-step.active .step-label {
            color: #495057;
        }
        
        .progress-line {
            width: 30px;
            height: 2px;
            background: #e9ecef;
            margin: 0 0.5rem;
        }
        
        .modern-payment-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: calc(100vh - 200px);
            padding: 2rem 0;
        }
        
        .payment-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: none;
        }
        
        .payment-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 2rem;
            border-bottom: 1px solid #dee2e6;
        }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #6c757d;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .back-link:hover {
            color: #0d6efd;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }
        
        @media (max-width: 768px) {
            .payment-progress-indicator {
                display: none;
            }
        }
    </style>

    <div class="modern-payment-container">
        <div class="container">
            <div class="payment-card">
                <div class="payment-header">
                    <a href="{{ route('user.bookings.show', $booking) }}" class="back-link">
                        <i class="bi bi-arrow-left"></i>
                        Back to Booking Details
                    </a>
                </div>
                <div class="p-4">

                    @if(session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row g-4">
                        <!-- Booking Summary -->
                        <div class="col-lg-5">
                            <div class="summary-card">
                                <div class="summary-header">
                                    <h3 class="summary-title">
                                        <i class="bi bi-clipboard-check"></i>
                                        Booking Summary
                                    </h3>
                                </div>
                                <div class="summary-content">
                                    <div class="summary-item">
                                        <span class="summary-label">
                                            <i class="bi bi-calendar3"></i>
                                            Trek Date
                                        </span>
                                        <span class="summary-value">{{ $booking->trek_date->format('M d, Y') }}</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-label">
                                            <i class="bi bi-clock"></i>
                                            Start Time
                                        </span>
                                        <span class="summary-value">{{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }}</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-label">
                                            <i class="bi bi-geo-alt"></i>
                                            Trail
                                        </span>
                                        <span class="summary-value">{{ $booking->trail }}</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-label">
                                            <i class="bi bi-hourglass-split"></i>
                                            Length of Stay
                                        </span>
                                        <span class="summary-value">{{ str_replace('_', ' ', ucfirst($booking->length_of_stay)) }}</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-label">
                                            <i class="bi bi-people"></i>
                                            Tourists
                                        </span>
                                        <span class="summary-value">{{ $booking->foreign_tourists }} Foreign, {{ $booking->local_tourists }} Local</span>
                                    </div>
                                    
                                    <div class="fee-breakdown">
                                        <div class="fee-item">
                                            <span>Tourist Fee</span>
                                            <span>₱{{ number_format($booking->tourist_fee, 2) }}</span>
                                        </div>
                                        @if($booking->guide_fee > 0)
                                            <div class="fee-item">
                                                <span>Guide Fee</span>
                                                <span>₱{{ number_format($booking->guide_fee, 2) }}</span>
                                            </div>
                                        @endif
                                        @if($booking->porter_fee > 0)
                                            <div class="fee-item">
                                                <span>Porter Fee</span>
                                                <span>₱{{ number_format($booking->porter_fee, 2) }}</span>
                                            </div>
                                        @endif
                                        @if($booking->tricycle_fee > 0)
                                            <div class="fee-item">
                                                <span>Tricycle Fee</span>
                                                <span>₱{{ number_format($booking->tricycle_fee, 2) }}</span>
                                            </div>
                                        @endif
                                        <div class="fee-item">
                                            <span>Processing Fee</span>
                                            <span>₱{{ number_format($booking->processing_fee, 2) }}</span>
                                        </div>
                                        <div class="fee-item total">
                                            <span>Total Amount</span>
                                            <span>₱{{ number_format($booking->total_amount, 2) }}</span>
                                        </div>
                                        <div class="fee-item down-payment">
                                            <span>Required Down Payment</span>
                                            <span>₱{{ number_format($booking->down_payment, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Instructions & Form -->
                        <div class="col-lg-7">
                            <!-- Payment Instructions -->
                            <div class="instructions-card mb-4">
                                <div class="instructions-header">
                                    <h3 class="instructions-title">
                                        <i class="bi bi-info-circle"></i>
                                        Payment Instructions
                                    </h3>
                                </div>
                                <div class="instructions-content">
                                    <div class="payment-method-info">
                                        <h4 class="method-name">{{ $paymentMethod->name }} Payment Steps:</h4>
                                        <div class="method-instructions">
                                            {!! nl2br(e($paymentMethod->instructions)) !!}
                                        </div>
                                        @if($paymentMethod->configuration)
                                            <div class="payment-details">
                                                @foreach($paymentMethod->configuration as $key => $value)
                                                    <div class="detail-item">
                                                        <span class="detail-label">{{ ucwords(str_replace('_', ' ', $key)) }}:</span>
                                                        <span class="detail-value">{{ $value }}</span>
                                                    </div>
                                                @endforeach
                                                <div class="detail-item highlight">
                                                    <span class="detail-label">Amount:</span>
                                                    <span class="detail-value">₱{{ number_format($booking->down_payment, 2) }}</span>
                                                </div>
                                                <div class="detail-item">
                                                    <span class="detail-label">Booking Reference:</span>
                                                    <span class="detail-value">{{ $booking->id }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Form -->
                            <div class="payment-form-card">
                                <div class="form-header">
                                    <h3 class="form-title">
                                        <i class="bi bi-credit-card"></i>
                                        Submit Payment Details
                                    </h3>
                                    <div class="security-badges">
                                        <span class="security-badge">
                                            <i class="bi bi-shield-check"></i>
                                            Secure
                                        </span>
                                        <span class="security-badge">
                                            <i class="bi bi-lock"></i>
                                            Encrypted
                                        </span>
                                    </div>
                                </div>
                                <form id="payment-form" action="{{ route('user.bookings.verify-payment', $booking) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-content">
                                        <div class="form-group">
                                            <label for="transaction_id" class="form-label">
                                                <i class="bi bi-receipt"></i>
                                                Transaction ID / Reference Number
                                                <span class="required">*</span>
                                            </label>
                                            <input type="text" 
                                                   class="form-control enhanced-input @error('transaction_id') is-invalid @enderror" 
                                                   id="transaction_id" 
                                                   name="transaction_id" 
                                                   value="{{ old('transaction_id') }}" 
                                                   placeholder="Enter your transaction reference number"
                                                   required>
                                            <div class="input-feedback">
                                                <small class="form-text">Enter the reference number from your payment confirmation</small>
                                            </div>
                                            @error('transaction_id')
                                                <div class="invalid-feedback">
                                                    <i class="bi bi-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="receipt_image" class="form-label">
                                                <i class="bi bi-image"></i>
                                                Upload Receipt Image
                                                <span class="required">*</span>
                                            </label>
                                            <div class="file-upload-wrapper">
                                                <input type="file" 
                                                       class="form-control file-input @error('receipt_image') is-invalid @enderror" 
                                                       id="receipt_image" 
                                                       name="receipt_image" 
                                                       accept="image/*" 
                                                       required>
                                                <div class="file-upload-area" id="file-upload-area">
                                                    <div class="upload-icon">
                                                        <i class="bi bi-cloud-upload"></i>
                                                    </div>
                                                    <div class="upload-text">
                                                        <strong>Click to upload</strong> or drag and drop
                                                    </div>
                                                    <div class="upload-hint">
                                                        JPG, PNG or GIF (MAX. 5MB)
                                                    </div>
                                                </div>
                                                <div class="file-preview" id="file-preview" style="display: none;">
                                                    <img id="preview-image" src="" alt="Receipt Preview">
                                                    <div class="preview-info">
                                                        <span id="file-name"></span>
                                                        <button type="button" class="btn-remove" id="remove-file">
                                                            <i class="bi bi-x-circle"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('receipt_image')
                                                <div class="invalid-feedback">
                                                    <i class="bi bi-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="notes" class="form-label">
                                                <i class="bi bi-chat-text"></i>
                                                Additional Notes
                                                <span class="optional">(Optional)</span>
                                            </label>
                                            <textarea class="form-control enhanced-textarea" 
                                                      id="notes" 
                                                      name="notes" 
                                                      rows="3" 
                                                      placeholder="Any additional information about your payment...">{{ old('notes') }}</textarea>
                                            <div class="char-counter">
                                                <span id="char-count">0</span>/500 characters
                                            </div>
                                        </div>

                                        <div class="alert alert-info d-flex align-items-center mb-4">
                                            <i class="bi bi-info-circle me-2"></i>
                                            <div>
                                                Your payment will be verified within 24 hours after submission. Your booking will remain pending until admin approval.
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary btn-submit" id="submit-btn">
                                                <span class="btn-text">
                                                    <i class="bi bi-check-circle"></i>
                                                    Submit Payment Details
                                                </span>
                                                <span class="btn-loading" style="display: none;">
                                                    <i class="bi bi-arrow-clockwise spin"></i>
                                                    Processing...
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
     <style>
         /* Enhanced Payment Page Styles */
         .payment-container {
             background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
             min-height: 100vh;
             padding: 2rem 0;
         }
         
         .payment-card {
             background: white;
             border-radius: 20px;
             box-shadow: 0 20px 40px rgba(0,0,0,0.1);
             overflow: hidden;
         }
         
         .payment-header {
             background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
             color: white;
             padding: 2rem;
             text-align: center;
         }
         
         .payment-title {
             font-size: 2rem;
             font-weight: 700;
             margin: 0;
         }
         
         .payment-subtitle {
             opacity: 0.9;
             margin: 0.5rem 0 0 0;
         }
         
         .progress-container {
             background: rgba(255,255,255,0.2);
             border-radius: 10px;
             padding: 1rem;
             margin-top: 1.5rem;
         }
         
         .progress-steps {
             display: flex;
             justify-content: space-between;
             align-items: center;
             position: relative;
         }
         
         .progress-line {
             position: absolute;
             top: 50%;
             left: 0;
             right: 0;
             height: 2px;
             background: rgba(255,255,255,0.3);
             z-index: 1;
         }
         
         .progress-line-fill {
             height: 100%;
             background: #28a745;
             width: 66.66%;
             transition: width 0.3s ease;
         }
         
         .progress-step {
             background: rgba(255,255,255,0.3);
             border: 2px solid rgba(255,255,255,0.5);
             border-radius: 50%;
             width: 40px;
             height: 40px;
             display: flex;
             align-items: center;
             justify-content: center;
             position: relative;
             z-index: 2;
             transition: all 0.3s ease;
         }
         
         .progress-step.completed {
             background: #28a745;
             border-color: #28a745;
             color: white;
         }
         
         .progress-step.active {
             background: #ffc107;
             border-color: #ffc107;
             color: #212529;
             animation: pulse 2s infinite;
         }
         
         @keyframes pulse {
             0% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.7); }
             70% { box-shadow: 0 0 0 10px rgba(255, 193, 7, 0); }
             100% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0); }
         }
         
         .step-label {
             position: absolute;
             top: 50px;
             left: 50%;
             transform: translateX(-50%);
             font-size: 0.8rem;
             white-space: nowrap;
             color: rgba(255,255,255,0.9);
         }
         
         .summary-card, .instructions-card, .payment-form-card {
             background: white;
             border-radius: 16px;
             box-shadow: 0 4px 20px rgba(0,0,0,0.08);
             overflow: hidden;
             height: fit-content;
         }
         
         .summary-header, .instructions-header, .form-header {
             background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
             padding: 1.5rem;
             border-bottom: 1px solid #dee2e6;
         }
         
         .summary-title, .instructions-title, .form-title {
             font-size: 1.25rem;
             font-weight: 600;
             color: #2c3e50;
             margin: 0;
             display: flex;
             align-items: center;
             gap: 0.75rem;
         }
         
         .summary-content, .instructions-content {
             padding: 1.5rem;
         }
         
         .summary-item {
             display: flex;
             justify-content: space-between;
             align-items: center;
             padding: 0.75rem 0;
             border-bottom: 1px solid #f8f9fa;
         }
         
         .summary-item:last-child {
             border-bottom: none;
         }
         
         .summary-label {
             font-weight: 500;
             color: #6c757d;
             display: flex;
             align-items: center;
             gap: 0.5rem;
         }
         
         .summary-value {
             font-weight: 600;
             color: #2c3e50;
         }
         
         .fee-breakdown {
             margin-top: 1.5rem;
             padding-top: 1.5rem;
             border-top: 2px solid #f8f9fa;
         }
         
         .fee-item {
             display: flex;
             justify-content: space-between;
             align-items: center;
             padding: 0.5rem 0;
             font-size: 0.95rem;
         }
         
         .fee-item.total {
             border-top: 2px solid #dee2e6;
             margin-top: 1rem;
             padding-top: 1rem;
             font-weight: 600;
             font-size: 1.1rem;
             color: #2c3e50;
         }
         
         .fee-item.down-payment {
             background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
             margin: 1rem -1.5rem -1.5rem -1.5rem;
             padding: 1rem 1.5rem;
             font-weight: 600;
             font-size: 1.1rem;
             color: #1976d2;
         }
         
         .payment-method-info {
             background: #f8f9fa;
             border-radius: 12px;
             padding: 1.5rem;
         }
         
         .method-name {
             font-size: 1.1rem;
             font-weight: 600;
             color: #2c3e50;
             margin-bottom: 1rem;
         }
         
         .method-instructions {
             color: #495057;
             line-height: 1.6;
             margin-bottom: 1.5rem;
         }
         
         .payment-details {
             background: white;
             border-radius: 8px;
             padding: 1rem;
             border: 1px solid #dee2e6;
         }
         
         .detail-item {
             display: flex;
             justify-content: space-between;
             align-items: center;
             padding: 0.5rem 0;
             border-bottom: 1px solid #f8f9fa;
         }
         
         .detail-item:last-child {
             border-bottom: none;
         }
         
         .detail-item.highlight {
             background: #fff3cd;
             margin: 0.5rem -1rem;
             padding: 0.75rem 1rem;
             border-radius: 6px;
             font-weight: 600;
             color: #856404;
         }
         
         .detail-label {
             font-weight: 500;
             color: #6c757d;
         }
         
         .detail-value {
             font-weight: 600;
             color: #2c3e50;
         }
         
         .security-badges {
             display: flex;
             gap: 0.5rem;
         }
         
         .security-badge {
             background: #28a745;
             color: white;
             padding: 0.25rem 0.75rem;
             border-radius: 20px;
             font-size: 0.8rem;
             font-weight: 500;
             display: flex;
             align-items: center;
             gap: 0.25rem;
         }
         
         .form-content {
             padding: 2rem;
         }
         
         .form-group {
             margin-bottom: 2rem;
         }
         
         .form-label {
             font-weight: 600;
             color: #2c3e50;
             margin-bottom: 0.75rem;
             display: flex;
             align-items: center;
             gap: 0.5rem;
         }
         
         .required {
             color: #e74c3c;
             font-weight: bold;
         }
         
         .optional {
             color: #6c757d;
             font-weight: normal;
             font-size: 0.9em;
         }
         
         .enhanced-input, .enhanced-textarea {
             border: 2px solid #e9ecef;
             border-radius: 12px;
             padding: 1rem;
             font-size: 1rem;
             transition: all 0.3s ease;
             background: #f8f9fa;
         }
         
         .enhanced-input:focus, .enhanced-textarea:focus {
             border-color: #0d6efd;
             box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
             background: white;
         }
         
         .file-upload-wrapper {
             position: relative;
         }
         
         .file-input {
             position: absolute;
             opacity: 0;
             width: 100%;
             height: 100%;
             cursor: pointer;
             z-index: 2;
         }
         
         .file-upload-area {
             border: 2px dashed #dee2e6;
             border-radius: 12px;
             padding: 3rem 2rem;
             text-align: center;
             background: #f8f9fa;
             transition: all 0.3s ease;
             cursor: pointer;
         }
         
         .file-upload-area:hover {
             border-color: #0d6efd;
             background: #e7f3ff;
         }
         
         .upload-icon {
             font-size: 3rem;
             color: #6c757d;
             margin-bottom: 1rem;
         }
         
         .upload-text {
             font-size: 1.1rem;
             color: #495057;
             margin-bottom: 0.5rem;
         }
         
         .upload-hint {
             font-size: 0.9rem;
             color: #6c757d;
         }
         
         .file-preview {
             border: 2px solid #28a745;
             border-radius: 12px;
             padding: 1rem;
             background: #f8fff9;
         }
         
         .file-preview img {
             max-width: 200px;
             max-height: 150px;
             border-radius: 8px;
             margin-bottom: 1rem;
         }
         
         .preview-info {
             display: flex;
             justify-content: space-between;
             align-items: center;
         }
         
         .btn-remove {
             background: none;
             border: none;
             color: #dc3545;
             font-size: 1.2rem;
             cursor: pointer;
             padding: 0.25rem;
             border-radius: 50%;
             transition: all 0.3s ease;
         }
         
         .btn-remove:hover {
             background: #dc3545;
             color: white;
         }
         
         .char-counter {
             text-align: right;
             font-size: 0.85rem;
             color: #6c757d;
             margin-top: 0.5rem;
         }
         
         .form-actions {
             text-align: center;
             padding-top: 1rem;
             border-top: 1px solid #dee2e6;
         }
         
         .btn-submit {
             padding: 1rem 2rem;
             font-size: 1.1rem;
             font-weight: 600;
             border-radius: 12px;
             min-width: 200px;
             transition: all 0.3s ease;
             background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
             border: none;
         }
         
         .btn-submit:hover:not(:disabled) {
             transform: translateY(-2px);
             box-shadow: 0 8px 25px rgba(13, 110, 253, 0.3);
         }
         
         .btn-submit:disabled {
             opacity: 0.7;
             cursor: not-allowed;
         }
         
         .spin {
             animation: spin 1s linear infinite;
         }
         
         @keyframes spin {
             from { transform: rotate(0deg); }
             to { transform: rotate(360deg); }
         }
         
         .input-feedback {
             margin-top: 0.5rem;
         }
         
         .invalid-feedback {
             display: flex;
             align-items: center;
             gap: 0.5rem;
             margin-top: 0.5rem;
         }
         
         /* Mobile Responsiveness */
         @media (max-width: 768px) {
             .payment-container {
                 padding: 1rem;
             }
             
             .payment-card {
                 border-radius: 16px;
             }
             
             .payment-header {
                 padding: 1.5rem;
             }
             
             .payment-title {
                 font-size: 1.5rem;
             }
             
             .progress-container {
                 padding: 0.75rem;
             }
             
             .progress-step {
                 width: 30px;
                 height: 30px;
                 font-size: 0.8rem;
             }
             
             .step-label {
                 font-size: 0.7rem;
                 top: 40px;
             }
             
             .summary-content, .instructions-content, .form-content {
                 padding: 1rem;
             }
             
             .fee-item.down-payment {
                 margin: 1rem -1rem -1rem -1rem;
                 padding: 1rem;
             }
             
             .file-upload-area {
                 padding: 2rem 1rem;
             }
             
             .upload-icon {
                 font-size: 2rem;
             }
         }
         
         @media (max-width: 576px) {
             .security-badges {
                 flex-direction: column;
                 align-items: flex-start;
                 gap: 0.25rem;
             }
             
             .form-header {
                 flex-direction: column;
                 align-items: flex-start;
                 gap: 1rem;
             }
         }
     </style>
     @endpush
    
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('payment-form');
            const fileInput = document.getElementById('receipt_image');
            const fileUploadArea = document.getElementById('file-upload-area');
            const filePreview = document.getElementById('file-preview');
            const previewImage = document.getElementById('preview-image');
            const fileName = document.getElementById('file-name');
            const removeFileBtn = document.getElementById('remove-file');
            const notesTextarea = document.getElementById('notes');
            const charCount = document.getElementById('char-count');
            const submitBtn = document.getElementById('submit-btn');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoading = submitBtn.querySelector('.btn-loading');

            // File upload handling
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    handleFileUpload(file);
                }
            });

            // Drag and drop handling
            fileUploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.style.borderColor = '#0d6efd';
                this.style.background = '#e7f3ff';
            });

            fileUploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.style.borderColor = '#dee2e6';
                this.style.background = '#f8f9fa';
            });

            fileUploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                this.style.borderColor = '#dee2e6';
                this.style.background = '#f8f9fa';
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    handleFileUpload(files[0]);
                }
            });

            function handleFileUpload(file) {
                // Validate file type
                if (!file.type.startsWith('image/')) {
                    alert('Please select an image file.');
                    return;
                }

                // Validate file size (5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB.');
                    return;
                }

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    fileName.textContent = file.name;
                    fileUploadArea.style.display = 'none';
                    filePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }

            // Remove file
            removeFileBtn.addEventListener('click', function() {
                fileInput.value = '';
                fileUploadArea.style.display = 'block';
                filePreview.style.display = 'none';
            });

            // Character counter for notes
            notesTextarea.addEventListener('input', function() {
                const length = this.value.length;
                charCount.textContent = length;
                
                if (length > 500) {
                    charCount.style.color = '#dc3545';
                    this.value = this.value.substring(0, 500);
                    charCount.textContent = '500';
                } else {
                    charCount.style.color = '#6c757d';
                }
            });

            // Form submission
            form.addEventListener('submit', function(e) {
                // Prevent double submission
                if (submitBtn.disabled) {
                    e.preventDefault();
                    return;
                }

                // Show loading state
                submitBtn.disabled = true;
                btnText.style.display = 'none';
                btnLoading.style.display = 'inline-flex';
            });

            // Input validation feedback
            const inputs = form.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.hasAttribute('required') && !this.value.trim()) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });

                input.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid') && this.value.trim()) {
                        this.classList.remove('is-invalid');
                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>