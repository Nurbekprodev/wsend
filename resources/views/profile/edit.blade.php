<x-app-layout>

    <x-section class="py-16 bg-gray-50 dark:bg-gray-900 min-h-screen">

        <x-container class="max-w-5xl">

            <!-- Header -->
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ __('Profile') }}
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                    {{ __('Manage your account settings and security.') }}
                </p>
            </div>

            <div class="space-y-6">

                <!-- Profile Info -->
                <x-card class="p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm bg-white dark:bg-gray-800">
                    <div class="max-w-2xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </x-card>

                <!-- Password -->
                <x-card class="p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm bg-white dark:bg-gray-800">
                    <div class="max-w-2xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </x-card>

                <!-- Delete -->
                <x-card class="p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm bg-white dark:bg-gray-800">
                    <div class="max-w-2xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </x-card>

            </div>

        </x-container>

    </x-section>

</x-app-layout>