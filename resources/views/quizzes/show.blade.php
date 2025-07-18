<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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
                        @foreach ($question->answers as $answer)
                            <label for="answer-{{ $answer->id }}" class="flex items-center p-3 border rounded hover:bg-gray-50 cursor-pointer">
                                <input type="radio" 
                                       id="answer-{{ $answer->id }}" 
                                       name="answers[{{ $question->id }}]" 
                                       value="{{ $answer->id }}" 
                                       class="mr-3" 
                                       required>
                                <span>{{ $answer->answer_text }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="mt-6">
                <button type="submit" class="w-full text-center block bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded">
                    Kirim Jawaban
                </button>
            </div>
        </form>
    </div>
</x-app-layout>