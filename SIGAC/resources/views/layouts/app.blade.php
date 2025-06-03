<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGAC - @yield('title', 'Sistema de Gestão de Atividades Complementares')</title>
    
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6.4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #006633;
            --secondary-color: #003366;
            --light-color: #f8f9fa;
        }
        
        .sigac-navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .sigac-hero {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            color: white;
            padding: 3rem 0;
        }
        
        .btn-sigac {
            background-color: var(--primary-color);
            color: white;
            border: none;
            transition: all 0.3s;
        }
        
        .btn-sigac:hover {
            background-color: #004d26;
            transform: translateY(-2px);
            color: white;
        }
        
        .sigac-card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .sigac-card:hover {
            transform: translateY(-5px);
        }
        
        .sigac-footer {
            background-color: var(--light-color);
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sigac-navbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/ifpr-logo.png') }}" alt="IFPR" height="40" class="d-inline-block align-top">
                <span class="ms-2 fw-bold">SIGAC</span>
            </a>
            
            <div class="d-flex">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Sair</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Entrar</a>
                    <a href="{{ route('register') }}" class="btn btn-sigac">Cadastre-se</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="sigac-footer py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h5 class="fw-bold">SIGAC</h5>
                    <p class="text-muted mb-0">Sistema de Gestão de Atividades Complementares</p>
                </div>
                
                <div class="col-md-3 mb-4 mb-md-0">
                    <h5 class="fw-bold">Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('login') }}" class="text-decoration-none text-muted">Login</a></li>
                        <li class="mb-2"><a href="{{ route('register') }}" class="text-decoration-none text-muted">Cadastro</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Termos de Uso</a></li>
                    </ul>
                </div>
                
                <div class="col-md-3">
                    <h5 class="fw-bold">Contato</h5>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Paranaguá - PR</li>
                        <li><i class="fas fa-envelope me-2"></i> sigac@ifpr.edu.br</li>
                    </ul>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="text-center text-muted">
                <small>© {{ date('Y') }} IFPR - Instituto Federal do Paraná</small>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>