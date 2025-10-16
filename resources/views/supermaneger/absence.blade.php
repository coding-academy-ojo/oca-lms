<!-- Your Blade template code -->
@extends('Layouts.app')
@section('title')
    Trainee Absence
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/style_files/absence_attendance.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

    <nav style="padding: 50px 50px 0;" aria-label="breadcrumb" class="breadcrumb-container">
        <ol class="breadcrumb">
            <li  class="breadcrumb-item"><a href="{{ route('academyview') }}" id="cohort_name_li">Cohort </a></li>
            <li class="breadcrumb-item active" aria-current="page">Absence</li>
        </ol>
    </nav>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <h2 class="text-primary">Absence Record</h2>

            <div class="d-flex flex-column align-items-end">
                <div class="d-flex gap-2 mb-2">
                    <input id="search_student" type="text" class="form-control" placeholder="Search Trainee..."
                        aria-label="Search" style="width: 250px;">
                    {{-- @auth('staff')
                        @if (Auth::guard('staff')->user()->role == 'manager')
                            <select class="form-select" id="cohortSelect">
                                <!-- Options -->
                            </select>
                        @endif
                    @endauth --}}
                </div>

                <button id="exportExcel" class="btn btn-primary" style="width: 250px;">
                    <i class="bi bi-file-earmark-excel"></i> Export to Excel
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table" id="students-table">
                <thead class="table-orange">
                    <tr class="">
                        <th scope="col">Trainee</th>
                        <th scope="col">National ID</th>
                        <th scope="col">Attended Days</th>
                        <th scope="col">Total Absent</th>
                        <th scope="col">Total Late</th>
                        <th scope="col">Attendance Percentage</th>
                        {{-- <th scope="col" style="padding-right: 142px;" class="text-end ">Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    <!-- Table body will be dynamically populated using JavaScript -->
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <select id="rowsPerPage" class="form-select form-select-sm" style="width: auto;">
                        <option value="10">10 rows</option>
                        <option value="20">20 rows</option>
                        <option value="30">30 rows</option>
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
    // 🔸 Global variables
    var allStudents = [];
    var currentPage = 1;
    var rowsPerPage = 10;
    var selectedCohortId = '';
    var selectedSearchQuery = '';

    $(document).ready(function() {
        rowsPerPage = parseInt($('#rowsPerPage').val());
        fetchStudents('', selectedCohortId);

        // 🔍 Search input
        $('#search_student').keyup(function() {
            selectedSearchQuery = $(this).val();
            currentPage = 1;
            fetchStudents(selectedSearchQuery, selectedCohortId);
        });

        // 🧭 Cohort dropdown
        $('#cohortSelect').change(function() {
            selectedCohortId = $(this).val();
            currentPage = 1;
            fetchStudents(selectedSearchQuery, selectedCohortId);
        });

        // 🔢 Rows per page
        $('#rowsPerPage').change(function() {
            rowsPerPage = parseInt($(this).val());
            currentPage = 1;
            fetchStudents(selectedSearchQuery, selectedCohortId);
        });

        // 📑 Pagination click
        $(document).on('click', '.pagination .page-link', function(e) {
            e.preventDefault();
            var pageNumber = parseInt($(this).text());
            if (!isNaN(pageNumber)) {
                currentPage = pageNumber;
                fetchStudents(selectedSearchQuery, selectedCohortId);
            }
        });

        // ◀️▶️ Prev/Next buttons
        $(document).on('click', '#prevPage', function(e) {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                fetchStudents(selectedSearchQuery, selectedCohortId);
            }
        });

        $(document).on('click', '#nextPage', function(e) {
            e.preventDefault();
            currentPage++;
            fetchStudents(selectedSearchQuery, selectedCohortId);
        });

        // 🟢 Fetch students
        function fetchStudents(query, cohortId) {
            $.ajax({
                type: 'GET',
                url: '{{ route('absence') }}',
                data: {
                    query: query,
                    filter: cohortId
                },
                success: function(response) {
                    var cohortSelect = $('#cohortSelect');
                    cohortSelect.empty();

                    // Store full student list for export
                    allStudents = Array.isArray(response.students) ? response.students : (response.students || []);

                    if (Array.isArray(response.cohorts)) {
                        $('#cohort_name_li').text(response.cohorts[0].cohort_name);
                        cohortSelect.append('<option value="" selected>Choose Cohort...</option>');
                        response.cohorts.forEach(function(cohort) {
                            cohortSelect.append('<option value="' + cohort.id + '">' + cohort.cohort_name + '</option>');
                        });
                    } else if (response.cohorts) {
                        $('#cohort_name_li').text(response.cohorts.cohort_name);
                        cohortSelect.append('<option value="' + response.cohorts.id + '" selected>' + response.cohorts.cohort_name + '</option>');
                    }

                    if (selectedCohortId) {
                        cohortSelect.val(selectedCohortId);
                    }

                    updateTable(allStudents);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // 🧾 Update table UI
        function updateTable(students) {
            var tableBody = $('#students-table tbody');
            tableBody.empty();

            if (!students || students.length === 0) {
                tableBody.append('<tr><td colspan="6" class="text-center">No students found</td></tr>');
                return;
            }

            var startIndex = (currentPage - 1) * rowsPerPage;
            var endIndex = Math.min(startIndex + rowsPerPage, students.length);

            for (var i = startIndex; i < endIndex; i++) {
                var student = students[i];

                var attended = Number(student.attended_days) || 0;
                var absent = Number(student.total_absent) || 0;
                var attendancePct = (attended + absent) > 0 ? ((attended / (attended + absent)) * 100).toFixed(1) + '%' : '0%';

                var row = `
                    <tr>
                        <td>${student.en_first_name} ${student.en_last_name}</td>
                        <td>${student.national_id}</td>
                        <td>${attended} Days</td>
                        <td>${absent}</td>
                        <td>${student.total_late || 0}</td>
                        <td>${attendancePct}</td>
                        <td>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="/students/${student.id}/absence">
                                    <button class="btn btn-primary">
                                        View
                                    </button>
                                </a>
                            </div>
                        </td>
                    </tr>
                `;
                tableBody.append(row);
            }

            updatePagination(students.length);
        }

        // 🔄 Pagination update
        function updatePagination(totalStudents) {
            var totalPages = Math.ceil(totalStudents / rowsPerPage);
            var pagination = $('.pagination');
            pagination.empty();

            var prevButton = `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                                <a class="page-link" href="#" id="prevPage">Previous</a>
                              </li>`;
            pagination.append(prevButton);

            for (var i = 1; i <= totalPages; i++) {
                var pageLink = `<li class="page-item ${i === currentPage ? 'active' : ''}">
                                  <a class="page-link" href="#">${i}</a>
                                </li>`;
                pagination.append(pageLink);
            }

            var nextButton = `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                                <a class="page-link" href="#" id="nextPage">Next</a>
                              </li>`;
            pagination.append(nextButton);
        }

        // 📤 Export all students to Excel
        $(document).on('click', '#exportExcel', function() {
            if (typeof XLSX === 'undefined') {
                alert("Export library not loaded. Please reload the page.");
                return;
            }
            if (!allStudents || allStudents.length === 0) {
                alert("No student data available to export.");
                return;
            }

            var wb = XLSX.utils.book_new();
            var ws_data = [];
            var headers = ["Trainee", "National ID", "Attended Days", "Total Absent", "Total Late", "Attendance Percentage"];
            ws_data.push(headers);

            allStudents.forEach(function(student) {
                var attended = Number(student.attended_days) || 0;
                var absent = Number(student.total_absent) || 0;
                var late = Number(student.total_late) || 0;
                var attendancePct = (attended + absent) > 0 ? ((attended / (attended + absent)) * 100).toFixed(1) + '%' : '0%';

                ws_data.push([
                    `${student.en_first_name || ''} ${student.en_last_name || ''}`,
                    student.national_id || '',
                    `${attended} Days`,
                    absent,
                    late,
                    attendancePct
                ]);
            });

            var ws = XLSX.utils.aoa_to_sheet(ws_data);
            ws['!cols'] = [
                { wch: 30 }, // Trainee
                { wch: 15 }, // ID
                { wch: 15 }, // Attended
                { wch: 15 }, // Absent
                { wch: 15 }, // Late
                { wch: 20 }  // Percentage
            ];

            XLSX.utils.book_append_sheet(wb, ws, "Absence Report");

            var now = new Date();
            var dateStr = now.getFullYear() + "-" + String(now.getMonth()+1).padStart(2,'0') + "-" + String(now.getDate()).padStart(2,'0');
            XLSX.writeFile(wb, "Absence_Report_" + dateStr + ".xlsx");
        });
    });
</script>

@endsection