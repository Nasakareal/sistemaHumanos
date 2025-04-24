@extends('adminlte::page')

@section('title', 'Asignar Tarjeta RFID')

@section('content_header')
    <h1>Asignar Tarjeta RFID a {{ $empleado->nombre }}</h1>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Empleado: {{ $empleado->nombre }}</h3>
            <div class="card-tools">
                <a href="{{ route('empleados.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('empleados.guardar_rfid', $empleado->id) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="rfid_uid" class="fw-bold">UID de la Tarjeta RFID</label>
                    <input
                        type="text"
                        name="rfid_uid"
                        id="rfid_uid"
                        class="form-control @error('rfid_uid') is-invalid @enderror"
                        placeholder="Ejemplo: 1AF38FDD"
                        value="{{ old('rfid_uid', $empleado->rfid_uid) }}"
                        required
                    >
                    @error('rfid_uid')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save"></i> Guardar Tarjeta
                </button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Aquí puedes añadir estilos adicionales si los necesitas */
    </style>
@stop

@section('js')
<script>
    // Consulta UID del archivo puente cada segundo
    setInterval(() => {
        fetch('/sistemaHumanos/public/puente.php')
            .then(res => res.text())
            .then(uid => {
                if (uid.trim() !== '') {
                    document.getElementById('rfid_uid').value = uid.trim().toUpperCase();
                }
            });
    }, 1000); // cada segundo
</script>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif
@stop


