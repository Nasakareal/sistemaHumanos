@extends('adminlte::page')

@section('title', 'Listado de Empleados')

@section('content_header')
    <h1>Listado de Empleados</h1>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Empleados</h3>
            <div class="card-tools">
                <a href="{{ route('empleados.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Crear Empleado
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- Filtro opcional por Área de Adscripción -->
            <form method="GET" action="{{ route('empleados.index') }}" class="mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <label for="area_adscripcion" class="col-form-label fw-bold">Filtrar por área:</label>
                    </div>
                    <div class="col-auto">
                        <select name="area_adscripcion" id="area_adscripcion" class="form-select">
                            <option value="">Todas las áreas</option>
                            @foreach($areas as $area)
                                <option value="{{ $area }}" {{ request('area_adscripcion') == $area ? 'selected' : '' }}>
                                    {{ $area }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </div>
                </div>
            </form>

            <!-- Mostrar total de empleados -->
            <div class="alert alert-info">
                <strong>Total de empleados:</strong> {{ $totalEmpleados }}
            </div>

            <!-- Tabla de Empleados -->
            <table id="empleados_table" class="table table-striped table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Puesto</th>
                        <th>Área de Adscripción</th>
                        <th>Correo Electrónico</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Fecha de Ingreso</th>
                        <!-- Columna de Acciones: no se exporta -->
                        <th class="noExport">Acciones</th>
                    </tr>
                </thead>
                <tbody>
    @foreach ($empleados as $emp)
        <tr>
            <td>{{ $emp->id }}</td>
            <td>{{ $emp->nombre }}</td>
            <td>{{ $emp->puesto }}</td>
            <td>{{ $emp->area_adscripcion }}</td>
            <td>{{ $emp->correo_electronico }}</td>
            <td>{{ $emp->fecha_nacimiento ? \Carbon\Carbon::parse($emp->fecha_nacimiento)->format('d-m-Y') : '' }}</td>
            <td>{{ $emp->fecha_ingreso ? \Carbon\Carbon::parse($emp->fecha_ingreso)->format('d-m-Y') : '' }}</td>
            <td class="noExport">
                <div class="btn-group" role="group">
                    <!-- Ver -->
                    <a href="{{ route('empleados.show', $emp->id) }}" class="btn btn-info btn-sm" title="Ver empleado">
                        <i class="fa-regular fa-eye"></i>
                    </a>

                    <!-- Editar -->
                    <a href="{{ route('empleados.edit', $emp->id) }}" class="btn btn-success btn-sm" title="Editar empleado">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>

                    <!-- Documentos -->
                    <a href="{{ route('documentos.index', $emp->id) }}" class="btn btn-warning btn-sm" title="Ver documentos">
                        <i class="fa-solid fa-folder-open"></i>
                    </a>

                    <!-- Asignar RFID -->
                    <a href="{{ route('empleados.asignar_rfid', $emp->id) }}" class="btn btn-primary btn-sm" title="Asignar tarjeta RFID">
                        <i class="fa-solid fa-id-badge"></i>
                    </a>

                    <!-- Eliminar -->
                    <form action="{{ route('empleados.destroy', $emp->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm delete-btn" title="Eliminar empleado">
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
