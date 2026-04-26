<nav x-data="{ open: false }" class="  sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200 dark:bg-gray-800/80">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center hover:opacity-90 transition">
            <img 
                src="{{ asset('images/logo_img.png') }}" 
                alt="logo"
                class="h-16 w-auto">
        </a>
        <!-- Right side -->
        <div class="flex items-center lg:order-2">

        <!-- Dark mode button -->
            <button 
                @click="
                    document.documentElement.classList.toggle('dark');
                    localStorage.theme =
                        document.documentElement.classList.contains('dark')
                        ? 'dark'
                        : 'light';
                "
                class="p-2 text-gray-500 rounded-lg hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                🌙
            </button>

            @guest
                <a href="{{ route('login') }}"
                   class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 mr-2 dark:hover:bg-gray-700">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700">
                    Register
                </a>
            @endguest

            @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="text-gray-800 dark:text-white hover:bg-gray-50 font-medium rounded-lg text-sm px-4 py-2 dark:hover:bg-gray-700">
                            {{ auth()->user()->name }}
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

            <!-- mobile button -->
            <button @click="open = !open" type="button"
                class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700">
                ☰
            </button>
        </div>

        <!-- Menu -->
        <div :class="{ 'hidden': !open }"
             class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1">

            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">

                <li>
                    <a href="{{ url('/') }}"
                    class="block py-2 pr-4 pl-3 rounded lg:p-0
                    {{ request()->is('/') 
                        ? 'text-white bg-primary-700 lg:bg-transparent lg:text-primary-700 dark:text-white' 
                        : 'text-gray-700 hover:text-primary-700 dark:text-gray-400 lg:dark:hover:text-white' }}">
                    Home
                    </a>
                </li>

                <li>
                    <a href="{{ url('upload') }}"
                    class="block py-2 pr-4 pl-3 rounded lg:p-0
                    {{ request()->is('upload') 
                        ? 'text-white bg-primary-700 lg:bg-transparent lg:text-primary-700 dark:text-white' 
                        : 'text-gray-700 hover:text-primary-700 dark:text-gray-400 lg:dark:hover:text-white' }}">
                    Upload
                    </a>
                </li>

                @auth
                <li>
                    <a href="{{ route('dashboard') }}"
                    class="block py-2 pr-4 pl-3 rounded lg:p-0
                    {{ request()->routeIs('dashboard') 
                        ? 'text-white bg-primary-700 lg:bg-transparent lg:text-primary-700 dark:text-white' 
                        : 'text-gray-700 hover:text-primary-700 dark:text-gray-400 lg:dark:hover:text-white' }}">
                    Dashboard
                    </a>
                </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>