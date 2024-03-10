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
                'staff_name' => 'Dana',
                'staff_email' => 'manager@example.com',
                'staff_password' => Hash::make('password'), // Use a secure password
                'staff_Phone' => '1234567890',
                'role' => 'manager',
                'staff_personal_img' => 'person.png',
                'staff_bio' => 'Manager bio Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            ],
            [
                'staff_name' => 'Rana',
                'staff_email' => 'supermanager@example.com',
                'staff_password' => Hash::make('password'), // Use a secure password
                'staff_Phone' => '1234567890',
                'role' => 'super_manager',
                'staff_personal_img' => 'person.png',
                'staff_bio' => 'Super Manager bio Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            ],
            [
                'staff_name' => 'Reem',
                'staff_email' => 'trainer@example.com',
                'staff_password' => Hash::make('password'), // Use a secure password
                'staff_Phone' => '1234567890',
                'role' => 'trainer',
                'staff_personal_img' => 'person.png',
                'staff_bio' => 'Trainer bio Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            ],
        ]);
    }
}
