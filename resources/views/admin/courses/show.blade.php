<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Konten: {{ $course->title }}
        </h2>
    </x-slot>

    <div class="p-6 text-gray-900">
        <a href="{{ route('admin.courses.index') }}" class="mb-4 inline-block text-blue-500 hover:underline"><< Kembali ke Daftar Kursus</a>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- FORM UNTUK MEMBUAT SESI BARU --}}
        <div class="mb-6 p-4 bg-white rounded shadow-md">
            <h3 class="text-lg font-bold mb-2">Tambah Sesi Baru</h3>
            <form action="{{ route('admin.sessions.store') }}" method="POST">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <div>
                    <label for="title" class="block font-medium text-sm text-gray-700">Judul Sesi:</label>
                    <input type="text" id="title" name="title" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                </div>
                <button type="submit" class="mt-3 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan Sesi</button>
            </form>
        </div>

        <hr class="my-6">

        {{-- DAFTAR SESI DAN VIDEO YANG SUDAH ADA --}}
        <h3 class="text-xl font-bold mb-4">Daftar Sesi dan Video</h3>
        @forelse($course->sessions as $session)
            <div class="mb-4 p-4 bg-white rounded shadow-md">
                <div class="flex justify-between items-center border-b pb-2 mb-2">
                    <h4 class="text-lg font-bold">{{ $session->title }}</h4>
                    <div>
                        <a href="#" class="text-blue-500 text-sm mr-2 hover:underline">Edit</a>
                        <form action="{{ route('admin.sessions.destroy', $session->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 text-sm hover:underline" onclick="return confirm('Yakin ingin menghapus sesi ini beserta semua videonya?')">Hapus</button>
                        </form>
                    </div>
                </div>

                {{-- FORM UNTUK MENAMBAH VIDEO KE SESI INI --}}
                <form action="{{ route('admin.lessons.store') }}" method="POST" class="mt-4 p-3 bg-gray-50 rounded">
                    @csrf
                    <input type="hidden" name="session_id" value="{{ $session->id }}">
                    <div class="flex flex-col sm:flex-row gap-2">
                        <input type="text" name="title" placeholder="Judul Video" class="flex-1 border-gray-300 rounded-md shadow-sm" required>
                        <input type="text" name="youtube_video_id" placeholder="ID Video YouTube" class="flex-1 border-gray-300 rounded-md shadow-sm" required>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Tambah Video</button>
                    </div>
                </form>

                {{-- DAFTAR VIDEO DI DALAM SESI INI --}}
                <ul class="mt-3 space-y-1">
                    @forelse ($session->lessons as $lesson)
                        <li class="flex justify-between items-center p-2 border-b last:border-b-0">
                            <span>- {{ $lesson->title }} (ID: {{ $lesson->youtube_video_id }})</span>
                            <form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 text-xs hover:underline">Hapus</button>
                            </form>
                        </li>
                    @empty
                        <li class="p-2 text-gray-500">Belum ada video di sesi ini.</li>
                    @endforelse
                </ul>
            </div>
        @empty
            <p class="p-4 bg-white rounded shadow-md text-gray-500">Belum ada sesi di kursus ini.</p>
        @endforelse

        <hr class="my-6 border-t-2">

        {{-- BAGIAN UNTUK MENGELOLA UJIAN AKHIR --}}
        <div class="mt-6 p-4 bg-white rounded shadow-md">
            <h3 class="text-xl font-bold mb-4">Ujian Akhir</h3>

            @if ($course->finalExam)
                {{-- Bagian jika ujian sudah ada --}}
                <p class="mb-4">Kuis: <strong>{{ $course->finalExam->title }}</strong></p>

                <form action="{{ route('admin.questions.store') }}" method="POST" class="p-4 border rounded-md bg-gray-50">
                    @csrf
                    <h4 class="font-semibold text-lg">Tambah Pertanyaan Baru</h4>
                    <input type="hidden" name="quiz_id" value="{{ $course->finalExam->id }}">
                    <div class="mt-2">
                        <label for="question_text" class="block font-medium text-sm text-gray-700">Teks Pertanyaan:</label>
                        <textarea name="question_text" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required></textarea>
                    </div>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Jawaban 1 (Benar)</label>
                            <input type="text" name="answers[0][text]" class="w-full mt-1 border-green-400 rounded-md shadow-sm" required>
                            <input type="hidden" name="answers[0][is_correct]" value="1">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Jawaban 2 (Salah)</label>
                            <input type="text" name="answers[1][text]" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            <input type="hidden" name="answers[1][is_correct]" value="0">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Jawaban 3 (Salah)</label>
                            <input type="text" name="answers[2][text]" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Jawaban 4 (Salah)</label>
                            <input type="text" name="answers[3][text]" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>
                    <button type="submit" class="mt-4 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Simpan Pertanyaan</button>
                </form>

                <div class="mt-6 border-t pt-4">
                    <h4 class="font-semibold mb-2 text-lg">Daftar Pertanyaan:</h4>
                    @if($course->finalExam->questions->isNotEmpty())
                        <ul class="list-decimal list-inside space-y-2">
                            @foreach ($course->finalExam->questions as $question)
                                <li class="flex justify-between items-center p-2 rounded hover:bg-gray-50">
                                    <span>{{ $question->question_text }}</span>
                                    <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 text-xs hover:underline">Hapus</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">Belum ada pertanyaan untuk ujian ini.</p>
                    @endif
                </div>

            @else
                {{-- Bagian jika ujian belum ada --}}
                <form action="{{ route('admin.quizzes.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <label for="quiz_title" class="block font-medium text-sm text-gray-700">Judul Ujian:</label>
                    <input type="text" id="quiz_title" name="title" value="Ujian Akhir: {{ $course->title }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                    <button type="submit" class="mt-3 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Buat Ujian Akhir</button>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>