<h1>{{ $course->title }}</h1>
<p>{{ $course->description }}</p>

<hr>

<div style="display: flex;">
    {{-- Bagian Pemutar Video Utama --}}
    <div style="flex: 3; margin-right: 20px;">
        <h3>Sedang Memutar: <span id="video-title">{{ $course->lessons->first()->title ?? 'Pilih video' }}</span></h3>
        @if($course->lessons->isNotEmpty())
            <div id="player"></div>
        @else
            <p>Belum ada video di kursus ini.</p>
        @endif
    </div>

    <div style="margin-top: 10px;">
        <strong>Progress:</strong>
        <div style="background-color: #e0e0e0; border-radius: 5px; padding: 3px;">
            <div id="progress-bar" style="width: 0%; height: 20px; background-color: #4CAF50; border-radius: 5px; text-align: center; color: white; line-height: 20px;">
                0%
            </div>
        </div>
    </div>

    {{-- Bagian Daftar Putar (Playlist) --}}
    <div style="flex: 1;">
        <h3>Daftar Video</h3>
        <ul style="list-style: none; padding: 0;">
            @foreach($course->lessons as $lesson)
                <li id="lesson-{{ $lesson->id }}" style="padding: 10px; border-bottom: 1px solid #eee; cursor:pointer;"
                    onclick="playVideo('{{ $lesson->youtube_video_id }}', '{{ $lesson->title }}', '{{ $lesson->id }}')">
                    {{ $loop->iteration }}. {{ $lesson->title }}
                </li>
            @endforeach
        </ul>
    
    </div>
</div>

<script>
    const API_TOKEN = "{{ $apiToken }}";
    // 1. Memuat script YouTube IFrame Player API secara asynchronous.
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // 2. Mendeklarasikan variabel player yang akan digunakan untuk mengontrol video.
    var player;
    // Ambil ID video pertama dari daftar putar
    const firstVideoId = '{{ $course->lessons->first()->youtube_video_id ?? '' }}';
    var player;
    let progressInterval;

    function onYouTubeIframeAPIReady() {
        if (firstVideoId) {
            player = new YT.Player('player', {
                height: '400',
                width: '100%',
                videoId: firstVideoId,
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }
    }

    
    function onPlayerReady(event) {
        // auto-play video saat pemutar siap
    }

    
    let currentLessonId = '{{ $course->lessons->first()->id ?? null }}';

    function onPlayerStateChange(event) {
        // Jika video sedang diputar (PLAYING)
        if (event.data == YT.PlayerState.PLAYING) {
            // Mulai timer untuk update progress bar
            progressInterval = setInterval(updateProgressBar, 1000);
        } else {
            // Hentikan timer jika video di-pause, selesai, dll.
            clearInterval(progressInterval);
        }
        
        // Jika video selesai (ENDED)
        if (event.data == YT.PlayerState.ENDED) {
            markVideoAsComplete(currentLessonId);
            // Set progress bar ke 100% saat selesai
            document.getElementById('progress-bar').style.width = '100%';
            document.getElementById('progress-bar').innerText = '100%';
        }
    }


    // Fungsi untuk memutar video yang dipilih dari daftar putar
    function playVideo(videoId, videoTitle, lessonId) {
        player.loadVideoById(videoId);
        document.getElementById('video-title').innerText = videoTitle;
        currentLessonId = lessonId;
    }

    function updateProgressBar() {
        if (player && typeof player.getCurrentTime == 'function') {
            const currentTime = player.getCurrentTime();
            const duration = player.getDuration();
            const percentage = (currentTime / duration) * 100;

            const progressBar = document.getElementById('progress-bar');
            progressBar.style.width = percentage + '%';
            progressBar.innerText = Math.round(percentage) + '%';
        }
    }

    // Fungsi untuk mengirim laporan ke backend Laravel
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
                console.log(`Video ${lessonId} ditandai selesai!`);
                document.getElementById(`lesson-${lessonId}`).innerHTML += ' ✅';
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
</script>