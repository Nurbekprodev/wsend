<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100 dark:bg-gray-900/80 dark:border-gray-800">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 sm:py-3">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center gap-2 hover:opacity-90 transition">
            <img src="{{ asset('images/logo_img.png') }}" class="h-10 sm:h-16 w-auto">
        </a>

        <!-- Right side -->
        <div class="flex items-center gap-2 lg:order-2">

            <!-- Dark mode -->
            <button 
                @click="
                    document.documentElement.classList.toggle('dark');
                    localStorage.theme =
                        document.documentElement.classList.contains('dark')
                        ? 'dark'
                        : 'light';
                "
                class="p-2.5 text-gray-500 rounded-xl hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 transition">
                
                <!-- Sun -->
                <svg class="w-5 h-5 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>

                <!-- Moon -->
                <svg class="w-5 h-5 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                </svg>
            </button>

            @auth
                <!-- User dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 font-medium rounded-xl text-sm px-4 py-2.5 transition">
                            
                            <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center">
                                <span class="text-sm font-semibold text-blue-600 dark:text-blue-400">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                            </div>

                            {{ Str::limit(auth()->user()->name, 6) }}

                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @endauth

            <!-- Mobile toggle -->
            <button @click="open = !open" type="button"
                class="inline-flex items-center justify-center p-2.5 text-gray-500 rounded-xl lg:hidden hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 transition">
                
                <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                <svg x-show="open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Menu -->
        <div :class="{ 'hidden': !open }"
             class="hidden w-full lg:flex lg:w-auto lg:order-1">

            <ul class="flex flex-col mt-4 gap-1 lg:flex-row lg:gap-1 lg:mt-0">

                <!-- Home -->
                <li>
                    <a href="{{ url('/') }}"
                       class="block px-4 py-2.5 rounded-xl text-sm font-medium transition
                       {{ request()->is('/') 
                           ? 'text-blue-600 bg-blue-50 dark:text-blue-400 dark:bg-blue-900/20' 
                           : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-800' }}">
                        Home
                    </a>
                </li>

                @auth
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="block px-4 py-2.5 rounded-xl text-sm font-medium transition
                       {{ request()->routeIs('dashboard') 
                           ? 'text-blue-600 bg-blue-50 dark:text-blue-400 dark:bg-blue-900/20' 
                           : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-800' }}">
                        Dashboard
                    </a>
                </li>
                @endauth

                <!-- Guest buttons (mobile only) -->
                @guest
                <li class="mt-2 flex flex-col gap-2 lg:hidden">

                    <a href="{{ route('login') }}"
                       class="block text-center px-4 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="block text-center px-4 py-2.5 rounded-xl text-sm font-semibold bg-blue-600 text-white hover:bg-blue-700 transition">
                        Start sharing
                    </a>

                </li>
                @endguest

            </ul>
        </div>

        <!-- Desktop guest buttons -->
        @guest
        <div class="hidden lg:flex items-center gap-2">
            <x-button-secondary href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium rounded-xl">
                Login
            </x-button-secondary>

            <x-button-primary href="{{ route('register') }}" class="px-4 py-2 text-sm font-semibold rounded-xl">
                Start sharing
            </x-button-primary>
        </div>
        @endguest

    </div>
</nav>