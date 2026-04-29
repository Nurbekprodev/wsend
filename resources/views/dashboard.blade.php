<x-app-layout>

    <x-section class="bg-gray-50 dark:bg-gray-900 py-10 min-h-screen">
        <x-container class="max-w-6xl">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Your files
                    </h1>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Manage and share your uploaded files
                    </p>
                </div>

                <x-button-primary href="{{ url('/upload') }}" class="px-5 py-2.5 rounded-xl">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Upload new
                </x-button-primary>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

                <div class="p-5 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $files->total() }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total files</p>
                        </div>
                    </div>
                </div>

                <div class="p-5 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $files->sum('downloads') ?? 0 }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Downloads</p>
                        </div>
                    </div>
                </div>

                <div class="p-5 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ number_format($files->sum('file_size') / 1024 / 1024, 1) }} MB
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Storage used</p>
                        </div>
                    </div>
                </div>

                <div class="p-5 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ $files->where('expires_at', '>', now())->count() }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Active links</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Search + Filters -->
            <form method="GET" class="mb-6">
                <x-card class="p-5 rounded-2xl border border-gray-100 dark:border-gray-700">

                    <div class="flex flex-col lg:flex-row lg:items-center gap-4">

                        <!-- Search -->
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search your files..."
                                class="w-full pl-11 pr-4 py-3 text-sm border border-gray-200 rounded-xl bg-gray-50
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                                       dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400">
                        </div>

                        <!-- Filters -->
                        <div class="flex flex-col sm:flex-row gap-3">

                            <select name="type"
                                class="px-4 py-3 text-sm border border-gray-200 rounded-xl bg-gray-50
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                                       dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">All files</option>
                                <option value="image" {{ request('type')=='image'?'selected':'' }}>Images</option>
                                <option value="pdf" {{ request('type')=='pdf'?'selected':'' }}>Documents</option>
                                <option value="video" {{ request('type')=='video'?'selected':'' }}>Videos</option>
                                <option value="archive" {{ request('type')=='archive'?'selected':'' }}>Archives</option>
                            </select>

                            <select name="sort"
                                class="px-4 py-3 text-sm border border-gray-200 rounded-xl bg-gray-50
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                                       dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="newest">Newest</option>
                                <option value="oldest">Oldest</option>
                                <option value="largest">Largest</option>
                                <option value="smallest">Smallest</option>
                            </select>

                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-2">
                            <x-button-primary type="submit" class="px-5 py-3 rounded-xl">
                                Apply
                            </x-button-primary>
                            <x-button-secondary href="{{ url()->current() }}" class="px-5 py-3 rounded-xl">
                                Reset
                            </x-button-secondary>
                        </div>

                    </div>

                </x-card>
            </form>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 p-4 flex items-center gap-3 text-sm text-green-700 rounded-xl bg-green-50 border border-green-200 dark:bg-green-900/20 dark:text-green-400 dark:border-green-800">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table -->
            <x-card class="rounded-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">

                        <thead class="text-xs font-medium text-gray-500 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-4">File</th>
                                <th class="px-6 py-4">Size</th>
                                <th class="px-6 py-4">Created</th>
                                <th class="px-6 py-4">Expires</th>
                                <th class="px-6 py-4">Downloads</th>
                                <th class="px-6 py-4">Share</th>
                                <th class="px-6 py-4">Download</th>
                                <th class="px-6 py-4 text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                        @forelse($files as $file)
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">

                                <!-- File -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <span class="font-medium text-gray-900 dark:text-white max-w-[180px] truncate">
                                            {{ $file->original_name }}
                                        </span>
                                    </div>
                                </td>

                                <!-- Size -->
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                    {{ number_format($file->file_size / 1024 / 1024, 2) }} MB
                                </td>

                                <!-- Created -->
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                    {{ $file->created_at->format('d M Y') }}
                                </td>

                                <!-- Expires -->
                                <td class="px-6 py-4">
                                    @if($file->expires_at)
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-lg
                                            {{ $file->expires_at->isPast() 
                                                ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' 
                                                : 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' }}">
                                            {{ $file->expires_at->format('d M Y') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-lg bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400">
                                            Never
                                        </span>
                                    @endif
                                </td>

                                <!-- Downloads -->
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1 text-gray-600 dark:text-gray-300">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                        {{ $file->downloads ?? 0 }}
                                    </span>
                                </td>

                                <!-- Share -->
                                <td class="px-6 py-4">
                                    <x-button-primary
                                        onclick="
                                            navigator.clipboard.writeText('{{ url('/file/'.$file->token) }}');
                                            const btn = this;
                                            btn.innerText = 'Copied!';
                                            setTimeout(() => btn.innerText = 'Copy', 1500);
                                        "
                                        class="px-3 py-2 text-xs rounded-lg"
                                        type="button">
                                        Copy
                                    </x-button-primary>
                                </td>

                                <!-- Download -->
                                <td class="px-6 py-4">
                                    <x-button-secondary href="/file/{{ $file->token }}" class="px-3 py-2 text-xs rounded-lg">
                                        Download
                                    </x-button-secondary>
                                </td>

                                <!-- Delete -->
                                <td class="px-6 py-4 text-right">
                                    <form action="/file/{{ $file->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Delete this file?')"
                                            class="inline-flex items-center gap-1 text-sm font-medium text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="px-6 py-16">
                                    <div class="flex flex-col items-center justify-center text-center">
                                        <div class="w-16 h-16 mb-4 rounded-2xl bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <p class="text-gray-900 dark:text-white font-medium">No files uploaded yet</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Get started by uploading your first file</p>
                                        <x-button-primary href="{{ url('/upload') }}" class="mt-4 px-5 py-2.5 rounded-xl">
                                            Upload file
                                        </x-button-primary>
                                    </div>
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>
                </div>

            </x-card>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $files->links() }}
            </div>

        </x-container>
    </x-section>

</x-app-layout>