@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
            <div class="position-sticky pt-3">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/ifpr-logo-white.png') }}" alt="IFPR" class="img-fluid" style="max-height: 80px;">
                    <h6 class="text-white mt-2">{{ Auth::user()->name }}</h6>
                    <small class="text-muted">Administrador</small>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                           href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('admin.students.*') ? 'active' : '' }}" 
                           href="{{ route('admin.students.index') }}">
                            <i class="fas fa-users me-2"></i> Alunos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('admin.activities.*') ? 'active' : '' }}" 
                           href="{{ route('admin.activities.index') }}">
                            <i class="fas fa-tasks me-2"></i> Solicitações
                            @if($pendingCount > 0)
                                <span class="badge bg-danger rounded-pill ms-1">{{ $pendingCount }}</span>
                            @endif
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('admin.courses.*', 'admin.classes.*', 'admin.categories.*') ? 'active' : '' }}" 
                           data-bs-toggle="collapse" href="#configMenu">
                            <i class="fas fa-cog me-2"></i> Configurações
                        </a>
                        <div class="collapse {{ request()->routeIs('admin.courses.*', 'admin.classes.*', 'admin.categories.*') ? 'show' : '' }}" id="configMenu">
                            <ul class="nav flex-column ps-4">
                                <li class="nav-item">
                                    <a class="nav-link text-white {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}" 
                                       href="{{ route('admin.courses.index') }}">
                                        <i class="fas fa-graduation-cap me-2"></i> Cursos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white {{ request()->routeIs('admin.classes.*') ? 'active' : '' }}" 
                                       href="{{ route('admin.classes.index') }}">
                                        <i class="fas fa-users-class me-2"></i> Turmas
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" 
                                       href="{{ route('admin.categories.index') }}">
                                        <i class="fas fa-tags me-2"></i> Categorias
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" 
                           href="{{ route('admin.reports.hours') }}">
                            <i class="fas fa-chart-bar me-2"></i> Relatórios
                        </a>
                    </li>
                </ul>
                
                <hr class="text-white mt-4">
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i> Sair
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            @include('components.alerts')
            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">@yield('title')</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    @yield('actions')
                </div>
            </div>
            
            @yield('main-content')
        </main>
    </div>
</div>
@endsection

@push('styles')
<style>
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 48px 0 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }
    
    .nav-link {
        font-weight: 500;
        color: #adb5bd;
    }
    
    .nav-link.active {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.1);
    }
    
    .nav-link:hover {
        color: #fff;
    }
    
    @media (max-width: 767.98px) {
        .sidebar {
            top: 5rem;
        }
    }
</style>
@endpush