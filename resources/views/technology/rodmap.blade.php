@extends('Layouts.app')
@section('title')
Roadmap
@endsection
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

@include('Layouts.innerNav')
<section class="inner-bred my-5">

    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="{{ route('academyview') }}">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="{{ route('categories.indexCohort') }}">Roadmap</a></li>
        </ul>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}
<div class="innerPage   mt-3">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2 class="text-primary">Roadmap</h2>
            </div>
        </div>

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="projectCard">
            <div class="row">
                @foreach ($categories as $category)
                <div class="col-sm-4 mb-3">
                    <div class="widget-stat card">
                        <a href="{{ route('rodmap.show', $category) }}">
                            <img src="{{ asset('assets/img/project.jpg') }}" alt="">
                        </a>
                        <div class="innerCard">
                            <a href="{{ route('rodmap.show', $category) }}">
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