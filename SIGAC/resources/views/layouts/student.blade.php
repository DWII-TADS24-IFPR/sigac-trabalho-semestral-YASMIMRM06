<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Metatags e includes do head -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('partials.header') <!-- Se existir -->
    
    <main class="py-4">
        @yield('content')
    </main>
    
    @include('partials.footer') <!-- Inclui o footer -->
</body>
</html>