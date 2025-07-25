<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-50">
        <div class="max-w-md w-full mx-auto">
            <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
                <!-- Icon -->
                <div class="mb-6">
                    <div class="mx-auto w-20 h-20 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h1 class="text-3xl font-bold text-gray-900 mb-4">
                    Access Denied
                </h1>

                <!-- Description -->
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Sorry, you don't have permission to access this resource.
                    Please contact your administrator if you believe this is an error.
                </p>

                <!-- Error Code -->
                <div class="bg-gray-50 rounded-lg p-4 mb-8">
                    <p class="text-sm text-gray-500">
                        Error Code: <span class="font-mono font-semibold text-gray-700">403</span>
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    <a href="{{ url()->previous() }}"
                        class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Go Back
                    </a>

                    <a href="{{ route('home') }}"
                        class="w-full inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Go Home
                    </a>
                </div>

                <!-- Help Text -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-xs text-gray-500">
                        Need help? Contact support at
                        <a href="mailto:support@example.com" class="text-indigo-600 hover:text-indigo-500">
                            support@example.com
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
