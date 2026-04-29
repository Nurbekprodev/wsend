<x-guest-layout>

    <x-section class="bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 min-h-screen flex items-center py-16">
        <x-container class="max-w-md">

            <x-card class="p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-xl">

                <!-- Icon -->
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 rounded-2xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0-3.866 3.582-7 8-7v7c0 4.418-3.582 8-8 8s-8-3.582-8-8v-7c4.418 0 8 3.134 8 7z"/>
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h1 class="text-center text-xl font-bold text-gray-900 dark:text-white mb-2">
                    {{ __('Reset password') }}
                </h1>

                <!-- Description -->
                <p class="text-center text-sm text-gray-500 dark:text-gray-400 mb-6">
                    {{ __('Enter your new password below.') }}
                </p>

                <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                    @csrf

                    <!-- Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input
                            id="email"
                            class="w-full mt-1 rounded-xl"
                            type="email"
                            name="email"
                            :value="old('email', $request->email)"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input
                            id="password"
                            class="w-full mt-1 rounded-xl"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input
                            id="password_confirmation"
                            class="w-full mt-1 rounded-xl"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                        />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <x-primary-button class="w-full py-3 rounded-xl text-base font-semibold">
                        {{ __('Reset Password') }}
                    </x-primary-button>

                </form>

            </x-card>

        </x-container>
    </x-section>

</x-guest-layout>