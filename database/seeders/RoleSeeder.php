<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
      DB::table('roles')->insert([
            'id' => 1,
            'name' => 'student',
            'guard_name' => 'web']);

      DB::table('roles')->insert([
            'id' => 2,
            'name' => 'teacher',
       		'guard_name' => 'web']);
    
      DB::table('roles')->insert([
            'id' => 3,
            'name' => 'admin',
            'guard_name' => 'web']);

      DB::table('roles')->insert([
            'id' => 4,
            'name' => 'master',
            'guard_name' => 'web']);
    }
}

