<div class="bg-white dark:bg-gray-900">
        <div class="max-w-2xl mx-auto px-4 py-12 text-center">

                <h1 class="mb-3 text-3xl font-bold text-gray-900 dark:text-white">
                    Send files instantly
                </h1>

                <p class="mb-6 text-gray-500 dark:text-gray-400">
                    Upload a file and get a secure shareable link. No signup required.
                </p>

                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 text-left">

                <form id="uploadForm"
                    action="{{ url('/upload') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-4">

                    @csrf

                    <!-- File Drop Zone -->
                    <div id="dropZone"
                        class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center cursor-pointer hover:border-primary-500 transition">

                        <input type="file" name="file" id="fileInput" class="hidden">

                        <div class="text-gray-600 dark:text-gray-300">
                            <p class="text-sm font-medium">Drag & drop your file here</p>
                            <p class="text-xs mt-1">or click to browse</p>
                        </div>

                        <p id="fileName" class="mt-3 text-sm text-primary-600"></p>
                    </div>

                    <!-- Progress Bar (hidden initially) -->
                    <div id="progressContainer"
                        class="w-full bg-gray-200 dark:bg-gray-700 rounded overflow-hidden hidden">

                        <div id="progressBar"
                            class="bg-green-500 text-xs text-white text-center py-1"
                            style="width:0%">
                            0%
                        </div>
                    </div>

                    <!-- Status -->
                    <div id="status" class="text-sm"></div>

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
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Password (optional)
                        </label>

                        <input type="password"
                            name="password"
                            placeholder="Set a password"
                            class="w-full p-2.5 text-sm border border-gray-300 rounded-lg bg-gray-50 
                                focus:ring-primary-500 focus:border-primary-500
                                dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        id="uploadBtn"
                        class="w-full text-white bg-primary-700 hover:bg-primary-800 
                            font-medium rounded-lg text-sm px-5 py-2.5">
                        Upload & Get Link
                    </button>

                    <!-- Status / Result -->
                    <div id="status" class="text-sm"></div>

                    <!-- Result Box (hidden by default) -->
<div id="resultBox" class="hidden mt-4 p-4 border rounded-lg bg-gray-50 dark:bg-gray-800">
    
    <p class="text-green-600 font-medium">Upload complete</p>

    <div class="flex gap-2 mt-3">
        <input id="fileLink"
               class="w-full p-2 border rounded text-sm bg-white dark:bg-gray-700"
               readonly>

        <button id="copyBtn"
                type="button"
                class="px-3 py-2 bg-gray-900 text-white rounded text-sm">
            Copy
        </button>
    </div>
</div>
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