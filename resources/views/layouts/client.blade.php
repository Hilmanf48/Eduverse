<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Eduverse')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-stone-50 text-gray-800">

    
    <div class="flex flex-col min-h-screen">
        @include('client.partials.navbar')
        <main class="flex-grow">
            @yield('content')
        </main>
        @include('client.partials.footer')
    </div>
    @stack('scripts')
</body>
</html>