<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' | ' : '' }}{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-hover: #2563eb;
            --secondary-color: #f8fafc;
        }
        
        @keyframes fadeIn {
            from { 
                opacity: 0; 
                transform: translateY(20px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .bg-auth-gradient {
            background: linear-gradient(135deg, #f0f7ff 0%, #e1f0ff 100%);
        }
        
        .auth-wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }
        
        .auth-wave svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 120px;
        }
        
        .auth-wave .shape-fill {
            fill: #FFFFFF;
        }
    </style>
</head>
<body class="bg-auth-gradient min-h-screen flex items-center justify-center p-4 sm:p-0 relative overflow-hidden">
    <!-- Background elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-20 left-20 w-64 h-64 bg-blue-200 rounded-full opacity-10 mix-blend-multiply filter blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-20 w-64 h-64 bg-blue-300 rounded-full opacity-10 mix-blend-multiply filter blur-3xl animate-float animation-delay-2000"></div>
    </div>
    
    <!-- Wave decoration -->
    <div class="auth-wave">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
        </svg>
    </div>

    <!-- Main content -->
    <main class="animate-fade-in w-full max-w-md z-10">
        @yield('content')
    </main>

    <!-- Scripts -->
    <script>
        // Enhanced input interactions
        document.querySelectorAll('input').forEach(input => {
            // Focus effects
            input.addEventListener('focus', () => {
                const parent = input.parentElement;
                parent.classList.add('ring-2', 'ring-blue-200', 'rounded-lg');
                parent.querySelector('label')?.classList.add('text-blue-600');
            });
            
            input.addEventListener('blur', () => {
                const parent = input.parentElement;
                parent.classList.remove('ring-2', 'ring-blue-200', 'rounded-lg');
                parent.querySelector('label')?.classList.remove('text-blue-600');
            });
            
            // Auto add floating label effect if input has value
            if (input.value) {
                input.parentElement.querySelector('label')?.classList.add('text-blue-600');
            }
            
            input.addEventListener('input', () => {
                const label = input.parentElement.querySelector('label');
                if (label) {
                    label.classList.toggle('text-blue-600', input.value.length > 0);
                }
            });
        });
        
        // Toast notification for auth messages
        @if (session('status') || $errors->any())
            document.addEventListener('DOMContentLoaded', () => {
                setTimeout(() => {
                    const toast = document.createElement('div');
                    toast.className = 'fixed top-4 right-4 px-6 py-4 rounded-lg shadow-lg bg-white border-l-4 {{ session('status') ? 'border-green-500' : 'border-red-500' }} text-gray-800 z-50 transform transition-all duration-300 translate-x-0 opacity-100';
                    toast.innerHTML = `
                        <div class="flex items-center">
                            <div class="mr-4">
                                <svg class="h-6 w-6 {{ session('status') ? 'text-green-500' : 'text-red-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ session('status') ? 'M5 13l4 4L19 7' : 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' }}" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">{{ session('status') ? session('status') : 'Whoops! Something went wrong.' }}</p>
                                @if ($errors->any())
                                    <ul class="mt-1 text-sm">
                                        @foreach ($errors->all() as $error)
                                            <li class="text-red-600">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    `;
                    
                    document.body.appendChild(toast);
                    
                    setTimeout(() => {
                        toast.classList.add('translate-x-full', 'opacity-0');
                        setTimeout(() => toast.remove(), 300);
                    }, 5000);
                }, 300);
            });
        @endif
    </script>
</body>
</html>