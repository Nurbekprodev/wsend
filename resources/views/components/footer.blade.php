
<footer class="bg-gray-100 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-16">
    <div class="mx-auto w-full max-w-screen-xl p-6 lg:py-8">

        <div class="md:flex md:justify-between">
            <div class="mb-6 md:mb-0">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center hover:opacity-90 transition">
                <img 
                    src="{{ asset('images/logo_img.png') }}" 
                    alt="logo"
                    class="h-20 w-auto">
            </a>
            </div>

            <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">

                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
                        Product
                    </h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="/" class="hover:underline">Upload</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Pricing</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
                        Support
                    </h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Help</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Contact</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
                        Legal
                    </h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Terms</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <hr class="my-6 border-gray-200 dark:border-gray-700" />

        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
                © {{ date('Y') }} YourApp. All rights reserved.
            </span>
        </div>

    </div>
</footer>