@extends('adminlte::page')

@section('title', 'Agregar Documento')

@section('content_header')
    <h1>Agregar Documento para {{ $empleado->nombre }}</h1>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Nuevo Documento</h3>
            <div class="card-tools">
                <a href="{{ route('documentos.index', $empleado->id) }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('documentos.store', $empleado->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="tipo">Tipo de Documento</label>
                    <input type="text" name="tipo" id="tipo" class="form-control" value="{{ request('tipo') }}" readonly>
                </div>

                <div class="form-group">
                    <label for="fecha_entrega">Fecha de Entrega</label>
                    <input type="date" name="fecha_entrega" id="fecha_entrega"
                        class="form-control @error('fecha_entrega') is-invalid @enderror" value="{{ old('fecha_entrega') }}">
                    @error('fecha_entrega')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea name="observaciones" id="observaciones" rows="3"
                        class="form-control @error('observaciones') is-invalid @enderror"
                        placeholder="Observaciones sobre el documento">{{ old('observaciones') }}</textarea>
                    @error('observaciones')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="archivo">Archivo (PDF o imagen)</label>
                    <input type="file" name="archivo" id="archivo"
                        class="form-control @error('archivo') is-invalid @enderror" accept=".pdf,.jpg,.jpeg,.png">
                    @error('archivo')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Guardar
                    </button>
                </div>
            </form>
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
