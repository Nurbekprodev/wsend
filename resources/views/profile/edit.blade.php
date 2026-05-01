<x-app-layout>

    <x-section class="py-16 bg-gray-50 dark:bg-gray-900 min-h-screen">

        <x-container class="max-w-5xl">

            <!-- Header -->
            <div class="mb-10 max-w-2xl ">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ __('Profile') }}
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                    {{ __('Manage your account settings and security.') }}
                </p>
            </div>

            <!-- Success message -->
            @if (session('status'))
                <div class="mb-6 max-w-2xl">
                    <div class="px-4 py-3 rounded-xl bg-green-50 text-green-700 border border-green-200
                                dark:bg-green-900/20 dark:text-green-400 dark:border-green-800">
                        {{ 
                            session('status') === 'profile-updated' ? 'Profile updated successfully.' :
                            (session('status') === 'password-updated' ? 'Password updated successfully.' :
                            (session('status') === 'verification-link-sent' ? 'Verification email sent.' :
                            session('status')))
                        }}
                    </div>
                </div>
            @endif            

            <div class="space-y-6">

                <!-- Profile Info -->
                <x-card class="p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm bg-white dark:bg-gray-800">
                    <div class="max-w-2xl mx-auto">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </x-card>

                <!-- Password -->
                <x-card class="p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm bg-white dark:bg-gray-800">
                    <div class="max-w-2xl mx-auto">
                        @include('profile.partials.update-password-form')
                    </div>
                </x-card>

                <!-- Delete -->
                <x-card class="p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm bg-white dark:bg-gray-800">
                    <div class="max-w-2xl mx-auto">
                        @include('profile.partials.delete-user-form')
                    </div>
                </x-card>

            </div>

        </x-container>

    </x-section>

</x-app-layout>