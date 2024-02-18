@extends('layouts.app')
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}
<section class="innerImage classRoom">
    <img src="{{ asset('assets/img/img_bookclub.jpg') }}" alt="">
    <div class="pageTitle">
        <h2> Classroom</h2>
    </div>
   
</section>
@include('layouts.innerNav')
<section class="inner-bred">
    <div class="container">
         <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">test</a></li>

        </ul>
    </div>
       
       
</section>


{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}




<div class="innerPage  py-1 mt-5">
    <div class="container">
    <h2 class="mb-4">Project Details</h2>

<div class="row">
    <!-- First Card - Project Image and Trainer Info -->
    <div class="col-md-4 mb-4">
        <div class="card">
            <img src="{{ asset('assets/img/project.png') }}" class="card-img-top" alt="Project Image">
            <div class="card-body">
                <h5 class="card-title">Project Name</h5>
                <p class="card-text">Created by: Trainer Name</p>
                <p class="card-text">Created on: January 1, 2023</p>
            </div>
        </div>
    </div>

    <!-- Second Card - Project Description -->
    <div class="col-md-8 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Project Description</h5>
                <p class="card-text">
                As full-stack web developers, you must build a Single Page Application using React, that provide a booking service website for the end-user without using Database Using calling external API Your single-page applications (SPA) should have the following:
                    <ul>
                    <li>1.	Setup the development environment for React.</li>
                    <li>2.	Choose a correct theme that covers UI/UX standards and good design to show your visual identity inside your project.</li>
                    <li>3.	The landing page (Home) shows the booking services that you will provide in your SPA.</li>
                    <li>4.	Your application should have static pages such as: about us, contact us, …. etc. (to implement Routes in React)</li>
                    <li>5.	Your application should have a feature for Register, and log in.</li>
                    <li>6.	You must build your web application using HOOKS with React.</li>
                    <li>7.	Users can have full access to the website and read all about your service and can book a date to receive your service, but upon confirming the date if the user was not logged in then you must get the user to register and log in (if not registered) before can confirm the booking.</li>
                    <li>8.	Your website must be fully responsive.</li>
                    <li>9.	Your SPA must have a rating or leave a comment for the service he chooses it</li>
                </ul>

                Notice: YOU MUST add a feature match with your project idea after Delivering your main project and don’t create Admin dashboard.

                </p>
            </div>
        </div>
    </div>

    <!-- Third Card - Target Skills -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Target Skills</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Skill 1 - Level 1</li>
                    <li class="list-group-item">Skill 2 - Level 2</li>
                    <li class="list-group-item">Skill 3 - Level 3</li>
                </ul>
            </div>
        </div>
    </div>
</div>

     
    </div>
</div>




@endsection