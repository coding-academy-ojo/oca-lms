
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
            [
                'skill_id' => 3,
                'level_id' => 1,
                'skillLevels_description' => 'From an expression of need and an existing dynamic page, I make minor changes to the page: 

                - in terms of the interface content, its structure or its formatting,
                
                - in terms of the client-side processes (input field validation, etc.).',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 3,
                'level_id' => 2,
                'skillLevels_description' => 'From the need expressed and an existing dynamic page (created by the trainee or not): 

                - I make major changes (adding fields or client-side processes),
                
                - I add dynamic pages,
                
                - I add client-side process tests not yet done.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 3,
                'level_id' => 3,
                'skillLevels_description' => 'Description of the skill — implementation process

                Based on the static and adaptive web user interface and style guide, and in compliance with web application development and security best practice: develop, test and document the client-side processes to obtain a dynamic web page and improve the user experience, in particular for mobile devices. Optimize the web application for use on mobile devices. Publish the web application on a server and make it visible on search engines. Carry out a technological watch, including in English, to solve a technical problem or implement a new feature as well as to find out about IT security and known vulnerabilities. Share the results of their watch with their peers. 
                
                Professional context(s) for implementation
                
                This skill is performed alone or in a team and may require the use of a development environment. The visual rendering and features must be verified on all the target browsers. Web application visibility (SEO) depends on the target audience. Optimization of web applications for mobile devices may require the use of asynchronous mechanisms (such as AJAX, etc.).',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 4,
                'level_id' => 1,
                'skillLevels_description' => '- Install a CMS or e-commerce type solution 

                - Build the website structure
                
                - Use a layout pattern provided in the solution installed
                
                - Install an external layout pattern
                
                - Publish the showcase website or online store on a web server
                
                - Follow spelling and grammar rules when drafting documents',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 4,
                'level_id' => 2,
                'skillLevels_description' => '- Install a CMS or e-commerce type solution 

                - Maintain a CMS or e-commerce type solution, including in terms of security aspects
                
                - Take into account the constraints of multilingual applications
                
                - Build the website structure
                
                - Use a layout pattern provided in the solution installed
                
                - Install an external layout pattern
                
                - Create a specific layout pattern
                
                - Make the website visible on search engines with natural SEO techniques
                
                - Publish the showcase website or online store on a web server
                
                - Follow spelling and grammar rules when drafting documents',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 4,
                'level_id' => 3,
                'skillLevels_description' => 'Performance criteria 

                The website is installed and configured in line with the customer’s need. User accounts are created with their rights and roles in compliance with security rules. The website structure meets the customer’s need. The visual appearance follows the customer’s style guide and is suitable for the user’s device. The website is published on a server. The website follows the rules of natural SEO. The search subject is expressed precisely in French or English. The technical documentation relating to the associated technologies, in French or English, is understood (without misinterpretations, etc.). The search procedure enables them to solve a technical problem or implement a new feature. The watch over known vulnerabilities enables them to identify and correct potential flaws. The watch result is shared verbally or in writing with their peers. ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 5,
                'level_id' => 1,
                'skillLevels_description' => 'The DB is created using an error-free script and the data is inserted using an error-free script, the DB complies with the physical template provided and contains the required data once the scripts have been run. The intended users are able to access the DB using the required usage permissions. Questions raised during this implementation have been listed in a document together with the information sources that provided the answers (appropriate forums for the DB, tutorial, reference doc.).',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 5,
                'level_id' => 2,
                'skillLevels_description' => 'The physical schema meets the new client needs. The DB conforms to the schema. The multiplicity of relationships and choice of data type can be described verbally or in writing.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 5,
                'level_id' => 3,
                'skillLevels_description' => 'The database conforms to the physical schema. The database creation script is executed without errors. The test data insertion script is executed without errors. The database is available with the planned access rights. The test database can be recovered if there is an incident. The DBMS security needs are expressed according to the state of the art and the security requirements identified. The search subject is expressed precisely in French or English. The technical documentation relating to the associated technologies, in French or English, is understood (without misinterpretations, etc.). The search procedure enables them to find a solution to a technical problem. The search procedure enables them to solve a technical problem or implement a new feature. The watch result is shared verbally or in writing with their peers. ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 6,
                'level_id' => 1,
                'skillLevels_description' => 'The program with the embedded data access component works and complies with the mini specifications:

                    - The queries are syntactically correct
                    
                    - The queries are functionally correct (e.g. no deletion of an entire table due to a missed parameter)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 6,
                'level_id' => 2,
                'skillLevels_description' => 'The program with the data access components embedded works and complies with the mini specifications:

                    - The queries are syntactically correct
                    
                    - The queries are functionally correct (e.g.: no deletion of an entire table due to a missed parameter)
                    
                    - The new data access components are organized logically
                    
                    - The data is recovered and stored in the form of an object',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 6,
                'level_id' => 3,
                'skillLevels_description' => 'Processes relating to data manipulations correspond to the features described in the technical design file. A unit test is associated with each component, focusing on both function and security. The component source code is documented or auto-documented. The database access components follow the recognized security rules. The security of access components is based on the DBMS security mechanisms. The search subject is expressed precisely in French or English. The technical documentation relating to the associated technologies, in French or English, is understood (without misinterpretations, etc.). The search procedure enables them to solve a technical problem or implement a new feature. The watch over known vulnerabilities enables them to identify and correct potential flaws. The watch result is shared verbally or in writing with their peers.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 7,
                'level_id' => 1,
                'skillLevels_description' => 'The application functions in accordance with the requirements expressed in the technical design file: 

                - the requested changes have indeed been applied,
                
                - the back end is still functional.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 7,
                'level_id' => 2,
                'skillLevels_description' => 'The application functions in accordance with the requirements expressed in the technical design file: 

                - the requested changes have indeed been applied,
                
                - the back end is still functional.
                
                I also ensure that the code implemented is documented and tested (also good from a functional perspective as well as in terms of security).',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 7,
                'level_id' => 3,
                'skillLevels_description' => 'Development best practice is followed. The server components contribute to the application environment’s security. The component source code is documented or auto-documented. The tests guarantee that server processes correspond to the features described in the technical design file. The security tests follow a plan recognized by the profession. The web application is published on a server. The search subject is expressed precisely in French or English. The technical documentation relating to the associated technologies, including in English, is understood (without misinterpretations, etc.). The search procedure enables them to solve a technical problem or implement a new feature. The watch over known vulnerabilities enables them to identify and correct potential flaws. The search and watch result is shared either verbally or in writing with their peers. 


                Resources
                
                ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 8,
                'level_id' => 1,
                'skillLevels_description' => '- Object development best practice is followed

                - The additional or created components are integrated in the application environment
                
                - The server components contribute to the application environment’s security',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 8,
                'level_id' => 2,
                'skillLevels_description' => '- Object development best practice is followed

                - The additional or created components are integrated in the application environment
                
                - The server components contribute to the application environment’s security',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 8,
                'level_id' => 3,
                'skillLevels_description' => 'Object development best practice is followed. The additional or created components are integrated in the application environment. The server components contribute to the application environment’s security. The component source code is documented or auto-documented. The tests guarantee that the server processes correspond to the features described in the specifications. The security tests follow a plan recognized by the profession. The web application is published on a server. The search subject is expressed precisely in French or English. The technical documentation relating to the associated technologies, including in English, is understood (without misinterpretations, etc.). The search procedure enables them to solve a technical problem or implement a new feature. The watch over known vulnerabilities enables them to identify and correct potential flaws. The search and watch result is shared either verbally or in writing with their peers. 


                Resources
                
                Add a resource',
                'created_at' => now(),
                'updated_at' => now(),
            ],

           
        ]);

       
    }
}
