@extends('layouts.app')
@section('title')
Create project
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
            <li><a href="">Create project</a></li>

        </ul>
    </div>


</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}


<div class="innerPage  py-1 mt-5">
    <div class="container">
        <div class="addpro">


            <h1 class="text-center mb-4">Create New Project Brief</h1>
            <form>
                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control rounded-pill" id="title" name="title" placeholder="Enter the title" required>
                </div>

                <!-- Quick Description -->
                <div class="mb-4">
                    <label for="quickDescription" class="form-label">Quick Description <span class="text-danger">*</span></label>
                    <textarea class="form-control rounded-pill auto-resize" id="quickDescription" name="quickDescription" placeholder="Enter a quick description" required></textarea>
                </div>

                <!-- Context -->
                <div class="mb-4">
                    <label for="context" class="form-label">Context <span class="text-danger">*</span></label>
                    <textarea class="form-control rounded-pill auto-resize" id="context" name="context" placeholder="Enter the context" required></textarea>
                </div>

                <!-- Learning Method -->
                <div class="mb-4">
                    <label for="learningMethod" class="form-label">Learning Method <span class="text-danger">*</span></label>
                    <textarea class="form-control rounded-pill auto-resize" id="learningMethod" name="learningMethod" placeholder="Enter the learning method" required></textarea>
                </div>

                <!-- Assessment Method -->
                <div class="mb-4">
                    <label for="assessmentMethod" class="form-label">Assessment Method <span class="text-danger">*</span></label>
                    <textarea class="form-control rounded-pill auto-resize" id="assessmentMethod" name="assessmentMethod" placeholder="Enter the assessment method" required></textarea>
                </div>

                <!-- Deliverables -->
                <div class="mb-4">
                    <label for="deliverables" class="form-label">Deliverables <span class="text-danger">*</span></label>
                    <textarea class="form-control rounded-pill auto-resize" id="deliverables" name="deliverables" placeholder="Enter the deliverables" required></textarea>
                </div>

                <!-- Performance Criteria -->
                <div class="mb-4">
                    <label for="performanceCriteria" class="form-label">Performance Criteria <span class="text-danger">*</span></label>
                    <textarea class="form-control rounded-pill auto-resize" id="performanceCriteria" name="performanceCriteria" placeholder="Enter the performance criteria" required></textarea>
                </div>

                <!-- Submit Button -->
                <button  class="btn btn-primary rounded-pill"><a style="text-decoration: none" href="{{route('createProjectSkills')}}">Next step</a></button>
            </form>
        


        </div>




    </div>
</div>

<script>
    document.addEventListener('input', function(e) {
        if (e.target.tagName.toLowerCase() === 'textarea' && e.target.classList.contains('auto-resize')) {
            autoResizeTextarea(e.target);
        }
    });

    function autoResizeTextarea(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = (textarea.scrollHeight + 2) + 'px'; // 2px offset to prevent scrollbar flickering
    }
</script>


@endsection