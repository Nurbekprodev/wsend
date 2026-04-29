<x-guest-layout>

    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                class="block mt-1 w-full rounded-xl"
                type="email"
                name="email"
                :value="old('email')"
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
                class="block mt-1 w-full rounded-xl"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                    name="remember"
                >
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Remember me') }}
                </span>
            </label>

            @if (Route::has('password.request'))
                <a
                    href="{{ route('password.request') }}"
                    class="text-sm text-blue-600 hover:text-blue-500"
                >
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Button -->
        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-3 rounded-xl text-base font-semibold">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Register -->
        <div class="text-center pt-2 text-sm text-gray-500 dark:text-gray-400">
            Don’t have an account?
            <a
                href="{{ route('register') }}"
                class="text-blue-600 hover:text-blue-500 font-medium"
            >
                Register
            </a>
        </div>

    </form>

</x-guest-layout>