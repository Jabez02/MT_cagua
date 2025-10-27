<x-app-layout>
    <style>
        :root {
            --primary-color: #3b82f6;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #06b6d4;
            --light-bg: #f8fafc;
            --card-bg: rgba(255, 255, 255, 0.95);
            --border-color: rgba(226, 232, 240, 0.8);
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --border-radius: 12px;
            --border-radius-sm: 8px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dashboard-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .page-header {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-lg);
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .page-title i {
            color: var(--primary-color);
        }

        .content-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        .card-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius-sm);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .btn-success {
            background: var(--success-color);
            color: white;
        }

        .btn-warning {
            background: var(--warning-color);
            color: white;
        }

        .btn-danger {
            background: var(--danger-color);
            color: white;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .table th {
            background: var(--light-bg);
            font-weight: 600;
            color: var(--text-primary);
        }

        .table tbody tr:hover {
            background: var(--light-bg);
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        .badge-info {
            background: rgba(6, 182, 212, 0.1);
            color: var(--info-color);
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: var(--border-radius-sm);
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: var(--success-color);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: var(--danger-color);
        }

        .pagination-wrapper {
            padding: 1.5rem 2rem;
            border-top: 1px solid var(--border-color);
        }

        .nav-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .nav-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: all 0.2s ease;
            border: 1px solid var(--primary-color);
        }

        .nav-btn:hover {
            background: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .nav-btn:disabled,
        .nav-btn.disabled {
            background: var(--muted-color);
            border-color: var(--muted-color);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .page-info {
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* Dark mode styles */
        .dark .nav-btn {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .dark .nav-btn:hover {
            background: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        .dark .page-info {
            color: var(--text-secondary);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
    </style>

    <div class="dashboard-container">
        <div class="container mx-auto px-4">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="bi bi-backpack"></i>
                    Porter Management
                </h1>
                <p class="text-secondary mt-2 mb-0">Manage hiking porters and their information</p>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Main Content Card -->
            <div class="content-card">
                <div class="card-header">
                    <div>
                        <h3 class="mb-0">All Porters</h3>
                        <p class="text-secondary mb-0">Total: {{ $porters->total() }} porters</p>
                    </div>
                    <a href="{{ route('admin.porters.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i>
                        Add New Porter
                    </a>
                </div>

                @if($porters->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>Max Capacity</th>
                                    <th>Total Hikes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($porters as $porter)
                                    <tr>
                                        <td>
                                            <div>
                                                <strong>{{ $porter->name }}</strong>
                                                <div class="text-secondary small">{{ $porter->address }}</div>
                                            </div>
                                        </td>
                                        <td>{{ $porter->contact_number }}</td>
                                        <td>
                                            <span class="badge {{ $porter->getStatusBadgeClass() }}">
                                                {{ $porter->getStatusLabel() }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $porter->getCapacityDisplay() }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $porter->total_hikes }}</span>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('admin.porters.show', $porter) }}" 
                                                   class="btn btn-sm btn-primary" title="View Details">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.porters.edit', $porter) }}" 
                                                   class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.porters.toggle-status', $porter) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" 
                                                            class="btn btn-sm {{ $porter->status === 'available' ? 'btn-warning' : 'btn-success' }}"
                                                            title="{{ $porter->status === 'available' ? 'Mark Unavailable' : 'Mark Available' }}">
                                                        <i class="bi bi-{{ $porter->status === 'available' ? 'pause' : 'play' }}"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.porters.destroy', $porter) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this porter?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Navigation Buttons -->
                    @if($porters->hasPages())
                        <div class="pagination-wrapper">
                            <div class="nav-buttons">
                                @if($porters->previousPageUrl())
                                    <a href="{{ $porters->previousPageUrl() }}" class="nav-btn nav-btn-prev">
                                        <i class="bi bi-chevron-left"></i>
                                        Previous
                                    </a>
                                @endif
                                
                                <span class="page-info">
                                    Page {{ $porters->currentPage() }} of {{ $porters->lastPage() }}
                                </span>
                                
                                @if($porters->nextPageUrl())
                                    <a href="{{ $porters->nextPageUrl() }}" class="nav-btn nav-btn-next">
                                        Next
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                @else
                    <div class="p-4 text-center">
                        <i class="bi bi-backpack display-1 text-secondary"></i>
                        <h4 class="mt-3">No Porters Found</h4>
                        <p class="text-secondary">Get started by adding your first porter.</p>
                        <a href="{{ route('admin.porters.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg"></i>
                            Add First Porter
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>