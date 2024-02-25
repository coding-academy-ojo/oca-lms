<?php

use Illuminate\Database\Seeder;
use App\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Frontend Technologies
         Technology::create([
            'technology_category_id' => 1,
            'technologies_name' => 'UI/UX',
            'technologies_description' => '
            UI (User Interface) and UX (User Experience) are integral aspects of digital design focused on creating intuitive and engaging interactions for users. UI emphasizes the visual elements and layout of a digital product, including buttons, menus, and typography, aiming for aesthetic appeal and clarity. UX, on the other hand, addresses the overall experience and usability of the product, considering factors such as ease of navigation, responsiveness, and user satisfaction. By combining UI design principles with UX methodologies, designers strive to craft seamless and enjoyable experiences for users across websites, applications, and other digital platforms, ultimately enhancing engagement and fostering positive brand interactions.',
            'technologies_resources' => 'https://www.w3schools.com/',
            'technologies_trainingPeriod' => '2 weeks',
            'technologies_photo' => 'project.jpg',
        ]);

        Technology::create([
            'technology_category_id' => 1,
            'technologies_name' => 'HTML+CSS',
            'technologies_description' => 'HTML (Hypertext Markup Language) and CSS (Cascading Style Sheets) are foundational languages in web development. HTML defines the structure and content of web pages using tags to mark elements such as headings, paragraphs, and images. CSS complements HTML by controlling the presentation and layout of these elements, defining styles for colors, fonts, spacing, and more. Together, they enable the creation of visually appealing and well-structured websites with consistent design across different devices. HTML and CSS work in tandem to create user-friendly interfaces, ensuring seamless navigation and an optimal user experience on the World Wide Web.',
            'technologies_resources' => 'https://www.w3schools.com/',
            'technologies_trainingPeriod' => '3 weeks',
            'technologies_photo' => 'project.jpg',
        ]);

        Technology::create([
            'technology_category_id' => 1,
            'technologies_name' => 'JavaScript',
            'technologies_description' => '
            JavaScript (JS) is a versatile programming language primarily used for web development. It enables dynamic and interactive features on websites, enhancing user experience by allowing for actions like form validation, animations, and interactive maps. JavaScript is client-side, meaning it runs in the user browser, reducing server load and enabling faster response times. It supports modern frameworks like React, Angular, and Vue.js, facilitating the creation of complex web applications. With its widespread adoption and compatibility across browsers, JavaScript is an essential tool for front-end developers, empowering them to build engaging and responsive interfaces that adapt to user interactions and preferences.',
            'technologies_resources' => 'https://www.w3schools.com/',
            'technologies_trainingPeriod' => '2 weeks',
            'technologies_photo' => 'project.jpg',
        ]);

        // Backend Technologies
        Technology::create([
            'technology_category_id' => 2,
            'technologies_name' => 'PHP',
            'technologies_description' => 'PHP (Hypertext Preprocessor) is a server-side scripting language widely used for web development. It enables the creation of dynamic web pages and robust web applications by embedding PHP code directly into HTML. PHP excels in interacting with databases, managing sessions, and handling forms, making it versatile for building e-commerce platforms, content management systems, and more. Its open-source nature and extensive community support contribute to its popularity. PHP frameworks like Laravel and Symfony streamline development by providing pre-built components and following modern software engineering practices. With its flexibility and scalability, PHP remains a cornerstone in web development, powering a significant portion of the internet.',
            'technologies_resources' => 'https://www.w3schools.com/',
            'technologies_trainingPeriod' => '2 weeks',
            'technologies_photo' => 'project.jpg',
        ]);

        Technology::create([
            'technology_category_id' => 2,
            'technologies_name' => 'Node.js',
            'technologies_description' => 'Node.js is a runtime environment that allows developers to execute JavaScript code outside the browser, on server-side applications. Built on Chrome V8 JavaScript engine, it enables high-performance, event-driven programming, ideal for building scalable and real-time web applications. Node.js utilizes non-blocking, asynchronous I/O, enhancing efficiency and scalability by handling multiple concurrent connections seamlessly. It boasts an extensive package ecosystem through npm (Node Package Manager), providing access to a myriad of libraries and frameworks. With its versatility, Node.js is widely adopted for building APIs, microservices, and full-stack web applications, revolutionizing backend development with its lightweight, efficient, and JavaScript-centric approach.',
            'technologies_resources' => 'https://www.w3schools.com/',
            'technologies_trainingPeriod' => '2 weeks',
            'technologies_photo' => 'project.jpg',
        ]);

        Technology::create([
            'technology_category_id' => 2,
            'technologies_name' => '.net',
            'technologies_description' => '
            .NET is a robust and versatile framework developed by Microsoft for building a variety of applications, including web, desktop, mobile, and cloud-based solutions. It offers a comprehensive set of tools, libraries, and languages such as C#, F#, and Visual Basic, facilitating rapid development and deployment across platforms. With its rich ecosystem, .NET supports modern software development practices like object-oriented programming, asynchronous programming, and dependency injection. It includes frameworks like ASP.NET for web development, Xamarin for cross-platform mobile app development, and Entity Framework for data access. .NET empowers developers to create scalable, secure, and high-performance applications, driving innovation in the digital landscape.',
            'technologies_resources' => 'https://www.w3schools.com/',
            'technologies_trainingPeriod' => '2 weeks',
            'technologies_photo' => 'project.jpg',
        ]);

        // Database Technologies
        Technology::create([
            'technology_category_id' => 3,
            'technologies_name' => 'MySQL',
            'technologies_description' => 'MySQL is an open-source relational database management system (RDBMS) renowned for its reliability, performance, and scalability. Developed by Oracle Corporation, MySQL is widely used in web applications, powering data storage and retrieval for dynamic websites and enterprise solutions alike. It supports SQL (Structured Query Language), enabling developers to interact with databases efficiently through queries for data manipulation, retrieval, and management. MySQL offers features like ACID compliance, replication, and high availability, making it suitable for mission-critical applications. With its robust security features and compatibility across platforms, MySQL remains a preferred choice for businesses and developers seeking a reliable and scalable database solution.',
            'technologies_resources' => 'https://www.w3schools.com/',
            'technologies_trainingPeriod' => '2 weeks',
            'technologies_photo' => 'project.jpg',
        ]);

        Technology::create([
            'technology_category_id' => 3,
            'technologies_name' => 'MongoDB',
            'technologies_description' => 'MongoDB is a popular NoSQL database management system designed for flexibility, scalability, and performance. Unlike traditional relational databases, MongoDB stores data in a flexible, schema-less format known as BSON (Binary JSON), enabling dynamic and hierarchical data structures. It excels in handling unstructured or semi-structured data, making it ideal for applications with evolving data models or complex data relationships. MongoDB document-oriented architecture allows for seamless integration with modern development practices like agile methodologies and microservices architecture. With features like horizontal scaling, sharding, and replication, MongoDB offers high availability and scalability, making it a preferred choice for businesses dealing with large volumes of data and real-time applications.',
            'technologies_resources' => 'https://www.w3schools.com/',
            'technologies_trainingPeriod' => '2 weeks',
            'technologies_photo' => 'project.jpg',
        ]);

        Technology::create([
            'technology_category_id' => 3,
            'technologies_name' => 'SQLServer',
            'technologies_description' => 'SQL Server, developed by Microsoft, is a robust relational database management system (RDBMS) renowned for its scalability, security, and performance. It offers a comprehensive set of features for managing and querying structured data efficiently. SQL Server supports Transact-SQL (T-SQL), a powerful extension of SQL, enabling developers to write complex queries, stored procedures, and triggers. It provides advanced security features such as row-level security and dynamic data masking, ensuring data protection and compliance. SQL Server offers high availability through features like Always On Availability Groups and automatic failover clustering. With its integration with Microsoft ecosystem, SQL Server is a preferred choice for enterprise-level database solutions.',
            'technologies_resources' => 'https://www.w3schools.com/',
            'technologies_trainingPeriod' => '2 weeks',
            'technologies_photo' => 'project.jpg',
        ]);
    }
}
