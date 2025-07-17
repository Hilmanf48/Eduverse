<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hasil Ujian
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-12 text-gray-900 text-center">

                    <h3 class="text-2xl font-bold">Ujian Telah Selesai!</h3>
                    <p class="mt-2 text-gray-600">Berikut adalah hasil ujian Anda untuk kuis:</p>
                    <p class="font-semibold text-lg mt-1">{{ $attempt->quiz->title }}</p>

                    <div class="my-8">
                        <p class="text-lg">Skor Anda:</p>
                        <p class="text-7xl font-bold text-blue-600">{{ $attempt->score }}</p>
                    </div>

                    <div class="flex justify-center gap-4">
                        <a href="{{ route('courses.show', $attempt->quiz->course_id) }}" class="px-6 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Kembali ke Kursus
                        </a>
                        <a href="{{ route('dashboard') }}" class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                            Ke Dashboard
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>