@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-1 text-gray-800">Payment Methods</h1>
                    <p class="text-muted mb-0">Manage payment methods and their configurations</p>
                </div>
                <a href="{{ route('admin.payment-methods.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    Add Payment Method
                </a>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Methods
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $paymentMethods->count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-credit-card fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Active Methods
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $paymentMethods->where('is_active', true)->count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-check-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Inactive Methods
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $paymentMethods->where('is_active', false)->count() }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-x-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Total Usage
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $paymentMethods->sum('payments_count') }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-graph-up fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Methods Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Payment Methods List</h6>
                </div>
                <div class="card-body">
                    @if($paymentMethods->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Priority</th>
                                        <th>Method</th>
                                        <th>Processing Fees</th>
                                        <th>Limits</th>
                                        <th>Currencies</th>
                                        <th>Status</th>
                                        <th>Usage</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable-payment-methods">
                                    @foreach($paymentMethods as $method)
                                        <tr data-id="{{ $method->id }}">
                                            <td class="text-center">
                                                <span class="badge badge-secondary">{{ $method->priority }}</span>
                                                <i class="bi bi-grip-vertical text-muted ms-2" style="cursor: move;"></i>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <strong>{{ $method->name }}</strong>
                                                    <small class="text-muted">{{ $method->code }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    @if($method->processing_fee_percentage > 0)
                                                        <span class="text-success">{{ $method->processing_fee_percentage }}%</span>
                                                    @endif
                                                    @if($method->processing_fee_fixed > 0)
                                                        <span class="text-info">₱{{ number_format($method->processing_fee_fixed, 2) }}</span>
                                                    @endif
                                                    @if($method->processing_fee_percentage == 0 && $method->processing_fee_fixed == 0)
                                                        <span class="text-muted">Free</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    @if($method->min_amount)
                                                        <small class="text-muted">Min: ₱{{ number_format($method->min_amount, 2) }}</small>
                                                    @endif
                                                    @if($method->max_amount)
                                                        <small class="text-muted">Max: ₱{{ number_format($method->max_amount, 2) }}</small>
                                                    @endif
                                                    @if(!$method->min_amount && !$method->max_amount)
                                                        <span class="text-muted">No limits</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach($method->currencies as $currency)
                                                        <span class="badge badge-outline-primary">{{ $currency }}</span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input status-toggle" 
                                                           type="checkbox" 
                                                           data-id="{{ $method->id }}"
                                                           {{ $method->is_active ? 'checked' : '' }}>
                                                    <label class="form-check-label">
                                                        <span class="badge {{ $method->is_active ? 'badge-success' : 'badge-secondary' }}">
                                                            {{ $method->is_active ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-info">{{ $method->payments_count ?? 0 }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.payment-methods.edit', $method) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-pencil"></i>
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-credit-card text-muted" style="font-size: 4rem;"></i>
                            <h4 class="text-muted mt-3">No Payment Methods Found</h4>
                            <p class="text-muted">Get started by adding your first payment method.</p>
                            <a href="{{ route('admin.payment-methods.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg"></i>
                                Add Payment Method
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Classic Bootstrap Admin Styling */
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }

    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }

    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }

    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }

    .text-xs {
        font-size: 0.7rem;
    }

    .text-gray-300 {
        color: #dddfeb !important;
    }

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

    .badge-outline-primary {
        color: #4e73df;
        border: 1px solid #4e73df;
        background-color: transparent;
    }

    .table th {
        background-color: #f8f9fc;
        border-color: #e3e6f0;
        font-weight: 600;
        font-size: 0.85rem;
        color: #5a5c69;
        text-transform: uppercase;
    }

    .table td {
        border-color: #e3e6f0;
        vertical-align: middle;
    }

    .btn-outline-primary {
        border-color: #4e73df;
        color: #4e73df;
    }

    .btn-outline-primary:hover {
        background-color: #4e73df;
        border-color: #4e73df;
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

    .alert {
        border: 1px solid transparent;
        border-radius: 0.35rem;
    }

    .alert-success {
        color: #0f5132;
        background-color: #d1e7dd;
        border-color: #badbcc;
    }

    .alert-danger {
        color: #842029;
        background-color: #f8d7da;
        border-color: #f5c2c7;
    }

    /* Sortable styling */
    #sortable-payment-methods tr {
        cursor: move;
    }

    #sortable-payment-methods tr:hover {
        background-color: #f8f9fc;
    }

    .ui-sortable-helper {
        background-color: #fff;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
$(document).ready(function() {
    // Make table sortable
    $("#sortable-payment-methods").sortable({
        handle: ".bi-grip-vertical",
        update: function(event, ui) {
            var order = $(this).sortable('toArray', {attribute: 'data-id'});
            
            $.ajax({
                url: '{{ route("admin.payment-methods.update-priority") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    order: order
                },
                success: function(response) {
                    if(response.success) {
                        // Update priority badges
                        $('#sortable-payment-methods tr').each(function(index) {
                            $(this).find('.badge-secondary').text(index + 1);
                        });
                        
                        // Show success message
                        showAlert('success', 'Priority order updated successfully!');
                    }
                },
                error: function() {
                    showAlert('danger', 'Failed to update priority order.');
                }
            });
        }
    });

    // Status toggle functionality
    $('.status-toggle').change(function() {
        var methodId = $(this).data('id');
        var isActive = $(this).is(':checked');
        var toggle = $(this);
        var badge = toggle.siblings('label').find('.badge');
        
        $.ajax({
            url: '/admin/payment-methods/' + methodId + '/toggle-status',
            method: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}',
                is_active: isActive
            },
            success: function(response) {
                if(response.success) {
                    // Update badge
                    if(isActive) {
                        badge.removeClass('badge-secondary').addClass('badge-success').text('Active');
                    } else {
                        badge.removeClass('badge-success').addClass('badge-secondary').text('Inactive');
                    }
                    
                    showAlert('success', 'Payment method status updated successfully!');
                } else {
                    // Revert toggle
                    toggle.prop('checked', !isActive);
                }
            },
            error: function() {
                // Revert toggle
                toggle.prop('checked', !isActive);
                showAlert('danger', 'Failed to update payment method status.');
            }
        });
    });

    // Auto-hide alerts
    setTimeout(function() {
        $('.alert').fadeOut();
    }, 5000);
});

function showAlert(type, message) {
    var alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    var icon = type === 'success' ? 'bi-check-circle' : 'bi-exclamation-triangle';
    
    var alert = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            <i class="bi ${icon} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    $('.container-fluid').prepend(alert);
    
    setTimeout(function() {
        $('.alert').first().fadeOut();
    }, 5000);
}
</script>
@endpush
@endsection