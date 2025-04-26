@extends('adminlte::page')

@section('title', 'Listado de Asistencias')

@section('content_header')
    <h1>Listado de Asistencias</h1>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Asistencias</h3>
            <div class="card-tools">
                <a href="{{ route('asistencias.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Registrar Asistencia
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Filtro opcional por Fecha -->
            <form method="GET" action="{{ route('asistencias.index') }}" class="mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <label for="fecha" class="col-form-label fw-bold">Filtrar por fecha:</label>
                    </div>
                    <div class="col-auto">
                        <input type="date" name="fecha" id="fecha" class="form-control"
                            value="{{ request('fecha') }}">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </div>
                </div>
            </form>

            <!-- Tabla de Asistencias -->
            <table id="asistencias_table" class="table table-striped table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Empleado</th>
                        <th>Fecha</th>
                        <th>Hora Entrada</th>
                        <th>Hora Salida</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                        <th class="noExport">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($asistencias as $asistencia)
                    <tr>
                        <td>{{ $asistencia->id }}</td>
                        <td>{{ $asistencia->empleado ? $asistencia->empleado->nombre : 'Empleado no disponible' }}</td>
                        <td>{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d-m-Y') }}</td>
                        <td>{{ $asistencia->hora_entrada ?? '-' }}</td>
                        <td>{{ $asistencia->hora_salida ?? '-' }}</td>
                        <td>{{ ucfirst($asistencia->estado) }}</td>
                        <td>{{ $asistencia->observaciones ?? '-' }}</td>
                        <td class="noExport">
                            <div class="btn-group" role="group">

                                <!-- Editar -->
                                <a href="{{ route('asistencias.edit', $asistencia->id) }}" class="btn btn-success btn-sm" title="Editar asistencia">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>

                                <!-- Eliminar -->
                                <form action="{{ route('asistencias.destroy', $asistencia->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-btn" title="Eliminar asistencia">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop


@section('css')
    <style>
        /* Estilos personalizados */
    </style>
@stop

@section('js')
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#empleados_table').DataTable({
                "dom": '<"row"<"col-sm-6"l><"col-sm-6"Bf>>rtip',
                "pageLength": 10,
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
                "language": {
                    "emptyTable": "No hay información disponible",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Empleados",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Empleados",
                    "infoFiltered": "(filtrado de _MAX_ Empleados en total)",
                    "lengthMenu": "Mostrar _MENU_ Empleados",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron resultados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": [
                    {
                        extend: 'collection',
                        text: 'Opciones',
                        buttons: [
                            {
                                extend: 'copy',
                                text: 'Copiar',
                                exportOptions: {
                                    columns: ':not(.noExport)'
                                }
                            },
                            {
                                extend: 'pdf',
                                text: 'PDF',
                                exportOptions: {
                                    columns: ':not(.noExport)'
                                }
                            },
                            {
                                extend: 'csv',
                                text: 'CSV',
                                exportOptions: {
                                    columns: ':not(.noExport)'
                                }
                            },
                            {
                                extend: 'excel',
                                text: 'Excel',
                                exportOptions: {
                                    columns: ':not(.noExport)'
                                }
                            },
                            {
                                extend: 'print',
                                text: 'Imprimir',
                                exportOptions: {
                                    columns: ':not(.noExport)'
                                }
                            }
                        ]
                    },
                    {
                        extend: 'colvis',
                        text: 'Visor de columnas'
                    }
                ]
            });
        });

        @if (session('success'))
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        $(document).on('click', '.delete-btn', function (e) {
            e.preventDefault();
            var form = $(this).closest('form');
            Swal.fire({
                title: '¿Estás seguro de eliminar este Empleado?',
                text: "¡No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@stop
