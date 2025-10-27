<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("all bookings") }}
                </div>
                <div class="bg-white shadow-lg rounded-2xl p-8 max-w-md w-full">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Booking Form</h2>

                    <form action="#" method="POST" class="space-y-5">
                    <!-- Full Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" id="name" name="name" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-800 transition">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" id="email" name="email" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-800 transition">
                        </div>

                        <!-- Contact Number -->
                        <div>
                            <label for="contact" class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                            <input type="tel" id="contact" name="contact" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-800 transition">
                        </div>

                        <!-- Booking Date -->
                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Booking Date</label>
                            <input type="date" id="date" name="date" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-800 transition">
                        </div>

                        <!-- Number of Guests -->
                        <div>
                            <label for="guests" class="block text-sm font-medium text-gray-700 mb-1">Number of Guests</label>
                            <input type="number" id="guests" name="guests" min="1" max="20" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-800 transition">
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Additional Message</label>
                            <textarea id="message" name="message" rows="3"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-800 transition"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                                class="w-full bg-black text-white font-medium py-2 rounded-lg hover:bg-gray-800 transition">
                            Book Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
