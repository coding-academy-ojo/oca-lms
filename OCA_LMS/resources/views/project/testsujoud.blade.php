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

<!-- First Card - Project Image and Trainer Info -->
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <img src="{{ asset('assets/img/s.jpg') }}" style="height: 400px; width:auto; " class="card-img-top" alt="Project Image">
            <div class="card-body">
                <h5 class="card-title">Project Name</h5>
                <p class="card-text">Created by: Trainer Name</p>
                <p class="card-text">Created on: January 1, 2023</p>
            </div>
        </div>
    </div>
</div>

<!-- Second Card - Project Description -->
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Project Description</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
            </div>
        </div>
    </div>
</div>

<!-- Third Card - Target Skills -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <h2>Target Project Skills</h2>
            @php
            $skills = [
                ['id' => 1, 'name' => 'Create mock-ups for an application'],
                ['id' => 2, 'name' => 'Create static and adaptive web user interfaces'],
                ['id' => 3, 'name' => 'Develop a dynamic web user interface'],
            ];

            $levels = [
                ['id' => 1, 'name' => 'Imitate'],
                ['id' => 2, 'name' => 'Adapt'],
                ['id' => 3, 'name' => 'Transpose'],
            ];
            @endphp
  <!-- Loop through each skill -->
  @foreach($skills as $skill)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $skill['name'] }}</h5>
                
                <!-- Loop through each level for the skill -->
                @foreach($levels as $level)
                    <div class="mb-2">
                        <strong>{{ $level['name'] }}:</strong>
                        <div class="progress">
                            <!-- Adjust the width dynamically based on the progress -->
                            <div class="progress-bar {{ ($level['name'] == $skill['level']) ? 'bg-success' : 'bg-secondary' }}"
                                 role="progressbar"style="width: {{ ($level['name'] == $skill['level']) ? '100%' : '0%' }};" aria-valuenow="{{ ($level['name'] == $skill['level']) ? '100' : '0' }}" aria-valuemin="0" aria-valuemax="100">
                                {{ ($level['name'] == $skill['level']) ? 'Achieved' : 'Not Achieved' }}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @endforeach

        </div>
    </div>
            </div>
        </div>
    </div>
</div>
       
    </div>


</div>




@endsection