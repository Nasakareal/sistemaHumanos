<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

// Rutas existentes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Nueva ruta para obtener los datos JSON desde HomeController
Route::get('/home/json', [App\Http\Controllers\HomeController::class, 'dashboardJson'])->name('dashboard.json');

// Ruta para el escaneo de QR
Route::get('/scan', function () {
    return view('scan.scan_qr');
})->middleware('auth')->name('scan.qr');


// Rutas para Empleados
Route::prefix('empleados')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\EmpleadoController::class, 'index'])->name('empleados.index');
    Route::get('/create', [App\Http\Controllers\EmpleadoController::class, 'create'])->middleware('can:crear empleados')->name('empleados.create');
    Route::post('/', [App\Http\Controllers\EmpleadoController::class, 'store'])->middleware('can:crear empleados')->name('empleados.store');
    Route::get('/{empleado}', [App\Http\Controllers\EmpleadoController::class, 'show'])->middleware('can:ver empleados')->name('empleados.show');
    Route::get('/{empleado}/edit', [App\Http\Controllers\EmpleadoController::class, 'edit'])->middleware('can:editar empleados')->name('empleados.edit');
    Route::put('/{empleado}', [App\Http\Controllers\EmpleadoController::class, 'update'])->middleware('can:editar empleados')->name('empleados.update');
    Route::delete('/{empleado}', [App\Http\Controllers\EmpleadoController::class, 'destroy'])->middleware('can:eliminar empleados')->name('empleados.destroy');
    Route::get('/{empleado}/asignar-tarjeta', [App\Http\Controllers\EmpleadoController::class, 'formAsignarTarjeta'])->middleware('can:editar empleados')->name('empleados.asignarTarjeta');
    Route::post('/{empleado}/guardar-tarjeta', [App\Http\Controllers\EmpleadoController::class, 'guardarTarjeta'])->middleware('can:editar empleados')->name('empleados.guardarTarjeta');
});



// Rutas para Empleados
Route::prefix('empleados')->middleware('auth')->group(function () {
    Route::get('/',   [App\Http\Controllers\EmpleadoController::class, 'index'])->name('empleados.index');
    Route::get('/create', [App\Http\Controllers\EmpleadoController::class, 'create'])->middleware('can:crear empleados')->name('empleados.create');
    Route::post('/',  [App\Http\Controllers\EmpleadoController::class, 'store'])->middleware('can:crear empleados')->name('empleados.store');
    Route::get('/{empleado}', [App\Http\Controllers\EmpleadoController::class, 'show'])->middleware('can:ver empleados')->name('empleados.show');
    Route::get('/{empleado}/edit',   [App\Http\Controllers\EmpleadoController::class, 'edit'])->middleware('can:editar empleados')->name('empleados.edit');
    Route::put('/{empleado}',        [App\Http\Controllers\EmpleadoController::class, 'update'])->middleware('can:editar empleados')->name('empleados.update');
    Route::delete('/{empleado}',     [App\Http\Controllers\EmpleadoController::class, 'destroy'])->middleware('can:eliminar empleados')->name('empleados.destroy');
    Route::get('/{empleado}/asignar-rfid',    [App\Http\Controllers\EmpleadoController::class, 'formAsignarTarjeta'])->middleware('can:editar empleados')->name('empleados.asignar_rfid');
    Route::post('/{empleado}/guardar-rfid',   [App\Http\Controllers\EmpleadoController::class, 'guardarTarjeta'])->middleware('can:editar empleados')->name('empleados.guardar_rfid');

    Route::prefix('{empleado}/documentos')->group(function () {
        Route::get('/',          [App\Http\Controllers\DocumentoController::class, 'index'])->name('documentos.index');
        Route::get('/create',    [App\Http\Controllers\DocumentoController::class, 'create'])->name('documentos.create');
        Route::post('/',         [App\Http\Controllers\DocumentoController::class, 'store'])->name('documentos.store');
        Route::get('/{documento}/edit', [App\Http\Controllers\DocumentoController::class, 'edit'])->name('documentos.edit');
        Route::put('/{documento}',      [App\Http\Controllers\DocumentoController::class, 'update'])->name('documentos.update');
        Route::delete('/{documento}',   [App\Http\Controllers\DocumentoController::class, 'destroy'])->name('documentos.destroy');
        Route::get('/{documento}/descargar', [App\Http\Controllers\DocumentoController::class, 'descargar'])->name('documentos.descargar');
    });
});


// Rutas para Requisiciones
Route::prefix('requisiciones')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\RequisicionesController::class, 'index'])->middleware('can:ver requisiciones')->name('requisiciones.index');
    Route::get('/create', [App\Http\Controllers\RequisicionesController::class, 'create'])->middleware('can:crear requisiciones')->name('requisiciones.create');
    Route::post('/', [App\Http\Controllers\RequisicionesController::class, 'store'])->middleware('can:crear requisiciones')->name('requisiciones.store');
    Route::get('/{requisicion}', [App\Http\Controllers\RequisicionesController::class, 'show'])->middleware('can:ver requisiciones')->name('requisiciones.show');
    Route::get('/{requisicion}/edit', [App\Http\Controllers\RequisicionesController::class, 'edit'])->middleware('can:editar requisiciones')->name('requisiciones.edit');
    Route::put('/{requisicion}', [App\Http\Controllers\RequisicionesController::class, 'update'])->middleware('can:editar requisiciones')->name('requisiciones.update');
    Route::delete('/{requisicion}', [App\Http\Controllers\RequisicionesController::class, 'destroy'])->middleware('can:eliminar requisiciones')->name('requisiciones.destroy');
    Route::get('/partidas-por-capitulo/{capitulo}', [App\Http\Controllers\RequisicionesController::class, 'porCapitulo'])->name('requisiciones.partidasPorCapitulo');

});


// Configuraciones generales
Route::prefix('admin/settings')->middleware('can:ver configuraciones')->group(function () {
    // Configuración general
    Route::get('/', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');

    // Cuentas
    Route::prefix('cuentas')->middleware('can:ver cuentas')->group(function () {
        Route::get('/', [App\Http\Controllers\CuentaBancariaController::class, 'index'])->name('cuentas.index');
        Route::get('/create', [App\Http\Controllers\CuentaBancariaController::class, 'create'])->middleware('can:crear cuentas')->name('cuentas.create');
        Route::post('/', [App\Http\Controllers\CuentaBancariaController::class, 'store'])->middleware('can:crear cuentas')->name('cuentas.store');
        Route::get('/{cuenta}', [App\Http\Controllers\CuentaBancariaController::class, 'show'])->middleware('can:ver cuentas')->name('cuentas.show');
        Route::get('/{cuenta}/edit', [App\Http\Controllers\CuentaBancariaController::class, 'edit'])->middleware('can:editar cuentas')->name('cuentas.edit');
        Route::put('/{cuenta}', [App\Http\Controllers\CuentaBancariaController::class, 'update'])->middleware('can:editar cuentas')->name('cuentas.update');
        Route::delete('/{cuenta}', [App\Http\Controllers\CuentaBancariaController::class, 'destroy'])->middleware('can:eliminar cuentas')->name('cuentas.destroy');
    });

    // Usuarios
    Route::prefix('users')->middleware('can:ver usuarios')->group(function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->middleware('can:crear usuarios')->name('users.create');
        Route::post('/', [App\Http\Controllers\UserController::class, 'store'])->middleware('can:crear usuarios')->name('users.store');
        Route::get('/{user}', [App\Http\Controllers\UserController::class, 'show'])->middleware('can:ver usuarios')->name('users.show');
        Route::get('/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->middleware('can:editar usuarios')->name('users.edit');
        Route::put('/{user}', [App\Http\Controllers\UserController::class, 'update'])->middleware('can:editar usuarios')->name('users.update');
        Route::delete('/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->middleware('can:eliminar usuarios')->name('users.destroy');
    });


    // Roles
    Route::prefix('roles')->middleware('can:ver roles')->group(function () {
        Route::get('/', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
        Route::get('/create', [App\Http\Controllers\RoleController::class, 'create'])->middleware('can:crear roles')->name('roles.create');
        Route::post('/', [App\Http\Controllers\RoleController::class, 'store'])->middleware('can:crear roles')->name('roles.store');
        Route::get('/{role}', [App\Http\Controllers\RoleController::class, 'show'])->name('roles.show');
        Route::get('/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->middleware('can:editar roles')->name('roles.edit');
        Route::put('/{role}', [App\Http\Controllers\RoleController::class, 'update'])->middleware('can:editar roles')->name('roles.update');
        Route::delete('/{role}', [App\Http\Controllers\RoleController::class, 'destroy'])->middleware('can:eliminar roles')->name('roles.destroy');
        Route::get('/{role}/permissions', [App\Http\Controllers\RoleController::class, 'permissions'])->middleware('can:editar roles')->name('roles.permissions');
        Route::post('/{role}/permissions', [App\Http\Controllers\RoleController::class, 'assignPermissions'])->middleware('can:editar roles')->name('roles.assignPermissions');
    });

    // Actividad
    Route::prefix('actividad')->middleware('can:ver actividades')->group(function () {
        Route::get('/', [App\Http\Controllers\ActividadController::class, 'index'])->name('actividades.index');
        Route::get('/actividad', [App\Http\Controllers\ActividadController::class, 'create'])->middleware('can:crear actividades')->name('actividades.create');
        Route::post('/', [App\Http\Controllers\ActividadController::class, 'store'])->middleware('can:crear actividades')->name('actividades.store');
        Route::get('/{actividad}', [App\Http\Controllers\ActividadController::class, 'show'])->middleware('can:ver actividades')->name('actividades.show');
        Route::get('/{actividad}/edit', [App\Http\Controllers\ActividadController::class, 'edit'])->middleware('can:editar actividades')->name('actividades.edit');
        Route::put('/{actividad}', [App\Http\Controllers\ActividadController::class, 'update'])->middleware('can:editar actividades')->name('actividades.update');
        Route::delete('/{actividad}', [App\Http\Controllers\ActividadController::class, 'destroy'])->middleware('can:eliminar actividades')->name('actividades.destroy');
    });
});

Route::get('/prueba-404', function () {
    return response()->view('errors.404', [], 404);
});

