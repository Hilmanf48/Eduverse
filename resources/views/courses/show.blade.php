<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->title }}
        </h2>
    </x-slot>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="p-6">
        <div class="flex flex-col md:flex-row gap-6 min-h-screen animate-fade-in-up">
            
            {{-- Kolom Kiri: Video Player --}}
            <div class="w-full md:w-2/3">
                <div class="bg-black rounded-lg shadow-lg overflow-hidden relative pb-[56.25%] h-0">
                    <div id="player" class="absolute top-0 left-0 w-full h-full"></div>
                </div>

                <div class="mt-4 p-4 bg-white rounded shadow">
                    <h3 class="font-bold text-lg mb-2">
                        Sedang Memutar: <span id="video-title">Pilih video dari daftar</span>
                    </h3>

                    <strong>Progress:</strong>
                    <div class="mt-1 bg-gray-200 rounded-full">
                        <div id="videoProgress" style="width: 0%;" 
                             class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full">
                             0%
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Daftar Sesi dan Tombol Kuis --}}
            <div class="w-full md:w-1/3 bg-white p-4 rounded-lg shadow-lg min-h-screen animate-fade-in-up">
                @livewire('course-progress', ['course' => $course])
            </div>
        </div>
    </div>

    </div> {{-- Tutup container kanan --}}


<script src="https://www.youtube.com/iframe_api"></script>

<script>
    let player;
    let videoDuration = 0;
    let currentLessonId = null;
    let hasCompleted = false;


    window.playVideo = function(videoId, title, lessonId) {
        if (player && typeof player.loadVideoById === 'function') {
            player.loadVideoById(videoId);
            document.getElementById('video-title').innerText = title;
            currentLessonId = lessonId;
            hasCompleted = false;

            const checkDuration = setInterval(() => {
                const dur = player.getDuration();
                if (dur > 0) {
                    videoDuration = dur;
                    clearInterval(checkDuration);
                }
            }, 500);
        }
    };

    function onYouTubeIframeAPIReady() {
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
        if (event.data === YT.PlayerState.ENDED && !hasCompleted) {
            hasCompleted = true;
            markVideoAsComplete(currentLessonId);
            document.getElementById('videoProgress').style.width = '100%';
            document.getElementById('videoProgress').innerText = '100%';
        }
    }

    function updateProgressBar() {
        if (player && player.getPlayerState() === YT.PlayerState.PLAYING) {
            const currentTime = player.getCurrentTime();
            const percent = Math.floor((currentTime / videoDuration) * 100);
            const bar = document.getElementById("videoProgress");
            bar.style.width = percent + "%";
            bar.textContent = percent + "%";
        }
    }

    function markVideoAsComplete(lessonId) {
    fetch(`/lessons/${lessonId}/complete`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        credentials: 'include'
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => {
                console.error("❌ Backend Error Response:", text);
                throw new Error(`Response not ok: ${response.status}`);
            });
        }
        return response.json();
    })
    .then(data => {
        console.log("✅ Progress berhasil disimpan:", data);
        window.dispatchEvent(new CustomEvent('lessonCompleted'));
    })
    .catch(err => console.error("❌ Gagal menyimpan progress:", err));
}
</script>
</x-app-layout>