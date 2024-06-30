@extends('Layouts.app')
@section('title')
Technology Categories
@endsection
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

@include('Layouts.innerNav')
<section class="inner-bred">

    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">Categories</a></li>
        </ul>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}
<div class="innerPage   mt-3">
    <div class="container">
        <div class="projectCard">
            <div class="row">
                @foreach ($categories as $category)
                <div class="col-sm-4 mb-3">
                    <div class="card">
                        <a href="{{ route('categories.show', $category) }}">
                            <img src="{{ asset('assets/img/project.jpg') }}" alt="">
                        </a>
                        <div class="innerCard">
                            <a href="{{ route('categories.show', $category) }}">
                                <h4 class="text-center">{{ $category->Categories_name }}</h4>
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