<!-- Your Blade template code -->
@extends('Layouts.app')
@section('title')
    Trainee Absence
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/style_files/absence_attendance.css') }}">
    <nav style="padding: 50px 50px 0;" aria-label="breadcrumb" class="breadcrumb-container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('academyview') }}">Cohort 4</a></li>
            <li class="breadcrumb-item active" aria-current="page">Absence</li>
        </ol>
    </nav>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">Absence Record</h2>
            <div class="d-flex gap-2">
                <input id="search_student" type="text" class="form-control" placeholder="Search Trainee..."
                    aria-label="Search">
                {{-- @auth('staff')
                    @if (Auth::guard('staff')->user()->role == 'manager')
                        <select class="form-select" id="cohortSelect">

                            <!-- Options -->
                        </select>
                    @endif
                @endauth --}}
            </div>
        </div>


        <div class="table-responsive">
            <table class="table" id="students-table">
                <thead class="table-orange">
                    <tr class="">
                        <th scope="col">Trainee</th>
                        <th scope="col">Total Absent</th>
                        <th scope="col">Total Late</th>
                        <th scope="col" style="padding-right: 142px;" class="text-end ">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table body will be dynamically populated using JavaScript -->
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <select id="rowsPerPage" class="form-select form-select-sm" style="width: auto;">
                        <option value="5">5 rows</option>
                        <option value="10">10 rows</option>
                        <option value="15">15 rows</option>
                    </select>
                </div>
                <nav>
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#" id="prevPage">Previous</a></li>
                        <!-- Dynamically generated page numbers will go here -->
                        <li class="page-item"><a class="page-link" href="#" id="nextPage">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>


    </div>




    <script>
        $(document).ready(function() {
            var currentPage = 1;
            var rowsPerPage = parseInt($('#rowsPerPage').val());
            var selectedCohortId = '';
            var selectedSearchQuery = '';
            fetchStudents('', selectedCohortId);
    
            $('#search_student').keyup(function() {
                var query = $(this).val();
                currentPage = 1;
                selectedSearchQuery = query;
                fetchStudents(query, selectedCohortId, selectedSearchQuery);
            });
    
            $('#cohortSelect').change(function() {
                selectedCohortId = $(this).val();
                currentPage = 1;
                fetchStudents(selectedSearchQuery, selectedCohortId, selectedSearchQuery);
            });
    
            $('#rowsPerPage').change(function() {
                currentPage = 1;
                rowsPerPage = parseInt($(this).val());
                fetchStudents(selectedSearchQuery, selectedCohortId, selectedSearchQuery);
            });
    
            $(document).on('click', '.pagination .page-link', function(e) {
                e.preventDefault();
                var pageNumber = parseInt($(this).text());
                if (!isNaN(pageNumber)) {
                    currentPage = pageNumber;
                    fetchStudents(selectedSearchQuery, selectedCohortId, selectedSearchQuery);
                }
            });
    
            $(document).on('click', '#prevPage', function(e) {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    fetchStudents(selectedSearchQuery, selectedCohortId, selectedSearchQuery);
                }
            });
    
            $(document).on('click', '#nextPage', function(e) {
                e.preventDefault();
                currentPage++;
                fetchStudents(selectedSearchQuery, selectedCohortId, selectedSearchQuery);
            });
    
            function fetchStudents(query, cohortId, searchQuery) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('absence') }}',
                    data: {
                        query: searchQuery,
                        filter: cohortId
                    },
                    success: function(response) {
                        // console.log(response);
                        var cohortSelect = $('#cohortSelect');
                        cohortSelect.empty();
    
                        if (Array.isArray(response.cohorts)) {
                            cohortSelect.append('<option value="" selected>Choose Cohort...</option>');
                            response.cohorts.forEach(function(cohort) {
                                cohortSelect.append('<option value="' + cohort.id + '">' +
                                    cohort.cohort_name + '</option>');
                            });
                        } else {
                            cohortSelect.append('<option value="' + response.cohorts.id +
                                '" selected>' + response.cohorts.cohort_name + '</option>');
                        }
    
                        if (selectedCohortId) {
                            cohortSelect.val(selectedCohortId);
                        }
    
                        updateTable(response.students);
                    },
    
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
    
            function updateTable(students) {
                var tableBody = $('#students-table tbody');
                tableBody.empty();
    
                if (students.length === 0) {
                    tableBody.append('<tr><td colspan="4">No students found</td></tr>');
                    return;
                }
    
                var startIndex = (currentPage - 1) * rowsPerPage;
                var endIndex = Math.min(startIndex + rowsPerPage, students.length);
    
                for (var i = startIndex; i < endIndex; i++) {
                    var student = students[i];
                    var row = '<tr>' +
                        '<td>' + student.en_first_name + ' ' + student.en_last_name + '</td>' +
                        '<td>' + (student.total_absent ? student.total_absent : 'No Absent') + ' Days </td>' +
                        '<td>' + (student.total_late ? student.total_late : 'No Late') + ' Days </td>' +
                        '<td>' +
                        '<div class="d-flex justify-content-end gap-2">' +
                        '<a href="/students/' + student.id +
                        '/absence"><button class="btn btn-primary">View</button></a>'+
                        '</div>' +
                        '</td>' +
                        '</tr>';
    
                    tableBody.append(row);
                }
    
                updatePagination(students.length);
            }
    
            function updatePagination(totalStudents) {
                var totalPages = Math.ceil(totalStudents / rowsPerPage);
                var pagination = $('.pagination');
                pagination.empty();
    
                var prevButton = '<li class="page-item ' + (currentPage === 1 ? 'disabled' : '') +
                    '"><a class="page-link" href="#" id="prevPage">Previous</a></li>';
                pagination.append(prevButton);
    
                for (var i = 1; i <= totalPages; i++) {
                    var pageLink = '<li class="page-item ' + (i === currentPage ? 'active' : '') +
                        '"><a class="page-link" href="#">' + i + '</a></li>';
                    pagination.append(pageLink);
                }
    
                var nextButton = '<li class="page-item ' + (currentPage === totalPages ? 'disabled' : '') +
                    '"><a class="page-link" href="#" id="nextPage">Next</a></li>';
                pagination.append(nextButton);
            }
        });
    </script>
@endsection
