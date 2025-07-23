<nav x-data="{ open: false }" class="bg-white shadow-md py-4 px-4 md:px-8 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Eduverse logo" class="h-8 md:h-10">
                <span class="text-gray-800 text-xl md:text-2xl font-bold">Eduverse</span>
            </a>

            <button @click="open = !open" class="text-gray-600 md:hidden focus:outline-none">
                <span x-show="!open" class="text-3xl">&#9776;</span>
                <span x-show="open" class="text-3xl">&#x2715;</span>
            </button>

            <div class="hidden md:flex items-center space-x-6">
                <a href="#hero" class="text-gray-600 hover:text-blue-600 transition duration-300">Home</a>
                <a href="{{ route('courses.index') }}" class="text-gray-600 hover:text-blue-600 transition duration-300">Kelas</a>
                <a href="#story-success" class="text-gray-600 hover:text-blue-600 transition duration-300">Story Success</a>
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition duration-300">Login</a>
            </div>
        </div>

        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-3" x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-3"
             class="md:hidden bg-white mt-4 py-2 space-y-2 border-t border-gray-200">
            <a href="#hero" @click="open = false" class="block text-gray-600 px-4 py-2 hover:bg-gray-100">Home</a>
            <a href="#kelas-unggulan" @click="open = false" class="block text-gray-600 px-4 py-2 hover:bg-gray-100">Kelas</a>
            <a href="#story-success" @click="open = false" class="block text-gray-600 px-4 py-2 hover:bg-gray-100">Story Success</a>
            <a href="#" @click="open = false" class="block bg-blue-600 text-white px-5 py-2 mx-4 rounded-full text-center hover:bg-blue-700 mt-2">Login</a>
        </div>
    </nav>