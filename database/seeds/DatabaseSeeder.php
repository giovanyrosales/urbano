<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ProcesoTableSeeder::class);
         $this->call(EstadoTableSeeder::class);
         $this->call(UserTableSeeder::class);
    }
}
