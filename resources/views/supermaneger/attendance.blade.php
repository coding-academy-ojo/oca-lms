@extends('Layouts.app')
@section('title', 'Trainee Attendance')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('assets/js_files/attendance.js') }}"></script>
<link rel="stylesheet" href="{{asset('assets/style_files/absence_attendance.css')}}">

<style>
    .attendance-header {
        background: linear-gradient(135deg, #ff7900 0%, #ff9a00 100%);
        color: white;
        padding: 30px;
        border-radius: 16px;
        margin-bottom: 30px;
    }

    .stat-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 5px;
    }

    .filter-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 20px;
    }

    .filter-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        margin-bottom: 8px;
    }

    .attendance-table-wrapper {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        overflow-x: auto;
    }

    .attendance-table-wrapper::-webkit-scrollbar {
        height: 8px;
    }

    .attendance-table-wrapper::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .attendance-table-wrapper::-webkit-scrollbar-thumb {
        background: #ff7900;
        border-radius: 4px;
    }

    .attendance-table thead {
        background: #343a40;
        color: white;
    }

    .attendance-table th {
        font-weight: 600;
        font-size: 0.85rem;
        padding: 15px 12px;
        border: none;
        white-space: nowrap;
    }

    .attendance-table td {
        padding: 12px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
        white-space: nowrap;
    }

    .attendance-table tbody tr:hover {
        background: #f8f9fa;
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

    @media (max-width: 768px) {
        .attendance-header {
            padding: 20px;
            text-align: center;
        }
        
        .stat-value {
            font-size: 1.5rem;
        }
        
        .filter-card {
            margin-bottom: 20px;
        }
        
        .attendance-table {
            font-size: 0.85rem;
        }
    }
</style>

<div class="container-fluid px-4">
    <div class="attendance-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="mb-1">📊 Attendance</h2>
                <p class="mb-0 opacity-75">Track student attendance and check-in times</p>
            </div>
            <div class="col-md-4 text-md-end">
                <span class="badge bg-white text-dark fs-6 px-3 py-2">
                    📅 {{ now()->format('l, M d, Y') }}
                </span>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-6 col-md-3">
            <div class="card stat-card h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon bg-light text-dark me-3">
                        👥
                    </div>
                    <div>
                        <div class="stat-value" id="AllStudents">0</div>
                        <div class="stat-label">Total Students</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon bg-success text-white me-3">
                        ✓
                    </div>
                    <div>
                        <div class="stat-value text-success" id="AttendedToday">0</div>
                        <div class="stat-label">Present</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon bg-danger text-white me-3">
                        ✗
                    </div>
                    <div>
                        <div class="stat-value text-danger" id="AbsentToday">0</div>
                        <div class="stat-label">Absent</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon bg-warning text-dark me-3">
                        ⏰
                    </div>
                    <div>
                        <div class="stat-value text-warning" id="LateToday">0</div>
                        <div class="stat-label">Late / Early</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-3">
            <div class="filter-card">
                <h5 class="mb-3">🔍 Filters</h5>
                
                <div class="mb-3">
                    <label class="filter-label">Academy</label>
                    <select class="form-select" id="academySelect">
                        <option value="">All Academies</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="filter-label">Cohort</label>
                    <select class="form-select" id="cohortSelect">
                        <option value="">All Cohorts</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="filter-label">Date</label>
                    <input id="dateFilter" type="date" class="form-control" value="{{ date('Y-m-d') }}">
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-outline-secondary btn-sm" onclick="resetFilters()">
                        ↻ Reset Filters
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="attendance-table-wrapper">
                <div class="attendance-table">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
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

            <div class="d-flex justify-content-between align-items-center mt-3 px-2">
                <div class="text-muted small">
                    Showing <span id="showingFrom">0</span> to <span id="showingTo">0</span> of <span id="totalRecords">0</span> entries
                </div>
                <div>
                    <select id="rowsPerPage" class="form-select form-select-sm" style="width: auto;">
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
            tableBody.append('<tr><td colspan="10" class="text-center py-4 text-muted">No data available</td></tr>');
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