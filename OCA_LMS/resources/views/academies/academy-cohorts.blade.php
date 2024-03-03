@extends('Layouts.app')
@section('title')
    @if (!$cohorts->isEmpty())
        {{ $cohorts[0]->academy->academy_name }} Cohorts
    @else
        No Cohorts Available
    @endif
@endsection

@section('content')
    @include('layouts.innerNav')

    @if (session('success'))
        <script>
            Swal.fire({
            title: 'Success!',
            html: '<div style="color: #ff7900; font-size: 30px;"><i class="fas fa-check-circle"></i></div>' +
                '<div style="margin-top: 20px;">{{ session('success') }}</div>',
            showConfirmButton: true,
            timer: 5000,
            confirmButtonColor: '#ff7900',
        });
        </script>
    @endif
    <div class="d-flex align-items-center flex-wrap my-4 gap-3 justify-content-center g-4">
        @forelse ($cohorts as $cohort)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('assets/img/img_read_thumb.jpg') }}" alt="Cohort Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $cohort->cohort_name }}</h5>
                    <hr>
                    <p class="card-text py-2">Academy: {{ $cohort->academy->academy_name }}</p>

                    <div class="d-flex g-1 justify-content-end gap-2">
                        <a href="{{ route('view-cohort', $cohort->id) }}" class="btn btn-secondary">View</a>
                        @auth('staff')
                            @if (Auth::guard('staff')->user()->role === 'super_manager'|| Auth::guard('staff')->user()->role === 'manager')
                                <a href="{{ route('cohortedit', $cohort->id) }}" class="btn btn-primary">Edit</a>
                            @endif
                        @endauth

                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning" role="alert">
                No cohorts available for this academy.
            </div>
        @endforelse
    </div>
    @auth('staff')
    @if (Auth::guard('staff')->user()->role === 'super_manager'|| Auth::guard('staff')->user()->role === 'manager')
    <div class="offcanvas offcanvas-end" tabindex="-1" id="addCohortOffcanvas"
                aria-labelledby="addCohortOffcanvasLabel">
                <div class="offcanvas-header">
                    <h5 id="addCohortOffcanvasLabel">Add Cohort</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form id="addCohortForm" action="{{ route('store-cohort') }}" method="POST">
                        @csrf
                        <input type="hidden" name="academy_id" value="{{ $pass_academy_id ?? '' }}">
                        <div class="mb-3">
                            <label for="cohortName" class="form-label">Cohort Name</label>
                            <input type="text" class="form-control" id="cohortName" name="cohort_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="cohortDonor" class="form-label">Cohort Donor</label>
                            <input type="text" class="form-control" id="cohortDonor" name="cohort_donor" required>
                        </div>
                        <div class="mb-3">
                            <label for="cohortDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="cohortDescription" name="cohort_description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="cohortStartDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="cohortStartDate" name="cohort_start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="cohortEndDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="cohortEndDate" name="cohort_end_date" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Cohort</button>
                    </form>
                </div>
            </div>
            <div style="z-index: 1040" class="position-fixed bottom-0 end-0 m-4">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#addCohortOffcanvas"
                    aria-controls="addCohortOffcanvas">
                    <span class="material-symbols-outlined">add</span>
                </button>
            </div>
        @endif
    @endauth
@endsection
