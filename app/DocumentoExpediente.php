<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentoExpediente extends Model
{
    protected $table = 'doc_exp';
    public $timestamps = false;
    protected $fillable = ['expediente_id', 'url'];
}
