<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('sites')->insert([
             'name' => 'The Baccalaureate School of Global Education',
             'nickname' => 'BSGE']);


        DB::table('sites')->insert([
             'name' => 'The Art League of Long Island',
             'nickname' => 'ALLI']);
    }
}
