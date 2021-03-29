<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ArtifactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    		 DB::table('artifacts')->insert([
             'id' => 3,
             'component_id' => 7,
             'assignment_id' => 2,
             'section_id' => '',
             'artifact_path' => 'uploads/1515159184.jpeg',
             'artifact_thumb' => 'uploads/1515159184.thumb.jpeg',
             'annotation' => 'Photograph of me in dramatic lighting taken by Olivia Vargas',
             'title' => 'Aoife Kenny',
             'medium' => 'Photograph',
             'year' => NULL,
             'dimensions_height' => 'Digital',
             'dimensions_width' => 'Digital',
             'dimensions_depth' => 'Digital',
             'dimensions_units' => 'pixels',
             'is_published' => '1',
             'is_public' =>	'1',
             'artist' => NULL,
             'user_id' => 1,
             'created_at' => 2020-03-28 21:17:00,
         	  ]);


    }
}
