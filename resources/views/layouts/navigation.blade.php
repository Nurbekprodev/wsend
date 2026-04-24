<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 py-4">

            <!-- Left -->
            <div class="flex items-center">
                <a href="{{ url('/') }}">
                    <x-application-logo class="h-9 w-auto text-gray-800" />
                </a>

                <div class="hidden sm:flex sm:ml-10 space-x-8">
                    <x-nav-link :href="url('/')" :active="request()->is('/')">
                        Home
                    </x-nav-link>
                    
                    @auth
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            Dashboard
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Right -->
            <div class="flex items-center">

                @guest
                    <div class="flex gap-4">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-white bg-teal-600 rounded-md">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-teal-600 bg-gray-100 rounded-md">
                            Register
                        </a>
                    </div>
                @endguest

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="px-3 py-2 text-sm text-gray-600">
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

                <!-- Mobile button -->
                <button @click="open = ! open" class="sm:hidden ml-2">
                    ☰
                </button>

            </div>
        </div>
    </div>

    <!-- Mobile -->
    <div x-show="open" class="sm:hidden px-4 pb-3 space-y-2">

        <a href="{{ url('/') }}">Home</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>

        @auth
            <a href="{{ route('profile.edit') }}">Profile</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endguest

    </div>

</nav>