@extends('layouts.app')
@section('title')
Technologies
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
<!-- <div class="innerPage mt-3">
    <div class="container">
        @if(Auth::guard('staff')->check() && Auth::guard('staff')->user()->role === 'trainer')
        <div class="col-md-2 ms-auto mb-3">
            <a href="{{ route('technology.create', ['category' => $category->id]) }}" class=" btn btn-primary m-auto">Create technology</a>
        </div>
        @endif

        <div class="projectCard">
            <div class="row">
                @foreach ($technologies as $technology)
                <div class="col-sm-3 mb-3">
                    <div class="card">
                        <a href="{{ route('technology.showInfo', ['technology' => $technology]) }}">
                            <img src="{{ asset('assets/img/' . $technology->technologies_photo) }}" alt="">
                        </a>
                        <div class="innerCard" style="gap: 1rem;
    display: flex;
    flex-direction: column;">
                            <a href="{{ route('technology.showInfo', ['technology' => $technology]) }}">
                                <h4 class="text-center">{{ $technology->technologies_name }}</h4>
                            </a>
                          
                            @if(Auth::guard('staff')->check() && Auth::guard('staff')->user()->role === 'trainer')
                            <form style="display: flex;" method="POST" action="{{ route('technology.addToCohort', ['technology' => $technology]) }}">
                                @csrf
                                <input type="hidden" name="cohort_id" value="{{ $technology->technology_category_id }}">
                                <button class=" btn btn-primary m-auto" type="submit">Add to Cohort</button>
                                <a class=" btn btn-primary m-auto" href="{{ route('technology.showInfo', ['technology' => $technology]) }}">view</a>
                            </form>
                            @else
                            <a class=" btn btn-primary m-auto" href="{{ route('technology.showInfo', ['technology' => $technology]) }}">view</a>

                            @endif


                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div> -->








<div class="innerPage   mt-3">
    <div class="container">

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