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
             'title' => 'Surrealist Collage',
             'subtitle' => 'A Collection of Student Examples',
             'type' => 'slideshow',
             'showArtist' => 1,
             'showTitle' => 1,
             'showSubtitle' => 1,
             'showMedium' => 1,
             'showYear' => 1,
             'showDimensions' => 1,
             'showLabel' => 1]);

         DB::table('collection_user')->insert([
             'collection_id' => 1,
             'user_id' => 1,
         	 'position' => 1]);
    }
}
