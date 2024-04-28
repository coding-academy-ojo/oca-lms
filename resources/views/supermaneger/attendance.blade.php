@extends('Layouts.app')
@section('title', 'Trainee Attendance')

@section('content')



    <script src="{{ asset('assets/js_files/attendance.js') }}"></script>

    <link rel="stylesheet" href="{{asset('assets/style_files/absence_attendance.css')}}">

    <nav style="padding: 50px 50px 0;" aria-label="breadcrumb" class="breadcrumb-container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('academyview') }}">Cohort 4</a></li>
            <li class="breadcrumb-item active" aria-current="page">Attendance</li>
        </ol>
    </nav>


    <div class="container mt-2">
        <div class="row row-cols-1 row-cols-md-4 g-4 my-4">
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <span class="material-symbols-outlined">group</span>
                        <h5 class="card-title">All Students</h5>
                        <p id="AllStudents" class="card-text">100</p>
                    </div>
                </div>
            </div>

            <!-- Attended Card -->
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <span class="material-symbols-outlined">check_circle</span>
                        <h5 class="card-title">Attended Today</h5>
                        <p id="AttendedToday" class="card-text">20</p>
                    </div>
                </div>
            </div>

            <!-- Absent Card -->
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <span class="material-symbols-outlined">remove_circle</span>
                        <h5 class="card-title">Absent Today</h5>
                        <p id="AbsentToday" class="card-text">8</p>
                    </div>
                </div>
            </div>

            <!-- Late Card -->
            <div class="col">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <span class="material-symbols-outlined">schedule</span>
                        <h5 class="card-title">Late Today</h5>
                        <p id="LateToday" class="card-text">9</p>
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
                    <label for="academySelect" class="form-label">Academies</label>
                    <select class="form-select" id="academySelect">
                        <option selected>Choose Academy...</option>

                    </select>
                </div>
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
                                <th scope="col">Duration (Hours)</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="attendanceTableBody"></tbody>


                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <select id="rowsPerPage" class="form-select form-select-sm" style="width: auto;">
                                <option value="5">5 rows</option>
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
        </div>
    </div>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Cache-Control': 'no-cache, max-age=0'
                }
            });
    
            let currentPage = 1;
            let rowsPerPage = 5; 
    
            // Function to update the visible rows in the table based on pagination
            function displayPage(students) {
                const startIndex = (currentPage - 1) * rowsPerPage;
                const endIndex = startIndex + rowsPerPage;
                const paginatedItems = students.slice(startIndex, endIndex);
                populateAttendanceTable(paginatedItems);
            }
    
            // Function to update pagination controls
            function setupPagination(students) {
                const pageCount = Math.ceil(students.length / rowsPerPage);
                const paginationUl = $('.pagination');
                paginationUl.find('.page-number').remove(); // Remove existing page numbers
    
                // Clear the pagination controls before adding new ones
                paginationUl.html('');
    
                // Add the Previous button
                const prevPageItem = $(
                    '<li class="page-item"><a class="page-link" href="#" id="prevPage">Previous</a></li>');
                paginationUl.append(prevPageItem);
    
                for (let i = 1; i <= pageCount; i++) {
                    const pageItem = $('<li class="page-item page-number"></li>');
                    const pageLink = $('<a class="page-link" href="#">').text(i);
    
                    // Check if the current page is the active page
                    if (i === currentPage) {
                        pageItem.addClass('active');
                    }
    
                    pageLink.on('click', function(e) {
                        e.preventDefault();
                        currentPage = i;
                        displayPage(students);
                        $('.pagination .page-item').removeClass('active');
                        pageItem.addClass('active');
                    });
    
                    pageItem.append(pageLink);
                    paginationUl.append(pageItem);
                }
    
                // Add the Next button
                const nextPageItem = $(
                    '<li class="page-item"><a class="page-link" href="#" id="nextPage">Next</a></li>');
                paginationUl.append(nextPageItem);
    
                // Event listener for the Previous button
                $('#prevPage').on('click', function(e) {
                    e.preventDefault();
                    if (currentPage > 1) {
                        currentPage--;
                        displayPage(students);
                        $('.pagination .page-item').removeClass('active');
                        $('.pagination .page-number').eq(currentPage - 1).addClass('active');
                    }
                });
    
                // Event listener for the Next button
                $('#nextPage').on('click', function(e) {
                    e.preventDefault();
                    if (currentPage < pageCount) {
                        currentPage++;
                        displayPage(students);
                        $('.pagination .page-item').removeClass('active');
                        $('.pagination .page-number').eq(currentPage - 1).addClass('active');
                    }
                });
            }
    
    
            const today = new Date().toISOString().split('T')[0];
            $('#dateFilter').val(today);
    
            function populateFilters(academies, cohorts) {
                const academySelect = $('#academySelect');
                academySelect.empty().append('<option value="">Choose Academy...</option>');
                academies.forEach(academy => {
                    academySelect.append(`<option value="${academy.id}">${academy.academy_name}</option>`);
                });
    
                const cohortSelect = $('#cohortSelect');
                cohortSelect.empty().append('<option value="">Choose Cohort...</option>');
                cohorts.forEach(cohort => {
                    cohortSelect.append(`<option value="${cohort.id}">${cohort.cohort_name}</option>`);
                });
            }
    
            // Function to fetch and display attendance data based on filters
            function loadAttendanceData(filters = {}) {
                $.ajax({
                    url: "{{ route('attendance') }}",
                    type: "GET",
                    data: filters,
                    success: function(response) {
                        if (!filters.academy_id && !filters.cohort_id) {
                            populateFilters(response.academies, response.cohorts);
                        }
                        setupPagination(response.students);
                        displayPage(response.students);
                        updateAttendanceStats(response.counts);
                    },
                    error: function(xhr) {
                        console.error("Error fetching data: ", xhr.statusText);
                    }
                });
            }
    
            // Function to populate the attendance table
            function populateAttendanceTable(students) {
                const tableBody = $("#attendanceTableBody");
                tableBody.empty();
                students.forEach((student, index) => {
                    const row = `
            <tr data-student-id="${student.id}">
                <td>${index + 1}</td>
                <td>${student.en_first_name} ${student.en_last_name}</td>
                <td class="status-cell">
                    <span class="status-text">${student.attendanceStatus}</span>
                    <select class="form-select form-select-sm status-select d-none">
                        <option value="Attended" ${student.attendanceStatus === 'attended' ? 'selected' : ''}>attended</option>
                        <option value="Absent" ${student.attendanceStatus === 'absent' ? 'selected' : ''}>absent</option>
                        <option value="Late" ${student.attendanceStatus === 'late' ? 'selected' : ''}>late</option>
                        <option value="Leaving" ${student.attendanceStatus === 'leaving' ? 'selected' : ''}>leaving</option>
                    </select>
                </td>
                <td class="reason-cell">
                    <span class="reason-text">${student.absenceReason || '-'}</span>
                    <input type="text" class="form-control form-control-sm reason-input d-none" value="${student.absenceReason || ''}">
                </td>
                <td>
                    <span class="duration-text">${student.absenceDuration || '-'}</span>
                    <input type="number" class="form-control form-control-sm duration-input d-none" value="${student.absenceDuration || ''}" min="0">
                </td>
                
                <td>
                    <button class="btn btn-primary btn-sm edit-btn">Edit</button>
                    <button class="btn btn-success btn-sm save-btn d-none">Save</button>
                    <button class="btn btn-secondary btn-sm cancel-btn d-none">Cancel</button>
                </td>
            </tr>`;
                    tableBody.append(row);
                });
            }
    
    
    
    
            // Event listeners for filter changes
            $('#academySelect, #cohortSelect, #dateFilter').on('change', function() {
                const filters = {
                    academy_id: $('#academySelect').val(),
                    cohort_id: $('#cohortSelect').val(),
                    date: $('#dateFilter').val()
                };
                loadAttendanceData(filters);
            });
    
            // Event listeners for pagination controls (rows per page selection)
            $('#rowsPerPage').change(function() {
                rowsPerPage = parseInt($(this).val());
                currentPage = 1;
                loadAttendanceData({
                    academy_id: $('#academySelect').val(),
                    cohort_id: $('#cohortSelect').val(),
                    date: $('#dateFilter').val()
                });
            });
    
            function updateAttendanceStats(counts) {
                $('#AllStudents').text(counts.all);
                $('#AttendedToday').text(counts.attended);
                $('#AbsentToday').text(counts.absent);
                $('#LateToday').text(counts.late);
            }
    
            function resetEditing() {
                $('.status-select, .reason-input, .duration-input').addClass('d-none');
                $('.status-text, .reason-text, .duration-text').removeClass('d-none');
                $('.duration-input, .save-btn').addClass(
                    'd-none');
                $('.submit-btn, .cancel-btn').addClass('d-none');
                $('.edit-btn').removeClass('d-none');
            }
            // Edit button functionality
            $(document).on('click', '.edit-btn', function() {
                resetEditing(); // Reset editing for all rows
    
                const $row = $(this).closest('tr');
                $row.find('.status-text, .reason-text, .duration-text').addClass('d-none');
                $row.find('.status-select, .reason-input, .duration-input').removeClass('d-none');
    
                $(this).addClass('d-none');
                $row.find('.save-btn, .cancel-btn').removeClass(
                    'd-none');
            });
    
            // Cancel button functionality
            $(document).on('click', '.cancel-btn', function() {
                const $row = $(this).closest('tr');
                $row.find('.status-text, .reason-text').removeClass('d-none');
                $row.find('.status-select, .reason-input').addClass('d-none');
                $row.find('.edit-btn').removeClass('d-none');
                $row.find('.submit-btn').addClass('d-none');
                $row.find('.duration-input, .save-btn').addClass(
                    'd-none');
                $(this).addClass('d-none');
            });
    
    
    
            // Save button functionality
            $(document).on('click', '.save-btn', function() {
                const selectedDate = $('#dateFilter').val();
                if (!selectedDate) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'You have to choose a date first!',
                        confirmButtonColor: '#ff7900',
    
                    });
                    return; // Exit the function if no date is selected
                }
    
                const $row = $(this).closest('tr');
                const studentId = $row.data('student-id');
                let status = $row.find('.status-select').val();
                const reason = $row.find('.reason-input').val();
                const duration = $row.find('.duration-input').val();
                status = status.toLowerCase();
                $.ajax({
                    url: "/attendance/store-or-update",
                    type: "POST",
                    data: {
                        student_id: studentId,
                        status: status,
                        reason: reason,
                        date: selectedDate,
                        absences_duration: duration,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            html: '<div style="color: #ff7900; font-size: 30px;"><i class="fas fa-check-circle"></i></div>' +
                                '<div style="margin-top: 20px;">Attendance updated successfully</div>',
                            showConfirmButton: true,
                            timer: 5000,
                            confirmButtonColor: '#ff7900',
                        });
                        // Reload attendance data with selected filters after updating
                        const filters = {
                            academy_id: $('#academySelect').val(),
                            cohort_id: $('#cohortSelect').val(),
                            date: $('#dateFilter').val()
                        };
                        loadAttendanceData(filters);
                    },
                    error: function(xhr) {
                        Swal.fire('Error', xhr.responseJSON.message, 'error');
                    }
                });
            });
    
            loadAttendanceData();
        });
    </script>
@endsection
