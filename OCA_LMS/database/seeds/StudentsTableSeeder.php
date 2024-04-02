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
                    'en_last_name' =>'ahmad',              
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
                    'en_last_name' =>'mohanned',              
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
                    'en_last_name' =>'laith',              
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
                    'en_last_name' =>'hasan',              
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
                    'en_last_name' =>'ibrahim',              
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
                    'en_last_name' =>'bani hani',              
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
                    'en_last_name' =>'Mansour',              
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
                    'en_last_name' =>'talal',              
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
                    'en_last_name' =>'jad',              
                    'mobile' => '0775142287',           
                    'academy_id' => 1,
                    'cohort_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
           
            ]);
        }
        
    }
