<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Eduverse')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Sembunyikan kursor asli di body, tapi tampilkan di elemen interaktif */
        body 
        a, button, input { cursor: pointer; }

        #custom-cursor {
            position: fixed;
            pointer-events: none;
            width: 30px;
            height: 30px;
            border: 2px solid #3b82f6; /* Biru */
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: transform 0.1s ease-out;
            z-index: 9999;
        }
    </style>
</head>
<body class="font-sans antialiased bg-stone-50 text-gray-800">
    
    <div id="custom-cursor"></div>

    <div class="flex flex-col min-h-screen">
        
        {{-- PINDAHKAN NAVBAR KE SINI --}}
        @include('client.partials.navbar')

        <main class="flex-grow">
            @yield('content')
        </main>
        
        @include('client.partials.footer')

    </div>
    
    @stack('scripts')

    <script>
        const cursor = document.getElementById('custom-cursor');
        if (cursor) {
            window.addEventListener('mousemove', (e) => {
                cursor.style.left = e.clientX + 'px';
                cursor.style.top = e.clientY + 'px';
            });
        }
    </script>
</body>
</html>