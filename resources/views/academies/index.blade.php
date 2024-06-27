@extends('Layouts.app')

@section('title')
    Academies
@endsection

@section('content')
    @include('Layouts.innerNav')
    <style>
        @media (max-width: 780px) {
            .edit-academy-btn {

                position: static;
                margin-top: 30px;
            }

            #academy-card {
                max-width: 500px !important;
            }
        }
    </style>
   @if(session('success'))
   <script>
   Swal.fire({
       title: 'Success!',
       html: '<div style="color: #ff7900; font-size: 30px;"><i class="fas fa-check-circle"></i></div>' +
             '<div style="margin-top: 20px;">{{ session("success") }}</div>',
       showConfirmButton: true,
       timer: 5000,
       confirmButtonColor: '#ff7900',
   });
   </script>
   @endif
    @if (session('error'))
        <div class="d-flex gap-2 justify-content-center">
            <div id="alertMessage" class="alert alert-danger alert-dismissible fade show" role="alert"
                style="min-width: 300px; background-color: #dc3545; border: none; color: white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); border-radius: 5px;">
                {{ session('error') }}
            </div>
            <button id="closeAlertButton" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                style="color: white; background-color: #dc3545; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; border: none; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.15);">
                &times;
            </button>
        </div>
    @endif
    @if ($isSuperManager)
        <div class="d-flex justify-content-end p-3 px-xl-5">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#createAcademyOffcanvas" aria-controls="createAcademyOffcanvas">
                Create Academy
            </button>
        </div>
    @endif
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
                                            aria-controls="addCohortOffcanvas" onclick="setAcademyId({{ $academy->id }})"><span
                                                class="material-symbols-outlined">add</span></button>
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
                                                    <!-- Example additional detail -->
                                                    <p class="card-text">Cohort Donor: {{ $cohort->cohort_donor }}</p>
                                                    <!-- Example additional detail -->
                                                </div>
                                                <div class="d-flex gap-1">
                                                <div>
                                                    <a href="{{ route('view-cohort', ['cohort' => $cohort->id]) }}"
                                                        class="btn btn-sm btn-primary"><span class="material-symbols-outlined">
                                                            visibility
                                                            </span></a>
                                                </div>
                                               @if ($user = Auth::guard('staff')->user()->role == 'manager')
                                                <div>
                                                    <a href="{{ route('cohortedit', ['cohort' => $cohort->id]) }}" class="btn btn-sm btn-primary">
                                                        <span class="material-symbols-outlined">edit</span>
                                                    </a>
                                                </div>
                                                @endif

                                                
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
    @if ($isSuperManager)
        @include('academies.offcanvas._create-academy')
    @endif


    @auth('staff')
        @if (Auth::guard('staff')->user()->role === 'manager')
            @include('academies.offcanvas._create-cohort')
        @endif
    @endauth


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var closeButton = document.getElementById('closeAlertButton');
            var alertMessage = document.getElementById('alertMessage');

            closeButton.addEventListener('click', function() {
                alertMessage.style.display = 'none';
                closeButton.style.display = 'none';
            });
        });

        function setAcademyId(academyId) {
            document.getElementById('hiddenAcademyId').value = academyId;
            console.log(academyId)
        }
    </script>
@endsection
