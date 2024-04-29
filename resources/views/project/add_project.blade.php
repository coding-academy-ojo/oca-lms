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

    @if (session('success'))
        <script>
            Swal.fire({
            title: 'Success!',
            html: '<div style="color: #ff7900; font-size: 30px;"><i class="fas fa-check-circle"></i></div>' +
                '<div style="margin-top: 20px;">{{ session('success') }}</div>',
            showConfirmButton: true,
            timer: 5000,
            confirmButtonColor: '#ff7900',
        });
        </script>
    @endif

    <div class="container mt-3">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="/projects">Project</a><span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a style="color:#F16E00"href="">Add Project</a></li>
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
            <label for="project_type" class="form-label">Project Type</label>
            <select class="form-select" id="project_type" name="project_type">
                <option value="Group">Group</option>
                <option value="Individual">Individual</option>
                <option value="Corrective Action">Corrective Action</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="project_image" class="form-label">Project Image</label>
            <input type="file" class="form-control" id="project_image" name="project_image" required>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="project_start_date" class="form-label">Start Date</label>
                <input min="{{ date('Y-m-d') }}" type="date" class="form-control" id="project_start_date" name="project_start_date" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="project_delivery_date" class="form-label">Delivery Date</label>
                <input  min="{{ date('Y-m-d') }}" type="date" class="form-control" id="project_delivery_date" name="project_delivery_date" required>
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
