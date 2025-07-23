<aside id="sidebar" class="
    fixed inset-y-0 left-0 z-50 w-64 bg-blue-800 text-white
    transform -translate-x-full sidebar-transition
    flex flex-col
    shadow-lg
    custom-scrollbar
">
    <!-- Sidebar Header/Logo -->
    <div id="sidebar-logo-container" class="flex items-center justify-center h-20 bg-blue-900 border-b border-blue-700 logo-transition opacity-0 pointer-events-none">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" alt="EduVerse Logo" class="h-10 w-auto">
        </a>
    </div>

    <!-- Sidebar Navigation Links -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <a href="{{ route('dashboard') }}" class="
            flex items-center px-4 py-2 rounded-lg text-gray-200 hover:bg-blue-700 hover:text-white
            transition duration-200 ease-in-out
            {{ request()->routeIs('dashboard') ? 'bg-blue-700 text-white' : '' }}
        ">
            <!-- Icon Dashboard (example: SVG or Font Awesome if installed) -->
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Dashboard
        </a>
        <a href="{{ route('courses.index') }}" class="
            flex items-center px-4 py-2 rounded-lg text-gray-200 hover:bg-blue-700 hover:text-white
            transition duration-200 ease-in-out
            {{ request()->routeIs('courses.*') ? 'bg-blue-700 text-white' : '' }}
        ">
            <!-- Icon Kursus -->
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            Daftar Kursus
        </a>
        <a href="{{ route('profile.edit') }}" class="
            flex items-center px-4 py-2 rounded-lg text-gray-200 hover:bg-blue-700 hover:text-white
            transition duration-200 ease-in-out
            {{ request()->routeIs('profile.edit') ? 'bg-blue-700 text-white' : '' }}
        ">
            <!-- Icon Profil -->
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            Profil
        </a>
        {{-- Tambahkan tautan lain di sini jika diperlukan --}}

        <!-- Logout Form -->
        <form method="POST" action="{{ route('logout') }}" class="block">
            @csrf
            <button type="submit" class="
                w-full flex items-center px-4 py-2 rounded-lg text-gray-200 hover:bg-blue-700 hover:text-white
                transition duration-200 ease-in-out text-left
            ">
                <!-- Icon Logout -->
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
            </button>
        </form>
    </nav>
</aside>
