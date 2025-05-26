<div class="sidebar bg-white shadow-sm" id="sidebar">
    <div class="d-flex flex-column h-100">
        <!-- Sidebar Header -->
        <div class="p-3 border-bottom">
            <h4 class="text-center mb-0">{{ config('app.name') }}</h4>
        </div>
        
        <!-- Sidebar Menu -->
        <div class="flex-grow-1 overflow-auto">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home me-2"></i> Dashboard
                    </a>
                </li>
                
                <!-- Alunos -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('alunos.*') ? 'active' : '' }}" href="{{ route('alunos.index') }}">
                        <i class="fas fa-users me-2"></i> Alunos
                    </a>
                </li>
                
                <!-- Cursos -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cursos.*') ? 'active' : '' }}" href="{{ route('cursos.index') }}">
                        <i class="fas fa-graduation-cap me-2"></i> Cursos
                    </a>
                </li>
                
                <!-- Turmas -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('turmas.*') ? 'active' : '' }}" href="{{ route('turmas.index') }}">
                        <i class="fas fa-chalkboard me-2"></i> Turmas
                    </a>
                </li>
                
                <!-- Níveis -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('niveis.*') ? 'active' : '' }}" href="{{ route('niveis.index') }}">
                        <i class="fas fa-layer-group me-2"></i> Níveis
                    </a>
                </li>
                
                <!-- Documentos - Collapsible Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-toggle="collapse" href="#documentosMenu">
                        <i class="fas fa-file-alt me-2"></i> Documentos
                        <i class="fas fa-angle-down ms-auto"></i>
                    </a>
                    <div class="collapse {{ request()->routeIs('documentos.*') || request()->routeIs('categorias.*') || request()->routeIs('comprovantes.*') ? 'show' : '' }}" id="documentosMenu">
                        <ul class="nav flex-column ps-4">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('documentos.*') ? 'active' : '' }}" href="{{ route('documentos.index') }}">
                                    <i class="fas fa-file me-2"></i> Tipos de Documentos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('categorias.*') ? 'active' : '' }}" href="{{ route('categorias.index') }}">
                                    <i class="fas fa-tags me-2"></i> Categorias
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('comprovantes.*') ? 'active' : '' }}" href="{{ route('comprovantes.index') }}">
                                    <i class="fas fa-file-upload me-2"></i> Comprovantes
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <!-- Declarações -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('declaracoes.*') ? 'active' : '' }}" href="{{ route('declaracoes.index') }}">
                        <i class="fas fa-file-signature me-2"></i> Declarações
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Sidebar Footer -->
        <div class="p-3 border-top text-center">
            <small class="text-muted">v1.0.0</small>
        </div>
    </div>
</div>