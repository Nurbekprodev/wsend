<x-guest-layout>

    <x-section class="bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 min-h-screen flex items-center py-16">
        <x-container class="max-w-md">

            <x-card class="p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-xl">

                <!-- Icon -->
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 rounded-2xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h1 class="text-center text-xl font-bold text-gray-900 dark:text-white mb-2">
                    {{ __('Confirm password') }}
                </h1>

                <!-- Description -->
                <p class="text-center text-sm text-gray-500 dark:text-gray-400 mb-6">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <!-- Password -->
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" />

                        <x-text-input 
                            id="password" 
                            type="password"
                            name="password"
                            required 
                            autocomplete="current-password"
                            placeholder="Enter your password"
                            class="w-full px-4 py-3 rounded-xl" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <x-button-primary type="submit" class="w-full py-3 text-base font-semibold rounded-xl">
                        {{ __('Confirm') }}
                    </x-button-primary>

                </form>

            </x-card>

        </x-container>
    </x-section>

</x-guest-layout>