<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class TipoAnimalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {     
      DB::table('tipo_animales')->insert([
        [          
          'id' => 'perro',
          'descripcion' => 'perro',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [          
          'id' => 'gato',
          'descripcion' => 'gato',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ], 
        [          
          'id' => 'loro',
          'descripcion' => 'loro',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],   
      ]);
    }
}
