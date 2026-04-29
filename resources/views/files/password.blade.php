<x-app-layout>

    <x-section class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 py-16">

        <x-container class="max-w-md">

            <x-card class="p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-xl text-center bg-white dark:bg-gray-800">

                <!-- Icon -->
                <div class="mx-auto w-12 h-12 mb-6 rounded-2xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 text-2xl">
<svg class="w-10 h-10 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
</svg>
                </div>

                <!-- Title -->
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">
                    Protected File
                </h1>

                <!-- File name -->
                @isset($file)
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 truncate">
                        {{ $file->original_name }}
                    </p>
                @endisset

                <!-- Error -->
                @if(session('password'))
                    <div class="mt-5 p-3 text-sm text-red-600 bg-red-50 dark:bg-red-900/20 dark:text-red-300 rounded-xl">
                        {{ session('password') }}
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" class="mt-6 space-y-4">
                    @csrf

                    <x-input
                        type="password"
                        name="password"
                        placeholder="Enter password"
                        class="w-full rounded-xl px-4 py-3"
                    />

                    <x-button-primary
                        type="submit"
                        class="w-full py-3 rounded-xl text-base font-semibold"
                    >
                        Unlock file
                    </x-button-primary>

                </form>

            </x-card>

        </x-container>

    </x-section>

</x-app-layout>