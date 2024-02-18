@extends('Layouts.app')
@section('title', 'Trainee Attendance')

@section('content')



    <script src="{{asset('assets/js_files/attendance.js')}}"></script>

    @include('layouts.innerNav')

    <nav style="padding: 50px 50px 0;" aria-label="breadcrumb" class="breadcrumb-container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('academyview') }}">Cohort 4</a></li>
            <li class="breadcrumb-item active" aria-current="page">Attendance</li>
        </ol>
    </nav>
    <div class="container mt-2">
        <div class="row row-cols-1 row-cols-md-4 g-4 my-4">
            <!-- All Students Card -->
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <span class="material-symbols-outlined">group</span>
                        <h5 class="card-title">All Students</h5>
                        <p class="card-text">100</p>
                    </div>
                </div>
            </div>

            <!-- Attended Card -->
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <span class="material-symbols-outlined">check_circle</span>
                        <h5 class="card-title">Attended</h5>
                        <p class="card-text">20</p>
                    </div>
                </div>
            </div>

            <!-- Absent Card -->
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <span class="material-symbols-outlined">remove_circle</span>
                        <h5 class="card-title">Absent</h5>
                        <p class="card-text">8</p>
                    </div>
                </div>
            </div>

            <!-- Late Card -->
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <span class="material-symbols-outlined">schedule</span>
                        <h5 class="card-title">Late</h5>
                        <p class="card-text">9</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-2 ">
        <div class="row">
            <!-- Filters Column -->
            <div class="col-md-4 col-lg-3 order-md-2 mt-3">
            
                <div class="mb-3">
                    <label for="cohortSelect" class="form-label">Cohort</label>
                    <select class="form-select" id="cohortSelect">
                        <option selected>Choose Cohort...</option>
                        <option selected>Cohort 2</option>
                        <option selected>Cohort 3</option>
                        <!-- Options -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="dateFilter" class="form-label">Date</label>
                    <input id="dateFilter" type="date" class="form-control" placeholder="Filter by date..."
                        aria-label="Filter by date">
                </div>
            </div>

            <!-- Table Column -->
            <div class="col-md-8 col-lg-9 order-md-1 ">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-orange">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Trainee</th>
                                <th scope="col">Status</th>
                                <th scope="col">Reason</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Trainee 1</td>
                                <td class="status-cell">
                                    <span class="status-text">Attended</span>
                                    <select class="form-select form-select-sm status-select d-none">
                                        <option value="Attended">Attended</option>
                                        <option value="Absent">Absent</option>
                                        <option value="Late">Late</option>
                                    </select>
                                </td>
                                <td class="reason-cell">
                                    <span class="reason-text">-</span>
                                    <input type="text" class="form-control form-control-sm reason-input d-none"
                                        value="">
                                </td>
                                <td>2023-02-14</td>
                                <td>
                                    <button class="btn btn-primary btn-sm edit-btn">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <button class="btn btn-success btn-sm submit-btn d-none">
                                        <span class="material-symbols-outlined">check</span>
                                    </button>
                                    <button class="btn btn-secondary btn-sm cancel-btn d-none">
                                        <span class="material-symbols-outlined">close</span>
                                    </button>
                                </td>
                            </tr>
                            <!--  Row 2 -->
                            <tr>
                                <td>2</td>
                                <td>Trainee 2</td>
                                <td class="status-cell">
                                    <span class="status-text">Late</span>
                                    <select class="form-select form-select-sm status-select d-none">
                                        <option value="Attended">Attended</option>
                                        <option value="Absent">Absent</option>
                                        <option value="Late" selected>Late</option>
                                    </select>
                                </td>
                                <td class="reason-cell">
                                    <span class="reason-text">Traffic</span>
                                    <input type="text" class="form-control form-control-sm reason-input d-none"
                                        value="Traffic">
                                </td>
                                <td>2023-02-14</td>
                                <td>
                                    <button class="btn btn-primary btn-sm edit-btn">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <button class="btn btn-success btn-sm submit-btn d-none">
                                        <span class="material-symbols-outlined">check</span>
                                    </button>
                                    <button class="btn btn-secondary btn-sm cancel-btn d-none">
                                        <span class="material-symbols-outlined">close</span>
                                    </button>
                                </td>
                            </tr>
                            <!--  Row 3 -->
                            <tr>
                                <td>3</td>
                                <td>Trainee 3</td>
                                <td class="status-cell">
                                    <span class="status-text">Absent</span>
                                    <select class="form-select form-select-sm status-select d-none">
                                        <option value="Attended">Attended</option>
                                        <option value="Absent" selected>Absent</option>
                                        <option value="Late">Late</option>
                                    </select>
                                </td>
                                <td class="reason-cell">
                                    <span class="reason-text">Sick</span>
                                    <input type="text" class="form-control form-control-sm reason-input d-none"
                                        value="Sick">
                                </td>
                                <td>2023-02-14</td>
                                <td>
                                    <button class="btn btn-primary btn-sm edit-btn">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <button class="btn btn-success btn-sm submit-btn d-none">
                                        <span class="material-symbols-outlined">check</span>
                                    </button>
                                    <button class="btn btn-secondary btn-sm cancel-btn d-none">
                                        <span class="material-symbols-outlined">close</span>
                                    </button>
                                </td>
                            </tr>
                            <!--  Row 4 -->
                            <tr>
                                <td>4</td>
                                <td>Trainee 4</td>
                                <td class="status-cell">
                                    <span class="status-text">Attended</span>
                                    <select class="form-select form-select-sm status-select d-none">
                                        <option value="Attended" selected>Attended</option>
                                        <option value="Absent">Absent</option>
                                        <option value="Late">Late</option>
                                    </select>
                                </td>
                                <td class="reason-cell">
                                    <span class="reason-text">-</span>
                                    <input type="text" class="form-control form-control-sm reason-input d-none"
                                        value="">
                                </td>
                                <td>2023-02-14</td>
                                <td>
                                    <button class="btn btn-primary btn-sm edit-btn">
                                        <span class="material-symbols-outlined">edit</span>
                                    </button>
                                    <button class="btn btn-success btn-sm submit-btn d-none">
                                        <span class="material-symbols-outlined">check</span>
                                    </button>
                                    <button class="btn btn-secondary btn-sm cancel-btn d-none">
                                        <span class="material-symbols-outlined">close</span>
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <div class="offcanvas offcanvas-end" tabindex="-1" id="statusOffcanvas" aria-labelledby="statusOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 id="statusOffcanvasLabel">Add Student Status</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form>
                <div class="mb-3">
                    <label for="userSelect" class="form-label">Select Trainee</label>
                    <select class="form-select" id="userSelect">
                        <option selected>Choose...</option>
                        <!-- Dynamically populate these options based on your user data -->
                        <option value="1">Trainee 1</option>
                        <option value="2">Trainee 2</option>
                        <option value="3">Trainee 3</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="reasonText" class="form-label">Reason (Optional)</label>
                    <textarea class="form-control" id="reasonText" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="attendanceStatus" id="attended"
                                value="Attended">
                            <label class="form-check-label" for="attended">Attended</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="attendanceStatus" id="late"
                                value="Late">
                            <label class="form-check-label" for="late">Late</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="attendanceStatus" id="absent"
                                value="Absent">
                            <label class="form-check-label" for="absent">Absent</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    {{-- floating action btn --}}
    <div style="z-index: 23" class="position-fixed bottom-0 end-0 m-4">
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#statusOffcanvas"
            aria-controls="statusOffcanvas">
            <span class="material-symbols-outlined">add</span>
        </button>
    </div>
 

@endsection
