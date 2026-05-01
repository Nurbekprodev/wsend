<div class="space-y-6">

    <header>
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
            {{ __('Delete Account') }}
        </h2>

        <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-5 py-2.5 rounded-xl"
    >
        {{ __('Delete Account') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>

        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 space-y-5">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.') }}
            </p>

            <div>
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full rounded-xl"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end gap-3 pt-2">

                <x-secondary-button
                    x-on:click="$dispatch('close')"
                    class="px-5 py-2.5 rounded-xl"
                >
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="px-5 py-2.5 rounded-xl">
                    {{ __('Delete Account') }}
                </x-danger-button>

            </div>

        </form>

    </x-modal>

</div>