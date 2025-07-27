<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Kelas - Eduverse</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <style>
        html { scroll-behavior: smooth; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f0f0f0; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="font-sans antialiased bg-stone-50 text-gray-800">

    <nav x-data="{ open: false }" class="bg-white shadow-md py-4 px-4 md:px-8 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center space-x-2"> <img src="{{ asset('images/logo-eduverse.png') }}" alt="Eduverse logo" class="h-8 md:h-10">
                <span class="text-gray-800 text-xl md:text-2xl font-bold">Eduverse</span>
            </a>

            <button @click="open = !open" class="text-gray-600 md:hidden focus:outline-none">
                <span x-show="!open" class="text-3xl">&#9776;</span>
                <span x-show="open" class="text-3xl">&#x2715;</span>
            </button>

            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ url('/') }}" class="text-gray-600 hover:text-blue-600 transition duration-300">Home</a>
                <a href="{{ route('courses.index') }}" class="text-blue-600 font-semibold transition duration-300">Kelas</a> <a href="{{ url('/#story-success') }}" class="text-gray-600 hover:text-blue-600 transition duration-300">Story Success</a>
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition duration-300">Login</a>
            </div>
        </div>

        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-3" x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-3"
             class="md:hidden bg-white mt-4 py-2 space-y-2 border-t border-gray-200">
            <a href="{{ url('/') }}" @click="open = false" class="block text-gray-600 px-4 py-2 hover:bg-gray-100">Home</a>
            <a href="{{ route('courses.index') }}" @click="open = false" class="block text-blue-600 font-semibold px-4 py-2 hover:bg-gray-100">Kelas</a>
            <a href="{{ url('/#story-success') }}" @click="open = false" class="block text-gray-600 px-4 py-2 hover:bg-gray-100">Story Success</a>
            <a href="{{ ('login') }}" @click="open = false" class="block bg-blue-600 text-white px-5 py-2 mx-4 rounded-full text-center hover:bg-blue-700 mt-2">Login</a>
        </div>
    </nav>

    <section class="py-16 md:py-20 bg-gradient-to-br from-blue-50 to-stone-100 text-center">
        <div class="container mx-auto px-4 max-w-4xl">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                Jelajahi Semua Kelas Eduverse
            </h1>
            <p class="text-lg text-gray-700 max-w-2xl mx-auto">
                Temukan kelas terbaik di bidang pilihanmu dan mulai karir impianmu hari ini.
            </p>
        </div>
    </section>

    <section class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-12">
                <div class="relative flex-grow w-full md:w-auto md:max-w-md bg-white rounded-full shadow-md">
                    <input type="text" id="course-search" placeholder="Cari kelas..."
                           class="w-full py-3 pl-6 pr-12 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg text-gray-800 placeholder-gray-500">
                    <button class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-blue-600">
                        &#128269;
                    </button>
                </div>

                <div class="flex flex-wrap justify-center gap-3" id="course-filters">
                    <button class="filter-btn active" data-category="all">Semua</button>
                    @foreach($categories as $category)
                        <button class="filter-btn" data-category="{{ strtolower($category->name) }}">{{ $category->name }}</button>
                    @endforeach
                </div>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="course-list">
                </div>

            <div class="flex justify-center mt-12 space-x-2">
                <button class="px-4 py-2 border rounded-md text-gray-600 hover:bg-gray-100">&laquo; Previous</button>
                <button class="px-4 py-2 border rounded-md bg-blue-600 text-white">1</button>
                <button class="px-4 py-2 border rounded-md text-gray-600 hover:bg-gray-100">2</button>
                <button class="px-4 py-2 border rounded-md text-gray-600 hover:bg-gray-100">3</button>
                <button class="px-4 py-2 border rounded-md text-gray-600 hover:bg-gray-100">Next &raquo;</button>
            </div>
        </div>
    </section>

    <a href="#" class="fixed bottom-6 right-6 bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-6 rounded-full shadow-lg flex items-center space-x-2 transition duration-300 z-50">
        <span>&#9993;</span>
        <span>Konsultasi Kelas</span>
    </a>

    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4 text-center text-gray-400">
            <p>&copy; 2025 Eduverse. All rights reserved.</p>
            <div class="mt-4 space-x-4">
                <a href="#" class="hover:text-white transition duration-300">Kebijakan Privasi</a>
                <a href="#" class="hover:text-white transition duration-300">Syarat & Ketentuan</a>
            </div>
        </div>
    </footer>

    <script>
        // Data courses (ini akan sama dengan yang di landing page, bisa dipindahkan ke file JS terpisah nanti)
     //   const courses = [
      //      { id: 1, title: 'Fundamental UI/UX Design', category: 'uiux', description: 'Pelajari dasar-dasar desain antarmuka pengguna dan pengalaman pengguna dari nol.', image: '{{ asset('images/class-uiux.jpg') }}' },
      //      { id: 2, title: 'Fullstack Web Dev with Laravel & Vue', category: 'webdev', description: 'Bangun aplikasi web lengkap menggunakan Laravel dan Vue.js, siap untuk karir profesional.', image: '{{ asset('images/class-webdev.jpg') }}' },
      //      { id: 3, title: 'Strategi Jitu Mendapatkan Proyek Freelance', category: 'freelancer', description: 'Kuasai cara mendapatkan klien, negosiasi, dan mengelola proyek freelance secara efektif.', image: '{{ asset('images/class-freelancer.jpg') }}' },
      //      { id: 4, title: 'Advanced UX Research & Testing', category: 'uiux', description: 'Mendalami metodologi riset pengguna dan pengujian untuk desain yang berpusat pada manusia.', image: '{{ asset('images/class-ux-research.jpg') }}' },
      //      { id: 5, title: 'Backend Development dengan Node.js & Express', category: 'webdev', description: 'Pelajari membangun API yang kuat, aman, dan skalabel menggunakan Node.js dan Express.', image: '{{ asset('images/class-nodejs-backend.jpg') }}' },
      //      { id: 6, title: 'Optimalisasi SEO untuk Website Bisnis', category: 'others', description: 'Tingkatkan peringkat websitemu di mesin pencari dan tarik lebih banyak traffic organik.', image: '{{ asset('images/class-seo.jpg') }}' },
      //      { id: 7, title: 'Dasar-dasar Data Science dengan Python', category: 'others', description: 'Pengantar ke ilmu data, analisis data, dan visualisasi menggunakan bahasa pemrograman Python.', image: '{{ asset('images/class-data-science.jpg') }}' },
      //      { id: 8, title: 'Mengelola Keuangan Freelance', category: 'freelancer', description: 'Strategi pengelolaan keuangan khusus untuk para pekerja lepas, dari pajak hingga investasi.', image: '{{ asset('images/class-fintech.jpg') }}' }
      //  ];

        const courseListContainer = document.getElementById('course-list');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const searchInput = document.getElementById('course-search');

        function renderCourses(filteredCourses) {
            courseListContainer.innerHTML = '';
            if (filteredCourses.length === 0) {
                courseListContainer.innerHTML = '<p class="text-center text-gray-500 col-span-full">Tidak ada kelas yang ditemukan.</p>';
                return;
            }
            filteredCourses.forEach(course => {
                const courseCard = `
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300">
                        <img src="${course.image}" alt="${course.title}" class="w-full h-40 object-cover">
                        <div class="p-6">
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full mb-2">${course.category.toUpperCase()}</span>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">${course.title}</h3>
                            <p class="text-gray-600 text-sm mb-4">${course.description}</p>
                            <a href="#" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-full text-sm hover:bg-blue-700 transition duration-300">Lihat Detail</a>
                        </div>
                    </div>
                `;
                courseListContainer.insertAdjacentHTML('beforeend', courseCard);
            });
        }

        function applyFiltersAndSearch() {
            const activeCategory = document.querySelector('.filter-btn.active').dataset.category;
            const searchTerm = searchInput.value.toLowerCase();

            let filteredCourses = courses.filter(course => {
                const matchesCategory = (activeCategory === 'all' || course.category === activeCategory);
                const matchesSearch = course.title.toLowerCase().includes(searchTerm) || course.description.toLowerCase().includes(searchTerm);
                return matchesCategory && matchesSearch;
            });
            renderCourses(filteredCourses);
        }

        // Event listener for filter buttons
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                filterButtons.forEach(btn => {
                    btn.classList.remove('active', 'bg-blue-600', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-800');
                });
                button.classList.add('active', 'bg-blue-600', 'text-white');
                button.classList.remove('bg-gray-200', 'text-gray-800');
                applyFiltersAndSearch();
            });
        });

        // Event listener for search input
        searchInput.addEventListener('input', applyFiltersAndSearch);

        // Initial render
        document.addEventListener('DOMContentLoaded', () => {
            applyFiltersAndSearch();
        });
    </script>
</body>
</html>