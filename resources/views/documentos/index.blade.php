@extends('adminlte::page')

@section('title', 'Documentos del Empleado')

@section('content_header')
    <h1>Documentación de {{ $empleado->nombre }}</h1>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Revisión de Documentos</h3>
            <div class="card-tools">
                <a href="{{ route('empleados.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th class="text-center">Entregado</th>
                        <th class="text-center">Fecha de Entrega</th>
                        <th class="text-center">Observaciones</th>
                        <th class="text-center">Archivo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipos as $tipo)
                        @php
                            $doc = $empleado->documentos->firstWhere('tipo', $tipo);
                        @endphp
                        <tr>
                            <td>{{ $tipo }}</td>
                            <td class="text-center">
                                @if ($doc)
                                    <span class="badge bg-success">Sí</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                            <td class="text-center">
                                {{ $doc && $doc->fecha_entrega ? \Carbon\Carbon::parse($doc->fecha_entrega)->format('d/m/Y') : '-' }}
                            </td>
                            <td class="text-center">
                                {{ $doc->observaciones ?? '-' }}
                            </td>
                            <td class="text-center">
                                @if ($doc && $doc->ruta_archivo)
                                    <a href="{{ route('documentos.descargar', [$empleado->id, $doc->id]) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                @else
                                    <span class="text-muted">No disponible</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($doc)
                                    <a href="{{ route('documentos.edit', [$empleado->id, $doc->id]) }}" class="btn btn-sm btn-success" title="Editar">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('documentos.destroy', [$empleado->id, $doc->id]) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este documento?')">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('documentos.create', $empleado->id) }}?tipo={{ urlencode($tipo) }}" class="btn btn-sm btn-primary" title="Agregar">
                                        <i class="fa-solid fa-plus"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
            $('#documentos').DataTable({
                "dom": '<"row"<"col-sm-6"l><"col-sm-6"Bf>>rtip',
                "pageLength": 10,
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
                "language": {
                    "emptyTable": "No hay información disponible",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Documentos",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Documentos",
                    "infoFiltered": "(filtrado de _MAX_ Documentos en total)",
                    "lengthMenu": "Mostrar _MENU_ Documentos",
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
                title: '¿Estás seguro de eliminar este Documento?',
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
