<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <!-- Link SIGAC (logo) apontando para welcome -->
        <a class="navbar-brand" href="{{ route('welcome') }}">SIGAC</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <!-- Link Home apontando para welcome quando não autenticado, ou home quando autenticado -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ auth()->check() ? route('home') : route('welcome') }}">Home</a>
                </li>
                
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('atividades.index') }}">Atividades</a>
                    </li>
                @endauth
            </ul>
            
            <!-- Restante do código do header -->
        </div>
    </div>
</nav>