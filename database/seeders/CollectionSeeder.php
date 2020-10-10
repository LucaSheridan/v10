<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('collections')->insert([
             'title' => 'Surrealist Collage']);

         DB::table('collection_user')->insert([
             'collection_id' => 1,
             'user_id' => 1,
         	 'position' => 1]);
    }
}
