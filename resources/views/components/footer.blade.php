<footer class="bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800">
    <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 py-12">

        <div class="flex flex-col md:flex-row md:justify-between gap-8">

            <!-- Logo + description -->
            <div class="max-w-xs">
                <a href="{{ url('/') }}" class="flex items-center mb-4">
                    <img 
                        src="{{ asset('images/logo_img.png') }}" 
                        alt="logo" 
                        class="h-16 w-auto">
                </a>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Fast, secure file sharing with auto-expiring links. No signup required.
                </p>
            </div>

            <!-- Minimal links -->
            <div class="flex flex-col gap-3 text-sm">

                <a href="{{ url('/') }}" 
                   class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">
                    Upload
                </a>

                @auth
                <a href="{{ route('dashboard') }}" 
                   class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">
                    Dashboard
                </a>
                @endauth

                <a href="mailto:nurbekprodev@gmail.com" 
                   class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">
                    Report an issue
                </a>

            </div>

        </div>

        <hr class="my-8 border-gray-100 dark:border-gray-800" />

        <div class="text-center text-sm text-gray-400 dark:text-gray-500">
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>

    </div>
</footer>