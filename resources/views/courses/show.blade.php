<x-app-layout>
</style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="flex flex-col md:flex-row gap-6 min-h-screen animate-fade-in-up">

            {{-- Kolom Kiri: Pemutar Video dan Progress --}}
            <div class="w-full md:w-2/3">
                <div class="bg-black rounded-lg shadow-lg overflow-hidden relative pb-[56.25%] h-0">
                    <div id="player" class="absolute top-0 left-0 w-full h-full"></div>
                </div>

                <div class="mt-4 p-4 bg-white rounded shadow">
                    <h3 class="font-bold text-lg mb-2">Sedang Memutar: <span id="video-title">Pilih video dari daftar</span></h3>
                    <strong>Progress:</strong>
                    <div class="mt-1 bg-gray-200 rounded-full">
                        <div id="videoProgress" style="width: 0%;" class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full">0%</div>
                    </div>
                </div>
            </div>



            {{-- Kolom Kanan: Daftar Sesi, Video, dan Tombol Ujian --}}
            <div class="w-full md:w-1/3 bg-white p-4 rounded-lg shadow-lg min-h-screen animate-fade-in-up">
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
                <p>
                    Progress: {{ $completedLessons->count() }} dari {{ $allLessons->count() }} pelajaran selesai.
                </p>
                <div id="quizSection" class="{{ $isExamUnlocked ? '' : 'hidden' }}">
                    <a href="{{ route('quizzes.show', $course->id) }}" class="btn btn-primary">
                        Mulai Kuis
                    </a>
                </div>
                <p id="warningText" class="text-warning {{ $isExamUnlocked ? 'hidden' : '' }}">
                    Selesaikan semua pelajaran terlebih dahulu untuk membuka kuis.
                </p>


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
        let videoDuration = 0;
        let currentLessonId = null;

        function onYouTubeIframeAPIReady() {
            console.log('YouTube API Ready');
            player = new YT.Player('player', {
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }
        function onPlayerReady(event) {
            videoDuration = player.getDuration();
            setInterval(updateProgressBar, 1000); 
        }

        function onPlayerStateChange(event) {
            const stateMap = {
                '-1': 'UNSTARTED',
                '0': 'ENDED',
                '1': 'PLAYING',
                '2': 'PAUSED',
                '3': 'BUFFERING',
                '5': 'CUED'
            };

            console.log('Player state changed:', stateMap[event.data], event.data);

            if (event.data == YT.PlayerState.ENDED) {
                console.log('Video ENDED. Calling markVideoAsComplete with lessonId:', currentLessonId);
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

        
                const checkDuration = setInterval(() => {
            const dur = player.getDuration();
            if (dur > 0) {
                videoDuration = dur;
                console.log("Duration loaded:", videoDuration);
                clearInterval(checkDuration);
            }
        }, 500);
            }
        }

        function updateProgressBar() {
            if (player && player.getPlayerState() === YT.PlayerState.PLAYING) {
                const currentTime = player.getCurrentTime();
                const percent = Math.floor((currentTime / videoDuration) * 100);
                console.log(`Updating progress bar: ${percent}%`);
                const bar = document.getElementById("videoProgress");
                bar.style.width = percent + "%";
                bar.textContent = percent + "%";
            } else {
                console.log("Skipping update: player not playing or videoDuration = 0");
            }
        }
        
        function markVideoAsComplete(lessonId, token) {
            fetch(`/api/lessons/${lessonId}/complete`, {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log("Response data:", data);

                if (data.message === 'Tes berhasil masuk controller') {
                    document.getElementById("quizSection").style.display = "block";
                    document.getElementById("warningText").style.display = "none";
                }
        })
        .catch(error => {
            console.error("Error:", error);
        });
    }
    </script>

</x-app-layout>