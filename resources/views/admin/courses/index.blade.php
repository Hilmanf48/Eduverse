<h1>Daftar Kursus</h1>

{{-- Tombol untuk menambah kursus baru --}}
<a href="{{ route('admin.courses.create') }}">Tambah Kursus Baru</a>
<br><br>

{{-- Menampilkan pesan sukses setelah operasi CRUD --}}
@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th width="20%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($courses as $course)
        <tr>
            <td>{{ $course->title }}</td>
            <td>{{ $course->description }}</td>
            <td>
                <a href="{{ route('admin.courses.show', $course->id) }}">Kelola Video</a> |
                <a href="{{ route('admin.courses.edit', $course->id) }}">Edit</a> |
                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus kursus ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3">Belum ada data kursus.</td>
        </tr>
        @endforelse
    </tbody>
</table>