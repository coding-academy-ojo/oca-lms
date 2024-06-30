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
                'staff_name' => 'Rana Shehadeh',
                'staff_email' => 'rana.shehadeh@orange.com',
                'staff_password' => Hash::make('password'), // Use a secure password
                'staff_Phone' => '0776808753',
                'role' => 'super_manager',
                'staff_personal_img' => 'person.png',
                'staff_bio' => 'Chief Corporate Communication & Sustainability Officer',
            ],
            // [
            //     'staff_name' => 'Dana Alkukhun',
            //     'staff_email' => 'gt.dana.alkukhun@orange.com',
            //     'staff_password' => Hash::make('password'), // Use a secure password
            //     'staff_Phone' => '0776800150',
            //     'role' => 'manager',
            //     'staff_personal_img' => 'person.png',
            //     'staff_bio' => 'Manager bio Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            // ],
            // [
            //     'staff_name' => 'Salameh Yasin',
            //     'staff_email' => 'salameh.yasin@orange.com',
            //     'staff_password' => Hash::make('password'), // Use a secure password
            //     'staff_Phone' => '0776806986',
            //     'role' => 'manager',
            //     'staff_personal_img' => 'person.png',
            //     'staff_bio' => 'Super Manager bio Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            // ],
            // [
            //     'staff_name' => 'Mohammad Frehat',
            //     'staff_email' => 'gt.mohammad.frhat@orange.com',
            //     'staff_password' => Hash::make('password'), // Use a secure password
            //     'staff_Phone' => '0776808599',
            //     'role' => 'manager',
            //     'staff_personal_img' => 'person.png',
            //     'staff_bio' => 'Super Manager bio Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            // ],
            // [
            //     'staff_name' => 'Reem Emad',
            //     'staff_email' => 'gt.reem.shtaiwi@orange.com',
            //     'staff_password' => Hash::make('password'), // Use a secure password
            //     'staff_Phone' => '0776800714',
            //     'role' => 'trainer',
            //     'staff_personal_img' => 'person.png',
            //     'staff_bio' => 'Trainer bio Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            // ],
            // [
            //     'staff_name' => 'Rawan ALhaleeq',
            //     'staff_email' => 'gt.rawan.alhalleeq@orange.com',
            //     'staff_password' => Hash::make('password'), // Use a secure password
            //     'staff_Phone' => '0776800250',
            //     'role' => 'trainer',
            //     'staff_personal_img' => 'person.png',
            //     'staff_bio' => 'Trainer bio Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            // ],   
            // [
            //     'staff_name' => 'Rawan AbuSeini',
            //     'staff_email' => 'gt.rawan.abuseini@orange.com',
            //     'staff_password' => Hash::make('password'), // Use a secure password
            //     'staff_Phone' => '0776800128',
            //     'role' => 'trainer',
            //     'staff_personal_img' => 'person.png',
            //     'staff_bio' => 'Trainer bio Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            // ],
            // [
            //     'staff_name' => 'Wesam Alegrreweh',
            //     'staff_email' => 'gt.wesam.alegrreweh@orange.com',
            //     'staff_password' => Hash::make('password'), // Use a secure password
            //     'staff_Phone' => '1234567890',
            //     'role' => 'trainer',
            //     'staff_personal_img' => 'person.png',
            //     'staff_bio' => 'Trainer bio Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            // ],
            // [
            //     'staff_name' => 'Ayman Aljradaat',
            //     'staff_email' => 'gt.aiman.aljaradat@orange.com',
            //     'staff_password' => Hash::make('password'), // Use a secure password
            //     'staff_Phone' => '1234567890',
            //     'role' => 'trainer',
            //     'staff_personal_img' => 'person.png',
            //     'staff_bio' => 'Trainer bio Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            // ],
            // [
            //     'staff_name' => 'Batool Aldalki',
            //     'staff_email' => 'gt.batool.Aldalki@orange.com',
            //     'staff_password' => Hash::make('password'), // Use a secure password
            //     'staff_Phone' => '1234567890',
            //     'role' => 'trainer',
            //     'staff_personal_img' => 'person.png',
            //     'staff_bio' => 'Trainer bio Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            // ],
            // [
            //     'staff_name' => 'Amro Alwaqee',
            //     'staff_email' => 'trainer4@example.com',
            //     'staff_password' => Hash::make('password'), // Use a secure password
            //     'staff_Phone' => '1234567890',
            //     'role' => 'trainer',
            //     'staff_personal_img' => 'person.png',
            //     'staff_bio' => 'Trainer bio Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            // ],
            // [
            //     'staff_name' => 'Alaa Habarneh',
            //     'staff_email' => 'trainer5@example.com',
            //     'staff_password' => Hash::make('password'), // Use a secure password
            //     'staff_Phone' => '1234567890',
            //     'role' => 'trainer',
            //     'staff_personal_img' => 'person.png',
            //     'staff_bio' => 'Trainer bio Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            // ],
        ]);
    }
}
