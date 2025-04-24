<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Empleado extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'empleados';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        // Datos personales y de contacto
        'nombre',
        'puesto',
        'area_adscripcion',
        'fecha_nacimiento',
        'lugar_nacimiento',
        'nss',
        'correo_electronico',
        'rfc',
        'curp',
        // Domicilio
        'domicilio',
        'calle',
        'no_ext',
        'no_int',
        'colonia',
        'cp',
        'poblacion',
        // Teléfonos
        'telefono',
        'celular',
        // Formación académica
        'licenciatura',
        'cedula_licenciatura',
        'maestria',
        'cedula_maestria',
        'doctorado',
        'cedula_doctorado',
        // Datos familiares y de salud
        'estado_civil',
        'edad_hijos',
        'alergias',
        'tipo_sanguineo',
        'restricciones_salud',
        // Contacto de emergencia
        'contacto_emergencia_nombre',
        'contacto_emergencia_telefono',
        'contacto_emergencia_domicilio',
        // Datos laborales
        'fecha_ingreso',
        'desempena_otro_trabajo',
        'otra_dependencia',
        'otro_trabajo_horario',
        'otro_trabajo_puesto',
        'rfid_uid',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'nombre',
                'puesto',
                'area_adscripcion',
                'fecha_nacimiento',
                'lugar_nacimiento',
                'nss',
                'correo_electronico',
                'rfc',
                'curp',
                'domicilio',
                'calle',
                'no_ext',
                'no_int',
                'colonia',
                'cp',
                'poblacion',
                'telefono',
                'celular',
                'licenciatura',
                'cedula_licenciatura',
                'maestria',
                'cedula_maestria',
                'doctorado',
                'cedula_doctorado',
                'estado_civil',
                'edad_hijos',
                'alergias',
                'tipo_sanguineo',
                'restricciones_salud',
                'contacto_emergencia_nombre',
                'contacto_emergencia_telefono',
                'contacto_emergencia_domicilio',
                'fecha_ingreso',
                'desempena_otro_trabajo',
                'otra_dependencia',
                'otro_trabajo_horario',
                'otro_trabajo_puesto',
            ])
            ->useLogName('empleados')
            ->logOnlyDirty();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "El empleado ha sido {$eventName}";
    }

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_ingreso'  => 'date',
        'desempena_otro_trabajo' => 'boolean',
    ];

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

}
