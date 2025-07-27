<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EduVerse') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom CSS untuk memastikan transisi sidebar berjalan mulus */
        .sidebar-transition {
            transition: transform 0.3s ease-in-out, width 0.3s ease-in-out;
        }

        .content-transition {
            transition: margin-left 0.3s ease-in-out;
        }

        /* Animasi untuk dropdown (opsional, Tailwind sudah cukup baik) */
        .dropdown-enter-active, .dropdown-leave-active {
            transition: all 0.2s ease-out;
        }
        .dropdown-enter-from, .dropdown-leave-to {
            opacity: 0;
            transform: translateY(-10px);
        }

        /* Custom scrollbar for sidebar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #1e3a8a; /* Darker blue for track */
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #60a5fa; /* Lighter blue for thumb */
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #93c5fd; /* Even lighter on hover */
        }

        /* Custom CSS for logo transition */
        .logo-transition {
            transition: opacity 0.3s ease-in-out;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
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
                    <img src="{{ asset('images/logo1.png') }}" alt="EduVerse Logo" class="h-13 w-auto">
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

        <!-- Main Content Area -->
        <div id="main-content" class="flex-1 flex flex-col content-transition">
            <!-- Top Navigation Bar -->
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200 shadow-sm z-40">
                <!-- Hamburger Button -->
                <button id="sidebar-toggle" class="p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <!-- Top Nav Logo (visible when sidebar is hidden) -->
                <div id="top-nav-logo" class="flex-1 text-xl font-extrabold text-gray-900 tracking-wider logo-transition flex items-center cursor-pointer">
                    <img src="{{ asset('images/logo.png') }}" alt="EduVerse Logo" class="h-12 w-auto">
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

            <!-- Page Heading (Existing Laravel Header Slot) -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- JavaScript for Sidebar Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const mainContent = document.getElementById('main-content');
            const sidebarLogoContainer = document.getElementById('sidebar-logo-container');
            const topNavLogo = document.getElementById('top-nav-logo');

            // State variable to track sidebar open/close status
            let isSidebarOpen = false;

            // Function to set sidebar and logo states based on desired visibility
            function setSidebarState(shouldBeVisible) {
                console.log('setSidebarState called. shouldBeVisible:', shouldBeVisible); // Debugging log
                isSidebarOpen = shouldBeVisible; // Update the state variable

                if (shouldBeVisible) { // Sidebar should be visible
                    sidebar.classList.remove('-translate-x-full'); // Show sidebar by removing translation
                    // Ensure sidebar is fully visible and interactive
                    sidebar.classList.remove('w-0', 'overflow-hidden'); // Remove any hiding width/overflow
                    sidebar.classList.add('w-64'); // Ensure it has its intended width

                    // Adjust main content margin for desktop
                    if (window.innerWidth >= 768) {
                        mainContent.classList.remove('md:ml-0');
                        mainContent.classList.add('md:ml-64');
                    } else { // Mobile overlay
                        // On mobile, main content doesn't shift, sidebar is an overlay
                        mainContent.classList.remove('md:ml-64', 'md:ml-0');
                        mainContent.classList.add('ml-0');
                    }

                    // Hide top nav logo, show sidebar logo (with fade)
                    topNavLogo.classList.add('opacity-0', 'pointer-events-none');
                    topNavLogo.classList.remove('opacity-100');
                    sidebarLogoContainer.classList.remove('opacity-0', 'pointer-events-none');
                    sidebarLogoContainer.classList.add('opacity-100');

                } else { // Sidebar should be hidden
                    sidebar.classList.add('-translate-x-full'); // Hide sidebar by translating it off-screen

                    // On desktop, we want to visually collapse its space
                    if (window.innerWidth >= 768) {
                         sidebar.classList.add('w-0', 'overflow-hidden'); // Collapse width and hide overflow
                         sidebar.classList.remove('w-64'); // Remove full width
                    } else {
                        // On mobile, sidebar is an overlay, so it maintains its full width (w-64)
                        sidebar.classList.remove('w-0', 'overflow-hidden'); // Remove desktop-specific hide classes
                        sidebar.classList.add('w-64'); // Ensure w-64 for mobile overlay
                    }


                    // Adjust main content margin for desktop
                    if (window.innerWidth >= 768) {
                        mainContent.classList.remove('md:ml-64');
                        mainContent.classList.add('md:ml-0');
                    } else { // Mobile overlay
                        mainContent.classList.remove('md:ml-64', 'md:ml-0'); // Ensure no desktop margins
                        mainContent.classList.add('ml-0'); // Mobile content doesn't shift
                    }

                    // Show top nav logo, hide sidebar logo (with fade)
                    topNavLogo.classList.remove('opacity-0', 'pointer-events-none');
                    topNavLogo.classList.add('opacity-100');
                    sidebarLogoContainer.classList.add('opacity-0', 'pointer-events-none');
                    sidebarLogoContainer.classList.remove('opacity-100');
                }
            }

            // Function to toggle sidebar visibility
            function toggleSidebar() {
                console.log('toggleSidebar called.'); // Debugging log
                console.log('Current isSidebarOpen:', isSidebarOpen); // Debugging log
                setSidebarState(!isSidebarOpen); // Toggle the state based on the variable
            }

            // Event listener for the hamburger button
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
                console.log('Sidebar toggle button listener added.'); // Debugging log
            } else {
                console.error('Sidebar toggle button (#sidebar-toggle) not found!'); // Debugging error
            }

            // Add event listener for the top navigation logo to toggle sidebar
            if (topNavLogo) {
                topNavLogo.addEventListener('click', toggleSidebar);
                console.log('Top Nav Logo listener added.'); // Debugging log
            } else {
                console.error('Top Nav Logo (#top-nav-logo) not found!'); // Debugging error
            }


            // Close sidebar when clicking outside on mobile (only if fixed overlay)
            document.addEventListener('click', function(event) {
                // Only apply this logic if it's a mobile view AND sidebar is currently visible
                if (window.innerWidth < 768 && isSidebarOpen) { // Use isSidebarOpen variable
                    if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target) && !topNavLogo.contains(event.target)) {
                        console.log('Clicked outside on mobile, hiding sidebar.'); // Debugging log
                        setSidebarState(false); // Hide sidebar
                    }
                }
            });

            // Handle initial state and resize
            function handleResize() {
                console.log('handleResize called. Window width:', window.innerWidth); // Debugging log
                // Always start with sidebar hidden and top nav logo visible
                setSidebarState(false); // This will set isSidebarOpen to false and handle initial visibility

                // Ensure main content has correct initial margin based on screen size
                if (window.innerWidth >= 768) { // Desktop
                    mainContent.classList.remove('ml-0', 'md:ml-64'); // Remove mobile and potential old desktop margin
                    mainContent.classList.add('md:ml-0'); // Default desktop margin when sidebar is hidden
                    console.log('Desktop: mainContent margin set to md:ml-0'); // Debugging log
                } else { // Mobile
                    mainContent.classList.remove('md:ml-0', 'md:ml-64'); // Remove desktop margins
                    mainContent.classList.add('ml-0'); // Default mobile margin
                    console.log('Mobile: mainContent margin set to ml-0'); // Debugging log
                }
            }

            // Initial call
            handleResize();
            // Add event listener for window resize
            window.addEventListener('resize', handleResize);
        });

        // Alpine.js (for dropdown, if you use it. If not, you can remove x-data and x-show)
        // Laravel Breeze/Jetstream biasanya sudah menyertakan Alpine.js.
    </script>
</body>
</html>
