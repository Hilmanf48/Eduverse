@extends('layouts.client')

@section('title', 'Eduverse - Mulai Karir Impianmu')

@section('content')
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
<header id="hero" class="py-20 md:py-32 bg-gradient-to-br from-blue-50 to-stone-100 overflow-hidden">
        <div class="container mx-auto px-4 text-center max-w-4xl">
            <div class="flex flex-col md:flex-row items-center justify-center">
                <div class="md:w-1/2 md:pr-8 text-center md:text-left">
                    <p class="text-blue-600 font-semibold text-lg mb-3">#MulaiKarirImpianmu</p>
                    <h1 class="text-5xl md:text-6xl font-extrabold leading-tight text-gray-900 mb-6">
                        Temukan Course Skill <br class="hidden md:inline"> Impianmu di <span class="text-blue-600">Eduverse</span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-700 mb-10">
                    Pilih dari ratusan course berkualitas tinggi di bidang UI/UX, Web Development, Freelancing, dan banyak lagi.
                    </p>
                </div>
                <div class="md:w-1/2 mt-8 md:mt-0">
                    {{-- Pastikan gambar ini ada di public/images/ --}}
                    <img src="{{ asset('images/logo.png') }}" alt="Ilustrasi Eduverse" class="w-full h-auto rounded-lg shadow-xl">
                </div>
            </div>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4 mt-8">
                <a href="#kelas-unggulan" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 shadow-lg">Lihat Semua Course</a>
                <a href="#story-success" class="bg-white border border-gray-300 text-gray-800 font-bold py-3 px-8 rounded-full text-lg hover:bg-gray-100 transition duration-300 shadow-md">Kenapa Eduverse?</a>
            </div>
        </div>
    </header>
    <section id="kelas-unggulan" class="py-16 md:py-24 bg-stone-100">
        <div class="container mx-auto px-4 max-w-6xl">
            <h2 class="text-4xl font-bold text-center text-gray-900 mb-12">Kelas Unggulan Eduverse</h2>
            <div class="flex flex-wrap justify-center gap-3" id="course-filters">
                <button class="filter-btn active" data-category="all">Semua</button>
                @foreach($categories as $category)
        
                <button class="filter-btn" data-category="{{ strtolower($category->name) }}">{{ $category->name }}</button>
                @endforeach
                </div>
            
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8" id="course-list">
            {{-- Diisi oleh JavaScript --}}
            </div>
        </div>
    </section>

    <section id="story-success" class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-4 max-w-4xl text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-12">Story Success Member</h2>
            <div class="relative w-full max-w-xl mx-auto overflow-hidden">
                <div id="testimonial-slider-container" class="testimonial-slider">
                    {{-- Diisi oleh JavaScript --}}
                </div>
                <button id="prev-testimonial" class="absolute left-0 top-1/2 -translate-y-1/2 bg-gray-700 text-white p-3 rounded-full shadow-lg hover:bg-gray-800 focus:outline-none z-10">&#8249;</button>
                <button id="next-testimonial" class="absolute right-0 top-1/2 -translate-y-1/2 bg-gray-700 text-white p-3 rounded-full shadow-lg hover:bg-gray-800 focus:outline-none z-10">&#8250;</button>
                <div class="flex justify-center space-x-2 mt-8" id="testimonial-dots-container"></div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    const courses = {!! json_encode($featuredCourses ?? []) !!};
    const testimonials = {!! json_encode($testimonials ?? []) !!};

    const courseListContainer = document.getElementById('course-list');
    const filterButtons = document.querySelectorAll('.filter-btn');
    function renderCourses(coursesToRender) {
        console.log("Fungsi renderCourses dipanggil dengan data:", coursesToRender);
        if (!courseListContainer) return;
        courseListContainer.innerHTML = '';
        coursesToRender.forEach(course => {
            console.log("Merender course:", course);
            const courseCard = `
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <img src="${course.image}" alt="${course.title}" class="w-full h-40 object-cover">
                    <div class="p-6">
                        <span class="...">${course.category_name.toUpperCase()}</span>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">${course.title}</h3>
                        <p class="text-gray-600 text-sm mb-4">${course.description}</p>
                        <a href="/courses/${course.id}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-full text-sm hover:bg-blue-700 transition duration-300">Lihat Detail</a>
                    </div>
                </div>`;
            courseListContainer.insertAdjacentHTML('beforeend', courseCard);
        });
    }

    if (filterButtons.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-blue-600', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-800');
                });
                button.classList.add('bg-blue-600', 'text-white');
                button.classList.remove('bg-gray-200', 'text-gray-800');
                
                const category = button.dataset.category;
                let filteredCourses = (category === 'all') ? courses : courses.filter(course => course.category === category);
                renderCourses(filteredCourses);
            });
        });
    }

    let currentSlide = 0;
    const testimonialSliderContainer = document.getElementById('testimonial-slider-container');
    const prevTestimonialBtn = document.getElementById('prev-testimonial');
    const nextTestimonialBtn = document.getElementById('next-testimonial');
    const testimonialDotsContainer = document.getElementById('testimonial-dots-container');

    function renderTestimonials() {
        if (!testimonialSliderContainer) return;
        testimonialSliderContainer.innerHTML = '';
        testimonialDotsContainer.innerHTML = '';
        testimonials.forEach((testimonial, index) => {
            const slideHtml = `<div class="testimonial-slide flex-shrink-0 w-full p-8"><img src="${testimonial.image}" alt="${testimonial.name}" class="w-24 h-24 rounded-full object-cover mx-auto mb-4 border-2 border-blue-600"><h3 class="text-2xl font-bold text-gray-900 mb-1">${testimonial.name}</h3><p class="text-gray-500 text-sm mb-4">${testimonial.role}</p><p class="text-lg italic text-gray-700 max-w-lg mx-auto">${testimonial.quote}</p></div>`;
            testimonialSliderContainer.insertAdjacentHTML('beforeend', slideHtml);
            const dot = document.createElement('button');
            dot.classList.add('w-3', 'h-3', 'rounded-full', 'bg-gray-300', 'hover:bg-gray-400');
            dot.dataset.index = index;
            dot.addEventListener('click', () => showSlide(index));
            testimonialDotsContainer.appendChild(dot);
        });
    }


    function updateSliderPosition() {
        if (!testimonialSliderContainer || testimonialSliderContainer.children.length === 0) return;
        const slideWidth = testimonialSliderContainer.children[0].clientWidth;
        testimonialSliderContainer.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
    }

    function updateDots() {
        document.querySelectorAll('#testimonial-dots-container button').forEach((dot, index) => {
            dot.classList.toggle('bg-blue-600', index === currentSlide);
            dot.classList.toggle('bg-gray-300', index !== currentSlide);
        });
    }

    function showSlide(index) {
        if (!testimonials || testimonials.length === 0) return;
        currentSlide = (index + testimonials.length) % testimonials.length;
        updateSliderPosition();
        updateDots();
    }

    document.addEventListener('DOMContentLoaded', () => {
        if (courses && courses.length > 0) {
            renderCourses(courses);
        }
        
        if (testimonials && testimonials.length > 0 && testimonialSliderContainer) {
            renderTestimonials();
            showSlide(0);
            window.addEventListener('resize', updateSliderPosition);
            prevTestimonialBtn.addEventListener('click', () => showSlide(currentSlide - 1));
            nextTestimonialBtn.addEventListener('click', () => showSlide(currentSlide + 1));
            setInterval(() => showSlide(currentSlide + 1), 5000);
        }
    });
</script>
@endpush
</html>