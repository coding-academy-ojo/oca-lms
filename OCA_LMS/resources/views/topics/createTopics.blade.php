@extends('layouts.app')
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}
<section class="innerImage classRoom">
    <img src="{{ asset('assets/img/img_bookclub.jpg') }}" alt="">
    <div class="pageTitle">
        <h2>Topics</h2>
    </div>

</section>
@include('layouts.innerNav')
<section class="inner-bred">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">Create Topics</a></li>

        </ul>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}


<div class="innerPage  py-1 mt-5">
    <div class="container">
        <div class="addpro">


            <h1 class="text-center mb-4">Create New Topic </h1>
            <form>
                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control rounded-pill" id="title" name="title" placeholder="Enter the title" required>
                </div>
                
                <!-- Context -->
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
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