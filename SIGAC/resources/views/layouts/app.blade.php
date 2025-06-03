<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | SIGAC - IFPR</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <div id="app">
        @include('partials.navbar')
        
        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
        
        @include('partials.footer')
    </div>
</body>
</html>