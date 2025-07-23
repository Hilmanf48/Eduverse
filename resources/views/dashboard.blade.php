<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight animate-fade-in">
                {{ __('Dashboard') }}
            </h2>
            <div class="flex items-center space-x-4">
                <div class="relative group">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center cursor-pointer hover:bg-blue-200 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-0 right-0 h-3 w-3 bg-red-500 rounded-full animate-pulse"></span>
                    </div>
                </div>
                <div class="relative">
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-full object-cover border-2 border-blue-500 hover:border-blue-600 transition-all duration-300 cursor-pointer">
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 animate-fade-in">
        <!-- Stats Cards -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Kursus Diambil</p>
                                <p class="text-2xl font-semibold text-gray-800">{{ $courses_taken }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Kuis Diselesaikan</p>
                                <p class="text-2xl font-semibold text-gray-800">{{ $quizzes_completed }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Jam Belajar</p>
                                <p class="text-2xl font-semibold text-gray-800">{{ round($learning_hours, 1) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Poin</p>
                                <p class="text-2xl font-semibold text-gray-800">{{ number_format($points) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Quiz Results -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-xl">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-semibold text-gray-800">Hasil Kuis Terakhir</h3>
                                <a href="{{ route('quiz.history') }}" class="text-sm text-blue-600 hover:text-blue-800 transition-colors duration-200">Lihat Semua</a>
                            </div>
                            <div class="space-y-4">
                                @forelse($recentAttempts as $attempt)
                                <div class="border-b border-gray-100 pb-4 last:border-0 last:pb-0 transform transition-all duration-200 hover:scale-[1.01]">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $attempt->quiz->course->title ?? 'Kuis' }}</p>
                                            <p class="text-sm text-gray-500">{{ $attempt['quiz_title'] }}</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $attempt['score'] >= 70 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $attempt['score'] }}%
                                        </span>
                                    </div>
                                    <div class="mt-2 flex justify-between items-center">
                                        <p class="text-xs text-gray-400">{{ $attempt['created_at'] }}</p>
                                        <a href="{{ route('quizzes.result', ['attempt' => $attempt['id']]) }}" class="text-xs text-blue-600 hover:text-blue-800">Review</a>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="mt-2 text-gray-500">Belum ada riwayat kuis</p>
                                    <a href="{{ route('courses.index') }}" class="mt-2 inline-block text-sm text-blue-600 hover:text-blue-800">Mulai Belajar</a>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Progress Card -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-xl">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6">Progres Belajar Keseluruhan</h3>
                            <div class="space-y-6">
                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-sm font-medium text-gray-700">Progress</span>
                                        <span class="text-sm font-semibold text-blue-600">{{ round($overallProgress) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full animate-progress" style="width: {{ round($overallProgress) }}%"></div>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-blue-50 rounded-lg p-4 transform transition-all duration-200 hover:scale-[1.02]">
                                        <p class="text-sm font-medium text-gray-600 mb-1">Kursus Aktif</p>
                                        <p class="text-xl font-bold text-gray-800">{{ $activeCourses }} Kursus</p>
                                        <div class="mt-2 w-full bg-blue-100 rounded-full h-1.5">
                                            <div class="bg-blue-600 h-1.5 rounded-full" style="width: 60%"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="bg-blue-50 rounded-lg p-4 transform transition-all duration-200 hover:scale-[1.02]">
                                        <p class="text-sm font-medium text-gray-600 mb-1">Modul Terselesaikan</p>
                                        <p class="text-xl font-bold text-gray-800">{{ $completedModules }} Modul</p>
                                        <div class="mt-2 w-full bg-blue-100 rounded-full h-1.5">
                                            <div class="bg-blue-600 h-1.5 rounded-full" style="width: 45%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Chart -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-xl">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2 sm:mb-0">Aktivitas Belajar</h3>
                                <div class="flex space-x-2">
                                    <a href="{{ route('dashboard', ['range' => 'week']) }}" class="{{ $range == 'week' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} px-3 py-1 text-sm rounded-full transition-colors duration-200">1 Minggu</a>
                                    <a href="{{ route('dashboard', ['range' => 'month']) }}" class="{{ $range == 'month' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} px-3 py-1 text-sm rounded-full transition-colors duration-200">1 Bulan</a>
                                    <a href="{{ route('dashboard', ['range' => 'year']) }}" class="{{ $range == 'year' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} px-3 py-1 text-sm rounded-full transition-colors duration-200">1 Tahun</a>
                                </div>
                            </div>
                            <canvas id="activityChart" class="w-full h-64"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial Section -->
            <div class="mt-8 bg-white rounded-xl shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-xl">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Bagikan Pengalaman Belajarmu!</h3>
                    
                    @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg animate-fade-in">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">
                                    {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-label for="name" value="Nama" />
                                <x-input id="name" type="text" class="mt-1 block w-full bg-gray-100" value="{{ Auth::user()->name }}" readonly />
                            </div>
                            
                            <div>
                                <x-label for="role" value="Pekerjaan / Role Saat Ini" />
                                <x-input id="role" name="role" type="text" class="mt-1 block w-full" placeholder="Contoh: UI/UX Designer" required />
                            </div>
                            
                            <div>
                                <x-label for="member_of" value="Member Kelas" />
                                <x-input id="member_of" name="member_of" type="text" class="mt-1 block w-full" placeholder="Contoh: Kelas Fundamental UI/UX" required />
                            </div>
                            
                            <div>
                                <x-label for="image" value="Foto Profil (Opsional)" />
                                <div class="mt-1 flex items-center">
                                    <label for="image" class="cursor-pointer">
                                        <div class="flex items-center space-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-sm text-gray-500">Upload Foto</span>
                                        </div>
                                        <input id="image" name="image" type="file" class="hidden" accept="image/*">
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <x-label for="quote" value="Tulis testimonimu di sini:" />
                            <textarea id="quote" name="quote" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-200" required minlength="20"></textarea>
                        </div>
                        
                        <div class="flex justify-end">
                            <x-button type="submit" class="px-6 py-3">
                                Kirim Testimoni
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart Initialization
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('activityChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'Video Selesai',
                        data: {!! json_encode($chartData) !!},
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                        pointBackgroundColor: '#3b82f6',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 6,
                        pointHoverBorderWidth: 2,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1e3a8a',
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 12
                            },
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                stepSize: 1
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    animations: {
                        tension: {
                            duration: 1000,
                            easing: 'linear',
                            from: 0.5,
                            to: 0.3,
                            loop: false
                        }
                    }
                }
            });
        });

        // File input preview
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.createElement('div');
                    preview.className = 'relative';
                    preview.innerHTML = `
                        <img src="${event.target.result}" class="h-10 w-10 rounded-full object-cover border-2 border-blue-500">
                        <button type="button" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs" onclick="this.parentElement.remove()">×</button>
                    `;
                    document.querySelector('label[for="image"]').replaceWith(preview);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
    @endpush

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes progress {
            from { width: 0; }
            to { width: 100%; }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        
        .animate-progress {
            animation: progress 1.5s ease-out forwards;
        }
        
        [x-cloak] { display: none !important; }
    </style>
</x-app-layout>