<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST">
            @csrf

            @foreach ($quiz->questions as $index => $question)
                <div class="mb-6 p-4 bg-white rounded shadow">
                    <p class="font-semibold">{{ $index + 1 }}. {{ $question->question_text }}</p>

                    <div class="mt-4 space-y-2">
                        @forelse ($question->answers as $answer)
                            <label class="flex items-center p-3 border rounded hover:bg-gray-50 cursor-pointer">
                                <input type="radio"
                                       name="answers[{{ $question->id }}]"
                                       value="{{ $answer->id }}"
                                       class="mr-3"
                                       required>
                                <span>{{ $answer->text }}</span>
                            </label>
                        @empty
                            <p class="text-sm text-red-500">Tidak ada jawaban untuk pertanyaan ini.</p>
                        @endforelse
                    </div>
                </div>
            @endforeach
            <pre>
   
</pre>

            <div class="mt-6">
                <button type="submit"
                        class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded">
                    Kirim Jawaban
                </button>
            </div>
        </form>
    </div>
</x-app-layout>