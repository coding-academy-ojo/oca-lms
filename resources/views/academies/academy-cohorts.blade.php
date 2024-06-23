@extends('layouts.app')
@section('title')
Trainer's Academies and Cohorts
@endsection

@section('content')
@include('layouts.innerNav')

<nav style="padding: 50px 50px 0;" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Academies</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cohorts</li>
    </ol>
</nav>

<div class="container my-5">
    <h2>Academy Cohorts</h2>
    <div style="min-height: 50vh" class="d-flex align-items-center flex-wrap my-4 gap-3 justify-content-center g-4">

        @forelse ($academies as $academy)
            <div class="col-md-8 col-lg-8 mb-4">
                <div class="card" id="academy-card">
                    <div class="row">
                        <div class="col-md-4 d-flex align-items-center position-relative">
                            <img style="height: 100%; width: 30px; margin-right: 10px;"
                                src="{{ asset('assets/img/orangeBG.png') }}" alt="Card image cap">
                            <div class="p-3 d-flex flex-wrap flex-column">
                                <h5 class="card-title">{{ $academy->academy_name }}</h5>
                                <p class="card-text">Location: {{ $academy->academy_location }}</p>
                                <p class="card-text">Manager:
                                    @if ($academy->managers->first())
                                        {{ $academy->managers->first()->staff_name }}
                                    @else
                                        No manager assigned
                                    @endif
                                </p>
                                <p class="py-1">
                                </p>
                                <!-- Edit Academy Button -->
                                @auth('staff')
                                    @if (Auth::guard('staff')->user()->role === 'super_manager')
                                        <a href="{{ route('editacademy', $academy->id) }}"
                                            class="btn btn-primary btn-sm position-absolute bottom-0 end-0 mb-2 mx-4 edit-academy-btn">
                                            <span class="material-symbols-outlined">
                                                edit
                                            </span>
                                        </a>
                                    @elseif (Auth::guard('staff')->user()->role === 'manager')
                                        <button class="btn btn-primary btn-sm position-absolute bottom-0 end-0 mb-2 mx-4"
                                            type="button" data-bs-toggle="offcanvas" data-bs-target="#addCohortOffcanvas"
                                            aria-controls="addCohortOffcanvas" onclick="setAcademyId({{ $academy->id }})">
                                            <span class="material-symbols-outlined">add</span>
                                        </button>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="overflow-auto" style="max-height: 200px;">
                                    <!-- Dynamic cohort cards -->
                                    @forelse ($academy->cohorts as $cohort)
                                        <div class="card mb-2" style="width: 100%;">
                                            <div class="card-body d-flex justify-content-between">
                                                <div>
                                                    <h6 class="card-title">{{ $cohort->cohort_name }}</h6>
                                                    <p class="card-text">Start Date: {{ $cohort->cohort_start_date }}</p>
                                                    <p class="card-text">End Date: {{ $cohort->cohort_end_date }}</p>
                                                    <p class="card-text">Cohort Donor: {{ $cohort->cohort_donor }}</p>
                                                    <p class="card-text">Description: {{ $cohort->cohort_description }}</p>
                                                </div>
                                                <div class="d-flex gap-1">
                                                    <div>
                                                        <a href="{{ route('view-cohort', ['cohort' => $cohort->id]) }}"
                                                            class="btn btn-sm btn-primary"><span class="material-symbols-outlined">
                                                                visibility
                                                                </span></a>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p>No cohorts found for this academy.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning" role="alert">
                There are no academies available.
            </div>
        @endforelse
    </div>
</div>
@endsection
