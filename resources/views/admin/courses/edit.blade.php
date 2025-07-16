<h1>Edit Kursus: {{ $course->title }}</h1>
<form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="title">Judul:</label><br>
        <input type="text" id="title" name="title" value="{{ $course->title }}" required>
    </div>
    <br>
    <div>
        <label for="description">Deskripsi:</label><br>
        <textarea id="description" name="description" required>{{ $course->description }}</textarea>
    </div>
    <br>
    <button type="submit">Update</button>
</form>