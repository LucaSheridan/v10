<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
       DB::table('users')->insert([
            'id' => '1',
            'firstName' => 'Lucas',
            'lastName' => 'Sheridan',
            'email' => 'lsheridan@bsge.org',
            'password' => bcrypt('secret')]);

        DB::table('users')->insert([
            'id' => '2',
            'firstName' => 'student ',
            'lastName' => 'one',
            'email' => 'student1@bsge.org',
            'password' => bcrypt('secret')]);

        DB::table('users')->insert([
            'id' => '3',
            'firstName' => 'student',
            'lastName' => 'two',
            'email' => 'student2@bsge.org',
            'password' => bcrypt('secret')]);

        DB::table('users')->insert([
            'id' => '4',
            'firstName' => 'student',
            'lastName' => 'three',
            'email' => 'student3@bsge.org',
            'password' => bcrypt('secret')]);

        DB::table('users')->insert([
            'id' => '5',
            'firstName' => 'student',
            'lastName' => 'four',
            'email' => 'student4@bsge.org',
            'password' => bcrypt('secret')]);

        DB::table('users')->insert([
            'id' => '6',
            'firstName' => 'student',
            'lastName' => 'five',
            'email' => 'student5@bsge.org',
            'password' => bcrypt('secret')]);

        DB::table('users')->insert([
            'id' => '7',
            'firstName' => 'student',
            'lastName' => 'six',
            'email' => 'student6@bsge.org',
            'password' => bcrypt('secret')]);

         DB::table('users')->insert([
            'id' => '8',
            'firstName' => 'student',
            'lastName' => 'seven',
            'email' => 'student7@bsge.org',
            'password' => bcrypt('secret')]);

          DB::table('users')->insert([
            'id' => '9',
            'firstName' => 'student',
            'lastName' => 'eight',
            'email' => 'student8@bsge.org',
            'password' => bcrypt('secret')]);

           DB::table('users')->insert([
            'id' => '10',
            'firstName' => 'student',
            'lastName' => 'nine',
            'email' => 'student9@bsge.org',
            'password' => bcrypt('secret')]);

            DB::table('users')->insert([
            'id' => '11',
            'firstName' => 'student',
            'lastName' => 'ten',
            'email' => 'student10@bsge.org',
            'password' => bcrypt('secret')]);

            DB::table('users')->insert([
            'id' => '12',
            'firstName' => 'student',
            'lastName' => 'eleven',
            'email' => 'student11@bsge.org',
            'password' => bcrypt('secret')]);

             DB::table('users')->insert([
            'id' => '13',
            'firstName' => 'student',
            'lastName' => 'twelve',
            'email' => 'student12@bsge.org',
            'password' => bcrypt('secret')]);

             DB::table('users')->insert([
            'id' => '14',
            'firstName' => 'student',
            'lastName' => 'thirteen',
            'email' => 'student13@bsge.org',
            'password' => bcrypt('secret')]);

            DB::table('users')->insert([
            'id' => '15',
            'firstName' => 'student',
            'lastName' => 'fourteen',
            'email' => 'student14@bsge.org',
            'password' => bcrypt('secret')]);

            DB::table('users')->insert([
            'id' => '16',
            'firstName' => 'student',
            'lastName' => 'fifteen',
            'email' => 'student15@bsge.org',
            'password' => bcrypt('secret')]);

            DB::table('users')->insert([
            'id' => '17',
            'firstName' => 'student',
            'lastName' => 'sixteen',
            'email' => 'student16@bsge.org',
            'password' => bcrypt('secret')]);
    }
}
