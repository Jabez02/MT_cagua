@extends('layouts.admin')

@section('content')
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary-color: #64748b;
            --success-color: #059669;
            --warning-color: #d97706;
            --danger-color: #dc2626;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --border-radius-sm: 0.375rem;
            --border-radius-md: 0.5rem;
            --border-radius-lg: 0.75rem;
            --spacing-xs: 0.5rem;
            --spacing-sm: 0.75rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
        }

        .dashboard-container {
            background: var(--light-bg);
            min-height: 100vh;
            padding: var(--spacing-lg) 0;
        }

        .page-header {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            padding: var(--spacing-xl);
            margin-bottom: var(--spacing-xl);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .page-title i {
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .form-card {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .form-card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: white;
            padding: var(--spacing-lg) var(--spacing-xl);
            border-bottom: 1px solid var(--border-color);
        }

        .form-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .form-card-body {
            padding: var(--spacing-xl);
        }

        .form-section {
            margin-bottom: var(--spacing-xl);
        }

        .form-section-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: var(--spacing-lg);
            padding-bottom: var(--spacing-sm);
            border-bottom: 2px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .form-section-title i {
            color: var(--primary-color);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: var(--spacing-sm);
            font-size: 0.875rem;
        }

        .form-control, .form-select {
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius-md);
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            background: var(--card-bg);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgb(37 99 235 / 0.1);
            outline: none;
        }

        .form-control.is-invalid, .form-select.is-invalid {
            border-color: var(--danger-color);
        }

        .invalid-feedback {
            color: var(--danger-color);
            font-size: 0.75rem;
            margin-top: var(--spacing-xs);
        }

        .input-group-text {
            background: var(--light-bg);
            border: 2px solid var(--border-color);
            border-right: none;
            color: var(--text-secondary);
            font-weight: 600;
        }

        .input-group .form-control {
            border-left: none;
        }

        .input-group .form-control:focus {
            border-left: none;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius-md);
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-xs);
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .btn-light {
            background: var(--card-bg);
            color: var(--text-secondary);
            border: 2px solid var(--border-color);
        }

        .btn-light:hover {
            background: var(--light-bg);
            border-color: var(--secondary-color);
            color: var(--text-primary);
            transform: translateY(-1px);
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: var(--spacing-xl);
            border-top: 1px solid var(--border-color);
            margin-top: var(--spacing-xl);
        }

        .text-danger {
            color: var(--danger-color) !important;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: var(--spacing-md) 0;
            }
            
            .page-header, .form-card-body {
                padding: var(--spacing-lg);
            }
            
            .form-actions {
                flex-direction: column;
                gap: var(--spacing-md);
            }
            
            .form-actions .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="dashboard-container">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="bi bi-pencil-square"></i>
                    {{ __('Edit Hike Schedule') }}
                </h1>
            </div>

            <!-- Form Card -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="form-card">
                        <div class="form-card-header">
                            <h2 class="form-card-title">
                                <i class="bi bi-mountain"></i>
                                {{ __('Hike Schedule Information') }}
                            </h2>
                        </div>
                        <div class="form-card-body">
                            <form action="{{ route('admin.hikes.update', $hike->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Schedule Information Section -->
                                <div class="form-section">
                                    <h3 class="form-section-title">
                                        <i class="bi bi-calendar-event"></i>
                                        {{ __('Schedule Details') }}
                                    </h3>
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="date" class="form-label">{{ __('Date') }} <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $hike->date ? $hike->date->format('Y-m-d') : '') }}" required>
                                                @error('date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="start_time" class="form-label">{{ __('Start Time') }} <span class="text-danger">*</span></label>
                                                <input type="time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time', $hike->start_time ? $hike->start_time->format('H:i') : '') }}" required>
                                                @error('start_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="trail" class="form-label">{{ __('Trail') }} <span class="text-danger">*</span></label>
                                                <select class="form-select @error('trail') is-invalid @enderror" id="trail" name="trail" required>
                                                    <option value="">{{ __('Select Trail') }}</option>
                                                    <option value="Sta. Clara Trail" {{ old('trail', $hike->trail) === 'Sta. Clara Trail' ? 'selected' : '' }}>{{ __('Sta. Clara Trail') }}</option>
                                                    <option value="Alternative Trail" {{ old('trail', $hike->trail) === 'Alternative Trail' ? 'selected' : '' }}>{{ __('Alternative Trail') }}</option>
                                                </select>
                                                @error('trail')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="capacity" class="form-label">{{ __('Capacity') }} <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity', $hike->capacity) }}" min="1" required>
                                                @error('capacity')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pricing & Details Section -->
                                <div class="form-section">
                                    <h3 class="form-section-title">
                                        <i class="bi bi-gear"></i>
                                        {{ __('Pricing & Details') }}
                                    </h3>
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="price" class="form-label">{{ __('Price') }} <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text">₱</span>
                                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $hike->price) }}" min="0" required>
                                                </div>
                                                @error('price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="difficulty" class="form-label">{{ __('Difficulty') }} <span class="text-danger">*</span></label>
                                                <select class="form-select @error('difficulty') is-invalid @enderror" id="difficulty" name="difficulty" required>
                                                    <option value="">{{ __('Select Difficulty') }}</option>
                                                    <option value="easy" {{ old('difficulty', $hike->difficulty) === 'easy' ? 'selected' : '' }}>{{ __('Easy') }}</option>
                                                    <option value="moderate" {{ old('difficulty', $hike->difficulty) === 'moderate' ? 'selected' : '' }}>{{ __('Moderate') }}</option>
                                                    <option value="hard" {{ old('difficulty', $hike->difficulty) === 'hard' ? 'selected' : '' }}>{{ __('Hard') }}</option>
                                                </select>
                                                @error('difficulty')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">{{ __('Status') }} <span class="text-danger">*</span></label>
                                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                                    <option value="">{{ __('Select Status') }}</option>
                                                    <option value="open" {{ old('status', $hike->status) === 'open' ? 'selected' : '' }}>{{ __('Open') }}</option>
                                                    <option value="full" {{ old('status', $hike->status) === 'full' ? 'selected' : '' }}>{{ __('Full') }}</option>
                                                    <option value="closed" {{ old('status', $hike->status) === 'closed' ? 'selected' : '' }}>{{ __('Closed') }}</option>
                                                </select>
                                                @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="notes" class="form-label">{{ __('Notes') }}</label>
                                                <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3" placeholder="{{ __('Add any additional notes or instructions...') }}">{{ old('notes', $hike->notes) }}</textarea>
                                                @error('notes')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="form-actions">
                                    <a href="{{ route('admin.hikes.show', $hike->id) }}" class="btn btn-light">
                                        <i class="bi bi-arrow-left"></i>
                                        {{ __('Cancel') }}
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg"></i>
                                        {{ __('Update Hike') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection