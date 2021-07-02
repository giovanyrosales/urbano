<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentoResolucion extends Model
{
    protected $table = 'doc_res';
    public $timestamps = false;
    protected $fillable = ['resoluciones_id', 'url'];
}
