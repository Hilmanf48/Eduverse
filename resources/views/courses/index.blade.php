<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kursus') }}
        </h2>
    </x-slot>

    {{-- Seluruh konten halaman Anda (tabel, tombol, dll) diletakkan di sini --}}
    <div class="p-6">
        <h1>Pilih Kursus yang Tersedia</h1>
        <div>
            @foreach($courses as $course)
                <div class="border p-4 mb-4">
                    <h2>{{ $course->title }}</h2>
                    <p>{{ $course->description }}</p>
                    <a href="{{ route('courses.show', $course->id) }}">Mulai Belajar</a>
                </div>
            @endforeach
        </div>
    </div>
    
</x-app-layout>