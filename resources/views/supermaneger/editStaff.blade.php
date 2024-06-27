@extends('Layouts.app')

@section('title', 'Edit Staff')

@section('content')

@include('Layouts.innerNav')

<nav style="padding: 50px 50px 0;" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="">Staff</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Staff</li>
    </ol>
</nav>

<div class="container my-5">
    <h2>Edit Staff</h2>
    <form method="POST" action="{{ route('staff.update', $staff->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="staffName" class="form-label fw-bold">Name <small class="text-danger">: Not
                    Modifiable</small></label>
            <input type="text" class="form-control" id="staffName" name="name" placeholder="Staff Name Here"
                readonly value="{{$staff->staff_name}}">
        </div>

        <div class="mb-3">
            <label for="staffEmail" class="form-label fw-bold">Email<small class="text-danger">: Not
                    Modifiable</small></label>
            <input type="email" class="form-control " id="staffEmail" name="email" placeholder="Staff Email Here"
                readonly value="{{$staff->staff_email}}">
        </div>

        @if ($editingUserRole == 'manager')
        <div class="mb-3">
            <label class="form-label">Academies</label>
            <div class="dropdown ">
                <button class="btn btn-secondary dropdown-toggle" style="    width: 100%; border-radius: 0; text-align: left;" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Choose Academies
                </button>
                <div class="dropdown-menu p-2 form-select" aria-labelledby="dropdownMenuButton">
                    @foreach ($academies as $academy)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="academies[]" value="{{ $academy->id }}"
                            id="academy{{ $academy->id }}" @if(in_array($academy->id, $selectedAcademies)) checked @endif>
                        <label class="form-check-label" for="academy{{ $academy->id }}">
                            {{ $academy->academy_name }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var dropdownMenu = document.querySelector('.dropdown-menu');
                dropdownMenu.addEventListener('click', function (e) {
                    e.stopPropagation();
                });
            });
        </script>
          @else
          <div class="mb-3">
          <!-- Single select  for academies for the trainer -->
          <label for="academy" class="form-label">Assign To Academy</label>
          <select class="form-select" id="academy" name="academy">
              @foreach ($academies as $academy)
                  <option value="{{ $academy->id }}" @if (in_array($academy->id, $selectedAcademies)) selected @endif>
                      {{ $academy->academy_name }}
                  </option>
              @endforeach
          </select>
          </div>
      @endif

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
       {{-- <div class="mb-3">
            <label for="roleSelect" class="form-label">Role</label>
            <select class="form-select" id="roleSelect" name="role">
                <option selected>Choose a role...</option>
                <option value="manager">Manager</option>
                <option value="trainer">Trainer</option>
            </select>
        </div> --}}
@endsection
