<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('staff')->insert([
            [
                'staff_name' => 'Manager Name',
                'staff_email' => 'manager@example.com',
                'staff_password' => Hash::make('password'), // Use a secure password
                'role' => 'manager',
                'staff_cv' => null,
                'staff_bio' => 'Manager bio',
                'staff_personal_img' => 'person.png',
            ],
            [
                'staff_name' => 'Super Manager Name',
                'staff_email' => 'supermanager@example.com',
                'staff_password' => Hash::make('password'), // Use a secure password
                'role' => 'super_manager',
                'staff_cv' => null,
                'staff_bio' => 'Super Manager bio',
                'staff_personal_img' => 'person.png',
            ],
            [
                'staff_name' => 'Trainer Name',
                'staff_email' => 'trainer@example.com',
                'staff_password' => Hash::make('password'), // Use a secure password
                'role' => 'trainer',
                'staff_cv' => null,
                'staff_bio' => 'Trainer bio',
                'staff_personal_img' => 'person.png',
            ],
        ]);
    }
}
