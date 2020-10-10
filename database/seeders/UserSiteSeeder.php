<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
      // BSGE Enrollment
      DB::table('site_user')->insert([
                'site_id' => 1,
                'user_id' => 1]);

      DB::table('site_user')->insert([
                'site_id' => 1,
                'user_id' => 2]);

      DB::table('site_user')->insert([
                'site_id' => 1,
                'user_id' => 3]);

      // ALLI Enrollment
      DB::table('site_user')->insert([
                'site_id' => 1,
                'user_id' => 4]);
    }
}
