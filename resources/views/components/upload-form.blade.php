<div class="bg-white dark:bg-gray-900">
        <div class="max-w-2xl mx-auto px-4 py-12 text-center">

                <h1 class="mb-3 text-3xl font-bold text-gray-900 dark:text-white">
                    Send files instantly
                </h1>

                <p class="mb-6 text-gray-500 dark:text-gray-400">
                    Upload a file and get a secure shareable link. No signup required.
                </p>

                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 text-left">

                    <form action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <!-- File input -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Choose file
                            </label>

                            <input 
                                type="file"
                                name="file"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 
                                    dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600">
                        </div>

                        <!-- Expiry -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Link expires after
                            </label>

                            <select name="expires_in"
                                class="w-full p-2.5 text-sm border border-gray-300 rounded-lg bg-gray-50 
                                    dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                                <option value="1">1 day</option>
                                <option value="7" selected>7 days</option>
                                <option value="30">30 days</option>

                            </select>

                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                File will be automatically deleted after this period.
                            </p>
                        </div>

                        <!-- Submit -->
                        <button 
                            type="submit"
                            class="w-full text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 
                                font-medium rounded-lg text-sm px-5 py-2.5 
                                dark:bg-primary-600 dark:hover:bg-primary-700">
                            Upload & Get Link
                        </button>

                    </form>

                    {{-- Errors --}}
                    @if ($errors->any())
                        <div class="mt-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-700 dark:text-red-400">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    {{-- Success --}}
                    @if (session('success'))
                        <div class="mt-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-700 dark:text-green-400">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Download Link --}}
                    @if (session('link'))
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Share link
                            </label>

                            <div class="flex">
                                <input 
                                    id="share-link"
                                    type="text" 
                                    value="{{ session('link') }}"
                                    readonly
                                    class="flex-1 p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-l-lg
                                        dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                            <button 
                                onclick="
                                    navigator.clipboard.writeText(document.getElementById('share-link').value);
                                    const btn = this;
                                    const original = btn.innerText;
                                    btn.innerText = 'Copied!';
                                    btn.classList.add('bg-green-600');
                                    btn.classList.remove('bg-primary-700', 'bg-primary-800');

                                    setTimeout(() => {
                                        btn.innerText = original;
                                        btn.classList.remove('bg-green-600');
                                        btn.classList.add('bg-primary-700');
                                    }, 1500);
                                "
                                class="px-4 py-2.5 text-sm font-medium text-white bg-primary-700 rounded-r-lg
                                    hover:bg-primary-800 dark:bg-primary-600 dark:hover:bg-primary-700">
                                Copy
                            </button>
                            </div>
                        </div>
                    @endif

                    <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                        Files are automatically deleted after some time.
                    </p>

                </div>

        </div>
</div>