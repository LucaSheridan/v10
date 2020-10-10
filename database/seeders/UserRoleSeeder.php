<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // BSGE Teachers
         DB::table('model_has_roles')->insert([
                'role_id' => 2,
                'model_id' => 1,
                'model_type' => 'App\Models\User']);
         
      	  // Student 1
          DB::table('model_has_roles')->insert([
                'role_id' => 1,
                'model_id' => 2,
                'model_type' => 'App\Models\User']);

          // Student 2
          DB::table('model_has_roles')->insert([
                'role_id' => 1,
                'model_id' => 3,
                'model_type' => 'App\Models\User']);

          // Student 3
          DB::table('model_has_roles')->insert([
                'role_id' => 1,
                'model_id' => 4,
                'model_type' => 'App\Models\User']);

          // Student 4
          DB::table('model_has_roles')->insert([
                'role_id' => 1,
                'model_id' => 5,
                'model_type' => 'App\Models\User']);

          // Student 5
          DB::table('model_has_roles')->insert([
                'role_id' => 1,
                'model_id' => 6,
                'model_type' => 'App\Models\User']);

          // Student 6
          DB::table('model_has_roles')->insert([
                'role_id' => 1,
                'model_id' => 7,
                'model_type' => 'App\Models\User']);

          // Student 7
          DB::table('model_has_roles')->insert([
                'role_id' => 1,
                'model_id' => 8,
                'model_type' => 'App\Models\User']);

          // Student 8
          DB::table('model_has_roles')->insert([
                'role_id' => 1,
                'model_id' => 9,
                'model_type' => 'App\Models\User']);

          // Student 9
          DB::table('model_has_roles')->insert([
                'role_id' => 1,
                'model_id' => 10,
                'model_type' => 'App\Models\User']);

          // Student 10
          DB::table('model_has_roles')->insert([
                'role_id' => 1,
                'model_id' => 11,
                'model_type' => 'App\Models\User']);

          // Student 11
          DB::table('model_has_roles')->insert([
                'role_id' => 1,
                'model_id' => 12,
                'model_type' => 'App\Models\User']);

          // Student 12
          DB::table('model_has_roles')->insert([
                'role_id' => 1,
                'model_id' => 13,
                'model_type' => 'App\Models\User']);

          // Student 13
          DB::table('model_has_roles')->insert([
                'role_id' => 1,
                'model_id' => 14,
                'model_type' => 'App\Models\User']);

          // Student 14
          DB::table('model_has_roles')->insert([
                'role_id' => 1,
                'model_id' => 15,
                'model_type' => 'App\Models\User']);

          // Student 15
          DB::table('model_has_roles')->insert([
                'role_id' => 1,
                'model_id' =>16,
                'model_type' => 'App\Models\User']);

          // Student 16
          DB::table('model_has_roles')->insert([
                'role_id' => 1,
                'model_id' => 17,
                'model_type' => 'App\Models\User']);
    }
}
