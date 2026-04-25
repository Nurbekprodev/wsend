<x-app-layout>
    
    <section class="bg-white dark:bg-gray-900 min-h-screen flex items-center">

        <div class="max-w-xl mx-auto px-4 w-full">

            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm 
                        dark:bg-gray-800 dark:border-gray-700 text-center">

                <!-- File Icon -->
                <div class="flex justify-center mb-4 text-gray-500 dark:text-gray-300">
                    @php
                        $ext = pathinfo($file->original_name, PATHINFO_EXTENSION);
                    @endphp

                    @if(in_array($ext, ['jpg','jpeg','png','gif','webp']))
                        🖼️
                    @elseif(in_array($ext, ['pdf']))
                        📄
                    @elseif(in_array($ext, ['zip','rar','7z']))
                        🗜️
                    @elseif(in_array($ext, ['mp4','mov','avi']))
                        🎬
                    @elseif(in_array($ext, ['mp3','wav']))
                        🎵
                    @else
                        📁
                    @endif
                </div>

                <!-- Title -->
                <h1 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">
                    File ready to download
                </h1>

                <!-- File Name -->
                <p class="text-sm text-gray-700 dark:text-gray-300 break-all">
                    {{ $file->original_name }}
                </p>

                <!-- File Size -->
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    {{ number_format($file->file_size / 1024 / 1024, 2) }} MB
                </p>

                <!-- Download Button -->
                <a href="/download/{{ $file->token }}"
                class="mt-6 inline-flex items-center justify-center w-full text-white 
                        bg-primary-700 hover:bg-primary-800 focus:ring-4 
                        focus:ring-primary-300 font-medium rounded-lg 
                        text-sm px-5 py-2.5 
                        dark:bg-primary-600 dark:hover:bg-primary-700">
                    Download file
                </a>

                <!-- Footer Note -->
                <p class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                    This link may expire after some time.
                </p>

            </div>

        </div>

    </section>

</x-app-layout>