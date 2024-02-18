@extends('layouts.app')

@section('title', 'Staff')

@section('content')
    @include('layouts.innerNav')

    <!-- Filters and Search Bar -->
    <div class="container my-4">
        <div class="d-flex justify-content-between mb-4">
            <div class="d-flex gap-3">
                <select class="form-select" id="academyFilter">
                    <option selected>Academy</option>
                    <option value="albalqa">Albalqa Academy</option>
                    <option value="amman">Amman Academy</option>
                </select>

                <select class="form-select" id="roleFilter">
                    <option selected> Role</option>
                    <option value="manager">Manager</option>
                    <option value="team-leader">Team Leader</option>
                    <option value="trainer">Trainer</option>
                </select>
            </div>

        </div>
    </div>

    <!-- Staff Table Section -->
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-primary" scope="col">#</th>
                        <th  scope="col">Photo</th>
                        <th  scope="col">Name</th>
                        <th  scope="col">Role</th>
                        <th  scope="col ">Academy</th>
                        <th  scope="col ">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- Staff Member Row 1 -->
                    <tr>
                        <th scope="row">1</th>
                        <td><img src="{{ asset('assets/img/usericon.jpg') }}" class="img-fluid rounded-circle"
                                alt="Staff Member" style="width: 50px; height: 50px;"></td>
                                <td>Dana</td>
                                <td>Manager</td>
                                <td>Al Aqaba</td>
                        <td>
                            <a href="{{route('staff.edit')}}" class="btn btn-secondary btn-sm">Edit</a>
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#confirmRemoveModal" data-staff-id="1">Remove</a>
                        </td>
                    </tr>
                    <!-- Staff Member Row 2 -->
                    <tr>
                        <th scope="row">2</th>
                        <td><img src="{{ asset('assets/img/usericon.jpg') }}" class="img-fluid rounded-circle"
                                alt="Staff Member" style="width: 50px; height: 50px;"></td>
                        <td>Rawan</td>
                        <td>Trainer</td>
                        <td>Balqa</td>
                        <td>
                            <a href="{{route('staff.edit')}}" class="btn btn-secondary btn-sm">Edit</a>
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#confirmRemoveModal" data-staff-id="2">Remove</a>
                        </td>
                    </tr>
                    <!-- Staff Member Row 3 -->
                    <tr>
                        <th scope="row">3</th>
                        <td><img src="{{ asset('assets/img/usericon.jpg') }}" class="img-fluid rounded-circle"
                                alt="Staff Member" style="width: 50px; height: 50px;"></td>
                        <td>Mohammed</td>
                        <td>Team leader</td>
                        <td>Al Zarqa</td>
                        <td>
                            <a href="{{route('staff.edit')}}" class="btn btn-secondary btn-sm">Edit</a>
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#confirmRemoveModal" data-staff-id="3">Remove</a>
                        </td>
                    </tr>
                    <!-- Staff Member Row 4 -->
                    <tr>
                        <th scope="row">4</th>
                        <td><img src="{{ asset('assets/img/usericon.jpg') }}" class="img-fluid rounded-circle"
                                alt="Staff Member" style="width: 50px; height: 50px;"></td>
                        <td> Staff</td>
                        <td>Manager</td>
                        <td>Amman</td>
                        <td class="d-flex gap-1">
                            <a href="{{route('staff.edit')}}" class="btn btn-secondary btn-sm">Edit</a>
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#confirmRemoveModal" data-staff-id="4">Remove</a>
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>



    {{-- add staff off canvas --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="addStaffOffcanvas" aria-labelledby="addStaffOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 id="addStaffOffcanvasLabel">Add Staff</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <!-- Form for adding staff -->
            <form id="addStaffForm">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="manager">Manager</option>
                        <option value="super_manager">Super Manager</option>
                        <option value="trainer">Trainer</option>
                    </select>
                </div>
               
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
    
    <div style="z-index: 1040" class="position-fixed bottom-0 end-0 m-4">
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#addStaffOffcanvas"
            aria-controls="addStaffOffcanvas">
            <span class="material-symbols-outlined">add</span>
        </button>
    </div>
    
@endsection
