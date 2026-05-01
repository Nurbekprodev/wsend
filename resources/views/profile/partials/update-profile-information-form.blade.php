<header class="mb-6">
    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
        {{ __('Profile Information') }}
    </h2>

    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
        {{ __("Update your account's profile information and email address.") }}
    </p>
</header>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="space-y-5">
    @csrf
    @method('patch')

    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input
            id="name"
            name="name"
            type="text"
            class="mt-1 block w-full rounded-xl"
            :value="old('name', $user->name)"
            required
            autofocus
            autocomplete="name"
        />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input
            id="email"
            name="email"
            type="email"
            class="mt-1 block w-full rounded-xl"
            :value="old('email', $user->email)"
            required
            autocomplete="username"
        />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-3 text-sm text-gray-500 dark:text-gray-400">
                {{ __('Your email address is unverified.') }}

                <button
                    type="submit"
                    form="send-verification"
                    class="ml-2 text-blue-600 hover:underline font-medium"
                >
                    {{ __('Resend verification email') }}
                </button>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm font-medium text-green-600">
                        {{ __('Verification link sent.') }}
                    </p>
                @endif
            </div>
        @endif
    </div>

    <div class="flex items-center gap-3 pt-2">
        <x-button-primary type="submit" class="px-6 py-2.5 rounded-xl">
            {{ __('Save') }}
        </x-button-primary>

        @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-500 dark:text-gray-400"
            >
                {{ __('Saved.') }}
            </p>
        @endif
    </div>

</form>