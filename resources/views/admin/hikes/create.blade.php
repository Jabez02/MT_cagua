<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fs-4 fw-semibold text-body mb-0">
                {{ __('Create New Hike') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.hikes.store') }}" method="POST">
                                @csrf

                                <!-- Hike Schedule Information -->
                                <h4 class="fs-5 fw-semibold mb-4">{{ __('Hike Schedule Information') }}</h4>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">{{ __('Date') }} <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" required>
                                            @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="start_time" class="form-label">{{ __('Start Time') }} <span class="text-danger">*</span></label>
                                            <select class="form-select @error('start_time') is-invalid @enderror" id="start_time" name="start_time" required>
                                                <option value="">{{ __('Select Start Time') }}</option>
                                                <optgroup label="{{ __('Day Hike Options') }}">
                                                    <option value="05:30" {{ old('start_time') === '05:30' ? 'selected' : '' }}>5:30 AM</option>
                                                    <option value="06:00" {{ old('start_time') === '06:00' ? 'selected' : '' }}>6:00 AM</option>
                                                    <option value="07:00" {{ old('start_time') === '07:00' ? 'selected' : '' }}>7:00 AM</option>
                                                </optgroup>
                                                <optgroup label="{{ __('Overnight Options') }}">
                                                    <option value="10:00" {{ old('start_time') === '10:00' ? 'selected' : '' }}>10:00 AM</option>
                                                    <option value="10:30" {{ old('start_time') === '10:30' ? 'selected' : '' }}>10:30 AM</option>
                                                    <option value="11:00" {{ old('start_time') === '11:00' ? 'selected' : '' }}>11:00 AM</option>
                                                    <option value="11:30" {{ old('start_time') === '11:30' ? 'selected' : '' }}>11:30 AM</option>
                                                    <option value="12:00" {{ old('start_time') === '12:00' ? 'selected' : '' }}>12:00 PM</option>
                                                    <option value="12:30" {{ old('start_time') === '12:30' ? 'selected' : '' }}>12:30 PM</option>
                                                    <option value="13:00" {{ old('start_time') === '13:00' ? 'selected' : '' }}>1:00 PM</option>
                                                </optgroup>
                                            </select>
                                            <small class="form-text text-muted">
                                                {{ __('Day Hike: 5:30 AM, 6:00 AM, or 7:00 AM | Overnight: Between 10:00 AM and 1:00 PM') }}
                                            </small>
                                            @error('start_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="trail" class="form-label">{{ __('Trail') }} <span class="text-danger">*</span></label>
                                            <select class="form-select @error('trail') is-invalid @enderror" id="trail" name="trail" required>
                                                <option value="">{{ __('Select Trail') }}</option>
                                                <option value="Sta. Clara Trail (Back-Trail Only)" {{ old('trail') === 'Sta. Clara Trail (Back-Trail Only)' ? 'selected' : '' }} selected>{{ __('Sta. Clara Trail (Back-Trail Only)') }}</option>
                                                <option value="Alternative Trail" {{ old('trail') === 'Alternative Trail' ? 'selected' : '' }}>{{ __('Alternative Trail') }}</option>
                                            </select>
                                            @error('trail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="capacity" class="form-label">{{ __('Capacity') }} <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity') }}" min="1" required>
                                            @error('capacity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="price" class="form-label">{{ __('Price') }} <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">₱</span>
                                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" min="0" required>
                                            </div>
                                            @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="difficulty" class="form-label">{{ __('Difficulty') }} <span class="text-danger">*</span></label>
                                            <select class="form-select @error('difficulty') is-invalid @enderror" id="difficulty" name="difficulty" required>
                                                <option value="">{{ __('Select Difficulty') }}</option>
                                                <option value="easy" {{ old('difficulty') === 'easy' ? 'selected' : '' }}>{{ __('Easy') }}</option>
                                                <option value="moderate" {{ old('difficulty') === 'moderate' ? 'selected' : '' }}>{{ __('Moderate') }}</option>
                                                <option value="hard" {{ old('difficulty') === 'hard' ? 'selected' : '' }}>{{ __('Hard') }}</option>
                                            </select>
                                            @error('difficulty')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Status and Notes -->
                                <h4 class="fs-5 fw-semibold mb-4">{{ __('Status and Additional Information') }}</h4>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">{{ __('Status') }} <span class="text-danger">*</span></label>
                                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                                <option value="">{{ __('Select Status') }}</option>
                                                <option value="open" {{ old('status') === 'open' ? 'selected' : '' }}>{{ __('Open') }}</option>
                                                <option value="full" {{ old('status') === 'full' ? 'selected' : '' }}>{{ __('Full') }}</option>
                                                <option value="closed" {{ old('status') === 'closed' ? 'selected' : '' }}>{{ __('Closed') }}</option>
                                            </select>
                                            @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="notes" class="form-label">{{ __('Notes') }}</label>
                                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="4" placeholder="Optional notes about this hike schedule">{{ old('notes') }}</textarea>
                                            @error('notes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-3">
                                    <a href="{{ route('admin.hikes.index') }}" class="btn btn-light">{{ __('Cancel') }}</a>
                                    <button type="submit" class="btn btn-primary">{{ __('Create Hike') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>