<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

       $this->call([

			SiteSeeder::class,
			UserSeeder::class,
			UserSiteSeeder::class,
			RoleSeeder::class,
			UserRoleSeeder::class,
            //CoursesTableSeeder::class,
            SectionSeeder::class,
            ArtifactSeeder::class,
            CollectionSeeder::class,
            //PostsTablesSeeder::class,
            AssignmentSeeder::class

            ]);
    }
}
