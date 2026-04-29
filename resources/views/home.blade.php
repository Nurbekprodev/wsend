<x-app-layout>

    <!-- HERO / UPLOAD FIRST -->
    <x-section class="bg-gradient-to-b from-blue-50 to-white dark:from-gray-900 dark:to-gray-800 pt-16 pb-20">
        <x-container class="max-w-3xl">

            <div class="text-center mb-10">
                <span class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-600 bg-blue-100 rounded-full dark:bg-blue-900/30 dark:text-blue-400 mb-4">
                    No signup required
                </span>

                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                    Share files instantly
                </h1>

                <p class="mt-4 text-lg text-gray-600 dark:text-gray-400 max-w-xl mx-auto">
                    Send assignments, project files, or client assets in seconds.
                    Auto delete, password protected, download limits.
                </p>
            </div>

            <x-upload-form/>

        </x-container>
    </x-section>


    <!-- TRUST STRIP -->
    <x-section class="py-12 bg-white dark:bg-gray-800 border-y border-gray-100 dark:border-gray-700">
        <x-container class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">

            <div class="flex flex-col items-center">
                <div class="w-12 h-12 mb-3 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <p class="text-base font-semibold text-gray-900 dark:text-white">No signup</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Upload instantly</p>
            </div>

            <div class="flex flex-col items-center">
                <div class="w-12 h-12 mb-3 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-base font-semibold text-gray-900 dark:text-white">Auto delete</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Files expire automatically</p>
            </div>

            <div class="flex flex-col items-center">
                <div class="w-12 h-12 mb-3 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <p class="text-base font-semibold text-gray-900 dark:text-white">Secure</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Private download links</p>
            </div>

            <div class="flex flex-col items-center">
                <div class="w-12 h-12 mb-3 rounded-xl bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <p class="text-base font-semibold text-gray-900 dark:text-white">Fast</p>
                <p class="text-sm text-gray-500 dark:text-gray-400">Optimized uploads</p>
            </div>

        </x-container>
    </x-section>


    <!-- HOW IT WORKS -->
    <x-section class="py-20 bg-gray-50 dark:bg-gray-900">
        <x-container>

            <div class="text-center max-w-2xl mx-auto mb-14">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
                    How it works
                </h2>
                <p class="mt-3 text-lg text-gray-500 dark:text-gray-400">
                    Share files in 3 simple steps
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-10">

                <div class="relative text-center p-6">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-blue-600 text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-blue-600/30">
                        1
                    </div>
                    <h3 class="mt-5 text-lg font-semibold text-gray-900 dark:text-white">
                        Upload files
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 mt-2">
                        Drag & drop or browse your files
                    </p>
                </div>

                <div class="relative text-center p-6">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-blue-600 text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-blue-600/30">
                        2
                    </div>
                    <h3 class="mt-5 text-lg font-semibold text-gray-900 dark:text-white">
                        Get secure link
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 mt-2">
                        Instantly generated for sharing
                    </p>
                </div>

                <div class="relative text-center p-6">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-blue-600 text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-blue-600/30">
                        3
                    </div>
                    <h3 class="mt-5 text-lg font-semibold text-gray-900 dark:text-white">
                        Share anywhere
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 mt-2">
                        Track downloads in real-time
                    </p>
                </div>

            </div>

        </x-container>
    </x-section>


    <!-- FEATURES -->
    <x-section class="py-20 bg-white dark:bg-gray-800">
        <x-container>

            <div class="text-center max-w-2xl mx-auto mb-14">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
                    Built for simple secure sharing
                </h2>
                <p class="mt-3 text-lg text-gray-500 dark:text-gray-400">
                    Everything you need for safe file transfers
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="p-6 rounded-2xl bg-gray-50 dark:bg-gray-700/50 border border-gray-100 dark:border-gray-700">
                    <div class="w-10 h-10 mb-4 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Expiring links</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Automatically revoke access after set time</p>
                </div>

                <div class="p-6 rounded-2xl bg-gray-50 dark:bg-gray-700/50 border border-gray-100 dark:border-gray-700">
                    <div class="w-10 h-10 mb-4 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Password protection</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Secure file access with passwords</p>
                </div>

                <div class="p-6 rounded-2xl bg-gray-50 dark:bg-gray-700/50 border border-gray-100 dark:border-gray-700">
                    <div class="w-10 h-10 mb-4 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Download limits</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Control how many times files are accessed</p>
                </div>

                <div class="p-6 rounded-2xl bg-gray-50 dark:bg-gray-700/50 border border-gray-100 dark:border-gray-700">
                    <div class="w-10 h-10 mb-4 rounded-lg bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Multiple files</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Upload and share multiple files at once</p>
                </div>

                <div class="p-6 rounded-2xl bg-gray-50 dark:bg-gray-700/50 border border-gray-100 dark:border-gray-700">
                    <div class="w-10 h-10 mb-4 rounded-lg bg-cyan-100 dark:bg-cyan-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Fast uploads</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Optimized for speed and performance</p>
                </div>

                <div class="p-6 rounded-2xl bg-gray-50 dark:bg-gray-700/50 border border-gray-100 dark:border-gray-700">
                    <div class="w-10 h-10 mb-4 rounded-lg bg-pink-100 dark:bg-pink-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">No account required</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Start sharing files instantly</p>
                </div>

            </div>

        </x-container>
    </x-section>


    <!-- FINAL CTA -->
    <x-section class="py-20 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800">
        <x-container class="max-w-3xl">

            <x-card class="p-10 md:p-14 text-center rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">

                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
                    Start sharing files now
                </h2>

                <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">
                    Free, secure and simple file transfer
                </p>

                <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">

                    <x-button-primary href="/upload" class="px-8 py-3 text-base font-semibold rounded-xl">
                        Upload file
                    </x-button-primary>

                    <x-button-secondary href="/login" class="px-8 py-3 text-base font-medium rounded-xl">
                        Login / Register
                    </x-button-secondary>

                </div>

            </x-card>

        </x-container>
    </x-section>

</x-app-layout>