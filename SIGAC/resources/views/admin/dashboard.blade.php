@extends('layouts.admin')

@section('title', 'Dashboard Administrativo')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Dashboard Administrativo</h2>
            
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">Atividades Pendentes</h5>
                            <p class="card-text display-4">{{ $pendingActivities }}</p>
                            <a href="{{ route('admin.activities.index') }}" class="text-white">
                                Ver todas <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Alunos Cadastrados</h5>
                            <p class="card-text display-4">{{ $studentsCount }}</p>
                            <a href="{{ route('admin.students.index') }}" class="text-white">
                                Gerenciar alunos <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <h5 class="card-title">Cursos</h5>
                            <p class="card-text display-4">{{ count($courses) }}</p>
                            <a href="{{ route('admin.categories.index') }}" class="text-white">
                                Gerenciar cursos <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5>Distribuição de Alunos por Curso</h5>
                </div>
                <div class="card-body">
                    <canvas id="coursesChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('coursesChart').getContext('2d');
    const coursesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($courses->pluck('name')),
            datasets: [{
                label: 'Alunos por Curso',
                data: @json($courses->pluck('students_count')),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
@endsection