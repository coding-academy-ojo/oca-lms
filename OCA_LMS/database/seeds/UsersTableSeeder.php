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
              // Manager for academy_id 1
              $manager1 = User::create([
                'name' => 'balqa Manager ',
                'email' => 'manager@example.com',
                'password' => Hash::make('password'),
                'role' => 'manager',
            ]);
            
            // Manager for academy_id 2
            $manager2 = User::create([
                'name' => 'Aqaba Manager',
                'email' => 'manager1@example.com',
                'password' => Hash::make('password'),
                'role' => 'manager',
            ]);
        
        // Super_user user
        $Super_user = User::create([
            'name' => 'Super_user',
            'email' => 'supermanager@example.com',
            'password' => Hash::make('password'),
            'role' => 'super_manager',
        ]);

        // Create 3 trainers
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'name' => 'Trainer' . $i,
                'email' => 'trainer' . $i . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'trainer',
            ]);
        }

        // trainee user
        $trainee = User::create([
            'name' => 'Trainee',
            'email' => 'trainee@example.com',
            'password' => Hash::make('password'),
            'role' => 'trainee',
        ]);

        // Note: Make sure to replace '1' with the actual academy_id to establish the foreign key relationship.

        // Output a message to the console
        $this->command->info('Users seeded successfully!');
    }
}