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
        @endif
    </div>
</div>

<div class="innerPage mt-3">
    <div class="container">
        <div class="col-md-2 ms-auto mb-3">
            <a href="{{ route('technology.create', ['category' => $category->id]) }}" class="btn btn-primary m-auto">Create technology</a>
        </div>

        <div class="projectCard">
            <div class="row justify-content-center"> <!-- Center the row -->
                <div class="col-md-8">
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

                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                </div>

                <form method="POST" action="{{ route('technology.addToCohort') }}">
                    @csrf
                    @foreach ($technologies as $technology)
                    <div class="col-sm-12 mb-3">
                        <div class="card" style="box-shadow: 0px 4px 6px rgb(0 0 0 / 33%);">
                            <div class="card-body d-flex align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="technologies[]" id="technology{{ $technology->id }}" value="{{ $technology->id }}">
                                    <label class="form-check-label" for="technology{{ $technology->id }}">
                                        {{ $technology->technologies_name }}
                                    </label>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mb-3">Add Selected Technologies to Cohort</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
