@extends('Layouts.app')
@section('title', 'Trainee Attendance')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('assets/js_files/attendance.js') }}"></script>
<link rel="stylesheet" href="{{asset('assets/style_files/absence_attendance.css')}}">

@include('Layouts.innerNav')

<style>
    .stats-card {
        border: 1px solid #e9ecef;
    }

    .stats-value {
        font-size: 1.8rem;
        font-weight: 700;
        line-height: 1;
    }

    .status-badge-custom {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .gps-badge {
        font-size: 0.75rem;
        padding: 4px 10px;
    }

    .action-btn {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.8rem;
    }

    .student-name {
        font-weight: 600;
        color: #212529;
    }

    .time-display {
        font-family: 'Courier New', monospace;
        color: #495057;
    }

    .attendance-list-scroll {
        max-height: 62vh;
        overflow-y: auto;
        overflow-x: auto;
    }

    @media (max-width: 768px) {
        .stats-value {
            font-size: 1.5rem;
        }

        .attendance-list-scroll {
            max-height: 55vh;
        }
    }
</style>

<section class="inner-bred my-5">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="{{ route('academyview') }}">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="{{ route('attendance') }}">Attendance</a></li>
        </ul>
    </div>
</section>

<div class="container my-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="text-primary">Attendance</h2>
            <h2>{{ now()->format('l, M d, Y') }}</h2>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-6 col-md-3">
            <div class="card stats-card h-100">
                <div class="card-body">
                    <div>
                        <div class="text-muted small">Total Students</div>
                        <div class="stats-value" id="AllStudents">0</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stats-card h-100">
                <div class="card-body">
                    <div>
                        <div class="text-muted small">Present</div>
                        <div class="stats-value text-success" id="AttendedToday">0</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stats-card h-100">
                <div class="card-body">
                    <div>
                        <div class="text-muted small">Absent</div>
                        <div class="stats-value text-danger" id="AbsentToday">0</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stats-card h-100">
                <div class="card-body">
                    <div>
                        <div class="text-muted small">Late / Early</div>
                        <div class="stats-value text-warning" id="LateToday">0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary mb-3">Filters</h5>

                    <div class="mb-3">
                        <label class="form-label">Academy</label>
                        <select class="form-select" id="academySelect">
                            <option value="">All Academies</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cohort</label>
                        <select class="form-select" id="cohortSelect">
                            <option value="">All Cohorts</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input id="dateFilter" type="date" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-outline-secondary btn-sm" onclick="resetFilters()">
                            Reset Filters
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive attendance-list-scroll">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr class="table-light">
                                <th>#</th>
                                <th>Student</th>
                                <th>Day</th>
                                <th>Date</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Duration</th>
                            <th>Reason</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="attendanceTableBody">
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3 px-2">
                <div class="text-muted small">
                    Showing <span id="showingFrom">0</span> to <span id="showingTo">0</span> of <span id="totalRecords">0</span> entries
                </div>
                <div>
                    <select id="rowsPerPage" class="form-select form-select-sm w-auto">
                        <option value="10">10 per page</option>
                        <option value="25">25 per page</option>
                        <option value="50">50 per page</option>
                    </select>
                </div>
            </div>

            <nav class="mt-3">
                <ul class="pagination justify-content-center" id="pagination"></ul>
            </nav>
        </div>
    </div>
</div>

<script>
    function resetFilters() {
        $('#academySelect').val('');
        $('#cohortSelect').val('');
        $('#dateFilter').val(new Date().toISOString().split('T')[0]);
        loadAttendanceData({});
    }

    function populateAttendanceTable(students) {
        const tableBody = $("#attendanceTableBody");
        tableBody.empty();
        
        if (students.length === 0) {
            tableBody.append('<tr><td colspan="11" class="text-center py-4 text-muted">No data available</td></tr>');
            return;
        }
        
        students.forEach((student, index) => {
            const statusClass = student.attendanceStatus === 'present' ? 'bg-success' : 
                              student.attendanceStatus === 'late' ? 'bg-warning text-dark' :
                              student.attendanceStatus === 'left_early' ? 'bg-info' :
                              student.attendanceStatus === 'completed' ? 'bg-primary' :
                              student.attendanceStatus === 'absent' ? 'bg-danger' : 'bg-secondary';
            
            const statusText = student.attendanceStatus === 'present' ? 'Present' :
                             student.attendanceStatus === 'late' ? 'Late' :
                             student.attendanceStatus === 'left_early' ? 'Left Early' :
                             student.attendanceStatus === 'completed' ? 'Completed' :
                             student.attendanceStatus === 'absent' ? 'Absent' : 'Excused';
            
            const gpsHtml = (student.gpsLatitude && student.gpsLongitude) 
                ? `<span class="badge ${student.gpsStatus === 'inside' ? 'bg-success' : 'bg-danger'} gps-badge">
                    ${student.gpsStatus === 'inside' ? '✓ Inside' : '✗ Outside'}
                    ${student.gpsDistance ? '(' + student.gpsDistance + 'm)' : ''}
                   </span>`
                : '<span class="text-muted">-</span>';
            
            const durationText = student.attendanceStatus === 'late' && student.lateMinutes 
                ? (Math.floor(student.lateMinutes / 60) + 'h ' + (student.lateMinutes % 60) + 'm late')
                : student.attendanceStatus === 'left_early' && student.leaveMinutes
                ? (Math.floor(student.leaveMinutes / 60) + 'h ' + (student.leaveMinutes % 60) + 'm early')
                : '-';
            
            const durationClass = student.attendanceStatus === 'late' ? 'text-warning fw-bold' : 
                                student.attendanceStatus === 'left_early' ? 'text-info fw-bold' : '';
            
            const row = `
                <tr data-student-id="${student.id}">
                    <td>${index + 1}</td>
                    <td class="student-name">${student.en_first_name || ''} ${student.en_last_name || ''}</td>
                    <td>${student.checkInDay || '-'}</td>
                    <td>${student.checkInDate || '-'}</td>
                    <td class="time-display">${student.checkInTime || '-'}</td>
                    <td class="time-display">${student.checkOutTime || '-'}</td>
                    <td>${gpsHtml}</td>
                    <td class="status-cell">
                        <span class="view-mode badge ${statusClass} status-badge-custom">${statusText}</span>
                        <select class="edit-mode form-select form-select-sm" style="width: auto; display: none;">
                            <option value="present" ${student.attendanceStatus === 'present' ? 'selected' : ''}>Present</option>
                            <option value="late" ${student.attendanceStatus === 'late' ? 'selected' : ''}>Late</option>
                            <option value="left_early" ${student.attendanceStatus === 'left_early' ? 'selected' : ''}>Left Early</option>
                            <option value="completed" ${student.attendanceStatus === 'completed' ? 'selected' : ''}>Completed</option>
                            <option value="absent" ${student.attendanceStatus === 'absent' ? 'selected' : ''}>Absent</option>
                            <option value="excused" ${student.attendanceStatus === 'excused' ? 'selected' : ''}>Excused</option>
                        </select>
                    </td>
                    <td>
                        <span class="view-mode ${durationClass}">${durationText}</span>
                        <input type="number" class="edit-mode form-control form-control-sm" value="${student.absenceDuration || ''}" style="width: 80px; display: none;">
                    </td>
                    <td>
                        <span class="view-mode">${student.absenceReason || '-'}</span>
                        <input type="text" class="edit-mode form-control form-control-sm" value="${student.absenceReason || ''}" placeholder="Reason" style="display: none;">
                    </td>
                    <td class="text-nowrap">
                        <button class="btn btn-sm btn-outline-primary action-btn edit-btn" onclick="editRow(this)">Edit</button>
                        <button class="btn btn-sm btn-success action-btn save-btn" onclick="saveRow(this)" style="display: none;">Save</button>
                        <button class="btn btn-sm btn-secondary action-btn cancel-btn" onclick="cancelEdit(this)" style="display: none;">Cancel</button>
                    </td>
                </tr>`;
            tableBody.append(row);
        });
    }

    function editRow(btn) {
        const row = $(btn).closest('tr');
        
        row.find('.view-mode').hide();
        row.find('.edit-mode').show();
        
        $(btn).hide();
        row.find('.save-btn, .cancel-btn').show();
    }

    function saveRow(btn) {
        const row = $(btn).closest('tr');
        const studentId = row.data('student-id');
        const date = $('#dateFilter').val();
        
        const status = row.find('.status-cell .edit-mode').val();
        const reason = row.find('td:eq(9) .edit-mode').val();
        const duration = row.find('td:eq(8) .edit-mode').val();
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: '/attendance/store-or-update',
            type: 'POST',
            data: {
                student_id: studentId,
                date: date,
                status: status,
                reason: reason,
                absences_duration: duration,
                _token: csrfToken
            },
            success: function(response) {
                loadAttendanceData({});
                alert('Saved successfully!');
            },
            error: function(xhr) {
                alert('Error saving data');
            }
        });
    }

    function cancelEdit(btn) {
        const row = $(btn).closest('tr');
        
        row.find('.view-mode').show();
        row.find('.edit-mode').hide();
        row.find('.edit-btn').show();
        row.find('.save-btn, .cancel-btn').hide();
    }

    let currentPage = 1;
    let rowsPerPage = 10;
    let allStudents = [];

    $(document).ready(function() {
        loadAttendanceData({});
    });

    function renderTable() {
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const pageStudents = allStudents.slice(start, end);
        
        populateAttendanceTable(pageStudents);
        
        const totalRecords = allStudents.length;
        const showingFrom = totalRecords > 0 ? start + 1 : 0;
        const showingTo = Math.min(end, totalRecords);
        
        $('#showingFrom').text(showingFrom);
        $('#showingTo').text(showingTo);
        $('#totalRecords').text(totalRecords);
        
        renderPagination();
    }

    function renderPagination() {
        const totalPages = Math.ceil(allStudents.length / rowsPerPage);
        const pagination = $('#pagination');
        pagination.empty();
        
        if (totalPages <= 1) return;
        
        let html = '';
        
        html += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="changePage(${currentPage - 1}); return false;">Previous</a>
        </li>`;
        
        for (let i = 1; i <= totalPages; i++) {
            if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                html += `<li class="page-item ${currentPage === i ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${i}); return false;">${i}</a>
                </li>`;
            } else if (i === currentPage - 2 || i === currentPage + 2) {
                html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }
        }
        
        html += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="changePage(${currentPage + 1}); return false;">Next</a>
        </li>`;
        
        pagination.html(html);
    }

    function changePage(page) {
        const totalPages = Math.ceil(allStudents.length / rowsPerPage);
        if (page < 1 || page > totalPages) return;
        currentPage = page;
        renderTable();
    }

    $('#rowsPerPage').on('change', function() {
        rowsPerPage = parseInt($(this).val());
        currentPage = 1;
        renderTable();
    });

    function loadAttendanceData(filters = {}, rebuildCohorts = false) {
        const date = $('#dateFilter').val() || new Date().toISOString().split('T')[0];
        
        $.ajax({
            url: '/attendance',
            type: 'GET',
            data: {
                academy_id: $('#academySelect').val(),
                cohort_id: $('#cohortSelect').val(),
                date: date,
                ...filters
            },
            success: function(response) {
                if (response.students) {
                    allStudents = response.students;
                    currentPage = 1;
                    renderTable();
                    
                    $('#AllStudents').text(response.counts.all || 0);
                    $('#AttendedToday').text(response.counts.present || 0);
                    $('#AbsentToday').text(response.counts.absent || 0);
                    $('#LateToday').text(response.counts.late || 0);
                    
                    if (response.academies) {
                        const academySelect = $('#academySelect');
                        if (academySelect.children('option').length <= 1) {
                            academySelect.find('option:not(:first)').remove();
                            response.academies.forEach(function(academy) {
                                academySelect.append(`<option value="${academy.id}">${academy.academy_name}</option>`);
                            });
                        }
                    }
                    
                    if (response.cohorts) {
                        const cohortSelect = $('#cohortSelect');
                        if (rebuildCohorts || cohortSelect.children('option').length <= 1) {
                            cohortSelect.find('option:not(:first)').remove();
                            response.cohorts.forEach(function(cohort) {
                                cohortSelect.append(`<option value="${cohort.id}">${cohort.cohort_name}</option>`);
                            });
                            if (response.defaultCohortId) {
                                cohortSelect.val(response.defaultCohortId);
                            }
                        }
                    }
                }
            },
            error: function(xhr) {
                console.error('Error loading attendance:', xhr);
            }
        });
    }

    $('#academySelect, #cohortSelect, #dateFilter').on('change', function() {
        const isAcademyChange = $(this).attr('id') === 'academySelect';
        
        const filters = {
            academy_id: $('#academySelect').val(),
            cohort_id: $('#cohortSelect').val(),
            date: $('#dateFilter').val()
        };
        
        if (isAcademyChange) {
            $('#cohortSelect').html('<option value="">Loading...</option>');
        }
        
        loadAttendanceData(filters, isAcademyChange);
    });
</script>

@endsection