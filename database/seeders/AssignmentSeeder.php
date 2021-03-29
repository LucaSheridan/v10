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
             'assignment_id' =>'1',
             'section_id' => '1',
             'date_due' => Carbon::now()->addWeeks(1),          
             'class_viewable' => false            
             ]);

         DB::table('components')->insert([
             'title' => 'Artwork Analysis',
             'assignment_id' =>'1',
             'section_id' => '1',
             'date_due' => Carbon::now()->addWeeks(3),
             'class_viewable' => false          
            
             ]);

         DB::table('components')->insert([
             'title' => 'Ideation',
             'assignment_id' =>'1',
             'section_id' => '1',             'date_due' => Carbon::now()->addWeeks(2),
             'class_viewable' => false          
            
             ]);

         DB::table('components')->insert([
             'title' => 'Documentation & Reflection',
             'assignment_id' =>'1',
             'section_id' => '1',
             'date_due' => Carbon::now()->addWeeks(4),
             'class_viewable' => false          
           
             ]);

         DB::table('components')->insert([
             'title' => 'Final Artwork',
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
             'assignment_id' =>'2',
             'section_id' => '1',
             'date_due' => Carbon::now()->addWeeks(1),
             'class_viewable' => false          
           
             ]);

         DB::table('components')->insert([
             'title' => 'Artwork Analysis',
             'assignment_id' =>'2',
             'section_id' => '1',
             'date_due' => Carbon::now()->addWeeks(3),
             'class_viewable' => false          
            
             ]);

         DB::table('components')->insert([
             'title' => 'Ideation',
             'assignment_id' =>'2',
             'section_id' => '1',
             'date_due' => Carbon::now()->addWeeks(2),
             'class_viewable' => false          
            
             ]);

          DB::table('components')->insert([
             'title' => 'Documentation & Reflection',
             'assignment_id' =>'2',
             'section_id' => '1',
             'date_due' => Carbon::now()->addWeeks(4),
             'class_viewable' => false          
           
             ]);

         DB::table('components')->insert([
             'title' => 'Final Artwork',
             'assignment_id' =>'2',
             'section_id' => '1',
             'date_due' => Carbon::now()->addWeeks(4),
             'class_viewable' => true          
            
             ]);
    }
}
