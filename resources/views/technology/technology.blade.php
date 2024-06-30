@extends('Layouts.app')
@section('title')
Technologies
@endsection
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

@include('Layouts.innerNav')
<section class="inner-bred">

    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="/categories">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">{{ $category->Categories_name }}</a></li>
        </ul>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}


<div class="innerPage mt-3">
    <div class="container">
        @if(Auth::guard('staff')->check() && Auth::guard('staff')->user()->role === 'trainer')
        <!-- ms-auto -->
        <!-- <div class="col-md-2 mb-3">
            <a href="{{ route('technology.create', ['category' => $category->id]) }}" class="btn btn-primary m-auto">Create technology</a>
        </div> -->
        @endif

        <div class="projectCard">
            <div class="row justify-content-center"> <!-- Center the row -->
                <div class="col-md-8"> <!-- Define the column width -->
                    @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>






<div class="innerPage   mt-3">
    <div class="container">

        <div class="col-md-2 ms-auto mb-3">
            <a href="{{ route('technology.create', ['category' => $category->id]) }}"  class="btn btn-primary m-auto">Create technology</a>
        </div>
        <div class="projectCard">
            <div class="row">
                @foreach ($technologies as $technology)
                <div class="col-sm-3 mb-3">
                    <div class="card">
                        <a href="{{ route('technology.showInfo', ['technology' => $technology]) }}">
                            <img src="{{ asset('assets/img/' . $technology->technologies_photo) }}" alt="">
                        </a>

                        <div class="innerCard">
                            <a href="{{ route('technology.showInfo', ['technology' => $technology]) }}">
                                <h4 class="text-center">{{ $technology->technologies_name }}</h4>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection