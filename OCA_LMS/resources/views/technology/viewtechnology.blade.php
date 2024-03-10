@extends('layouts.app')
@section('title')
Technology
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
        <div class="">
            <div>
                <div>
                    <div class="vt" style="display: flex;
                               justify-content: flex-end;
                                             gap: 1rem;">

                        @if(Auth::guard('staff')->check() && Auth::guard('staff')->user()->role === 'trainer')
                        <form method="POST" action="{{ route('technology.destroy', ['technology' => $technology]) }}">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('technology.edit', ['technology' => $technology]) }}" class=" btn btn-primary m-auto">edit</a>
                            <button class=" btn btn-primary m-auto" type="submit">Delete</button>
                        </form>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" data-technologyid="{{ $technology->id }}">
                        Add Topic
                        </button>
                        @endif

                    </div>
                    @if ($technology->technologies_photo)
                    <!-- <img src="{{ asset('images/' . $technology->technologies_photo) }}" alt="Technology Image"> -->
                    <img style="    width: 100%;
    height: 350px;
    object-fit: cover;
    margin: 2rem 0px;" src="{{ asset('assets/img/' . $technology->technologies_photo) }}" alt="Technology Image">


                    @else
                    <p>No image uploaded</p>
                    @endif
                    <h1>{{ $technology->technologies_name }}</h1>
                    <p>Description: {{ $technology->technologies_description }}</p>
                    <p>Resources:<a href="{{ $technology->technologies_resources }}" target="_blank"> {{ $technology->technologies_resources }}</a></p>
                    <p>Training Period: {{ $technology->technologies_trainingPeriod }}</p>
                    <!-- Add more details as needed -->
                    <!-- <p>Category: {{ $technology->technology_category_id }}</p> -->
                    <!-- If you have an image, you can display it like this -->
                    <p>Topics:</p>
                    @foreach ($Topics as $topic)
                        <span class="mx-4">{{ $topic->topic_name }}</span>
                    @endforeach
                </div>

            </div>

        </div>
    </div>
</div>
{{-- Model --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Close"><span class="visually-hidden">Close</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('topic.store') }}" enctype="multipart/form-data" class="needs-validation m-auto" novalidate>
                    @csrf
                    <div class="input-group my-3">
                        <input type="text" class="form-control" name="topic" placeholder="Add Topic" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <input type="hidden" name="technology_id" id="technology_id" value="">
                        <button class="btn btn-primary" type="submit" id="button-addon2">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection