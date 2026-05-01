<x-card class="p-8 md:p-10 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">

                <form id="uploadForm" action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- UPLOAD BLOCK -->
                    <div id="uploadBox">
                        <div id="dropZone"
                            class="border-2 border-dashed border-gray-300 dark:border-gray-600
                                rounded-2xl p-10 text-center cursor-pointer
                                hover:border-blue-500 hover:bg-blue-50/50 dark:hover:bg-blue-900/10
                                bg-gray-50 dark:bg-gray-700/30
                                transition-all duration-200">

                            <x-input 
                                type="file" 
                                name="files[]" 
                                multiple 
                                id="fileInput" 
                                class="hidden" 
                            />

                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 mb-4 rounded-full bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                </div>
                                <p class="text-base font-semibold text-gray-700 dark:text-gray-200">
                                    Drag & drop your files here
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    or click to browse
                                </p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-3">
                                    Supports all file types up to 10MB
                                </p>
                            </div>

                            <div id="fileList" class="mt-4 text-sm text-blue-600 dark:text-blue-400 space-y-1"></div>

                        </div>

                        <button type="button"
                            id="addMoreBtn"
                            class="mt-4 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add more files
                        </button>

                        <x-button-primary 
                            type="button" 
                            id="nextBtn"
                            class="mt-6 w-full py-3 text-base font-semibold rounded-xl">
                            Continue
                        </x-button-primary>
<p id="status" class="mt-3 text-sm text-red-500"></p>
                    </div>


                    <!-- SETTINGS BLOCK -->
                    <div id="settingsBox" class="hidden">

                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                            Transfer settings
                        </h3>

                        <div class="space-y-5">

                            <div>
                                <x-label class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Link expires after</x-label>
                                <select name="expires_in"
                                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl bg-gray-50 
                                           focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                           dark:bg-gray-700 dark:border-gray-600 dark:text-white transition">
                                    <option value="1">1 day</option>
                                    <option value="3" selected>3 days</option>
                                    <option value="7">7 days</option>
                                </select>
                            </div>

                            <div>
                                <x-label class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password (optional)</x-label>
                                <x-input 
                                    type="password"
                                    name="password"
                                    placeholder="Set a password"
                                    class="w-full px-4 py-3 rounded-xl"
                                />
                            </div>

                            <div>
                                <x-label class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Max downloads (optional)</x-label>
                                <x-input 
                                    type="number"
                                    name="max_downloads"
                                    placeholder="e.g. 10"
                                    min="1"
                                    class="w-full px-4 py-3 rounded-xl"
                                />
                            </div>

                        </div>

                        <div id="progressContainer" class="hidden mt-6 w-full bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden h-3">
                            <div id="progressBar" class="bg-blue-600 h-3 text-xs text-white text-center transition-all duration-300" style="width:0%"></div>
                        </div>

                        <div id="status" class="mt-3 text-sm text-red-500"></div>

                        <div class="mt-6 flex flex-col gap-3">
                            <x-button-primary 
                                type="submit"
                                id="uploadBtn"
                                class="w-full py-3 text-base font-semibold rounded-xl">
                                Upload & Get Link
                            </x-button-primary>

                            <x-button-secondary 
                                type="button"
                                id="backBtn"
                                class="w-full py-3 text-base font-medium rounded-xl">
                                Back 
                            </x-button-secondary>
                        </div>

                    </div>

                    <!-- RESULT BLOCK -->
                    <div id="resultBox" class="hidden">

                        <!-- Success -->
                        <div class="text-center mb-6">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                                <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>

                            <p class="text-xl font-semibold text-green-600 dark:text-green-400">
                                Upload complete
                            </p>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Your files are ready to share
                            </p>
                        </div>

                        <!-- Link -->
                        <div class="flex gap-2">
                            <x-input 
                                id="fileLink"
                                type="text"
                                readonly
                                class="flex-1 px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700"
                            />
                            <x-button-primary
                                id="copyBtn"
                                type="button"
                                class="px-6 py-3 rounded-xl font-semibold">
                                Copy
                            </x-button-primary>
                        </div>

                        <!-- CTA (Guest only) -->
                        @guest
                        <div class="mt-6 p-5 rounded-xl border border-blue-100 dark:border-blue-800 bg-blue-50/60 dark:bg-blue-900/20 text-center">

                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                Want to track downloads and manage your files?
                            </p>

                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                Create a free account — takes less than 10 seconds
                            </p>

                            <div class="mt-4 flex flex-col gap-2">
                                <a href="/register"
                                class="w-full px-6 py-3 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition">
                                    Track files — Sign up free
                                </a>

                                <a href="/login"
                                class="text-sm text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                                    Already have an account? Log in
                                </a>
                            </div>

                        </div>
                        @endguest

                        <!-- CTA (Logged in) -->
                        @auth
                        <div class="mt-6 text-center">
                            <a href="/dashboard"
                            class="inline-block w-full px-6 py-3 text-sm font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700 transition">
                                View in dashboard
                            </a>
                        </div>
                        @endauth

                        <!-- New transfer -->
                        <div class="mt-6 text-center">
                            <button 
                                id="newTransferBtn"
                                type="button"
                                class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400 transition">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Upload another file
                            </button>
                        </div>

                    </div>

                </form>

</x-card>