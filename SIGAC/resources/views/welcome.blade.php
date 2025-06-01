<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGAC - Sistema de Gestão de Atividades Complementares</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .hero-section {
            background: linear-gradient(135deg, #003366 0%, #006633 100%);
            color: white;
            padding: 5rem 0;
        }
        .feature-icon {
            font-size: 2.5rem;
            color: #006633;
            margin-bottom: 1rem;
        }
        .btn-sigac {
            background-color: #006633;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 0.3rem;
            transition: all 0.3s;
        }
        .btn-sigac:hover {
            background-color: #004d26;
            color: white;
            transform: translateY(-2px);
        }
        .footer {
            background-color: #f8f9fa;
            padding: 2rem 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/ifpr-logo.png') }}" alt="IFPR" height="50">
                <span class="ms-2 fw-bold">SIGAC</span>
            </a>
            <div class="d-flex">
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Entrar</a>
                <a href="{{ route('register') }}" class="btn btn-sigac">Cadastre-se</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-4">Sistema de Gestão de Atividades Complementares</h1>
            <p class="lead mb-5">Gerencie suas horas complementares de forma simples e eficiente</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('login') }}" class="btn btn-light btn-lg px-4">Acessar Sistema</a>
                <a href="#features" class="btn btn-outline-light btn-lg px-4">Saiba Mais</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Recursos do SIGAC</h2>
                <p class="text-muted">Tudo que você precisa para gerenciar suas atividades complementares</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h4 class="card-title">Registro de Horas</h4>
                            <p class="card-text text-muted">Registre suas atividades complementares e acompanhe seu progresso em tempo real.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon">
                                <i class="fas fa-file-upload"></i>
                            </div>
                            <h4 class="card-title">Envio de Documentos</h4>
                            <p class="card-text text-muted">Anexe os documentos comprobatórios diretamente no sistema.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <h4 class="card-title">Relatórios</h4>
                            <p class="card-text text-muted">Acompanhe seu progresso com relatórios e gráficos detalhados.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Como funciona?</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex">
                            <span class="me-3 text-primary fw-bold">1</span>
                            <span>Faça login no sistema com suas credenciais</span>
                        </li>
                        <li class="mb-3 d-flex">
                            <span class="me-3 text-primary fw-bold">2</span>
                            <span>Registre suas atividades complementares</span>
                        </li>
                        <li class="mb-3 d-flex">
                            <span class="me-3 text-primary fw-bold">3</span>
                            <span>Anexe os documentos comprobatórios</span>
                        </li>
                        <li class="mb-3 d-flex">
                            <span class="me-3 text-primary fw-bold">4</span>
                            <span>Acompanhe o status da validação</span>
                        </li>
                        <li class="d-flex">
                            <span class="me-3 text-primary fw-bold">5</span>
                            <span>Emita sua declaração de horas quando completar</span>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('images/how-it-works.png') }}" alt="Como funciona" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="fw-bold">SIGAC</h5>
                    <p class="text-muted">Sistema de Gestão de Atividades Complementares do IFPR - Campus Paranaguá</p>
                </div>
                <div class="col-lg-3">
                    <h5 class="fw-bold">Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('login') }}" class="text-decoration-none text-muted">Login</a></li>
                        <li><a href="{{ route('register') }}" class="text-decoration-none text-muted">Cadastro</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Termos de Uso</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5 class="fw-bold">Contato</h5>
                    <ul class="list-unstyled text-muted">
                        <li><i class="fas fa-map-marker-alt me-2"></i> Paranaguá - PR</li>
                        <li><i class="fas fa-envelope me-2"></i> sigac@ifpr.edu.br</li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center text-muted">
                <small>© {{ date('Y') }} IFPR - Instituto Federal do Paraná. Todos os direitos reservados.</small>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>