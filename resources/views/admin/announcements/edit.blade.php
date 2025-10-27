<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Announcement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.announcements.update', $announcement) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="announcement-form-group">
                            <label for="title" class="announcement-form-label">{{ __('Title') }}</label>
                            <input type="text" name="title" id="title" class="announcement-form-input @error('title') announcement-form-error @enderror" value="{{ old('title', $announcement->title) }}" required>
                            @error('title')
                                <span class="announcement-form-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="announcement-form-group">
                            <label for="type" class="announcement-form-label">{{ __('Type') }}</label>
                            <select name="type" id="type" class="announcement-form-input @error('type') announcement-form-error @enderror" required>
                                <option value="default" {{ old('type', $announcement->type) == 'default' ? 'selected' : '' }}>{{ __('Default') }}</option>
                                <option value="emergency" {{ old('type', $announcement->type) == 'emergency' ? 'selected' : '' }}>{{ __('Emergency') }}</option>
                                <option value="weather" {{ old('type', $announcement->type) == 'weather' ? 'selected' : '' }}>{{ __('Weather') }}</option>
                                <option value="trail" {{ old('type', $announcement->type) == 'trail' ? 'selected' : '' }}>{{ __('Trail') }}</option>
                            </select>
                            @error('type')
                                <span class="announcement-form-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="announcement-form-group">
                            <label for="content" class="announcement-form-label">{{ __('Content') }}</label>
                            <textarea name="content" id="content" rows="6" class="announcement-form-textarea @error('content') announcement-form-error @enderror" required>{{ old('content', $announcement->content) }}</textarea>
                            @error('content')
                                <span class="announcement-form-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="announcement-form-group">
                            <label for="expires_at" class="announcement-form-label">{{ __('Expiration Date') }}</label>
                            <input type="datetime-local" name="expires_at" id="expires_at" class="announcement-form-input @error('expires_at') announcement-form-error @enderror" value="{{ old('expires_at', $announcement->expires_at ? $announcement->expires_at->format('Y-m-d\TH:i') : '') }}">
                            @error('expires_at')
                                <span class="announcement-form-error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="announcement-form-actions">
                            <a href="{{ route('admin.announcements.index') }}" class="announcement-form-cancel">{{ __('Cancel') }}</a>
                            <button type="submit" class="announcement-form-submit">{{ __('Update Announcement') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>