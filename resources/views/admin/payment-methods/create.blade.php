@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Page Header -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Add Payment Method</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.payment-methods.index') }}">Payment Methods</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Payment Method</li>
                        </ol>
                    </nav>
                </div>
                <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Back to List
                </a>
            </div>

            <!-- Form Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Payment Method Details</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.payment-methods.store') }}" class="payment-method-form">
                        @csrf
                        @include('admin.payment-methods.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Classic Bootstrap Admin Styling */
    .text-gray-800 {
        color: #5a5c69 !important;
    }

    .shadow {
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
    }

    .card {
        border: 1px solid #e3e6f0;
        border-radius: 0.35rem;
    }

    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }

    .breadcrumb {
        background-color: transparent;
        padding: 0;
        margin-bottom: 0;
        font-size: 0.85rem;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
        color: #858796;
    }

    .breadcrumb-item a {
        color: #5a5c69;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        color: #4e73df;
        text-decoration: underline;
    }

    .breadcrumb-item.active {
        color: #858796;
    }

    .btn-secondary {
        background-color: #858796;
        border-color: #858796;
    }

    .btn-secondary:hover {
        background-color: #717384;
        border-color: #6c757d;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .d-sm-flex {
            flex-direction: column;
            align-items: flex-start !important;
        }
        
        .d-sm-flex .btn {
            margin-top: 1rem;
            align-self: stretch;
        }
    }
</style>
@endpush
@endsection