@extends('layouts.app')
@section('title')
All Projects
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
            <li><a style="color:#F16E00"href="/projects">Project</a></li>
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

        @if(Auth::guard('staff')->check() && Auth::guard('staff')->user()->role === 'trainer')
        <div class="col-md-2 ms-auto mb-3">
            <form action="{{ route('show_add_project_form') }}" method="GET">
                <button type="submit" class="btn btn-primary">Add Project</button>
            </form>
        </div>
        @endif


            <div class="row">
                @foreach($projects as $project)
                    <div class="col-sm-3 mb-3">
                        <div class="card">
                            <div class="innerCard">
                                <a href="{{ route('project_brief', ['id' => $project->id]) }}">
                                    <img style="height: 250px; width: 100%;" src="{{ asset('images/' . $project->project_image) }}" alt="{{ $project->project_name }}">
                                </a>
                                <div class="container mt-2">
                                    <a href="{{ route('project_brief', ['id' => $project->id]) }}">
                                        <h4>{{ $project->project_name }}</h4>
                                    </a>
                                    <div class="createdby">
                                        <div class="personInfo" style="display: flex; align-items: center;">
                                            <img style="height: 50px; width: 50px; border-radius: 50%; margin-right: 10px;" src="{{ asset('images/' . $project->staff->staff_personal_img)}}" alt="" class="avatar">
                                            <p style="margin: 0;"><strong>{{ $project->staff->staff_name }}</strong></p>
                                        </div>
                                        <div style="margin-top: 10px; margin-left: 20px;">
                                            <p style="font-size: 12px; color: #444;">Start Date: {{ $project->project_start_date }}</p>
                                            <p style="font-size: 12px; color: #444;">Delivery Date: {{ $project->project_delivery_date }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


    </div>
</div>

@endsection
