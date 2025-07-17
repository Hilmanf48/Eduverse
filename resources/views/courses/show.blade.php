<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="flex flex-col md:flex-row gap-6">

            {{-- Kolom Kiri: Pemutar Video dan Progress --}}
            <div class="w-full md:w-2/3">
                <div class="bg-black rounded-lg shadow-lg overflow-hidden aspect-video">
                    <div id="player"></div>
                </div>
                <div class="mt-4 p-4 bg-white rounded shadow">
                    <h3 class="font-bold text-lg mb-2">Sedang Memutar: <span id="video-title">Pilih video dari daftar</span></h3>
                    <strong>Progress:</strong>
                    <div class="mt-1 bg-gray-200 rounded-full">
                        <div id="progress-bar" style="width: 0%;" class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full">0%</div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Daftar Sesi, Video, dan Tombol Ujian --}}
            <div class="w-full md:w-1/3 bg-white p-4 rounded-lg shadow-lg">
                <h3 class="text-lg font-bold mb-4">Materi Belajar</h3>
                
                <div class="space-y-4">
                    @forelse($course->sessions as $session)
                        <div class="border rounded">
                            <h4 class="p-3 font-semibold bg-gray-50 border-b">{{ $session->title }}</h4>
                            <ul class="list-none p-0 m-0">
                                @forelse($session->lessons as $lesson)
                                    <li id="lesson-{{ $lesson->id }}" onclick="playVideo('{{ $lesson->youtube_video_id }}', '{{ $lesson->title }}', '{{ $lesson->id }}')" class="flex items-center p-3 cursor-pointer hover:bg-gray-100 border-b last:border-b-0">
                                        @if($completedLessons->contains($lesson->id))
                                            <span class="text-green-500 mr-3">✅</span>
                                        @else
                                            <span class="text-gray-400 mr-3">⚪️</span>
                                        @endif
                                        <span class="flex-1">{{ $lesson->title }}</span>
                                    </li>
                                @empty
                                    <li class="p-3 text-gray-500">Belum ada video di sesi ini.</li>
                                @endforelse
                            </ul>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada sesi untuk kursus ini.</p>
                    @endforelse
                </div>

                {{-- Tombol Ujian Akhir --}}
                <div class="mt-6">
                    @if(isset($course->finalExam))
                        @if($isExamUnlocked)
                            <a href="{{ route('quizzes.show', $course->finalExam->id) }}" class="w-full text-center block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Mulai Ujian Akhir
                            </a>
                        @else
                            <button disabled class="w-full text-center block bg-gray-400 text-white font-bold py-2 px-4 rounded cursor-not-allowed" title="Selesaikan semua video untuk membuka ujian">
                                Ujian Terkunci
                            </button>
                        @endif
                    @else
                         <p class="text-center text-gray-500 text-sm">Ujian akhir untuk kursus ini belum tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        const API_TOKEN = "{{ $apiToken }}";
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        var player;
        let progressInterval;
        let currentLessonId = null;

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '100%',
                width: '100%',
                events: { 'onStateChange': onPlayerStateChange }
            });
        }
        
        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING) {
                progressInterval = setInterval(updateProgressBar, 1000);
            } else {
                clearInterval(progressInterval);
            }
            if (event.data == YT.PlayerState.ENDED) {
                markVideoAsComplete(currentLessonId);
                document.getElementById('progress-bar').style.width = '100%';
                document.getElementById('progress-bar').innerText = '100%';
            }
        }

        function playVideo(videoId, videoTitle, lessonId) {
            if(player && typeof player.loadVideoById === 'function') {
                player.loadVideoById(videoId);
                document.getElementById('video-title').innerText = videoTitle;
                currentLessonId = lessonId;
            }
        }

        function updateProgressBar() {
            if (player && typeof player.getCurrentTime == 'function' && player.getDuration() > 0) {
                const percentage = (player.getCurrentTime() / player.getDuration()) * 100;
                const progressBar = document.getElementById('progress-bar');
                progressBar.style.width = percentage + '%';
                progressBar.innerText = Math.round(percentage) + '%';
            }
        }
        
        function markVideoAsComplete(lessonId) {
            if (!lessonId) return;
            fetch(`/api/lessons/${lessonId}/complete`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + API_TOKEN
                },
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    const lessonElement = document.getElementById(`lesson-${lessonId}`);
                    if(lessonElement) {
                        lessonElement.querySelector('span:first-child').innerText = '✅';
                    }
                }
            });
        }
    </script>
</x-app-layout>