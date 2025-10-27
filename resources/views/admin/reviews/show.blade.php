@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.reviews.index') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Reviews
                </a>
            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">{{ $review->hike->trail }}</h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ $review->hike->date->format('M d, Y') }} at {{ $review->hike->start_time->format('h:i A') }}
                                </p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($review->is_verified)
                                        bg-green-100 text-green-800
                                    @else
                                        bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ $review->is_verified ? 'Verified' : 'Pending' }}
                                </span>
                                @if(!$review->is_public)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Hidden
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 py-6">
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-gray-700">User Information</h4>
                            <dl class="mt-2 grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $review->user->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $review->user->email }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-700">Rating</h4>
                            <div class="mt-1 flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="h-5 w-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" 
                                         fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                        </div>

                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-700">Review Content</h4>
                            <p class="mt-1 text-sm text-gray-900">{{ $review->comment }}</p>
                        </div>

                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-700">Review Information</h4>
                            <dl class="mt-2 grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Submitted</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $review->created_at->format('M d, Y h:i A') }}</dd>
                                </div>
                                @if($review->is_verified)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Verified By</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $review->moderator->name }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Verified At</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $review->moderated_at->format('M d, Y h:i A') }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>

                        <div class="mt-6 flex justify-between">
                            <a href="{{ route('admin.reviews.index') }}" 
                               class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Back to Reviews
                            </a>
                            <div class="flex space-x-3">
                                @if(!$review->is_verified)
                                    <form action="{{ route('admin.reviews.verify', $review) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="inline-flex justify-center rounded-md border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                            Verify Review
                                        </button>
                                    </form>
                                @endif

                                @if($review->is_public)
                                    <form action="{{ route('admin.reviews.hide', $review) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="inline-flex justify-center rounded-md border border-transparent bg-yellow-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                            Hide Review
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.reviews.publish', $review) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                            Publish Review
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this review?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                        Delete Review
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>