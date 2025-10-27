@push('styles')
<style>
    .btn-back {
        @apply inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150;
    }
    .btn-template {
        @apply text-left px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50;
    }
    .btn-cancel {
        @apply inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500;
    }
    .btn-send {
        @apply inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500;
    }
    .form-input {
        @apply shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md;
    }
    .form-checkbox {
        @apply h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded;
    }
</style>
@endpush

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Reply to Message') }}
            </h2>
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.messages.show', $message->id) }}" class="btn-back">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Back to Message') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Original Message Section -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Original Message') }}</h3>
                        <div class="bg-gray-50 rounded-lg p-6">
                            <div class="flex items-start space-x-4 mb-4">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-600 font-medium">{{ substr($message->user->name, 0, 2) }}</span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $message->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $message->user->email }}</p>
                                        </div>
                                        <span class="text-xs text-gray-500">{{ $message->created_at->format('M d, Y h:i A') }}</span>
                                    </div>
                                    <div class="mt-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $message->subject }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-14 text-sm text-gray-700">
                                {{ $message->content }}
                            </div>
                        </div>
                    </div>

                    <!-- Reply Form -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Your Reply') }}</h3>
                        <form action="{{ route('admin.messages.storeReply', $message->id) }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <!-- Subject Field -->
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700">{{ __('Subject') }}</label>
                                <div class="mt-1">
                                    <input type="text" name="subject" id="subject" 
                                        value="Re: {{ $message->subject }}"
                                        class="form-input"
                                        required>
                                </div>
                            </div>

                            <!-- Content Field -->
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700">{{ __('Message') }}</label>
                                <div class="mt-1">
                                    <textarea name="content" id="content" rows="8"
                                        class="form-input"
                                        placeholder="{{ __('Type your reply here...') }}"
                                        required></textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">
                                    {{ __('Write a thoughtful response to address the user\'s message.') }}
                                </p>
                            </div>

                            <!-- Quick Templates -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Quick Templates') }}</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <button type="button" 
                                        class="template-btn btn-template"
                                        data-template="{{ __('Thank you for your message. We have received your inquiry and will look into this matter promptly.') }}">
                                        {{ __('Acknowledgment') }}
                                    </button>
                                    <button type="button" 
                                        class="template-btn btn-template"
                                        data-template="{{ __('We apologize for any inconvenience caused. We are working to resolve this issue as quickly as possible.') }}">
                                        {{ __('Apology') }}
                                    </button>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between pt-4">
                                <div class="flex items-center">
                                    <input type="checkbox" name="mark_resolved" id="mark_resolved"
                                        class="form-checkbox">
                                    <label for="mark_resolved" class="ml-2 block text-sm text-gray-900">
                                        {{ __('Mark as resolved after sending') }}
                                    </label>
                                </div>
                                <div class="flex space-x-4">
                                    <button type="button" onclick="window.history.back()" class="btn-cancel">
                                        {{ __('Cancel') }}
                                    </button>
                                    <button type="submit" class="btn-send">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ __('Send Reply') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Quick Templates Functionality
        document.querySelectorAll('.template-btn').forEach(button => {
            button.addEventListener('click', function() {
                const template = this.dataset.template;
                const contentArea = document.getElementById('content');
                contentArea.value = template;
                contentArea.focus();
            });
        });

        // Character Counter
        const contentArea = document.getElementById('content');
        const maxLength = 1000;

        contentArea.addEventListener('input', function() {
            const remaining = maxLength - this.value.length;
            const counter = document.querySelector('.character-counter');
            if (!counter) {
                const counterElement = document.createElement('p');
                counterElement.className = 'character-counter mt-2 text-sm text-gray-500';
                this.parentNode.appendChild(counterElement);
            }
            document.querySelector('.character-counter').textContent = 
                `${remaining} ${__('characters remaining')}`;
        });

        // Form Submission Confirmation
        document.querySelector('form').addEventListener('submit', function(e) {
            if (!document.getElementById('content').value.trim()) {
                e.preventDefault();
                alert('{{ __('Please enter a reply message before sending.') }}');
            }
        });
    </script>
    @endpush
</x-app-layout>