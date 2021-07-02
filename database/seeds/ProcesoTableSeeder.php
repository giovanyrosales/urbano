<?php

use App\Procesos;
use Illuminate\Database\Seeder;

class ProcesoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Procesos::create([
            'nombre' => 'Linea de construcción'
        ]);

        Procesos::create([
            'nombre' => 'Calificación de lugar'
        ]);

        Procesos::create([
            'nombre' => 'Rompimiento de calle'
        ]);

        Procesos::create([
            'nombre' => 'Construcción simple'
        ]);

        Procesos::create([
            'nombre' => 'Construcción segun plano'
        ]);

        Procesos::create([
            'nombre' => 'Segregaciones'
        ]);

        Procesos::create([
            'nombre' => 'Instalaciones de Postes'
        ]);

        Procesos::create([
            'nombre' => 'Inspección de Rotulo'
        ]);

        Procesos::create([
            'nombre' => 'Denuncias'
        ]);

        Procesos::create([
            'nombre' => 'Reformas de Parcelaciones'
        ]);
    }
}
