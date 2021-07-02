<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $table = 'expediente';
    public $timestamps = false;
    protected $fillable = ['exp', 'solicitante', 'procesos_id', 'fecha',
                        'estados_id', 'mapa', 'parcela', 'correo_electronico',
                    'telefono', 'derecho_cancelado', 'catastral', 'direccion', 'comentarios'];
}
