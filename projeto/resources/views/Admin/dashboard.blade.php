@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Dashboard Administrativo</h2>
    
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Atividades Pendentes</h5>
                    <p class="card-text display-4">{{ $pendingCount }}</p>
                    <a href="{{ route('admin.activities') }}" class="text-white">Ver todas</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Alunos Cadastrados</h5>
                    <p class="card-text display-4">{{ $studentsCount }}</p>
                    <a href="{{ route('admin.students') }}" class="text-white">Ver todos</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            Horas Complementares por Curso
        </div>
        <div class="card-body">
            <canvas id="coursesChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('coursesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($courses->pluck('name')),
            datasets: [{
                label: 'Horas Complementares',
                data: @json($courses->pluck('activities_count')),
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
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