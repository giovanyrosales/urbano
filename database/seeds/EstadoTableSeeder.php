<?php

use App\Estado;
use Illuminate\Database\Seeder;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create([
            'nombre' => 'En Proceso'
        ]);

        Estado::create([
            'nombre' => 'Resolucion Generada'
        ]);

        Estado::create([
            'nombre' => 'Resolución Entregada'
        ]);
    }
}
