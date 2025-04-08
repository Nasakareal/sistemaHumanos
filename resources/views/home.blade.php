@extends('adminlte::page')

@section('title', 'Sistema de Recursos Humanos')

@section('content_header')
    <center><h1>Dashboard - Recursos Humanos</h1></center>
@stop

@section('content')
    <!-- Tarjetas resumen -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card metric-card">
                <div class="card-body">
                    <h5 class="card-title">Total de Empleados</h5>
                    <h2 id="totalEmpleados">--</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card metric-card">
                <div class="card-body">
                    <h5 class="card-title">Vacaciones Pendientes</h5>
                    <h2 id="vacacionesPendientes">--</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card metric-card">
                <div class="card-body">
                    <h5 class="card-title">Documentos Completos</h5>
                    <h2 id="documentosCompletos">--</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card metric-card">
                <div class="card-body">
                    <h5 class="card-title">Próximos Cumpleaños</h5>
                    <h2 id="proximosCumple">--</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos y análisis -->
    <div class="row" id="chartsContainer">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Distribución de Empleados por Departamento
                </div>
                <div class="card-body">
                    <canvas id="departamentosChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Estado de Solicitudes de Vacaciones
                </div>
                <div class="card-body">
                    <canvas id="vacacionesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .metric-card {
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Llama a la ruta que retorna los datos JSON
            fetch("{{ route('dashboard.json') }}", {
                headers: { "Authorization": "Bearer {{ csrf_token() }}" }
            })
            .then(response => response.json())
            .then(data => {
                // Actualización de tarjetas
                document.getElementById("totalEmpleados").innerText = data.totalEmpleados;
                document.getElementById("vacacionesPendientes").innerText = data.vacacionesPendientes;
                document.getElementById("documentosCompletos").innerText = data.documentosCompletos;
                document.getElementById("proximosCumple").innerText = data.proximosCumple;

                // Gráfico de departamentos (tipo Pie)
                const ctxDept = document.getElementById('departamentosChart').getContext('2d');
                new Chart(ctxDept, {
                    type: 'pie',
                    data: {
                        labels: data.departamentos.labels, // Ej. ["Ventas", "RRHH", "TI", ...]
                        datasets: [{
                            data: data.departamentos.data,       // Ej. [25, 30, 45, ...]
                            backgroundColor: data.departamentos.colors // Colores personalizados para cada departamento
                        }]
                    },
                    options: { responsive: true }
                });

                // Gráfico de vacaciones (tipo Doughnut)
                const ctxVac = document.getElementById('vacacionesChart').getContext('2d');
                new Chart(ctxVac, {
                    type: 'doughnut',
                    data: {
                        labels: ["Aprobadas", "Pendientes"],
                        datasets: [{
                            data: [data.vacacionesAprobadas, data.vacacionesPendientes],
                            backgroundColor: ["#28a745", "#ffc107"]
                        }]
                    },
                    options: {
                        responsive: true,
                        cutout: "70%"
                    }
                });
            })
            .catch(error => {
                console.error("Error al cargar datos:", error);
                document.getElementById("chartsContainer").innerHTML = `<div class='col-12 text-center'><p class='text-danger'>Error al cargar los datos.</p></div>`;
            });
        });
    </script>
@stop
