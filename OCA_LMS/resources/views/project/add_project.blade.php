@extends('layouts.app')
@section('title')
Create Project
@endsection
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

@include('layouts.innerNav')
<section class="inner-bred">

    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            {{-- <li><a href="">{{ $category->Categories_name }}</a></li> --}}
        </ul>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

<div class="innerPage mt-3">
    <div class="container">


        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <h2>Add Project</h2>
    <form action="{{ route('add_project') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="project_name" class="form-label">Project Name</label>
            <input type="text" class="form-control" id="project_name" name="project_name" required>
        </div>

        <div class="mb-3">
            <label for="project_description" class="form-label">Project Description</label>
            <textarea class="form-control auto-grow" id="project_description" name="project_description" required></textarea>
        </div>

        <div class="mb-3">
            <label for="project_image" class="form-label">Project Image</label>
            <input type="file" class="form-control" id="project_image" name="project_image" required>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="project_start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="project_start_date" name="project_start_date" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="project_delivery_date" class="form-label">Delivery Date</label>
                <input type="date" class="form-control" id="project_delivery_date" name="project_delivery_date" required>
            </div>
        </div>

                <!-- New input fields for the added columns -->
        <div class="mb-3">
            <label for="project_deliverable" class="form-label">Project Deliverable</label>
            <input type="text" class="form-control" id="project_deliverable" name="project_deliverable">
        </div>

        <div class="mb-3">
            <label for="project_resources" class="form-label">Project Resources</label>
            <input type="text" class="form-control" id="project_resources" name="project_resources">
        </div>

        <div class="mb-3">
            <label for="project_assessment_methods" class="form-label">Project Assessment Methods</label>
            <input type="text" class="form-control" id="project_assessment_methods" name="project_assessment_methods">
        </div>

        <div class="mb-3">
            <label for="cohort_id" class="form-label">Choose Cohort</label>
            <select class="form-select" id="cohort_id" name="cohort_id">
                @foreach($cohorts as $cohort)
                    @if(Auth::user()->cohorts->contains($cohort))
                        <option value="{{ $cohort->id }}">{{ $cohort->cohort_name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Next</button>
    </form>



    </div>
</div>

<script>
    document.addEventListener('input', function(event) {
        if (event.target && event.target.classList.contains('auto-grow')) {
            autoGrowTextarea(event.target);
        }
    });

    function autoGrowTextarea(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = (textarea.scrollHeight) + 'px';
    }

</script>



@endsection
