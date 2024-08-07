@extends('Layouts.app')

@section('title', 'Soft Skills Training')

@section('content')
    @include('Layouts.innerNav')
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
    

    <div class="container" style="min-height: 50vh">
        <div class="d-flex justify-content-end p-3 px-xl-5">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#createSoftSkillsOffcanvas" aria-controls="createSoftSkillsOffcanvas">
                <span class="material-symbols-outlined">
                    add
                    </span>
            </button>
        </div>
        
        
        <div class="table-responsive">
            @if($softSkills->isEmpty())
            <p>There are no soft skills taken yet.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-primary" scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Trainer</th>
                        <th scope="col">Date</th>
                        <th scope="col">Satisfaction</th>
                        <th scope="col">Cohort</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($softSkills as $softSkill)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $softSkill->name }}</td>
                        <td>{{ $softSkill->description }}</td>
                        <td>{{ $softSkill->trainer }}</td>
                        <td>{{ $softSkill->date }}</td>
                        <td>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar" role="progressbar" 
                                    style="width: {{ $softSkill->satisfaction }}%; 
                                           background-color: {{ $softSkill->satisfaction < 80 ? '#FFD700' : '#499557' }}; 
                                           color: black; 
                                           display: flex; 
                                           align-items: center; 
                                           justify-content: center;">
                                    {{ $softSkill->satisfaction }}%
                                </div>
                            </div>
                        </td>
                        <td>{{ $softSkill->cohort->cohort_name }}</td> <!-- Adjust this to the actual column name -->
                        <td class="d-flex gap-2">
                            <a href="{{ route('soft-skills.edit', $softSkill->id) }}" class="btn btn-secondary btn-sm">
                                <span class="material-symbols-outlined">Edit</span>
                            </a>
                            <form action="{{ route('soft-skills.destroy', $softSkill->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-primary btn-sm delete-confirm">
                                    <span class="material-symbols-outlined">Delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        @endif
        
            
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="createSoftSkillsOffcanvas" aria-labelledby="createSoftSkillsOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 id="createSoftSkillsOffcanvasLabel">Create Soft Skills Training</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form id="createSoftSkillsForm" action="{{ route('soft-skills.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Training Name..." name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" placeholder="Training Description..." name="description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="trainer" class="form-label">Trainer</label>
                    <input type="text" class="form-control" placeholder="Enter Trainer Name..." id="trainer" name="trainer" required>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="mb-3">
                    <label for="cohort_id" class="form-label">Cohort</label>
                    <select class="form-select" id="cohort_id" name="cohort_id" required>
                        @if($runningCohorts->isNotEmpty())
                            @foreach($runningCohorts as $cohort)
                                <option value="{{ $cohort->id }}">{{ $cohort->cohort_name }}</option>
                            @endforeach
                        @else
                            <option disabled selected>No running cohorts found</option>
                        @endif
                    </select>
                </div>
                <div class="mb-3">
                    <label for="satisfaction" class="form-label">Satisfaction</label>
                    <input type="range" class="form-range" id="satisfaction" name="satisfaction" min="0" max="100" step="1" value="0" oninput="updateSatisfactionValue(this.value)">
                    <div class="d-flex justify-content-between">
                        <small>0%</small>
                        <small>100%</small>
                    </div>
                    <input type="text" id="satisfactionValue" class="form-control mt-2" value="0%" readonly>
                </div>
                
                <script>
                    function updateSatisfactionValue(value) {
                        document.getElementById('satisfactionValue').value = value + '%';
                    }
                </script>
                
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <script src="{{asset('assets/js_files/staff.js')}}"></script>
    
@endsection
