<x-app-layout>

<!-- HERO -->
<section class="bg-white dark:bg-gray-900">
    <div class="max-w-screen-xl px-4 py-20 mx-auto grid lg:grid-cols-12 gap-10 items-center">

        <!-- Text -->
        <div class="lg:col-span-7">

            <h1 class="text-4xl md:text-5xl xl:text-6xl font-extrabold tracking-tight text-gray-900 dark:text-white leading-tight">
                Fast & secure file sharing for everyone
            </h1>

            <p class="mt-5 text-lg text-gray-600 dark:text-gray-400 max-w-2xl">
                Upload files instantly and generate secure shareable links with expiry, password protection, and download tracking.
            </p>

            <!-- Micro trust -->
            <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                No signup required • Auto-expiring links • Secure by default
            </p>

            <!-- CTA -->
            <div class="mt-8 flex flex-col sm:flex-row gap-3">

                <a href="/upload"
                   class="inline-flex items-center justify-center px-6 py-3 text-white bg-primary-700 hover:bg-primary-800 rounded-lg font-medium focus:ring-4 focus:ring-primary-300">
                    Upload File
                </a>

                <a href="/dashboard"
                   class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-900 dark:text-white dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    View Dashboard
                </a>

            </div>
        </div>

        <!-- Image -->
        <div class="lg:col-span-5 hidden lg:flex justify-center">
            <img src="{{ asset('images/hero_img.svg') }}"
                 alt="File sharing illustration"
                 class="w-full max-w-md hover:scale-105 transition duration-300">
        </div>

    </div>
</section>

<!-- STATS STRIP -->
<section class="bg-gray-50 dark:bg-gray-900 border-y border-gray-200 dark:border-gray-800">
    <div class="max-w-screen-xl mx-auto px-4 py-10 grid grid-cols-2 md:grid-cols-4 text-center gap-6">

        <div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">10K+</p>
            <p class="text-sm text-gray-500">Files shared</p>
        </div>

        <div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">99.9%</p>
            <p class="text-sm text-gray-500">Uptime</p>
        </div>

        <div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">&lt;2s</p>
            <p class="text-sm text-gray-500">Upload speed</p>
        </div>

        <div>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">Secure</p>
            <p class="text-sm text-gray-500">Encrypted links</p>
        </div>

    </div>
</section>

<!-- HOW IT WORKS -->
<section class="bg-white dark:bg-gray-900">
    <div class="max-w-screen-xl mx-auto px-4 py-20">

        <div class="text-center max-w-2xl mx-auto mb-14">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                How it works
            </h2>
            <p class="mt-3 text-gray-500 dark:text-gray-400">
                Share files in seconds with a simple 3-step process.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-10">

            <div class="text-center">
                <div class="w-12 h-12 mx-auto flex items-center justify-center rounded-full bg-primary-700 text-white font-bold">
                    1
                </div>
                <h3 class="mt-4 font-semibold text-lg text-gray-900 dark:text-white">Upload</h3>
                <p class="mt-2 text-sm text-gray-500">Select a file and upload it securely.</p>
            </div>

            <div class="text-center">
                <div class="w-12 h-12 mx-auto flex items-center justify-center rounded-full bg-primary-700 text-white font-bold">
                    2
                </div>
                <h3 class="mt-4 font-semibold text-lg text-gray-900 dark:text-white">Generate link</h3>
                <p class="mt-2 text-sm text-gray-500">We create a secure, shareable link instantly.</p>
            </div>

            <div class="text-center">
                <div class="w-12 h-12 mx-auto flex items-center justify-center rounded-full bg-primary-700 text-white font-bold">
                    3
                </div>
                <h3 class="mt-4 font-semibold text-lg text-gray-900 dark:text-white">Share</h3>
                <p class="mt-2 text-sm text-gray-500">Send it anywhere. Track downloads anytime.</p>
            </div>

        </div>

    </div>
</section>

<!-- FEATURES -->
<section class="bg-gray-50 dark:bg-gray-900">
    <div class="max-w-screen-xl mx-auto px-4 py-20">

        <div class="max-w-2xl mb-14">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                Powerful file sharing features
            </h2>
            <p class="mt-3 text-gray-500">
                Everything you need to control, protect, and share files securely.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">

            <div>
                <h3 class="font-semibold text-lg text-gray-900 dark:text-white">Expiring links</h3>
                <p class="mt-2 text-sm text-gray-500">Automatically revoke access after a set time.</p>
            </div>

            <div>
                <h3 class="font-semibold text-lg text-gray-900 dark:text-white">Password protection</h3>
                <p class="mt-2 text-sm text-gray-500">Restrict access with secure passwords.</p>
            </div>

            <div>
                <h3 class="font-semibold text-lg text-gray-900 dark:text-white">Download limits</h3>
                <p class="mt-2 text-sm text-gray-500">Control how many times a file can be downloaded.</p>
            </div>

            <div>
                <h3 class="font-semibold text-lg text-gray-900 dark:text-white">Fast uploads</h3>
                <p class="mt-2 text-sm text-gray-500">Optimized system for instant file processing.</p>
            </div>

            <div>
                <h3 class="font-semibold text-lg text-gray-900 dark:text-white">Secure storage</h3>
                <p class="mt-2 text-sm text-gray-500">Files stored safely with controlled access.</p>
            </div>

            <div>
                <h3 class="font-semibold text-lg text-gray-900 dark:text-white">Simple sharing</h3>
                <p class="mt-2 text-sm text-gray-500">No complexity. Just upload and share.</p>
            </div>

        </div>

    </div>
</section>

<!-- UPLOAD CTA (MOVED HERE) -->
<section class="bg-white dark:bg-gray-900">
    <div class="max-w-screen-lg mx-auto px-4 py-20 text-center">

        <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
            Upload your file in seconds
        </h2>

        <p class="mt-3 text-gray-500">
            No signup required. Secure, fast, and reliable file sharing.
        </p>

        <div class="mt-10">
            <x-upload-form />
        </div>

    </div>
</section>

<!-- FINAL CTA -->
<section class="bg-gray-50 dark:bg-gray-900">
    <div class="max-w-screen-lg mx-auto px-4 py-20">

        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-10 text-center shadow-sm">

            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                Start sharing files securely today
            </h2>

            <p class="mt-3 text-gray-500">
                Built for speed, security, and simplicity.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3">

                <a href="/upload"
                   class="px-6 py-3 bg-primary-700 text-white rounded-lg hover:bg-primary-800">
                    Upload File
                </a>

                <a href="/login"
                   class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    Login / Register
                </a>

            </div>

            <p class="mt-5 text-xs text-gray-500">
                No credit card required • Files expire automatically
            </p>

        </div>

    </div>
</section>

</x-app-layout>