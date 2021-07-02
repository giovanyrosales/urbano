<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procesos extends Model
{
    protected $table = 'procesos';
    public $timestamps = false;
    protected $fillable = ['nombre'];
}
