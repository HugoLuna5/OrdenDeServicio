<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_usuarios')->insert([
            'nombre' => 'Admin',
        ]);

        DB::table('tipo_usuarios')->insert([
            'nombre' => 'Solicitante',
        ]);

        DB::table('tipo_usuarios')->insert([
            'nombre' => 'Personal',
        ]);


    }
}
