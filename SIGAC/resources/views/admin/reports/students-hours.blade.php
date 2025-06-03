@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col">
            <h2>Relatório de Horas por Aluno</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Relatórios</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Horas Complementares por Aluno</h5>
        </div>
        
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="course" class="form-label">Filtrar por Curso:</label>
                    <select id="course" class="form-select">
                        <option value="">Todos os Cursos</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="class" class="form-label">Filtrar por Turma:</label>
                    <select id="class" class="form-select">
                        <option value="">Todas as Turmas</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button id="filter-btn" class="btn btn-primary w-100">
                        <i class="fas fa-filter me-2"></i> Filtrar
                    </button>
                </div>
            </div>

            <div class="chart-container" style="height: 400px;">
                <canvas id="hoursChart"></canvas>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@vite(['resources/js/chart.js'])
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('hoursChart').getContext('2d');
        const hoursChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($students->pluck('name')),
                datasets: [{
                    label: 'Horas Aprovadas',
                    data: @json($students->pluck('total_approved_hours')),
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }, {
                    label: 'Horas Pendentes',
                    data: @json($students->pluck('total_pending_hours')),
                    backgroundColor: 'rgba(255, 206, 86, 0.7)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Horas'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Alunos'
                        }
                    }
                }
            }
        });

        // Filtros
        document.getElementById('filter-btn').addEventListener('click', function() {
            const courseId = document.getElementById('course').value;
            const classId = document.getElementById('class').value;
            
            // Aqui você implementaria a lógica para filtrar os dados
            // Pode ser via AJAX ou recarregando a página com parâmetros
            console.log('Filtrar por:', courseId, classId);
        });
    });
</script>
@endsection
@endsection