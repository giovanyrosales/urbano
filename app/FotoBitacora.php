<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotoBitacora extends Model
{
    protected $table = 'fotos_bitacora';
    public $timestamps = false;
    protected $fillable = ['bitacora_id', 'url'];
}
