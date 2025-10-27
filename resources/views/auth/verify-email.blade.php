<x-guest-layout>
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Welcome to Mt. Cagua Hiking!</h2>
            <p class="text-gray-600 mt-2">One More Step to Your Adventure</p>
        </div>

        <div class="mb-6 text-gray-600 bg-blue-50 p-4 rounded-lg">
            <p class="mb-2">Thank you for registering with Mt. Cagua Hiking! To ensure the security of your account and keep you updated about your hiking adventures, please verify your email address.</p>
            <p>We've sent a verification link to your email. Simply click the link to activate your account.</p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg">
                <p class="font-medium">Great! We've sent a fresh verification link to your email address.</p>
            </div>
        @endif

        <div class="space-y-4">
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-700 mb-2">Haven't received the email?</h3>
                <p class="text-sm text-gray-600 mb-4">Check your spam folder or request a new verification link below.</p>
                
                <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
                    @csrf
                    <x-primary-button class="w-full justify-center bg-green-600 hover:bg-green-700">
                        {{ __('Resend Verification Email') }}
                    </x-primary-button>
                </form>
            </div>

            <div class="border-t pt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 underline">
                        {{ __('Return to Login') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
