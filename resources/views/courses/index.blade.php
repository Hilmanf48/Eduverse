<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kursus Tersedia') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-10 text-center animate-fade-in-down">
                Pilih Kursus Terbaik untuk Anda
            </h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($courses as $course)
                    {{-- Card Kursus --}}
                    <a href="{{ route('courses.show', $course->id) }}" class="block">
                        <div class="
                            bg-white rounded-xl shadow-lg overflow-hidden
                            transform transition-all duration-300 ease-in-out
                            hover:scale-105 hover:shadow-xl hover:ring-4 hover:ring-blue-200
                            group
                        ">
                            {{-- Thumbnail Kursus --}}
                            <div class="relative h-48 overflow-hidden">
                                <img
                                    src="{{ $course->image_path ?? 'https://placehold.co/600x400/E0F2F7/007BFF?text=EduVerse+Course' }}"
                                    alt="{{ $course->title }}"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                                    onerror="this.onerror=null;this.src='https://placehold.co/600x400/E0F2F7/007BFF?text=EduVerse+Course';"
                                >
                                {{-- Kategori Kursus --}}
                                @if($course->category)
                                    <span class="
                                        absolute top-3 left-3 bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full
                                        shadow-md
                                    ">
                                        {{ $course->category->name }}
                                    </span>
                                @endif
                            </div>

                            <div class="p-6">
                                {{-- Judul Kursus --}}
                                <h2 class="
                                    text-2xl font-bold text-gray-900 mb-2
                                    group-hover:text-blue-700 transition-colors duration-200
                                ">
                                    {{ $course->title }}
                                </h2>

                                {{-- Deskripsi Kursus --}}
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ Str::limit($course->description, 120) }}
                                </p>

                                {{-- Tombol Mulai Belajar --}}
                                <button class="
                                    w-full bg-blue-500 text-white font-semibold py-3 px-4 rounded-lg
                                    hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75
                                    transition duration-200 ease-in-out transform hover:-translate-y-0.5
                                    shadow-md hover:shadow-lg
                                ">
                                    Mulai Belajar
                                </button>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-10">
                        <p class="text-gray-500 text-lg">Belum ada kursus yang tersedia saat ini.</p>
                        <p class="text-gray-400 text-sm mt-2">Silakan cek kembali nanti atau hubungi administrator.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>


</x-app-layout>

<style>
    /* Custom animations for the page */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-down {
        animation: fadeInDown 0.8s ease-out forwards;
    }

    /* Ensure line-clamp works for description */
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>