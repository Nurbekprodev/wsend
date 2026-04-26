<x-app-layout>
    
    <section class="bg-white dark:bg-gray-900 min-h-screen flex items-center">

        <div class="max-w-xl mx-auto px-4 w-full">

            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm 
                        dark:bg-gray-800 dark:border-gray-700">

                <!-- Icon -->
                <div class="text-center text-4xl mb-4">
                    @php
                        $ext = pathinfo($file->original_name, PATHINFO_EXTENSION);
                    @endphp

                    @if(in_array($ext, ['jpg','jpeg','png','gif','webp']))
                        🖼️
                    @elseif(in_array($ext, ['pdf']))
                        📄
                    @elseif(in_array($ext, ['zip','rar','7z']))
                        📦
                    @elseif(in_array($ext, ['mp4','mov','avi']))
                        🎬
                    @elseif(in_array($ext, ['mp3','wav']))
                        🎵
                    @else
                        📁
                    @endif
                </div>

                <!-- Title -->
                <h1 class="text-center mb-4 text-xl font-semibold text-gray-900 dark:text-white">
                    File ready to download
                </h1>

                <!-- File name -->
                <p class="text-center text-sm text-gray-700 dark:text-gray-300 break-all mb-4">
                    {{ $file->original_name }}
                </p>

                <!-- Info box -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 space-y-3 text-sm">

                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-300">Size</span>
                        <span class="font-medium text-gray-900 dark:text-white">
                            {{ number_format($file->file_size / 1024 / 1024, 2) }} MB
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-300">Expires</span>
                        <span class="font-medium text-gray-900 dark:text-white">
                            {{ optional($file->expires_at)->diffForHumans() }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-300">Downloads left</span>
                        <span class="font-medium text-gray-900 dark:text-white">
                        @if(is_null($file->max_downloads))
                            Unlimited
                        @else
                            {{ $file->max_downloads - $file->downloads }}
                        @endif
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-300">Uploaded</span>
                        <span class="font-medium text-gray-900 dark:text-white">
                            {{ $file->created_at->format('M d, Y') }}
                        </span>
                    </div>

                </div>

                <!-- Download button -->
                <a href="/download/{{ $file->token }}"
                    class="mt-6 inline-flex items-center justify-center w-full text-white 
                            bg-primary-700 hover:bg-primary-800 focus:ring-4 
                            focus:ring-primary-300 font-medium rounded-lg 
                            text-sm px-5 py-2.5 
                            dark:bg-primary-600 dark:hover:bg-primary-700">
                    Download file
                </a>

            </div>

        </div>

    </section>

</x-app-layout>