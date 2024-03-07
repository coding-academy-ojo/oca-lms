@extends('layouts.app')

@section('title', 'Staff')

@section('content')
    @include('layouts.innerNav')
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
    
    <!-- Filters and Search Bar -->
    {{-- <div class="container my-4">
        <div class="d-flex justify-content-between mb-4">
            <div class="d-flex gap-3">
                <select class="form-select" id="academyFilter">
                    <option selected>Academy</option>
                    <option value="albalqa">Albalqa Academy</option>
                    <option value="amman">Amman Academy</option>
                </select>

                <select class="form-select" id="roleFilter">
                    <option selected>Role</option>
                    <option value="manager">Manager</option>
                    <option value="team-leader">Team Leader</option>
                    <option value="trainer">Trainer</option>
                </select>
            </div>
        </div>
    </div> --}}

    <!-- Staff Table Section -->
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-primary" scope="col">#</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Academy</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($staff as $member)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            <img src="{{ asset('assets/img/usericon.jpg') }}" class="img-fluid rounded-circle" alt="Staff Member" style="width: 50px; height: 50px;">
                        </td>
                        <td>{{ $member->staff_name }}</td>
                        <td>{{ $member->role }}</td>
                        <td>
                            @php
                                $academyNames = $member->academies->pluck('academy_name')->toArray();
                                echo implode(', ', $academyNames);
                            @endphp
                        </td>
                        <td >
                            <a  href="{{ route('staff.edit', $member->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form   action="{{ route('staff.destroy', $member->id) }}" method="POST" style="display: inline; margin-top:5px">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-confirm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        {{ $staff->links() }}
    </div>

    {{-- add staff off canvas --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="addStaffOffcanvas" aria-labelledby="addStaffOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 id="addStaffOffcanvasLabel">Add Staff</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <!-- Form for adding staff -->
            <form id="addStaffForm" action="{{ route('staff.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="staff_name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="staff_email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="staff_password" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="manager">Manager</option>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <script src="{{asset('assets/js_files/staff.js')}}">

        </script>
        
    
@endsection
