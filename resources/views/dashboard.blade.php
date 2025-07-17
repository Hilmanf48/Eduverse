<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-1 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Hasil Kuis Terakhir</h3>
                    <div class="space-y-4">
                        @forelse($recentAttempts as $attempt)
                            <div class="border-b pb-2">
                                <p class="font-semibold">{{ $attempt->quiz->course->title ?? 'Kuis' }}</p>
                                <p class="text-sm text-gray-600">Skor: <span class="font-bold text-blue-600">{{ round($attempt->score) }}%</span></p>
                                <p class="text-xs text-gray-400">{{ $attempt->created_at->diffForHumans() }}</p>
                            </div>
                        @empty
                            <p class="text-gray-500">Belum ada riwayat kuis.</p>
                        @endforelse
                    </div>
                </div>

                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Progres Belajar Keseluruhan</h3>
                        <div class="w-full bg-gray-200 rounded-full">
                            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-1 leading-none rounded-full" style="width: {{ round($overallProgress) }}%">
                                {{ round($overallProgress) }}%
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Aktivitas Belajar</h3>
                            <div class="flex space-x-2">
                                <a href="{{ route('dashboard', ['range' => 'week']) }}" class="{{ $range == 'week' ? 'bg-blue-600 text-white' : 'bg-gray-200' }} px-3 py-1 text-sm rounded-full">1 Minggu</a>
                                <a href="{{ route('dashboard', ['range' => 'month']) }}" class="{{ $range == 'month' ? 'bg-blue-600 text-white' : 'bg-gray-200' }} px-3 py-1 text-sm rounded-full">1 Bulan</a>
                                <a href="{{ route('dashboard', ['range' => 'year']) }}" class="{{ $range == 'year' ? 'bg-blue-600 text-white' : 'bg-gray-200' }} px-3 py-1 text-sm rounded-full">1 Tahun</a>
                            </div>
                        </div>
                        <canvas id="activityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="http://googleusercontent.com/chart.js/4.3.0/chart.umd.min.js"></script>
    <script>
        const ctx = document.getElementById('activityChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Video Selesai',
                    data: {!! json_encode($chartData) !!},
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>