<header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200 shadow-sm z-40">
    <!-- Hamburger Button -->
    <button id="sidebar-toggle" class="p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
    </button>

    <!-- Top Nav Logo (visible when sidebar is hidden) -->
    <div id="top-nav-logo" class="flex-1 text-xl font-extrabold text-gray-900 tracking-wider logo-transition flex items-center cursor-pointer">
        <img src="{{ asset('images/logo.png') }}" alt="EduVerse Logo" class="h-8 w-auto">
    </div>

    <!-- Spacer / User Dropdown -->
    <div class="flex justify-end items-center">
        <!-- User Dropdown -->
        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <button @click="open = !open" class="
                flex items-center space-x-2 p-2 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500
                transition duration-150 ease-in-out
            ">
                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url ?? 'https://placehold.co/80x80/60A5FA/FFFFFF?text=AV' }}" alt="{{ Auth::user()->name }}" />
                <span class="text-gray-700 font-medium hidden sm:block">{{ Auth::user()->name }}</span>
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" x-transition:enter="dropdown-enter-active" x-transition:enter-start="dropdown-enter-from" x-transition:enter-end="dropdown-enter-to"
                 x-transition:leave="dropdown-leave-active" x-transition:leave-start="dropdown-leave-from" x-transition:leave-end="dropdown-leave-to"
                 class="
                    absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50
                    ring-1 ring-black ring-opacity-5 focus:outline-none
                "
                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">
                    Profil
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-2">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
