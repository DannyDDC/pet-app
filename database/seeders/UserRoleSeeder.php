<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Uuid;
use Carbon\Carbon;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user_id = Uuid::generate()->string;

      DB::table('users')->insert([
        [
          'id' =>  $user_id,
          'name' => 'Admin', 
          'email' => 'admin@gmail.com',           
          'password' => bcrypt('administrador'),
          'phone_number' => '0967194110',
          'address' => 'gye',
          'city' => 'guayaquil',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]
      ]);

      DB::table('roles')->insert([
        [
          'id' => 'ADMIN', 
          'name' => 'admin',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ],
        [
          'id' => 'DONANTE', 
          'name' => 'donante',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]       
      ]);

      DB::table('role_user')->insert([
        [
          'role_id' => 'ADMIN',
          'user_id' => $user_id, 
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]
      ]);

      DB::table('permissions')->insert([
        [
          'id' =>  'agregar_contacto',
          'name' => 'agregar contacto',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]
      ]);

      DB::table('permission_role')->insert([
        [
          'permission_id' => 'agregar_contacto',
          'role_id' =>  'ADMIN',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]
      ]);
    }
}
