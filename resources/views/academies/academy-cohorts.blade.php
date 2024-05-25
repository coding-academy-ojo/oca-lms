@extends('layouts.app')

@section('title')
    Trainer's Academies and Cohorts
@endsection

@section('content')
    @include('layouts.innerNav')

    <div style="min-height: 50vh" class="container">
        <div class="row justify-content-center my-5">
            @foreach($cohorts as $cohort)
                <div class="col-md-8 col-lg-8 mb-4">
                    <div class="card" id="academy-card">
                        <div class="row">
                            <div class="col-md-4 d-flex align-items-center position-relative">
                                <img style="height: 100%; width: 30px; margin-right: 10px;"
                                    src="{{ asset('assets/img/orangeBG.png') }}" alt="Card image cap">
                                <div class="p-3 d-flex flex-wrap flex-column">
                                    <h5 class="card-title"> {{ $cohort->academy->academy_name }}</h5>
                                    <!-- Removed manager part -->
                                    <p class="py-1"></p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="overflow-auto" style="max-height: 200px;">
                                        <!-- Display cohort details -->
                                        <div class="card mb-2" style="width: 100%;">
                                            <div class="card-body d-flex justify-content-between">
                                                <div>
                                                    <h6 class="card-title">{{ $cohort->cohort_name }}</h6>
                                                    <p class="card-text">Start Date: {{ $cohort->cohort_start_date }}</p>
                                                    <p class="card-text">End Date: {{ $cohort->cohort_end_date }}</p>
                                                    <p class="card-text">Cohort Donor: {{ $cohort->cohort_donor }}</p>
                                                    <!-- You can add more cohort details here -->
                                                </div>
                                                <div>
                                                    <a href="{{ route('view-cohort', $cohort->id) }}" class="btn btn-secondary">View</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
