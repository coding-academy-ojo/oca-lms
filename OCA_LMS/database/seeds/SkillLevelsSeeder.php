
<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillLevelsSeeder extends Seeder
{
    public function run()
    {
        // Manually insert data into skill_levels table
        DB::table('skill_levels')->insert([
            [
                'skill_id' => 1,
                'level_id' => 1,
                'skillLevels_description' => 'Using a specified mock-up tool, reproduce a mock-up created on the same tool. Describe the elements of the style guide used and the planned security features. Formalize the interface links using the example provided as inspiration. Be capable of demonstrating that the mock-up adapts to mobile devices. Be capable of explaining the reasons for choosing ergonomics for a positive user experience.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 1,
                'level_id' => 2,
                'skillLevels_description' => 'Using a specified mock-up tool, reproduce a mock-up created on the same tool. Describe the elements of the style guide used and the planned security features. Formalize the interface links using the example provided as inspiration. Be capable of demonstrating that the mock-up adapts to mobile devices. Be capable of explaining the reasons for choosing ergonomics for a specific user experience.

                Be capable of explaining the link between the interfaces created and the use cases or user scenarios. Add new interfaces appropriate to other use cases while continuing to meet the existing style guide, security, ergonomics and adaptability criteria.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 1,
                'level_id' => 3,
                'skillLevels_description' => 'Description of the skill – implementation process

                Based on use cases or user scenarios, the style guide and the security requirements identified, design the mock-up for the application user interfaces, with content in French or English, including those appropriate for the target device, taking into account the user experience, and ergonomic features for a mobile device. Formalize the interface links so that the user can approve them as well as the mock-ups. 
                
                Professional context(s) for implementation
                
                Mock-ups are created in the design phase with strong involvement from the current or future end user, most often following an iterative project approach focused on the user experience (Agile approach). Each iteration enables the mock-up to be enhanced and finalized, so that the user can approve the application’s graphical interface and find the main features throughout the development cycle. The iterations may give rise to user presentation workshops. Mock-ups are created for applications on multiple devices and environments. ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 2,
                'level_id' => 1,
                'skillLevels_description' => 'Tasks to perform
                From an expression of need (mock-up) and an existing static user interface:
                
                - I adapt the interface content (change the text, etc.)
                
                - I make minor changes to the structure of the interface (I add a title, a paragraph, etc.)
                
                - I adapt the formatting of the interface (change the color of a title, change the font, etc.)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 2,
                'level_id' => 2,
                'skillLevels_description' => 'Tasks to perform
                From an expression of need (mock-up) and an existing static user interface (created personally or supplied by the training team):
                
                - I make major changes to the interface structure (adding new functional blocks, deleting existing functional blocks, etc.)
                
                - I add pages to my interface
                
                - I add formatting rules',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 2,
                'level_id' => 3,
                'skillLevels_description' => 'Tasks to perform
                Description of the skill — implementation process
                
                Based on the mock-up of the interface to be created and the style guide, and using a presentation language, create static and adaptive web pages, including for mobile devices, in order to obtain an optimized visual rendering suitable for the user’s device and all the target browsers. Follow structural and security best practice and meet the constraints of the target hardware’s architecture. Publish the web pages on a server and make them visible on search engines. Find relevant solutions to solve rendering and accessibility technical problems using documentation in French or English. Share the results of their watch with their peers. 
                
                Professional context(s) for implementation
                
                This skill is performed alone, or in a team when the website ergonomics require web design skills to format information and/or graphical and multimedia objects. The skill may require the use of a development environment and a test environment for the target devices, including mobile devices. Website visibility (SEO) depends on the target audience. ',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Add more data as needed
        ]);

        // You can add more data or loops to insert additional records
    }
}
