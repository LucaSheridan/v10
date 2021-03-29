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
            'firstName' => 'Hannah ',
            'lastName' => 'Abbott',
            'email' => 'HAbbot@bsge.org',
            'password' => bcrypt('secret')]);

        DB::table('users')->insert([
            'id' => '3',
            'firstName' => 'Millicent',
            'lastName' => 'Bulstrode',
            'email' => 'MBulstrode@bsge.org',
            'password' => bcrypt('secret')]);

        DB::table('users')->insert([
            'id' => '4',
            'firstName' => 'Cho',
            'lastName' => 'Chang',
            'email' => 'CChang@bsge.org',
            'password' => bcrypt('secret')]);

        DB::table('users')->insert([
            'id' => '5',
            'firstName' => 'Cedric',
            'lastName' => 'Diggory',
            'email' => 'CDiggory@bsge.org',
            'password' => bcrypt('secret')]);

        DB::table('users')->insert([
            'id' => '6',
            'firstName' => 'Lily',
            'lastName' => 'Evans',
            'email' => 'Levans@bsge.org',
            'password' => bcrypt('secret')]);

        DB::table('users')->insert([
            'id' => '7',
            'firstName' => 'Seamus',
            'lastName' => 'Finnigan',
            'email' => 'SFinnigan@bsge.org',
            'password' => bcrypt('secret')]);

         DB::table('users')->insert([
            'id' => '8',
            'firstName' => 'Hermoine',
            'lastName' => 'Granger',
            'email' => 'HGranger@bsge.org',
            'password' => bcrypt('secret')]);

          DB::table('users')->insert([
            'id' => '9',
            'firstName' => 'Helga',
            'lastName' => 'Hufflepuff',
            'email' => 'HHufflepuff@bsge.org',
            'password' => bcrypt('secret')]);

           DB::table('users')->insert([
            'id' => '10',
            'firstName' => 'Ron',
            'lastName' => 'Weasley',
            'email' => 'RWeasley@bsge.org',
            'password' => bcrypt('secret')]);

            DB::table('users')->insert([
            'id' => '11',
            'firstName' => 'Neville',
            'lastName' => 'Longbottom',
            'email' => 'NLongbottom@bsge.org',
            'password' => bcrypt('secret')]);

            DB::table('users')->insert([
            'id' => '12',
            'firstName' => 'Draco',
            'lastName' => 'Malfoy',
            'email' => 'DMalfoy@bsge.org',
            'password' => bcrypt('secret')]);

             DB::table('users')->insert([
            'id' => '13',
            'firstName' => 'Lavender',
            'lastName' => 'Brown',
            'email' => 'LBrown@bsge.org',
            'password' => bcrypt('secret')]);

             DB::table('users')->insert([
            'id' => '14',
            'firstName' => 'Pamda',
            'lastName' => 'Patil',
            'email' => 'PPatil@bsge.org',
            'password' => bcrypt('secret')]);

            DB::table('users')->insert([
            'id' => '15',
            'firstName' => 'Colin',
            'lastName' => 'Creevy',
            'email' => 'CCreevy@bsge.org',
            'password' => bcrypt('secret')]);

            DB::table('users')->insert([
            'id' => '16',
            'firstName' => 'Ginny',
            'lastName' => 'Weasley',
            'email' => 'GWeasley@bsge.org',
            'password' => bcrypt('secret')]);

            DB::table('users')->insert([
            'id' => '17',
            'firstName' => 'Luna',
            'lastName' => 'Lovegood',
            'email' => 'Lovegood@bsge.org',
            'password' => bcrypt('secret')]);
    }
}
