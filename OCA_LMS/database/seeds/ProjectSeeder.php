<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProjectSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('projects')->insert([
            [
                'project_name' => 'Project 1 : Mockup & Wirframe UI/UX',
                'project_description' => 'This project and will be done individually using bootstrap, HTML, CSS and PHP. The trainee should build the website using PHP from scratch, all the tasks should be organized and tracked using Trello, you should deliver all the required pages. All the pages of the website should be responsive, and your website should have a coherent visual identity all over, including Logo, Theme colors, fonts, and media types. This project consists of: • The website contains a view_products page; this page should include all the products cards that has been inserted form Add_products Page. • The home page should contain menu. In the Add-products Page, can insert their items to the store; each item has many details; Item name, photo, details date, is active. The image path (URL) should be fixed for all items and no need to fill it every adding item. Every added item should be added in a table below. • You can use bootstrap for design and don’t forget the nav bar and footer for all pages. • If no products added, you have to handle this issue in the view_products page.                ',
                'project_start_date' => '2024-02-25',
                'project_delivery_date' => '2024-02-27',
                'project_image' => '1708844437.webp', // You can specify the image path if needed
                'project_deliverable' => 'Responsive website GitHub Repo Link that contains the whole project (all above). Trello Link that contains the whole tasks.',
                'project_resources' => 'Resource 1, Resource 2',
                'project_assessment_methods' => 'The project will be evaluated in front of the Technical Team, the evaluation duration will be 15min for each one individually and 10 .',
                'cohort_id' => 1, // Adjust based on your cohorts
                'staff_id' => 3, // Adjust based on your staff
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'project_name' => 'Project 2 : Portfolio Website - Static',
                'project_description' => 'This project and will be done individually using bootstrap, HTML, CSS and PHP. The trainee should build the website using PHP from scratch, all the tasks should be organized and tracked using Trello, you should deliver all the required pages. All the pages of the website should be responsive, and your website should have a coherent visual identity all over, including Logo, Theme colors, fonts, and media types. This project consists of: • The website contains a view_products page; this page should include all the products cards that has been inserted form Add_products Page. • The home page should contain menu. In the Add-products Page, can insert their items to the store; each item has many details; Item name, photo, details date, is active. The image path (URL) should be fixed for all items and no need to fill it every adding item. Every added item should be added in a table below. • You can use bootstrap for design and don’t forget the nav bar and footer for all pages. • If no products added, you have to handle this issue in the view_products page.                ',
                'project_start_date' => '2024-03-01',
                'project_delivery_date' => '2024-03-04',
                'project_image' => '1708779664.jpg',
                'project_deliverable' => 'Responsive website
                GitHub Repo Link that contains the whole project (all above).
                Trello Link that contains the whole tasks.',
                'project_resources' => 'Resource 3, Resource 4',
                'project_assessment_methods' => 'The project will be evaluated in front of the Technical Team, the evaluation duration will be 15min for each one individually and 10 .',
                'cohort_id' => 1,
                'staff_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_name' => 'Project 3 : Building Online Quiz Website Using JavaScript',
                'project_description' => 'Build a responsive and dynamic quiz website that requires the user to register and sign in to answer quiz questions, compare the user answers with the correct answers previously saved on local storage.',
                'project_start_date' => '2024-04-01',
                'project_delivery_date' => '2024-04-04',
                'project_image' => '1708779664.jpg',
                'project_deliverable' => 'Responsive website
                GitHub Repo Link that contains the whole project (all above).
                Trello Link that contains the whole tasks.',
                'project_resources' => 'Resource 3, Resource 4',
                'project_assessment_methods' => 'The project will be evaluated in front of the Technical Team, the evaluation duration will be 15min for each one individually and 10 .',
                'cohort_id' => 1,
                'staff_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_name' => 'Project 4 : Build Ecommerce Website (PHP & MySql)',
                'project_description' => 'You will build an e-commerce web application using Front-end and back-end (PHP and MYSQL), You can choose any type of products you want [cars, clothes, furniture, ..etc.], but.',
                'project_start_date' => '2024-04-20',
                'project_delivery_date' => '2024-04-25',
                'project_image' => '1708779664.jpg',
                'project_deliverable' => 'Responsive website
                GitHub Repo Link that contains the whole project (all above).
                Trello Link that contains the whole tasks.',
                'project_resources' => 'Resource 3, Resource 4',
                'project_assessment_methods' => 'The project will be evaluated in front of the Technical Team, the evaluation duration will be 15min for each one individually and 10 .',
                'cohort_id' => 1,
                'staff_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_name' => 'Project 1 : Mockup & Wirframe UI/UX',
                'project_description' => 'This project and will be done individually using bootstrap, HTML, CSS and PHP. The trainee should build the website using PHP from scratch, all the tasks should be organized and tracked using Trello, you should deliver all the required pages. All the pages of the website should be responsive, and your website should have a coherent visual identity all over, including Logo, Theme colors, fonts, and media types. This project consists of: • The website contains a view_products page; this page should include all the products cards that has been inserted form Add_products Page. • The home page should contain menu. In the Add-products Page, can insert their items to the store; each item has many details; Item name, photo, details date, is active. The image path (URL) should be fixed for all items and no need to fill it every adding item. Every added item should be added in a table below. • You can use bootstrap for design and don’t forget the nav bar and footer for all pages. • If no products added, you have to handle this issue in the view_products page.                ',
                'project_start_date' => '2024-02-25',
                'project_delivery_date' => '2024-02-27',
                'project_image' => '1708844437.webp', // You can specify the image path if needed
                'project_deliverable' => 'Responsive website GitHub Repo Link that contains the whole project (all above). Trello Link that contains the whole tasks.',
                'project_resources' => 'Resource 1, Resource 2',
                'project_assessment_methods' => 'The project will be evaluated in front of the Technical Team, the evaluation duration will be 15min for each one individually and 10 .',
                'cohort_id' => 4, // Adjust based on your cohorts
                'staff_id' => 3, // Adjust based on your staff
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'project_name' => 'Project 2 : Portfolio Website - Static',
                'project_description' => 'This project and will be done individually using bootstrap, HTML, CSS and PHP. The trainee should build the website using PHP from scratch, all the tasks should be organized and tracked using Trello, you should deliver all the required pages. All the pages of the website should be responsive, and your website should have a coherent visual identity all over, including Logo, Theme colors, fonts, and media types. This project consists of: • The website contains a view_products page; this page should include all the products cards that has been inserted form Add_products Page. • The home page should contain menu. In the Add-products Page, can insert their items to the store; each item has many details; Item name, photo, details date, is active. The image path (URL) should be fixed for all items and no need to fill it every adding item. Every added item should be added in a table below. • You can use bootstrap for design and don’t forget the nav bar and footer for all pages. • If no products added, you have to handle this issue in the view_products page.                ',
                'project_start_date' => '2024-03-01',
                'project_delivery_date' => '2024-03-04',
                'project_image' => '1708779664.jpg',
                'project_deliverable' => 'Responsive website
                GitHub Repo Link that contains the whole project (all above).
                Trello Link that contains the whole tasks.',
                'project_resources' => 'Resource 3, Resource 4',
                'project_assessment_methods' => 'The project will be evaluated in front of the Technical Team, the evaluation duration will be 15min for each one individually and 10 .',
                'cohort_id' => 4,
                'staff_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_name' => 'Project 3 : Building Online Quiz Website Using JavaScript',
                'project_description' => 'Build a responsive and dynamic quiz website that requires the user to register and sign in to answer quiz questions, compare the user answers with the correct answers previously saved on local storage.',
                'project_start_date' => '2024-04-01',
                'project_delivery_date' => '2024-04-04',
                'project_image' => '1708779664.jpg',
                'project_deliverable' => 'Responsive website
                GitHub Repo Link that contains the whole project (all above).
                Trello Link that contains the whole tasks.',
                'project_resources' => 'Resource 3, Resource 4',
                'project_assessment_methods' => 'The project will be evaluated in front of the Technical Team, the evaluation duration will be 15min for each one individually and 10 .',
                'cohort_id' => 4,
                'staff_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_name' => 'Project 4 : Build Ecommerce Website (PHP & MySql)',
                'project_description' => 'You will build an e-commerce web application using Front-end and back-end (PHP and MYSQL), You can choose any type of products you want [cars, clothes, furniture, ..etc.], but.',
                'project_start_date' => '2024-04-20',
                'project_delivery_date' => '2024-04-25',
                'project_image' => '1708779664.jpg',
                'project_deliverable' => 'Responsive website
                GitHub Repo Link that contains the whole project (all above).
                Trello Link that contains the whole tasks.',
                'project_resources' => 'Resource 3, Resource 4',
                'project_assessment_methods' => 'The project will be evaluated in front of the Technical Team, the evaluation duration will be 15min for each one individually and 10 .',
                'cohort_id' => 4,
                'staff_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
