<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmpleadosSeeder extends Seeder
{
    public function run()
    {
        DB::table('empleados')->insert([
            [
                'nombre' => 'Juan Pérez',
                'puesto' => 'Analista de Recursos Humanos',
                'area_adscripcion' => 'Departamento de RRHH',
                'fecha_nacimiento' => '1985-05-20',
                'lugar_nacimiento' => 'Ciudad de México',
                'nss' => '12345678901',
                'correo_electronico' => 'juan.perez@ejemplo.com',
                'rfc' => 'JUAP850520ABC',
                'curp' => 'JUAP850520HDFLLL01',

                'domicilio' => 'Av. Reforma 123',
                'calle' => 'Av. Reforma',
                'no_ext' => '123',
                'no_int' => 'A',
                'colonia' => 'Centro',
                'cp' => '06000',
                'poblacion' => 'Ciudad de México',

                'telefono' => '5551234567',
                'celular' => '5557654321',

                'licenciatura' => 'Lic. en Administración',
                'cedula_licenciatura' => 'LIC123456',
                'maestria' => 'Maestría en Recursos Humanos',
                'cedula_maestria' => 'MAE654321',
                'doctorado' => null,
                'cedula_doctorado' => null,

                'estado_civil' => 'Soltero',
                'edad_hijos' => 0,
                'alergias' => 'Ninguna',
                'tipo_sanguineo' => 'O+',
                'restricciones_salud' => 'Ninguna',

                'contacto_emergencia_nombre' => 'Carlos Pérez',
                'contacto_emergencia_telefono' => '5559876543',
                'contacto_emergencia_domicilio' => 'Calle Secundaria 45',

                'fecha_ingreso' => '2020-01-15',
                'desempena_otro_trabajo' => false,
                'otra_dependencia' => null,
                'otro_trabajo_horario' => null,
                'otro_trabajo_puesto' => null,

                'rfid_uid' => '1AF38FDD', // ✅ Aquí el UID autorizado
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nombre' => 'María López',
                'puesto' => 'Coordinadora de Talento Humano',
                'area_adscripcion' => 'Departamento de RRHH',
                'fecha_nacimiento' => '1990-08-10',
                'lugar_nacimiento' => 'Guadalajara, Jalisco',
                'nss' => '10987654321',
                'correo_electronico' => 'maria.lopez@ejemplo.com',
                'rfc' => 'MARL900810XYZ',
                'curp' => 'MARL900810MJCLPN03',

                'domicilio' => 'Calle Independencia 456',
                'calle' => 'Calle Independencia',
                'no_ext' => '456',
                'no_int' => 'B',
                'colonia' => 'Centro',
                'cp' => '44100',
                'poblacion' => 'Guadalajara',

                'telefono' => '3312345678',
                'celular' => '3318765432',

                'licenciatura' => 'Lic. en Psicología',
                'cedula_licenciatura' => 'LIC654321',
                'maestria' => 'Maestría en Gestión Humana',
                'cedula_maestria' => 'MAE123456',
                'doctorado' => null,
                'cedula_doctorado' => null,

                'estado_civil' => 'Casada',
                'edad_hijos' => 2,
                'alergias' => 'Penicilina',
                'tipo_sanguineo' => 'A-',
                'restricciones_salud' => 'Ninguna',

                'contacto_emergencia_nombre' => 'Luis López',
                'contacto_emergencia_telefono' => '3316549870',
                'contacto_emergencia_domicilio' => 'Avenida Siempre Viva 789',

                'fecha_ingreso' => '2018-04-20',
                'desempena_otro_trabajo' => true,
                'otra_dependencia' => 'Departamento de Capacitación',
                'otro_trabajo_horario' => 'Lunes a Viernes, de 8:00 a 14:00',
                'otro_trabajo_puesto' => 'Asesora externa',

                'rfid_uid' => null, // ❌ No tiene tarjeta autorizada
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
