<x-app-layout>
    
    <section class="bg-white dark:bg-gray-900 min-h-screen flex items-center">
        <div class="max-w-xl mx-auto px-4 w-full">

            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm 
                        dark:bg-gray-800 dark:border-gray-700 text-center">

                <h1 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">
                    File ready to download
                </h1>

                <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">
                    {{ $file->original_name }}
                </p>

                <a href="/download/{{ $file->token }}"
                class="inline-flex items-center justify-center w-full text-white 
                        bg-primary-700 hover:bg-primary-800 focus:ring-4 
                        focus:ring-primary-300 font-medium rounded-lg 
                        text-sm px-5 py-2.5 
                        dark:bg-primary-600 dark:hover:bg-primary-700">
                    Download file
                </a>

                <p class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                    This link may expire after some time.
                </p>

            </div>

        </div>
    </section>

</x-app-layout>