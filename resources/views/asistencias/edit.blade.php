@extends('adminlte::page')

@section('title', 'Editar Asistencia')

@section('content_header')
    <h1>Edición de Observaciones de Asistencia</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Modificar Observaciones</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('asistencias.update', $asistencia->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Empleado (solo lectura) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Empleado</label>
                                    <input type="text" class="form-control" value="{{ $asistencia->empleado->nombre }}" disabled>
                                </div>
                            </div>

                            <!-- Fecha (solo lectura) -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d-m-Y') }}" disabled>
                                </div>
                            </div>

                            <!-- Estado (solo lectura) -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <input type="text" class="form-control" value="{{ ucfirst($asistencia->estado) }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Observaciones (editable) -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="observaciones">Observaciones</label>
                                    <textarea name="observaciones" id="observaciones" rows="4"
                                              class="form-control @error('observaciones') is-invalid @enderror"
                                              placeholder="Escriba alguna observación...">{{ old('observaciones', $asistencia->observaciones) }}</textarea>
                                    @error('observaciones')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <hr>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa-solid fa-check"></i> Guardar
                                </button>
                                <a href="{{ route('asistencias.index') }}" class="btn btn-secondary">
                                    <i class="fa-solid fa-ban"></i> Cancelar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .form-group label {
            font-weight: bold;
        }
    </style>
@stop

@section('js')
    <script>
        @if (session('success'))
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Error en el formulario',
                html: `
                    <ul style="text-align: left;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonText: 'Aceptar'
            });
        @endif
    </script>
@stop
