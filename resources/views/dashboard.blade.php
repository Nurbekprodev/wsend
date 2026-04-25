<x-app-layout>

    <section class="bg-white dark:bg-gray-900 py-10">
        <div class="max-w-6xl mx-auto px-4">

            <h1 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">
                Your files
            </h1>

            @if(session('success'))
                <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <div class="relative overflow-x-auto shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3">File</th>
                            <th class="px-6 py-3">Share</th>
                            <th class="px-6 py-3">Download</th>
                            <th class="px-6 py-3 text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($files as $file)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $file->original_name }}
                                </td>

                                <!-- Share -->
                                <td class="px-6 py-4">
                                    <button 
                                    onclick="
                                        navigator.clipboard.writeText('{{ url('/file/'.$file->token) }}');
                                        const btn = this;
                                        const original = btn.innerText;
                                        btn.innerText = 'Copied!';
                                        btn.classList.remove('bg-primary-700');
                                        btn.classList.add('bg-green-600');
                                        setTimeout(() => {
                                            btn.innerText = original;
                                            btn.classList.remove('bg-green-600');
                                            btn.classList.add('bg-primary-700');
                                        }, 1500);
                                    "
                                    class="inline-flex items-center text-white bg-primary-700 hover:bg-primary-800 
                                    focus:ring-4 focus:ring-primary-300 font-medium rounded-lg 
                                    text-xs px-3 py-2 dark:bg-primary-600 dark:hover:bg-primary-700">
                                    Copy link
                                    </button>
                                </td>

                                <!-- Download -->
                                <td class="px-6 py-4">
                                    <a href="/file/{{ $file->token }}"
                                    class="inline-flex items-center text-white bg-gray-700 hover:bg-gray-800 
                                    focus:ring-4 focus:ring-gray-300 font-medium rounded-lg 
                                    text-xs px-3 py-2 dark:bg-gray-600 dark:hover:bg-gray-700">
                                    Download
                                    </a>                    
                                </td>

                                <!-- Delete -->
                                <td class="px-6 py-4 text-right">
                                    <form action="/file/{{ $file->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                <button 
                                onclick="return confirm('Delete this file?')"
                                class="font-medium text-red-600 hover:underline dark:text-red-500">
                                    Delete
                                </button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    No files uploaded yet
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $files->links() }}
            </div>

        </div>
    </section>

</x-app-layout>
