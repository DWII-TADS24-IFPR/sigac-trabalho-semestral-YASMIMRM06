@extends('layouts.admin')

@section('title', 'Relatório de Horas')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Relatório de Horas Complementares</h1>
        <button class="d-none d-sm-inline-block btn btn-primary shadow-sm" onclick="window.print()">
            <i class="fas fa-print fa-sm text-white-50"></i> Imprimir Relatório
        </button>
    </div>

    <!-- Filtros -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filtrar Relatório</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.reports.hours') }}">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="course" class="form-label">Curso</label>
                        <select class="form-select" id="course" name="course">
                            <option value="">Todos os Cursos</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ request('course') == $course->id ? 'selected' : '' }}>
                                    {{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="class" class="form-label">Turma</label>
                        <select class="form-select" id="class" name="class">
                            <option value="">Todas as Turmas</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ request('class') == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">Todos</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completos</option>
                            <option value="incomplete" {{ request('status') == 'incomplete' ? 'selected' : '' }}>Incompletos</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">Data Inicial</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">Data Final</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-filter"></i> Filtrar
                    </button>
                    <a href="{{ route('admin.reports.hours') }}" class="btn btn-secondary">
                        <i class="fas fa-sync-alt"></i> Limpar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Resultados -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Resultados</h6>
            <div>
                <a href="{{ route('admin.reports.export') }}?{{ http_build_query(request()->query()) }}" 
                   class="btn btn-sm btn-success">
                    <i class="fas fa-file-excel"></i> Exportar para Excel
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Aluno</th>
                            <th>Matrícula</th>
                            <th>Curso</th>
                            <th>Turma</th>
                            <th>Horas Aprovadas</th>
                            <th>Horas Necessárias</th>
                            <th>Progresso</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->registration }}</td>
                            <td>{{ $student->course->name ?? 'N/A' }}</td>
                            <td>{{ $student->class->name ?? 'N/A' }}</td>
                            <td>{{ $student->approved_hours }}</td>
                            <td>{{ $student->required_hours }}</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" 
                                         style="width: {{ $student->progress }}%" 
                                         aria-valuenow="{{ $student->progress }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100"></div>
                                </div>
                                <small>{{ $student->progress }}%</small>
                            </td>
                            <td>
                                @if($student->progress >= 100)
                                    <span class="badge bg-success">Completo</span>
                                @else
                                    <span class="badge bg-warning text-dark">Incompleto</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Paginação -->
            <div class="d-flex justify-content-center mt-4">
                {{ $students->links() }}
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Distribuição por Curso</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="courseChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        @foreach($courseStats as $stat)
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color: {{ $stat['color'] }}"></i> {{ $stat['name'] }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status de Conclusão</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="statusChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Completos
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Incompletos
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Gráfico de distribuição por curso
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById("courseChart").getContext('2d');
        var courseChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_column($courseStats, 'name')) !!},
                datasets: [{
                    data: {!! json_encode(array_column($courseStats, 'count')) !!},
                    backgroundColor: {!! json_encode(array_column($courseStats, 'color')) !!},
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                cutout: '70%',
            },
        });

        // Gráfico de status
        var ctx2 = document.getElementById("statusChart").getContext('2d');
        var statusChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Completos', 'Incompletos'],
                datasets: [{
                    data: [{{ $completedCount }}, {{ $incompleteCount }}],
                    backgroundColor: ['#10B981', '#F59E0B'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
            },
        });
    });
</script>
@endpush

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .card, .card * {
            visibility: visible;
        }
        .card {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none !important;
            box-shadow: none !important;
        }
        .no-print {
            display: none !important;
        }
    }
</style>
@endsection