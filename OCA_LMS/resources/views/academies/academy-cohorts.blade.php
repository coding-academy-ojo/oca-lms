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
   
@endsection
