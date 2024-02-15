<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
         // Seed your users here
         DB::table('users')->insert([
            [
                'name' => 'Rana',
                'email' => 'rana@example.com',
                'password' => Hash::make('password'),
                'role' => 'super_manager',
                'photo' => 'path/to/photo.jpg',
                'cv' => 'path/to/cv.pdf',
                'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mohammad',
                'email' => 'moh@example.com',
                'password' => Hash::make('password'),
                'role' => 'trainee',
                'photo' => 'path/to/photo.jpg',
                'cv' => 'path/to/cv.pdf',
                'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sujoud',
                'email' => 'sujoud@example.com',
                'password' => Hash::make('password'),
                'role' => 'trainer',
                'photo' => 'path/to/photo.jpg',
                'cv' => 'path/to/cv.pdf',
                'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name' => 'Ayman',
                'email' => 'ayman@example.com',
                'password' => Hash::make('password'),
                'role' => 'trainer',
                'photo' => 'path/to/photo.jpg',
                'cv' => 'path/to/cv.pdf',
                'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name' => 'Sara',
                'email' => 'sara@example.com',
                'password' => Hash::make('password'),
                'role' => 'trainee',
                'photo' => 'path/to/photo.jpg',
                'cv' => 'path/to/cv.pdf',
                'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'created_at' => now(),
                'updated_at' => now(),
            ], [
                'name' => 'Salam',
                'email' => 'salam@example.com',
                'password' => Hash::make('password'),
                'role' => 'trainee',
                'photo' => 'path/to/photo.jpg',
                'cv' => 'path/to/cv.pdf',
                'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
