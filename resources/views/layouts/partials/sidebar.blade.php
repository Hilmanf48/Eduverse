<aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
    <h2 class="text-lg font-bold mb-4">EduVerse</h2>
    <nav>
        <ul>
            <li class="mb-2">
                <a href="{{ route('dashboard') }}" class="block p-2 rounded hover:bg-gray-700">Dashboard</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('courses.index') }}" class="block p-2 rounded hover:bg-gray-700">Courses</a>
            </li>
            {{-- Tampilkan menu ini hanya jika user adalah admin --}}
            @if(auth()->user() && auth()->user()->is_admin)
            <li class="mb-2 pt-4">
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Admin Panel</h3>
                <a href="{{ route('admin.courses.index') }}" class="block p-2 rounded hover:bg-gray-700">Manage Courses</a>
                <a href="{{ route('admin.users.index') }}" class="block p-2 rounded hover:bg-gray-700">Manage Users</a>
            </li>
            @endif
        </ul>
    </nav>
</aside>