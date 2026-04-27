<x-app-layout>

    <!-- Hero section -->
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-12 mx-auto lg:gap-8 lg:grid-cols-12">

            <!-- Text -->
            <div class="mr-auto place-self-center lg:col-span-7">

                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Fast & secure file sharing
                </h1>

                <p class="max-w-2xl mb-6 font-light text-gray-500 md:text-lg lg:text-xl dark:text-gray-400">
                    Upload files instantly and get a secure shareable link. No signup required. 
                    Set expiry dates, add passwords, and track downloads easily.
                </p>

                <a href="/upload"
                class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300">
                    Upload file
                    <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"/>
                    </svg>
                </a>

                <a href="/dashboard"
                class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700">
                    View dashboard
                </a>

            </div>

            <!-- Image -->
            <div class="hidden lg:flex lg:col-span-5 items-center justify-center">
                <img 
                    src="{{ asset('images/hero_img.svg') }}" 
                    alt="SaaS illustration"
                    class="w-full max-w-md h-auto transition duration-300 hover:scale-105"
                >
            </div>

        </div>
    </section>

    <!-- <div class="my-10  h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent dark:via-gray-700"></div> -->
    <!-- Upload box section -->
    <div>
        <x-upload-form/>
    </div>

    <!-- Short description section -->
    <section class="bg-white dark:bg-gray-900 pb-10">
        <div class="max-w-5xl mx-auto px-4 py-12">

            <h2 class="mb-8 text-2xl font-bold text-center text-gray-900 dark:text-white">
                How it works
            </h2>

            <div class="grid md:grid-cols-3 gap-8">

                <!-- Step 1 -->
                <div class="text-center">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 
                                text-white bg-primary-700 rounded-full">
                        1
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                        Upload
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        Choose your file and upload it securely to our servers.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 
                                text-white bg-primary-700 rounded-full">
                        2
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                        Get Link
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        We generate a unique secure download link instantly.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 
                                text-white bg-primary-700 rounded-full">
                        3
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                        Share
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        Send the link to anyone. They can download the file.
                    </p>
                </div>

            </div>

        </div>
    </section>

     <!-- features -->
    <section class="bg-white dark:bg-gray-900">
    <div class="py-12 px-4 mx-auto max-w-screen-xl lg:px-6">

        <!-- Heading -->
        <div class="max-w-screen-md mb-12">
            <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white">
                Everything you need for secure file sharing
            </h2>
            <p class="mt-4 text-gray-500 sm:text-xl dark:text-gray-400">
                Upload, protect, and share files with full control over expiry, access, and downloads.
            </p>
        </div>

        <!-- Features Grid -->
        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">

            <!-- Feature 1 -->
            <div>
                <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-primary-100 dark:bg-primary-900">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4h12v12H4z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Expiring Links</h3>
                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    Automatically delete access after a selected time period.
                </p>
            </div>

            <!-- Feature 2 -->
            <div>
                <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-primary-100 dark:bg-primary-900">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2l8 4v6c0 4-3 6-8 6S2 16 2 12V6l8-4z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Password Protection</h3>
                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    Secure files with optional password protection.
                </p>
            </div>

            <!-- Feature 3 -->
            <div>
                <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-primary-100 dark:bg-primary-900">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 10h14M3 6h14M3 14h14"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Download Limits</h3>
                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    Control how many times a file can be downloaded.
                </p>
            </div>

            <!-- Feature 4 -->
            <div>
                <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-primary-100 dark:bg-primary-900">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 12l4 4L19 6"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Fast Uploads</h3>
                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    Optimized upload system with instant link generation.
                </p>
            </div>

            <!-- Feature 5 -->
            <div>
                <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-primary-100 dark:bg-primary-900">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4h12v12H4z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Secure Storage</h3>
                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    Files are stored safely and automatically managed.
                </p>
            </div>

            <!-- Feature 6 -->
            <div>
                <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-primary-100 dark:bg-primary-900">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2v16M2 10h16"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Simple Sharing</h3>
                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    Share links instantly with anyone, no setup required.
                </p>
            </div>

        </div>
    </div>
    </section>
  

    <!-- trust section -->
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 py-12 mx-auto lg:px-6">

            <!-- Heading -->
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Trusted & secure file sharing
                </h2>
                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    Built for safety, speed, and full control over your files.
                </p>
            </div>

            <!-- Trust items -->
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">

                <!-- 1 -->
                <div class="p-5 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 text-center">
                    <div class="text-2xl mb-3">🔒</div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Secure Storage</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Files are safely stored and protected.
                    </p>
                </div>

                <!-- 2 -->
                <div class="p-5 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 text-center">
                    <div class="text-2xl mb-3">⏳</div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Auto Expiry</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Files automatically delete after set time.
                    </p>
                </div>

                <!-- 3 -->
                <div class="p-5 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 text-center">
                    <div class="text-2xl mb-3">📁</div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Private Links</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Only users with link can access files.
                    </p>
                </div>

                <!-- 4 -->
                <div class="p-5 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 text-center">
                    <div class="text-2xl mb-3">⚡</div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Fast Transfers</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Optimized uploads and downloads.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- final CTA -->
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 py-16 mx-auto text-center lg:px-6">

            <!-- Card -->
            <div class="p-10 bg-white border border-gray-200 rounded-2xl shadow-sm dark:bg-gray-800 dark:border-gray-700">

                <!-- Heading -->
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                    Ready to share your file?
                </h2>

                <!-- Sub text -->
                <p class="mt-3 text-gray-500 dark:text-gray-400">
                    Secure, fast and auto-expiring file sharing in seconds.
                </p>

                <!-- Buttons -->
                <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center">

                    <a href="/upload"
                    class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700">
                        Upload File
                    </a>

                    <a href="/login"
                    class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                        Login / Register
                    </a>

                </div>

                <!-- Small trust line -->
                <p class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                    No credit card required • Files expire automatically
                </p>

            </div>

        </div>
    </section>
     
</x-app-layout>