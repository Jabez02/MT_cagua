@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h1 class="page-title-text">
                    <i class="bi bi-pencil-square"></i>
                    Edit Payment Method
                </h1>
                <p class="page-subtitle">Update payment method configuration and settings</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-outline-light">
                    <i class="bi bi-arrow-left"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <div class="form-card-header">
            <h3 class="form-card-title">
                <i class="bi bi-credit-card"></i>
                Payment Method Details
            </h3>
            <p class="form-card-subtitle">Configure the payment method settings and preferences</p>
        </div>
        
        <div class="form-card-body">
            <form method="POST" action="{{ route('admin.payment-methods.update', $paymentMethod) }}" class="payment-method-form">
                @csrf
                @method('PUT')
                
                @include('admin.payment-methods.form')
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Page Layout */
    .container-fluid {
        padding: 2rem;
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Page Header */
    .page-header {
        margin-bottom: 2rem;
    }

    .page-header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-title {
        flex: 1;
    }

    .page-title-text {
        color: white;
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 0.5rem 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .page-subtitle {
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
        font-size: 1rem;
    }

    .page-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .btn-outline-light {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-outline-light:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.4);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        text-decoration: none;
    }

    /* Form Card */
    .form-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 1200px;
        margin: 0 auto;
    }

    .form-card-header {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
        padding: 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
    }

    .form-card-title {
        color: white;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0 0 0.5rem 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }

    .form-card-subtitle {
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
        font-size: 1rem;
    }

    .form-card-body {
        padding: 2.5rem;
    }

    .payment-method-form {
        max-width: 100%;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container-fluid {
            padding: 1rem;
        }

        .page-header-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .page-title-text {
            font-size: 1.75rem;
        }

        .page-actions {
            width: 100%;
            justify-content: flex-start;
        }

        .form-card-header {
            padding: 1.5rem;
            text-align: left;
        }

        .form-card-title {
            justify-content: flex-start;
            font-size: 1.25rem;
        }

        .form-card-body {
            padding: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .page-title-text {
            font-size: 1.5rem;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .form-card-title {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .btn-outline-light {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush
@endsection