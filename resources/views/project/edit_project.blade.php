@extends('Layouts.app')
@section('title')
Edit Project
@endsection
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

@include('Layouts.innerNav')
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
            <li><a style="color:#F16E00"href="">Edit Project</a></li>
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

     <h2>Edit Project</h2>
<form action="{{ route('update_project', ['id' => $project->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') {{-- Use the PUT method for updating --}}

    <div class="mb-3">
        <label for="name" class="form-label">Project Name</label>
        <input type="text" class="form-control" id="name" name="project_name" value="{{ old('project_name', $project->project_name) }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Project Description</label>
        <textarea class="form-control auto-grow" id="description" name="project_description" required>{{ old('project_description', $project->project_description) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="project_type" class="form-label">Project Type</label>
        <select class="form-select" id="project_type" name="project_type">
            <option value="Group" {{ old('project_type', $project->project_type) === 'Group' ? 'selected' : '' }}>Group</option>
            <option value="Individual" {{ old('project_type', $project->project_type) === 'Individual' ? 'selected' : '' }}>Individual</option>
            <option value="Corrective Action" {{ old('project_type', $project->project_type) === 'Corrective Action' ? 'selected' : '' }}>Corrective Action</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Project Image</label>
        <input type="file" class="form-control" id="image" name="project_image">
        <img src="{{ asset('images/' . $project->project_image) }}" alt="Project Image" class="img-thumbnail mt-2" style="max-width: 200px">
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="project_start_date" value="{{ old('project_start_date', $project->project_start_date) }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="delivery_date" class="form-label">Delivery Date</label>
            <input type="date" class="form-control" id="delivery_date" name="project_delivery_date" value="{{ old('project_delivery_date', $project->project_delivery_date) }}" required>
        </div>
    </div>


        <!-- New Fields -->
        <div class="mb-3">
            <label for="project_deliverable" class="form-label">Project Deliverable</label>
            <input type="text" class="form-control" id="project_deliverable" name="project_deliverable" value="{{ old('project_deliverable', $project->project_deliverable) }}">
        </div>

        <div class="mb-3">
            <label for="project_resources" class="form-label">Project Resources</label>
            <input type="text" class="form-control" id="project_resources" name="project_resources" value="{{ old('project_resources', $project->project_resources) }}">
        </div>

        <div class="mb-3">
            <label for="project_assessment_methods" class="form-label">Project Assessment Methods</label>
            <input type="text" class="form-control" id="project_assessment_methods" name="project_assessment_methods" value="{{ old('project_assessment_methods', $project->project_assessment_methods) }}">
        </div>
        <!-- End of New Fields -->

    <button type="submit" class="btn btn-primary">Update Project</button>
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
