<x-app-layout>

    <section class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 px-4">

        <div class="w-full max-w-md bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-6 text-center">

            <!-- Icon -->
            <div class="mx-auto w-14 h-14 mb-4 text-gray-400">
                🔒
            </div>

            <!-- Title -->
            <h1 class="text-xl font-semibold text-gray-900 dark:text-white">
                Protected File
            </h1>

            <!-- File name (optional) -->
            @isset($file)
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 truncate">
                    {{ $file->original_name }}
                </p>
            @endisset

            <!-- Error message -->
            @if(session('password'))
                <div class="mt-4 p-3 text-sm text-red-700 bg-red-100 dark:bg-red-900/40 dark:text-red-300 rounded-lg">
                    {{ session('password') }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" class="mt-5 space-y-4">
                @csrf

                <x-input 
                    type="password"
                    name="password"
                    placeholder="Enter password"
                    />

                <x-button-primary 
                    type="submit"
                    class="w-full">
                    Unlock file
                </x-button-primary>
            </form>

        </div>

    </section>

</x-app-layout>