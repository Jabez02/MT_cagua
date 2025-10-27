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
        }

        .card-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius-sm);
            font-size: 1rem;
            transition: var(--transition);
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-control.is-invalid {
            border-color: var(--danger-color);
        }

        .invalid-feedback {
            display: block;
            color: var(--danger-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
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

        .btn-secondary {
            background: var(--secondary-color);
            color: white;
        }

        .btn-secondary:hover {
            background: #475569;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .form-text {
            font-size: 0.875rem;
            color: var(--text-secondary);
            margin-top: 0.25rem;
        }

        .required {
            color: var(--danger-color);
        }

        .info-card {
            background: rgba(6, 182, 212, 0.1);
            border: 1px solid rgba(6, 182, 212, 0.2);
            border-radius: var(--border-radius-sm);
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-card h5 {
            color: var(--info-color);
            margin: 0 0 0.5rem 0;
            font-weight: 600;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
    </style>

    <div class="dashboard-container">
        <div class="container mx-auto px-4">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="bi bi-pencil-square"></i>
                    Edit Porter
                </h1>
                <p class="text-secondary mt-2 mb-0">Update porter information</p>
            </div>

            <!-- Current Status Info -->
            <div class="info-card">
                <h5><i class="bi bi-info-circle me-2"></i>Current Information</h5>
                <div class="info-grid">
                    <div class="info-item">
                        <span>Current Status:</span>
                        <span class="badge {{ $porter->getStatusBadgeClass() }}">
                            {{ $porter->getStatusLabel() }}
                        </span>
                    </div>
                    <div class="info-item">
                        <span>Total Hikes:</span>
                        <span class="badge badge-info">{{ $porter->total_hikes }}</span>
                    </div>
                    <div class="info-item">
                        <span>Max Capacity:</span>
                        <span class="badge badge-info">{{ $porter->getCapacityDisplay() }}</span>
                    </div>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="content-card">
                <div class="card-header">
                    <h3 class="mb-0">Porter Information</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.porters.update', $porter) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        Full Name <span class="required">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $porter->name) }}" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_number" class="form-label">
                                        Contact Number <span class="required">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('contact_number') is-invalid @enderror" 
                                           id="contact_number" 
                                           name="contact_number" 
                                           value="{{ old('contact_number', $porter->contact_number) }}" 
                                           required>
                                    @error('contact_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Enter a valid phone number</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" 
                                      name="address" 
                                      rows="3">{{ old('address', $porter->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Complete address for contact purposes</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="form-label">
                                        Status <span class="required">*</span>
                                    </label>
                                    <select class="form-control @error('status') is-invalid @enderror" 
                                            id="status" 
                                            name="status" 
                                            required>
                                        <option value="">Select Status</option>
                                        <option value="available" {{ old('status', $porter->status) === 'available' ? 'selected' : '' }}>
                                            Available
                                        </option>
                                        <option value="assigned" {{ old('status', $porter->status) === 'assigned' ? 'selected' : '' }}>
                                            Assigned
                                        </option>
                                        <option value="unavailable" {{ old('status', $porter->status) === 'unavailable' ? 'selected' : '' }}>
                                            Unavailable
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="max_weight_capacity" class="form-label">
                                        Maximum Weight Capacity (kg) <span class="required">*</span>
                                    </label>
                                    <input type="number" 
                                           class="form-control @error('max_weight_capacity') is-invalid @enderror" 
                                           id="max_weight_capacity" 
                                           name="max_weight_capacity" 
                                           value="{{ old('max_weight_capacity', $porter->max_weight_capacity) }}" 
                                           min="1" 
                                           max="100"
                                           required>
                                    @error('max_weight_capacity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Maximum weight the porter can carry (1-100 kg)</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('admin.porters.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i>
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg"></i>
                                Update Porter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>