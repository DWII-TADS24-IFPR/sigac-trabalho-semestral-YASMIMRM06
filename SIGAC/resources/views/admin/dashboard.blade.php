@extends('layouts.admin')

@section('title', 'Dashboard - Admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Administrativo</h1>
        <a href="{{ route('admin.reports.hours') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Gerar Relatório
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Total de Alunos -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total de Alunos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalStudents }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Solicitações Pendentes -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Solicitações Pendentes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingActivities }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Horas Aprovadas (Mês) -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Horas Aprovadas (Mês)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $approvedHoursThisMonth }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cursos Cadastrados -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Cursos Cadastrados</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCourses }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Gráfico de Atividades -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Atividades por Status (Últimos 6 Meses)</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Opções:</div>
                            <a class="dropdown-item" href="{{ route('admin.activities.index') }}">Ver Todas Atividades</a>
                            <a class="dropdown-item" href="{{ route('admin.reports.hours') }}">Gerar Relatório</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="activitiesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Últimas Solicitações -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Últimas Solicitações</h6>
                    <a href="{{ route('admin.activities.index') }}" class="btn btn-sm btn-primary">Ver Todas</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="list-group">
                        @forelse($recentActivities as $activity)
                        <a href="{{ route('admin.activities.review', $activity->id) }}" 
                           class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ $activity->student->name }}</h6>
                                <small class="text-{{ $activity->status == 'approved' ? 'success' : ($activity->status == 'rejected' ? 'danger' : 'warning') }}">
                                    {{ $activity->status == 'approved' ? 'Aprovado' : ($activity->status == 'rejected' ? 'Rejeitado' : 'Pendente') }}
                                </small>
                            </div>
                            <p class="mb-1">{{ Str::limit($activity->description, 40) }}</p>
                            <small>{{ $activity->hours }} horas - {{ $activity->created_at->format('d/m/Y') }}</small>
                        </a>
                        @empty
                        <div class="list-group-item">
                            Nenhuma atividade recente
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Gráfico de atividades
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById("activitiesChart").getContext('2d');
    var activitiesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartMonths) !!},
            datasets: [
                {
                    label: 'Aprovadas',
                    backgroundColor: '#10B981',
                    data: {!! json_encode($chartApproved) !!}
                },
                {
                    label: 'Rejeitadas',
                    backgroundColor: '#EF4444',
                    data: {!! json_encode($chartRejected) !!}
                },
                {
                    label: 'Pendentes',
                    backgroundColor: '#F59E0B',
                    data: {!! json_encode($chartPending) !!}
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true,
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endpush