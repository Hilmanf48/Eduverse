<h1>Kelola Video untuk Kursus: {{ $course->title }}</h1>
<a href="{{ route('admin.courses.index') }}"><< Kembali ke Daftar Kursus</a>

<hr>

<h3>Tambah Video Baru</h3>
<form action="{{ route('admin.lessons.store') }}" method="POST">
    @csrf
    <input type="hidden" name="course_id" value="{{ $course->id }}">
    <div>
        <label for="title">Judul Video:</label><br>
        <input type="text" id="title" name="title" required>
    </div>
    <br>
    <div>
        <label for="youtube_video_id">ID Video YouTube:</label><br>
        <input type="text" id="youtube_video_id" name="youtube_video_id" required>
        <small>Contoh: Jika URL adalah https://www.youtube.com/watch?v=<b>dQw4w9WgXcQ</b>, maka ID-nya adalah <b>dQw4w9WgXcQ</b></small>
    </div>
    <br>
    <button type="submit">Tambah Video</button>
</form>

<hr>

<h3>Daftar Video</h3>
<table border="1">
    <thead>
        <tr>
            <th>Urutan</th>
            <th>Judul Video</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($course->lessons as $lesson)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $lesson->title }}</td>
            <td>
                <form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3">Belum ada video.</td>
        </tr>
        @endforelse
    </tbody>
</table>