@extends('layouts.app')
@section('title')
Topics
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
            <li><a href="">{{ $category->Categories_name }}</a></li>
        </ul>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}
<div class="innerPage   mt-3">
    <div class="container">

        <div class="col-md-2 ms-auto mb-3">
            <a href="{{ route('technology.create', ['category' => $category->id]) }}">Create technology</a>
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
                            <!-- <div class="topicBt">
                                <a href="{{ route('technology.showInfo', ['technology' => $technology]) }}">view</a>
                                <a href="#">Delete</a>
                            </div> -->
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection