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

    <div class="my-10  h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent dark:via-gray-700"></div>
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
  
</x-app-layout>