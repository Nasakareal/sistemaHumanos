<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $table = 'documentos';

    protected $fillable = [
        'empleado_id',
        'tipo',
        'fecha_entrega',
        'observaciones',
        'vigente',
        'ruta_archivo',
    ];

    protected $casts = [
        'fecha_entrega' => 'date',
        'vigente' => 'boolean',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public static function tiposPredefinidos()
    {
        return [
            'Solicitud de empleo elaborada con foto',
            'Copia del acta de nacimiento',
            'Copia de Identificación',
            'Copia de la CURP',
            'Constancia de vigencia del IMSS y/o Copia de portada del Carnet de Citas del IMSS (UMF)',
            'Copia de Cédula de Identificación Fiscal (RFC con Homoclave)',
            'Copia de comprobante de domicilio',
            'Certificado médico (unidad médica gubernamental)',
            'Copia de la Cartilla de servicio militar liberada (en su caso)',
            'Dos cartas de recomendación',
            'Currículum Vitae (soportado)',
            'Certificado de No Inhabilitación (Directivos)',
            'Aviso de Retención de INFONAVIT y/o FONACOT',
            'Declaración de no desempeñar otro empleo o comisión',
            'Cuenta de ahorro/nómina en BBVA Bancomer',
        ];
    }

}
