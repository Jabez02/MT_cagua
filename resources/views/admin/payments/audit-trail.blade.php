<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Audit Trail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('admin.payments.show', $payment) }}" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Back to Payment Details
                        </a>
                    </div>

                    <!-- Payment Summary -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Payment Summary</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <dt class="font-medium">Payment ID</dt>
                                    <dd>#{{ $payment->id }}</dd>
                                </div>
                                <div>
                                    <dt class="font-medium">Amount</dt>
                                    <dd>₱{{ number_format($payment->amount, 2) }}</dd>
                                </div>
                                <div>
                                    <dt class="font-medium">Customer</dt>
                                    <dd>{{ $payment->booking->user->name }}</dd>
                                </div>
                                <div>
                                    <dt class="font-medium">Booking ID</dt>
                                    <dd>#{{ $payment->booking->id }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Audit Trail Timeline -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Activity Timeline</h3>
                        <div class="flow-root">
                            <ul role="list" class="-mb-8">
                                @foreach($auditTrail as $event)
                                    <li>
                                        <div class="relative pb-8">
                                            @if(!$loop->last)
                                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                            @endif
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white
                                                        {{ $event['action'] === 'Payment Verified' ? 'bg-green-500' :
                                                           ($event['action'] === 'Flagged for Review' ? 'bg-yellow-500' :
                                                           ($event['action'] === 'Payment Refunded' ? 'bg-red-500' : 'bg-gray-500')) }}">
                                                        <!-- Icon based on action -->
                                                        @if($event['action'] === 'Payment Verified')
                                                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                            </svg>
                                                        @elseif($event['action'] === 'Flagged for Review')
                                                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                            </svg>
                                                        @elseif($event['action'] === 'Payment Refunded')
                                                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                                            </svg>
                                                        @else
                                                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                                                            </svg>
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                    <div>
                                                        <p class="text-sm text-gray-500">
                                                            {{ $event['action'] }}
                                                            <span class="font-medium text-gray-900">
                                                                {{ $event['details'] }}
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                        <time datetime="{{ $event['timestamp'] }}">
                                                            {{ $event['timestamp']->format('M d, Y h:i A') }}
                                                        </time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    @if($payment->receipt_url)
                        <!-- Receipt Preview -->
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold mb-4">Payment Receipt</h3>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <img src="{{ $payment->receipt_url }}" alt="Payment Receipt" class="max-w-full h-auto">
                                <div class="mt-4">
                                    <a href="{{ $payment->receipt_url }}" target="_blank"
                                       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                        View Full Receipt
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>