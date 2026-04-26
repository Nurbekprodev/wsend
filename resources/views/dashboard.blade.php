<x-app-layout>

<section class="bg-white dark:bg-gray-900 py-10">
    <div class="max-w-6xl mx-auto px-4">

        <!-- Title -->
        <h1 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">
            Your files
        </h1>

        <!-- Search + Filters -->
        <form method="GET" class="mb-6">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">

                <!-- Search -->
                <div class="md:col-span-2 relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search your files..."
                        class="block w-full p-3 pl-10 text-sm border rounded-lg bg-gray-50 border-gray-300
                        dark:bg-gray-800 dark:border-gray-600 dark:text-white"
                    >
                </div>

                <!-- Type -->
                <select name="type"
                    class="p-3 text-sm border rounded-lg bg-gray-50 border-gray-300
                    dark:bg-gray-800 dark:border-gray-600 dark:text-white">

                    <option value="">All files</option>
                    <option value="image" {{ request('type')=='image'?'selected':'' }}>Images</option>
                    <option value="pdf" {{ request('type')=='pdf'?'selected':'' }}>Documents</option>
                    <option value="video" {{ request('type')=='video'?'selected':'' }}>Videos</option>
                    <option value="archive" {{ request('type')=='archive'?'selected':'' }}>Archives</option>

                </select>

                <!-- Sort -->
                <select name="sort"
                    class="p-3 text-sm border rounded-lg bg-gray-50 border-gray-300
                    dark:bg-gray-800 dark:border-gray-600 dark:text-white">

                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                    <option value="largest">Largest</option>
                    <option value="smallest">Smallest</option>

                </select>

            </div>

            <!-- Buttons -->
            <div class="flex gap-2 mt-3">

                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800">
                    Apply
                </button>

                <a href="{{ url()->current() }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100
                    dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    Reset
                </a>

            </div>

        </form>

        <!-- Success -->
        @if(session('success'))
            <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="relative overflow-x-auto shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                <!-- Header -->
                <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">File</th>
                        <th class="px-6 py-3">Size</th>
                        <th class="px-6 py-3">Created</th>
                        <th class="px-6 py-3">Expires</th>
                        <th class="px-6 py-3">Downloads</th>
                        <th class="px-6 py-3">Share</th>
                        <th class="px-6 py-3">Download</th>
                        <th class="px-6 py-3 text-right">Action</th>
                    </tr>
                </thead>

                <!-- Body -->
                <tbody>

                @forelse($files as $file)
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                        <!-- File -->
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white max-w-[220px] truncate">
                            📄 {{ $file->original_name }}
                        </td>

                        <!-- Size -->
                        <td class="px-6 py-4">
                            {{ number_format($file->file_size / 1024 / 1024, 2) }} MB
                        </td>

                        <!-- Created -->
                        <td class="px-6 py-4">
                            {{ $file->created_at->format('d M Y') }}
                        </td>

                        <!-- Expires -->
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                            {{ $file->expires_at ? $file->expires_at->format('d M Y') : 'Never' }}
                        </td>

                        <!-- download counter -->
                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                            {{ $file->downloads ?? 0 }}
                        </td>

                        <!-- Share -->
                        <td class="px-6 py-4">
                            <button
                                onclick="
                                    navigator.clipboard.writeText('{{ url('/file/'.$file->token) }}');
                                    const btn = this;
                                    btn.innerText = 'Copied!';
                                    setTimeout(() => btn.innerText = 'Copy', 1500);
                                "
                                class="text-white bg-primary-700 hover:bg-primary-800 px-3 py-2 rounded-lg text-xs">
                                Copy
                            </button>
                        </td>

                        <!-- Download -->
                        <td class="px-6 py-4">
                            <a href="/file/{{ $file->token }}"
                               class="text-white bg-gray-700 hover:bg-gray-800 px-3 py-2 rounded-lg text-xs">
                                Download
                            </a>
                        </td>

                        <!-- Delete -->
                        <td class="px-6 py-4 text-right">
                            <form action="/file/{{ $file->id }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Delete this file?')"
                                    class="text-red-600 hover:underline">
                                    Delete
                                </button>
                            </form>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="px-6 py-14 text-center">
                            <div class="text-gray-500 dark:text-gray-400">
                                No files uploaded yet
                            </div>

                            <a href="{{ url('/upload') }}"
                               class="mt-3 inline-block text-primary-600 hover:underline text-sm">
                                Upload your first file
                            </a>
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $files->links() }}
        </div>

    </div>
</section>

</x-app-layout>