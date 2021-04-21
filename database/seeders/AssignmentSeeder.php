<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Begin Complex Assignments

         DB::table('assignments')->insert([
             'title' => 'Project #0',
             'cover_thumb' => 'uploads/1526488096.thumb.jpeg',
             'description' => 'Starting out with research',
             'section_id' => '1',
             'course_id' => null,
             'site_id' => '1',
             'is_active' => true

         ]);

         DB::table('components')->insert([
             'title' => 'Visual Research',
             'description' => 'For this project you will need to search for artists that you love.',
             'assignment_id' =>'1',
             'section_id' => '1',
             'date_due' => Carbon::now()->addWeeks(1),          
             'class_viewable' => false            
             ]);

         DB::table('components')->insert([
             'title' => 'Artwork Analysis',
             'description' => 'now picking a Artwork from one of these artists and analyze it.',
             'assignment_id' =>'1',
             'section_id' => '1',
             'date_due' => Carbon::now()->addWeeks(3),
             'class_viewable' => false          
            
             ]);

         DB::table('components')->insert([
             'title' => 'Ideation',
             'description' => 'the goal of ideation is to use a page in your sketchbook to brainstorm a wide variety of possible directions that your project could advancing.',
             'assignment_id' =>'1',
             'section_id' => '1',             'date_due' => Carbon::now()->addWeeks(2),
             'class_viewable' => false          
            
             ]);

         DB::table('components')->insert([
             'title' => 'Documentation & Reflection',
             'description' => 'the goal of documentation and reflection is to record your decisions and thought process while making a work of art. Include aspects that you found challenging, solutions that you devised, thoughts for future projects and the overall success of the piece.',
             'assignment_id' =>'1',
             'section_id' => '1',
             'date_due' => Carbon::now()->addWeeks(4),
             'class_viewable' => false          
           
             ]);

         DB::table('components')->insert([
             'title' => 'Final Artwork',
             'description' => 'seriously. This is the final artwork. Make sure to add an annotation, title, medium and dimensions of the work.',
             'assignment_id' =>'1',
             'section_id' => '1',
             'date_due' => Carbon::now()->addWeeks(4),
             'class_viewable' => true          
            
             ]);


        DB::table('assignments')->insert([
             'title' => 'Project #1',
             'cover_thumb' => 'uploads/1526488096.thumb.jpeg',
             'description' => 'Working in Value',
             'section_id' => '1',
             'course_id' => null,
             'site_id' => '1',
             'is_active' => true

         ]);

         DB::table('components')->insert([
             'title' => 'Visual Research',
             'description' => 'For this project you will need to search for artists that you love.',
             'assignment_id' =>'2',
             'section_id' => '1',
             'date_due' => Carbon::now()->addWeeks(1),
             'class_viewable' => false          
           
             ]);

         DB::table('components')->insert([
             'title' => 'Artwork Analysis',
             'description' => 'For this project you will need to search for artists that you love.',
             'assignment_id' =>'2',
             'section_id' => '1',
             'date_due' => Carbon::now()->addWeeks(3),
             'class_viewable' => false          
            
             ]);

         DB::table('components')->insert([
             'title' => 'Ideation',
             'description' => 'For this project you will need to search for artists that you love.',
             'assignment_id' =>'2',
             'section_id' => '1',
             'date_due' => Carbon::now()->addWeeks(2),
             'class_viewable' => false          
            
             ]);

          DB::table('components')->insert([
             'title' => 'Documentation & Reflection',
             'description' => 'For this project you will need to search for artists that you love.',
             'assignment_id' =>'2',
             'section_id' => '1',
             'date_due' => Carbon::now()->addWeeks(4),
             'class_viewable' => false          
           
             ]);

         DB::table('components')->insert([
             'title' => 'Final Artwork',
             'description' => 'For this project you will need to search for artists that you love.',
             'assignment_id' =>'2',
             'section_id' => '1',
             'date_due' => Carbon::now()->addWeeks(4),
             'class_viewable' => true          
            
             ]);
    }
}
