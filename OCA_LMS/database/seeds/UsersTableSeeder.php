<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // manager user
        $manager = User::create([
            'name' => 'Manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'academy_id' => 1, // Replace with the appropriate academy_id
        ]);
        // Super_user user
        $Super_user = User::create([
            'name' => 'Super_user',
            'email' => 'supermanager@example.com',
            'password' => Hash::make('password'),
            'role' => 'super_manager',
            'academy_id' => 1, // Replace with the appropriate academy_id
        ]);
        // trainer user
        $trainer = User::create([
            'name' => 'Trainer',
            'email' => 'trainer@example.com',
            'password' => Hash::make('password'),
            'role' => 'trainer',
            'academy_id' => 1, // Replace with the appropriate academy_id
        ]);
        // trainee user
        $trainee = User::create([
            'name' => 'Trainee',
            'email' => 'trainee@example.com',
            'password' => Hash::make('password'),
            'role' => 'trainee',
            'academy_id' => 1, // Replace with the appropriate academy_id
        ]);


        // Note: Make sure to replace '1' with the actual academy_id to establish the foreign key relationship.

        // Output a message to the console
        $this->command->info('Users seeded successfully!');
    }
}
