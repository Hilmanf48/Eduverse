<nav x-data="{ open: false }" class="bg-white shadow-md py-4 px-4 md:px-8 sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ url('/') }}" class="flex items-center space-x-2">
            <img src="{{ asset('images/logo-eduverse.png') }}" alt="Eduverse logo" class="h-8 md:h-10">
            <span class="text-gray-800 text-xl md:text-2xl font-bold">Eduverse</span>
        </a>

        <button @click="open = !open" class="text-gray-600 md:hidden focus:outline-none">
            <span x-show="!open" class="text-3xl">&#9776;</span>
            <span x-show="open" class="text-3xl">&#x2715;</span>
        </button>

        <div class="hidden md:flex items-center space-x-6">
            <a href="{{ url('/') }}" class="text-gray-600 hover:text-blue-600 transition duration-300">Home</a>
            <a href="{{ route('courses.index') }}" class="text-gray-600 hover:text-blue-600 transition duration-300">Kelas</a>
            
            @auth
                {{-- Jika user sudah login --}}
                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 transition duration-300">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition duration-300">
                        Logout
                    </a>
                </form>
            @else
                {{-- Jika user belum login --}}
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition duration-300">Login</a>
            @endauth
        </div>
    </div>
    
    {{-- Navigasi Mobile --}}
    <div x-show="open" x-transition ... class="md:hidden ...">
        {{-- ... Isi navigasi mobile Anda ... --}}
    </div>
</nav>