<h1>Tambah Kursus Baru</h1>
<form action="{{ route('admin.courses.store') }}" method="POST">
    @csrf
    <div>
        <label for="title">Judul:</label><br>
        <input type="text" id="title" name="title" required>
    </div>
    <br>
    <div>
        <label for="description">Deskripsi:</label><br>
        <textarea id="description" name="description" required></textarea>
    </div>
    <br>
    <button type="submit">Simpan</button>
</form>