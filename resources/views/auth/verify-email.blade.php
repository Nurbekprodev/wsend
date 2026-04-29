<x-guest-layout>

    <x-section class="bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 min-h-screen flex items-center py-16">
        <x-container class="max-w-md">

            <x-card class="p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-xl text-center">

                <!-- Icon -->
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 rounded-2xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l4-4m-4 4l4 4"/>
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h1 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                    {{ __('Verify your email') }}
                </h1>

                <!-- Description -->
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                    {{ __('Please verify your email address before continuing.') }}
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 text-sm font-medium text-green-600 bg-green-50 dark:bg-green-900/20 p-3 rounded-xl">
                        {{ __('A new verification link has been sent to your email.') }}
                    </div>
                @endif

                <div class="space-y-4">

                    <!-- Resend -->
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <x-primary-button class="w-full py-3 rounded-xl text-base font-semibold">
                            {{ __('Resend verification email') }}
                        </x-primary-button>
                    </form>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                            class="w-full text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 underline">
                            {{ __('Log out') }}
                        </button>
                    </form>

                </div>

            </x-card>

        </x-container>
    </x-section>

</x-guest-layout>