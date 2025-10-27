<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Compose New Message') }}
            </h2>
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Messages
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.messages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Recipient Selection -->
                        <div>
                            <label for="recipient" class="block text-sm font-medium text-gray-700">Send To</label>
                            <div class="mt-1">
                                <select name="recipient" id="recipient" 
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    required>
                                    <option value="">Select Recipient</option>
                                    <optgroup label="Individual Users">
                                        @foreach($users as $user)
                                            <option value="user_{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Groups">
                                        <option value="all_users">All Users</option>
                                        <option value="active_users">Active Users</option>
                                        <option value="new_users">New Users (Last 30 Days)</option>
                                    </optgroup>
                                </select>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                                Select a specific user or a group of users to send this message to.
                            </p>
                        </div>

                        <!-- Subject Field -->
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                            <div class="mt-1">
                                <input type="text" name="subject" id="subject" 
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="Enter message subject"
                                    required>
                            </div>
                        </div>

                        <!-- Message Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Message Type</label>
                            <div class="grid grid-cols-4 gap-4">
                                <label class="relative flex items-center justify-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="message_type" value="general" class="sr-only" checked>
                                    <div class="flex flex-col items-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                        </svg>
                                        <span class="mt-2 text-sm font-medium text-gray-900">General</span>
                                    </div>
                                </label>
                                <label class="relative flex items-center justify-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="message_type" value="announcement" class="sr-only">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                        </svg>
                                        <span class="mt-2 text-sm font-medium text-gray-900">Announcement</span>
                                    </div>
                                </label>
                                <label class="relative flex items-center justify-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="message_type" value="notification" class="sr-only">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                        </svg>
                                        <span class="mt-2 text-sm font-medium text-gray-900">Notification</span>
                                    </div>
                                </label>
                                <label class="relative flex items-center justify-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="message_type" value="alert" class="sr-only">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                        <span class="mt-2 text-sm font-medium text-gray-900">Alert</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Content Field -->
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700">Message Content</label>
                            <div class="mt-1">
                                <textarea name="content" id="content" rows="8"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="Type your message here..."
                                    required></textarea>
                            </div>
                            <div class="mt-2 flex items-center justify-between">
                                <p class="text-sm text-gray-500">
                                    Write your message content here. Be clear and concise.
                                </p>
                                <span class="text-sm text-gray-500 character-counter"></span>
                            </div>
                        </div>

                        <!-- File Attachments -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">File Attachments</label>
                            <div class="file-upload-zone mt-1 flex justify-center px-6 pt-5 pb-6">
                                <div class="space-y-1 text-center">
                                    <svg class="upload-icon mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="attachments" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Upload files</span>
                                            <input id="attachments" name="attachments[]" type="file" class="sr-only" multiple accept=".pdf,.doc,.docx,.txt,.jpg,.jpeg,.png,.gif,.zip,.rar">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PDF, DOC, TXT, Images, ZIP up to 10MB each (max 5 files)
                                    </p>
                                </div>
                            </div>
                            <div id="file-list" class="mt-3 space-y-2"></div>
                        </div>

                        <!-- Quick Templates -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Quick Templates</label>
                            <div class="grid grid-cols-2 gap-4">
                                <button type="button" 
                                    class="template-btn text-left px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50"
                                    data-template="Important announcement regarding your recent activity on our platform.">
                                    Announcement Template
                                </button>
                                <button type="button" 
                                    class="template-btn text-left px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50"
                                    data-template="We have an important update about our services that may affect your experience.">
                                    Update Notification
                                </button>
                            </div>
                        </div>

                        <!-- Options -->
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="priority" id="priority"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="priority" class="ml-2 block text-sm text-gray-900">
                                    Mark as Priority
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="send_email" id="send_email"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="send_email" class="ml-2 block text-sm text-gray-900">
                                    Also send as email
                                </label>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-4 pt-4">
                            <button type="button" onclick="window.history.back()"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </button>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Send Message
                            </button>
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