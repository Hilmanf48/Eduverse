<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eduverse - Mulai Karir Impianmu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>

    <style>
        /* Smooth scroll for navigation */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar (optional, for aesthetics) */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f0f0f0;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Styles for the Testimonial Slider */
        .testimonial-slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .testimonial-slide {
            flex: 0 0 100%; /* Each slide takes full width */
            text-align: center;
            padding: 1rem; /* Adjust padding as needed */
        }
    </style>
</head>
<body class="font-sans antialiased bg-stone-50 text-gray-800">


    <nav x-data="{ open: false }" class="bg-white shadow-md py-4 px-4 md:px-8 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="flex items-center space-x-2">
                <img src="{{ asset('images/depan/icon.png') }}" alt="Eduverse logo" class="h-8 md:h-10">
                <span class="text-gray-800 text-xl md:text-2xl font-bold">Eduverse</span>
            </a>

            <button @click="open = !open" class="text-gray-600 md:hidden focus:outline-none">
                <span x-show="!open" class="text-3xl">&#9776;</span>
                <span x-show="open" class="text-3xl">&#x2715;</span>
            </button>

            <div class="hidden md:flex items-center space-x-6">
                <a href="#hero" class="text-gray-600 hover:text-blue-600 transition duration-300">Home</a>
                <a href="{{ route('courses.index') }}" class="text-gray-600 hover:text-blue-600 transition duration-300">Kelas</a>
                <a href="#story-success" class="text-gray-600 hover:text-blue-600 transition duration-300">Story Success</a>
                <a href="#" class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition duration-300">Login</a>
            </div>
        </div>

        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-3" x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-3"
             class="md:hidden bg-white mt-4 py-2 space-y-2 border-t border-gray-200">
            <a href="#hero" @click="open = false" class="block text-gray-600 px-4 py-2 hover:bg-gray-100">Home</a>
            <a href="#kelas-unggulan" @click="open = false" class="block text-gray-600 px-4 py-2 hover:bg-gray-100">Kelas</a>
            <a href="#story-success" @click="open = false" class="block text-gray-600 px-4 py-2 hover:bg-gray-100">Story Success</a>
            <a href="#" @click="open = false" class="block bg-blue-600 text-white px-5 py-2 mx-4 rounded-full text-center hover:bg-blue-700 mt-2">Login</a>
        </div>
    </nav>

    <header id="hero" class="py-20 md:py-32 bg-gradient-to-br from-blue-50 to-stone-100 overflow-hidden">
       <div class="container mx-auto px-4 text-center max-w-4xl flex flex-col md:flex-row items-center justify-center"> <div class="md:w-1/2 md:pr-8 text-center md:text-left"> <p class="text-blue-600 font-semibold text-lg mb-3">#MulaiKarirImpianmu</p>
            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-6">
                Temukan Course Skill <br class="hidden md:inline"> Impianmu di <span class="text-blue-600">Eduverse</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-700 mb-10">
                Pilih dari ratusan course berkualitas tinggi di bidang UI/UX, Web Development, Freelancing, dan banyak lagi.
            </p>
            </div>
        <div class="md:w-1/2 mt-8 md:mt-0"> <img src="{{ asset('images\kucing-sarjana.png') }}" alt="Ilustrasi Eduverse" class="w-full h-auto rounded-lg shadow-xl">
        </div>
    </div>
            </div>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4 mt-8">
                <a href="#kelas-unggulan" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 shadow-lg">
                    Lihat Semua Course
                </a>
                <a href="#story-success" class="bg-white border border-gray-300 text-gray-800 font-bold py-3 px-8 rounded-full text-lg hover:bg-gray-100 transition duration-300 shadow-md">
                    Kenapa Eduverse?
                </a>
            </div>
        </div>
    </header>

    <section id="kelas-unggulan" class="py-16 md:py-24 bg-stone-100">
        <div class="container mx-auto px-4 max-w-6xl">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-12">Kelas Unggulan Eduverse</h2>
            <p class="text-lg text-gray-700 text-center mb-12 max-w-3xl mx-auto">
                Pilihan kelas terbaik dan paling diminati untuk membantumu melangkah maju dalam karir.
            </p>

            <div class="flex flex-wrap justify-center gap-4 mb-12" id="course-filters">
                <button class="filter-btn bg-blue-600 text-white px-6 py-2 rounded-full font-semibold hover:bg-blue-700 transition duration-300 active" data-category="all">Semua Kelas</button>
                <button class="filter-btn bg-gray-200 text-gray-800 px-6 py-2 rounded-full font-semibold hover:bg-gray-300 transition duration-300" data-category="uiux">UI/UX Design</button>
                <button class="filter-btn bg-gray-200 text-gray-800 px-6 py-2 rounded-full font-semibold hover:bg-gray-300 transition duration-300" data-category="webdev">Web Development</button>
                <button class="filter-btn bg-gray-200 text-gray-800 px-6 py-2 rounded-full font-semibold hover:bg-gray-300 transition duration-300" data-category="freelancer">Freelancer</button>
                <button class="filter-btn bg-gray-200 text-gray-800 px-6 py-2 rounded-full font-semibold hover:bg-gray-300 transition duration-300" data-category="others">Lainnya</button>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8" id="course-list">
                </div>
        </div>
    </section>

    <section id="story-success" class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-4 max-w-4xl text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-12">Story Success Member</h2>

            <div class="relative w-full max-w-xl mx-auto overflow-hidden">
                <div id="testimonial-slider-container" class="testimonial-slider">
                    </div>

                <button id="prev-testimonial" class="absolute left-0 top-1/2 -translate-y-1/2 bg-gray-700 text-white p-3 rounded-full shadow-lg hover:bg-gray-800 focus:outline-none z-10">
                    &#8249; </button>
                <button id="next-testimonial" class="absolute right-0 top-1/2 -translate-y-1/2 bg-gray-700 text-white p-3 rounded-full shadow-lg hover:bg-gray-800 focus:outline-none z-10">
                    &#8250; </button>

                <div class="flex justify-center space-x-2 mt-8" id="testimonial-dots-container">
                    </div>
            </div>

            <a href="#" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full mt-12 text-lg transition duration-300 shadow-lg">
                Lihat Selengkapnya &#8594;
            </a>
        </div>
    </section>

    <a href="#" class="fixed bottom-6 right-6 bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-6 rounded-full shadow-lg flex items-center space-x-2 transition duration-300 z-50">
        <span>&#9993;</span> <span>Konsultasi Kelas</span>
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
        const courses = [
            { id: 1, title: 'Fundamental UI/UX Design', category: 'uiux', description: 'Pelajari dasar-dasar desain antarmuka pengguna dan pengalaman pengguna dari nol.', image: 'https://via.placeholder.com/400x250/b0d7ff/000000?text=UI/UX+Design' },
            { id: 2, title: 'Fullstack Web Dev with Laravel & Vue', category: 'webdev', description: 'Bangun aplikasi web lengkap menggunakan Laravel dan Vue.js, siap untuk karir profesional.', image: 'https://via.placeholder.com/400x250/b0d7ff/000000?text=Web+Dev' },
            { id: 3, title: 'Strategi Jitu Mendapatkan Proyek Freelance', category: 'freelancer', description: 'Kuasai cara mendapatkan klien, negosiasi, dan mengelola proyek freelance secara efektif.', image: 'https://via.placeholder.com/400x250/b0d7ff/000000?text=Freelancer' },
            { id: 4, title: 'Advanced UX Research & Testing', category: 'uiux', description: 'Mendalami metodologi riset pengguna dan pengujian untuk desain yang berpusat pada manusia.', image: 'https://via.placeholder.com/400x250/b0d7ff/000000?text=UX+Research' },
            { id: 5, title: 'Backend Development dengan Node.js & Express', category: 'webdev', description: 'Pelajari membangun API yang kuat, aman, dan skalabel menggunakan Node.js dan Express.', image: 'https://via.placeholder.com/400x250/b0d7ff/000000?text=Node.js+Backend' },
            { id: 6, title: 'Optimalisasi SEO untuk Website Bisnis', category: 'others', description: 'Tingkatkan peringkat websitemu di mesin pencari dan tarik lebih banyak traffic organik.', image: 'https://via.placeholder.com/400x250/b0d7ff/000000?text=SEO' },
            { id: 7, title: 'Dasar-dasar Data Science dengan Python', category: 'others', description: 'Pengantar ke ilmu data, analisis data, dan visualisasi menggunakan bahasa pemrograman Python.', image: 'https://via.placeholder.com/400x250/b0d7ff/000000?text=Data+Science' },
            { id: 8, title: 'Mengelola Keuangan Freelance', category: 'freelancer', description: 'Strategi pengelolaan keuangan khusus untuk para pekerja lepas, dari pajak hingga investasi.', image: 'https://via.placeholder.com/400x250/b0d7ff/000000?text=Fintech' }
        ];

        const testimonials = [
            {
                name: 'Havidz Muhammad Iqbal',
                role: 'Full-time Freelancer',
                memberOf: 'Kelas UI/UX dan IG Organik',
                image: 'images/depan/kucing1.jpg',
                quote: 'Dari Desain Aplikasi Kampus, Sukses Jadi Full-Time Freelancer! Ucing, menceritakan pengalaman belajar otodidak sampai bisa jadi full-time freelancer ...'
            },
            {
                name: 'Sarah Dewi',
                role: 'UI/UX Designer',
                memberOf: 'Kelas Fundamental UI/UX',
                image: 'images/depan/kucing3.jpg',
                quote: 'Materi di Eduverse sangat relevan dengan kebutuhan industri. Berkat bimbingan mentor, saya berhasil transisi karir ke UI/UX Designer!'
            },
            {
                name: 'David Kurniawan',
                role: 'Fullstack Developer',
                memberOf: 'Kelas Fullstack Web Dev',
                image: 'images/depan/kucing4.jpg',
                quote: 'Saya sangat terkesan dengan support komunitasnya. Pertanyaan saya selalu dijawab cepat dan ada banyak teman untuk diskusi coding.'
            },
            {
                name: 'Ayu Lestari',
                role: 'Digital Marketer',
                memberOf: 'Kelas Digital Marketing',
                image: 'images/depan/kucing2.jpg',
                quote: 'Kelas Digital Marketing membuka wawasan baru. Sekarang saya bisa menjalankan kampanye iklan yang efektif untuk bisnis saya sendiri.'
            }
        ];

        // Dynamic Course Listing and Filtering
        const courseListContainer = document.getElementById('course-list');
        const filterButtons = document.querySelectorAll('.filter-btn');
        // const categoryCards = document.querySelectorAll('.category-card'); // Dihapus karena section kategori dihapus

        function renderCourses(filteredCourses) {
            courseListContainer.innerHTML = ''; // Clear existing courses
            if (filteredCourses.length === 0) {
                courseListContainer.innerHTML = '<p class="text-center text-gray-500 col-span-full">Tidak ada kelas yang ditemukan untuk kategori ini.</p>';
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

        // Handle category card clicks for filtering (DIHAPUS KARENA SECTION KATEGORI DIHAPUS)
        /*
        categoryCards.forEach(card => {
            card.addEventListener('click', () => {
                const category = card.dataset.category;
                const targetButton = document.querySelector(`.filter-btn[data-category="${category}"]`);
                if (targetButton) {
                    targetButton.click();
                    document.getElementById('kelas-unggulan').scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
        */

        // Initial render of all courses
        renderCourses(courses);

        // Add event listeners to filter buttons
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons and reset their styles
                filterButtons.forEach(btn => {
                    btn.classList.remove('active', 'bg-blue-600', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-800');
                });

                // Add active class to clicked button and apply active styles
                button.classList.add('active', 'bg-blue-600', 'text-white');
                button.classList.remove('bg-gray-200', 'text-gray-800');

                const category = button.dataset.category;
                let filteredCourses = [];
                if (category === 'all') {
                    filteredCourses = courses;
                } else {
                    filteredCourses = courses.filter(course => course.category === category);
                }
                renderCourses(filteredCourses);
            });
        });


        // Testimonial Slider Logic
        let currentSlide = 0;
        const testimonialSliderContainer = document.getElementById('testimonial-slider-container');
        const prevTestimonialBtn = document.getElementById('prev-testimonial');
        const nextTestimonialBtn = document.getElementById('next-testimonial');
        const testimonialDotsContainer = document.getElementById('testimonial-dots-container');

        function renderTestimonials() {
            testimonialSliderContainer.innerHTML = ''; // Clear existing slides
            testimonialDotsContainer.innerHTML = ''; // Clear existing dots

            testimonials.forEach((testimonial, index) => {
                const slideHtml = `
                    <div class="testimonial-slide flex-shrink-0 w-full p-8 bg-white rounded-lg shadow-md flex flex-col items-center">
                        <img src="${testimonial.image}" alt="${testimonial.name}" class="w-24 h-24 rounded-full object-cover mb-4 border-2 border-blue-600">
                        <h3 class="text-2xl font-bold text-gray-900 mb-1">${testimonial.name}</h3>
                        <p class="text-blue-600 text-md font-semibold mb-2">Member ${testimonial.memberOf}</p>
                        <p class="text-gray-500 text-sm mb-4">${testimonial.role}</p>
                        <p class="text-lg italic text-gray-700 mb-6 max-w-lg">${testimonial.quote}</p>
                        <a href="#" class="bg-gray-800 text-white px-6 py-2 rounded-full hover:bg-gray-900 transition duration-300 flex items-center gap-2">
                            Baca Selengkapnya &#8594;
                        </a>
                    </div>
                `;
                testimonialSliderContainer.insertAdjacentHTML('beforeend', slideHtml);

                const dot = document.createElement('button');
                dot.classList.add('w-3', 'h-3', 'rounded-full', 'bg-gray-300', 'hover:bg-gray-400');
                if (index === currentSlide) {
                    dot.classList.add('bg-blue-600');
                }
                dot.dataset.index = index;
                dot.addEventListener('click', () => {
                    showSlide(index);
                });
                testimonialDotsContainer.appendChild(dot);
            });
            updateSliderPosition();
            updateDots();
        }

        function updateSliderPosition() {
            // Pastikan ada children sebelum mencoba mengakses clientWidth
            if (testimonialSliderContainer.children.length === 0) return;
            const slideWidth = testimonialSliderContainer.children[0].clientWidth;
            testimonialSliderContainer.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
        }

        function updateDots() {
            document.querySelectorAll('#testimonial-dots-container button').forEach((dot, index) => {
                dot.classList.remove('bg-blue-600');
                dot.classList.add('bg-gray-300');
                if (index === currentSlide) {
                    dot.classList.remove('bg-gray-300');
                    dot.classList.add('bg-blue-600');
                }
            });
        }

        function showSlide(index) {
            currentSlide = index;
            if (currentSlide < 0) {
                currentSlide = testimonials.length - 1;
            } else if (currentSlide >= testimonials.length) {
                currentSlide = 0;
            }
            updateSliderPosition();
            updateDots();
        }

        prevTestimonialBtn.addEventListener('click', () => {
            showSlide(currentSlide - 1);
        });

        nextTestimonialBtn.addEventListener('click', () => {
            showSlide(currentSlide + 1);
        });

        // Auto-advance for testimonials
        setInterval(() => {
            showSlide(currentSlide + 1);
        }, 5000); // Change testimonial every 5 seconds

        // Initialize slider on load
        document.addEventListener('DOMContentLoaded', () => {
            renderTestimonials();
            showSlide(0); // Ensure first slide is shown initially
            // Re-calculate slider position on window resize to ensure responsiveness
            window.addEventListener('resize', updateSliderPosition);
        });

    </script>
</body>
</html>