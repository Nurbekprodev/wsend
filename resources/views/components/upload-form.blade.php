    <div class="max-w-2xl mx-auto">
            <h1 class="mb-3 text-3xl font-bold text-gray-900 dark:text-white">
                Send files instantly
            </h1>
            <p class="mb-6 text-gray-500 dark:text-gray-400">
                Upload a file and get a secure shareable link. No signup required.
            </p>
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 text-left">
        
        <!-- upload form -->
        <form id="uploadForm"
            action="{{ url('/upload') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-4">
            @csrf

            <!-- File Drop Zone -->
            <div id="dropZone"
                class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center cursor-pointer hover:border-primary-500 transition">
                <x-input type="file" name="file" id="fileInput" class="hidden" 
                />
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
            <div id="status" class="text-sm text-red-500"></div>

            <!-- Expiry -->
            <div>
                <x-label >
                    Link expires after
                </x-label>
                <select name="expires_in"
                    class="w-full p-2.5 text-sm border border-gray-300 rounded-lg bg-gray-50 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="1">1 day</option>
                    <option value="3" selected>3 days</option>
                    <option value="7">7 days</option>
                </select>
            </div>

            <!-- Password -->
            <div>
                <x-label >
                    Password (optional)
                </x-label>
                <x-input 
                    type="password"
                    name="password"
                    placeholder="Set a password" 
                />
            </div>
            <div>
                <x-label >
                    Max downloads (optional)
                </x-label>
                <x-input type="number"
                    name="max_downloads"
                    placeholder="Set max downloads" 
                    min="1"
                />
            </div>

            <!-- Submit -->
            <x-button-primary type="submit"
                id="uploadBtn"
                class="w-full">
                Upload & Get Link
            </x-button-primary>


            <!-- Result Box (hidden by default) -->
            <div id="resultBox" class="hidden mt-4 p-4 border rounded-lg bg-gray-50 dark:bg-gray-800">
                
                <p class="text-green-600 font-medium">Upload complete</p>
                <div class="flex gap-2">
                    <x-input 
                        id="fileLink"
                        type="text"
                        readonly
                        class="flex-1"
                    />
                    <x-button-primary 
                        id="copyBtn"
                        type="button">
                        Copy
                    </x-button-primary>
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

        <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
            Files are automatically deleted after some time.
        </p>
    </div>

</div>