<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            DB::table('students')->insert([
                [
                    'email' => 'rawanbilal@gmail.com',
                    'password' => Hash::make('password'),
                    'en_first_name' =>'Rawan',
                    'en_second_name' =>'Bilal',              
                    'mobile' => '0775494887',           
                    'academy_id' => 1,
                    'cohort_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'email' => 'randali@gmail.com',
                    'password' => Hash::make('password'),
                    'en_first_name' =>'Rand',
                    'en_second_name' =>'Ali',              
                    'mobile' => '0775491787',           
                    'academy_id' => 1,
                    'cohort_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'email' => 'ahmadhasan@gmail.com',
                    'password' => Hash::make('password'),
                    'en_first_name' =>'Ahmad',
                    'en_second_name' =>'Hasan',              
                    'mobile' => '0775494836',           
                    'academy_id' => 1,
                    'cohort_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'email' => 'karamanas@gmail.com',
                    'password' => Hash::make('password'),
                    'en_first_name' =>'karam',
                    'en_second_name' =>'Anas',              
                    'mobile' => '0775491657',           
                    'academy_id' => 1,
                    'cohort_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'email' => 'alibilal@gmail.com',
                    'password' => Hash::make('password'),
                    'en_first_name' =>'Ali',
                    'en_second_name' =>'Bilal',              
                    'mobile' => '0775476287',           
                    'academy_id' => 1,
                    'cohort_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'email' => 'danahani@gmail.com',
                    'password' => Hash::make('password'),
                    'en_first_name' =>'Dana',
                    'en_second_name' =>'Hani',              
                    'mobile' => '0775435287',           
                    'academy_id' => 1,
                    'cohort_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'email' => 'omarmansour@gmail.com',
                    'password' => Hash::make('password'),
                    'en_first_name' =>'Omar',
                    'en_second_name' =>'Mansour',              
                    'mobile' => '0775141287',           
                    'academy_id' => 1,
                    'cohort_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'email' => 'talalmohammad@gmail.com',
                    'password' => Hash::make('password'),
                    'en_first_name' =>'Talal',
                    'en_second_name' =>'Mohammad',              
                    'mobile' => '0775147287',           
                    'academy_id' => 1,
                    'cohort_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'email' => 'omamaali@gmail.com',
                    'password' => Hash::make('password'),
                    'en_first_name' =>'Omama',
                    'en_second_name' =>'Ali',              
                    'mobile' => '0775142287',           
                    'academy_id' => 1,
                    'cohort_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'email' => 'ranarami@gmail.com',
                    'password' => Hash::make('password'),
                    'en_first_name' =>'Rana',
                    'en_second_name' =>'Rami',              
                    'mobile' => '0775494887',           
                    'academy_id' => 2,
                    'cohort_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'email' => 'assemali@gmail.com',
                    'password' => Hash::make('password'),
                    'en_first_name' =>'Assem',
                    'en_second_name' =>'Ali',              
                    'mobile' => '0775491787',           
                    'academy_id' => 2,
                    'cohort_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'email' => 'samihani@gmail.com',
                    'password' => Hash::make('password'),
                    'en_first_name' =>'Smai',
                    'en_second_name' =>'Hani',              
                    'mobile' => '0775494836',           
                    'academy_id' => 2,
                    'cohort_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'email' => 'karemanas@gmail.com',
                    'password' => Hash::make('password'),
                    'en_first_name' =>'karem',
                    'en_second_name' =>'Anas',              
                    'mobile' => '0775491657',           
                    'academy_id' => 2,
                    'cohort_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'email' => 'wasanbelal@gmail.com',
                    'password' => Hash::make('password'),
                    'en_first_name' =>'Wasan',
                    'en_second_name' =>'Belal',              
                    'mobile' => '0775476287',           
                    'academy_id' => 2,
                    'cohort_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'email' => 'meskbilal@gmail.com',
                    'password' => Hash::make('password'),
                    'en_first_name' =>'Mesk',
                    'en_second_name' =>'Bilal',              
                    'mobile' => '0775435287',           
                    'academy_id' => 2,
                    'cohort_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
           
            ]);
        }
        
    }
