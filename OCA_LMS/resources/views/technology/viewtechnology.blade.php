@extends('layouts.app')
@section('title')
Edit Topic
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
            <li><a href="">{{ $technology->technologies_name }}</a></li>

        </ul>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}
<div class="innerPage  mt-3">
    <div class="container">
        <div class="addpro">
            <div>
                <div>
                    <div class="topicBt">
                        <a href="{{ route('technology.edit', ['technology' => $technology]) }}">edit</a>
                        <form method="POST" action="{{ route('technology.destroy', ['technology' => $technology]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                            <input type="submit" value="Delete">
                        </form>
                    </div>
                    @if ($technology->technologies_photo)
                    <!-- <img src="{{ asset('images/' . $technology->technologies_photo) }}" alt="Technology Image"> -->
                    <img src="{{ asset('assets/img/' . $technology->technologies_photo) }}" alt="Technology Image">

                    @else
                    <p>No image uploaded</p>
                    @endif
                    <h1>{{ $technology->technologies_name }}</h1>
                    <p>Description: {{ $technology->technologies_description }}</p>
                    <p>Resources: {{ $technology->technologies_resources }}</p>
                    <p>Training Period: {{ $technology->technologies_trainingPeriod }}</p>
                    <!-- Add more details as needed -->
                    <p>Category: {{ $technology->technology_category_id }}</p>
                    <!-- If you have an image, you can display it like this -->

                </div>

            </div>

        </div>
    </div>
</div>
@endsection