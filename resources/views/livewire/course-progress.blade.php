<div>
    <h3 class="text-lg font-bold mb-4">Materi Belajar</h3>

    @forelse($course->sessions as $session)
        <details class="border rounded-lg mb-2">
            <summary class="cursor-pointer font-semibold bg-blue-50 px-4 py-3">
                {{ $session->title }}
            </summary>
            <ul class="list-none px-4 pb-3">
                @forelse($session->lessons as $lesson)
                    <li wire:key="lesson-{{ $lesson->id }}"
                        id="lesson-{{ $lesson->id }}"
                        onclick="playVideo('{{ $lesson->youtube_video_id }}', '{{ $lesson->title }}', '{{ $lesson->id }}')"
                        class="flex items-center py-2 cursor-pointer hover:text-blue-600">
                        
                        @if(in_array($lesson->id, $completedLessonIds))
                            <span class="text-green-500 mr-3">✅</span>
                        @else
                            <span class="text-gray-400 mr-3">⚪️</span>
                        @endif

                        <span class="flex-1">{{ $lesson->title }}</span>
                    </li>
                @empty
                    <li class="py-2 text-gray-500">Belum ada pelajaran.</li>
                @endforelse
            </ul>
        </details>
    @empty
        <p class="text-gray-500">Belum ada sesi yang tersedia untuk kursus ini.</p>
    @endforelse

   <p class="mt-4">
    Progress: {{ count($completedLessons) }} dari {{ $course->sessions->flatMap->lessons->count() }} pelajaran selesai.
</p>
   @if ($isExamUnlocked && $course->finalExam)
    <a href="{{ route('quizzes.show', $course->finalExam->id) }}"
   class="w-full block bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
    🎯 Mulai Kuis Final: {{ $course->finalExam->title }}
</a>
@elseif (!$isExamUnlocked)
    <p class="text-yellow-600 font-medium">⚠️ Selesaikan semua pelajaran untuk membuka kuis.</p>
@endif

</div>
