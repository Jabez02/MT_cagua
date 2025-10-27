<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-semibold">
            {{ __('New Message') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow">
                <div class="card-body">
                    <form method="POST" action="{{ route('user.messages.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="subject" class="form-label">{{ __('Subject') }}</label>
                            <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">{{ __('Message') }}</label>
                            <textarea name="message" id="message" rows="5" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('File Attachments') }}</label>
                            <div class="file-upload-zone p-4 text-center">
                                <div class="mb-3">
                                    <svg class="upload-icon mx-auto mb-2" width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <div class="text-muted">
                                        <label for="attachments" class="text-primary text-decoration-none fw-semibold" style="cursor: pointer;">
                                            {{ __('Choose files') }}
                                            <input id="attachments" name="attachments[]" type="file" class="d-none" multiple accept=".pdf,.doc,.docx,.txt,.jpg,.jpeg,.png,.gif,.zip,.rar">
                                        </label>
                                        {{ __(' or drag and drop') }}
                                    </div>
                                    <small class="text-muted d-block mt-2">
                                        {{ __('PDF, DOC, TXT, Images, ZIP up to 10MB each (max 5 files)') }}
                                    </small>
                                </div>
                            </div>
                            <div id="file-list" class="mt-3"></div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('user.messages.index') }}" class="btn btn-light">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Send Message') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <link href="{{ asset('css/file-upload.css') }}" rel="stylesheet">
    @endpush

    @push('scripts')
    <script src="{{ asset('js/file-upload.js') }}"></script>
    @endpush
</x-app-layout>