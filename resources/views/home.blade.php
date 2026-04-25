<x-app-layout>

    <!-- Hero section -->
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Payments tool for software companies</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">From checkout to global sales tax compliance, companies around the world use Flowbite to simplify their payment stack.</p>
                <a href="#" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                    Get started
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
                <a href="#" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Speak to Sales
                </a> 
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/phone-mockup.png" alt="mockup">
            </div>                
        </div>
    </section>

    
    <!-- Upload box section -->
    <section class="bg-white dark:bg-gray-900">
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
                                onclick="navigator.clipboard.writeText(document.getElementById('share-link').value)"
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
    </section>

    <!-- Short description section -->
    <section class="bg-white dark:bg-gray-900 pb-10">
        <div class="max-w-5xl mx-auto px-4 py-12">

            <h2 class="mb-8 text-2xl font-bold text-center text-gray-900 dark:text-white">
                How it works
            </h2>

            <div class="grid md:grid-cols-3 gap-8">

                <!-- Step 1 -->
                <div class="text-center">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 
                                text-white bg-primary-700 rounded-full">
                        1
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                        Upload
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        Choose your file and upload it securely to our servers.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="text-center">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 
                                text-white bg-primary-700 rounded-full">
                        2
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                        Get Link
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        We generate a unique secure download link instantly.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="text-center">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 
                                text-white bg-primary-700 rounded-full">
                        3
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">
                        Share
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">
                        Send the link to anyone. They can download the file.
                    </p>
                </div>

            </div>

        </div>
    </section>
  
</x-app-layout>