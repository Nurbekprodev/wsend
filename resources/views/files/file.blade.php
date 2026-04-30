<x-app-layout>

    <x-section class="bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 min-h-screen flex items-center py-16">
        <x-container class="max-w-md">

            <x-card class="p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-xl">

                <!-- Icon -->
                <div class="flex justify-center mb-6">
                @php
                    $baseFile = $files->first();
                    $totalSize = $files->sum('file_size');
                    $ext = strtolower(pathinfo($baseFile->original_name, PATHINFO_EXTENSION));
                @endphp

                @if($files->count() > 1)
                    <!-- generic icon -->
                    <div class="w-16 h-16 rounded-2xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 11h10M7 15h6"/>
                        </svg>
                    </div>
                @elseif(in_array($ext, ['jpg','jpeg','png','gif','webp','svg']))
                        <div class="w-16 h-16 rounded-2xl bg-pink-100 dark:bg-pink-900/30 flex items-center justify-center">
                            <svg class="w-8 h-8 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @elseif(in_array($ext, ['pdf','doc','docx','txt','rtf']))
                        <div class="w-16 h-16 rounded-2xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                            <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    @elseif(in_array($ext, ['zip','rar','7z','tar','gz']))
                        <div class="w-16 h-16 rounded-2xl bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center">
                            <svg class="w-8 h-8 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                            </svg>
                        </div>
                    @elseif(in_array($ext, ['mp4','mov','avi','mkv','webm']))
                        <div class="w-16 h-16 rounded-2xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                            <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @elseif(in_array($ext, ['mp3','wav','flac','aac','ogg']))
                        <div class="w-16 h-16 rounded-2xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                            </svg>
                        </div>
                    @else
                        <div class="w-16 h-16 rounded-2xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Title -->
                <h1 class="text-center text-xl font-bold text-gray-900 dark:text-white mb-2">
                    File ready to download
                </h1>

                <!-- File name -->
                @foreach($files as $file)
                    <p class="text-sm text-gray-600 dark:text-gray-400 break-all pb-2">
                        {{ $file->original_name }}
                    </p>
                @endforeach

                <!-- Info box -->
                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-5 space-y-4 text-sm mb-6">

                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                            </svg>
                            Size
                        </span>
                        <span class="font-semibold text-gray-900 dark:text-white">
                            {{ number_format($totalSize / 1024 / 1024, 2) }} MB
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Expires
                        </span>
                        <span class="font-semibold text-gray-900 dark:text-white">
                            {{ optional($baseFile->expires_at)->diffForHumans() ?? 'Never' }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Downloads left
                        </span>
                        <span class="font-semibold text-gray-900 dark:text-white">
                        @if(is_null($baseFile->max_downloads))
                            Unlimited
                        @else
                            {{ $baseFile->max_downloads - $baseFile->downloads }}
                        @endif
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Uploaded
                        </span>
                        <span class="font-semibold text-gray-900 dark:text-white">
                            {{ $baseFile->created_at->format('M d, Y') }}
                        </span>
                    </div>

                </div>

                <!-- Download button -->
                <x-button-primary 
                    href="/download/{{ $baseFile->token }}"
                    class="w-full py-3 text-base font-semibold rounded-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download file
                </x-button-primary>

                <!-- Back link -->
                <div class="mt-4 text-center">
                    <a href="{{ url('/') }}" 
                       class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to home
                    </a>
                </div>

            </x-card>

        </x-container>
    </x-section>

</x-app-layout>