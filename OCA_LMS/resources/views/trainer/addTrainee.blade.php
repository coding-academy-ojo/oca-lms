<!-- resources/views/pages/announcements.blade.php -->
@extends('layouts.app')
@section('title')
Add Trainee
@endsection
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}


@include('layouts.innerNav')
<section class="inner-bred my-5 ">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">Trainees</a></li>

        </ul>
    </div>
</section>


<!-- Invite trainees Modal -->
<div class="modal fade" id="inviteTraineeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Invite Trainees To Your Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Enter Email:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Invite</button>
            </div>
        </div>
    </div>
</div>

<!-- add trainee header -->

<div class="container border-bottom col-12 ">
    <div class="row border-bottom text-primary">
        <div class="col-6 ">
            <h1 class="display-4 ">Trainees</h1>
        </div>
        <div class="col-4  ">
        </div>

        <div class="col-1 align-bottom ">
            4 Trainees
        </div>
        <div class="col-1 align-bottom">
            <i class="fa-solid fa-user-plus" data-toggle="modal" data-target="#inviteTraineeModal"></i>
        </div>
    </div>


    <!-- List enrolled trainees in the cohort -->

    <table class="table table-hover .table-responsive">

        <!-- trainees table header -->
        <thead>
            <tr>
                <th scope="col">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    </div>
                </th>
                <th scope="col">
                    <div class="dropdown ">
                        <button class="btn  dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Action
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item" type="button">Email</button>
                            <button class="dropdown-item" type="button">Remove</button>
                        </div>
                    </div>
                </th>
                <th scope="col">

                </th>
                <th scope="col">

                </th>
                <th scope="col">
                    <i class="fa-solid fa-arrow-down-arrow-up"></i>
                </th>

            </tr>
        </thead>
        <!-- End of trainees table header -->

        <!-- trainees table Body -->
        <tbody>
            <tr>
                <!-- trainee record -->
                <th scope="row">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    </div>
                </th>
                <td>
                    <div class="d-flex flex-row">
                        <div>
                            <i class="fa-solid fa-circle-user fa-lg m-1"></i>
                        </div>
                        <div>Jacob</div>
                    </div>
                </td>
                <td></td>
                <td></td>
                <td>
                    <div>
                        <i class="fa-solid fa-ellipsis-vertical" id="dropdownMenu3" data-toggle="dropdown"></i>
                        <!-- List of options to do with trainee record -->
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu3">
                            <button class="dropdown-item" type="button">Email</button>
                            <button class="dropdown-item" type="button">Remove</button>
                        </div>
                    </div>
                </td>
                <!-- End of trainee record -->

                <!-- trainee record -->
            </tr>
            <tr>
                <th scope="row">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    </div>
                </th>
                <td>
                    <div class="d-flex flex-row">
                        <div>
                            <i class="fa-solid fa-circle-user fa-lg m-1"></i>
                        </div>
                        <div>Jacob</div>
                    </div>
                </td>
                <td></td>
                <td></td>
                <td>
                    <div>
                        <i class="fa-solid fa-ellipsis-vertical" id="dropdownMenu3" data-toggle="dropdown"></i>
                        <!-- List of options to do with trainee record -->
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu3">
                            <button class="dropdown-item" type="button">Email</button>
                            <button class="dropdown-item" type="button">Remove</button>
                        </div>
                    </div>
                </td>

            </tr>
            <!-- End of trainee record -->

            <tr>
                <th scope="row">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    </div>
                </th>
                <td>
                    <div class="d-flex flex-row">
                        <div>
                            <i class="fa-solid fa-circle-user fa-lg m-1"></i>
                        </div>
                        <div>Jacob</div>
                    </div>
                </td>
                <td></td>
                <td></td>
                <td>
                    <div>
                        <i class="fa-solid fa-ellipsis-vertical" id="dropdownMenu3" data-toggle="dropdown"></i>
                        <!-- List of options to do with trainee record -->
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu3">
                            <button class="dropdown-item" type="button">Email</button>
                            <button class="dropdown-item" type="button">Remove</button>
                        </div>
                    </div>
                </td>

            </tr>
            <tr>
                <th scope="row">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    </div>
                </th>
                <td>
                    <div class="d-flex flex-row">
                        <div>
                            <i class="fa-solid fa-circle-user fa-lg m-1"></i>
                        </div>
                        <div>Jacob</div>
                    </div>
                </td>
                <td></td>
                <td></td>
                <td>
                    <div>
                        <i class="fa-solid fa-ellipsis-vertical" id="dropdownMenu3" data-toggle="dropdown"></i>
                        <!-- List of options to do with trainee record -->
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu3">
                            <button class="dropdown-item" type="button">Email</button>
                            <button class="dropdown-item" type="button">Remove</button>
                        </div>
                    </div>
                </td>

            </tr>
        </tbody>
        <!-- End of trainees table Body -->
    </table>
</div>


@endSection