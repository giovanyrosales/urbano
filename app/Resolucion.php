<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resolucion extends Model
{
    protected $table = 'resoluciones';
    public $timestamps = false;
    protected $fillable = ['num_res', 'fecha_resolucion', 'fecha_pago', 'expediente_id',
                        'monto', 'vigencia', 'recibo', 'serie', 'fecha_pago', 'metros'];

}
