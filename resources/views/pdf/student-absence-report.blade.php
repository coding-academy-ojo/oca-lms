<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Absence Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; color: #333; }

        
        .header {
            background: #ffffff;
            color: #fff;
            padding-top: 50px;
            margin-bottom: 16px;
            position: relative;
        }
        .header img {
            position: absolute;
            top: 10px;
            right: 16px;
            width: 170px;
            height: auto;
        }

        /* Style for the H1 title */
        .header h1 {
            color: #000; /* black color */
            font-size: 22px;
            font-weight: bold;
            margin: 0;
            text-align: left;
        }
        .academy-title { font-size: 20px; font-weight: bold; margin-bottom: 5px; }
        .academy-subtitle { font-size: 11px; margin-bottom: 10px; }
        .report-title { font-size: 16px; font-weight: bold; }

        .student-info { background: #f5f5f5; padding: 15px; margin-bottom: 15px; border-left: 4px solid #ff7900; }
        .info-row { margin-bottom: 8px; font-size: 12px; }
        .info-label { font-weight: bold; color: #ff7900; display: inline-block; width: 100px; }

        .statistics { margin-bottom: 15px; border: 1px solid #ddd; }
        .stats-header { background: #ff7900; color: #fff; padding: 10px; font-weight: bold; font-size: 12px; }

        /* Make 4 cards on one row reliably in dompdf */
        .stats-body {
            padding: 10px;
            font-size: 0;            /* kill inline-block spacing */
            text-align: left;
        }
        .stat-item {
            display: inline-block;
            width: 20.5%;            /* 4 per row */
            box-sizing: border-box;
            margin: 0;               /* no margins to avoid wrapping */
            padding: 10px 12px;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 6px;
            vertical-align: top;
            text-align: center;
            font-size: 11px;         /* restore font size inside card */
        }
        .stat-number { font-size: 18px; font-weight: bold; color: #ff7900; }
        .stat-note { font-size: 9px; color: #777; margin-top: 2px; }

        .section-title { font-size: 14px; font-weight: bold; margin: 15px 0 10px 0; padding-bottom: 5px; border-bottom: 2px solid #ff7900; }

        .records-table { width: 100%; border-collapse: collapse; font-size: 9px; }
        .records-table th { background: #ff7900; color: #fff; padding: 8px 4px; text-align: left; font-weight: bold; }
        .records-table td { padding: 6px 4px; border-bottom: 1px solid #ddd; vertical-align: top; }
        .records-table tr:nth-child(even) { background: #f9f9f9; }

        .type-absent { background: #ffebee; color: #c62828; padding: 2px 4px; border-radius: 3px; font-size: 8px; font-weight: bold; }
        .type-late { background: #fff8e1; color: #f57f17; padding: 2px 4px; border-radius: 3px; font-size: 8px; font-weight: bold; }

        .footer { margin-top: 20px; padding: 10px 0; border-top: 2px solid #ff7900; text-align: center; font-size: 9px; color: #666; }
        .no-records { text-align: center; padding: 20px; background: #f5f5f5; border: 1px dashed #ccc; font-size: 12px; }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('images/Coding-Academy-LOGO-CMYK-Black-1024x576.png') }}" alt="Logo">
        <h1>Student Absence Report</h1>
    </div>

    <div class="student-info">
        <div class="info-row">
            <span class="info-label">Student:</span>
            {{ $student->en_first_name }} {{ $student->en_second_name }} {{ $student->en_last_name }}
        </div>
        <div class="info-row">
            <span class="info-label">ID:</span>
            #{{ str_pad($student->id, 6, '0', STR_PAD_LEFT) }}
        </div>
        <div class="info-row">
            <span class="info-label">National ID:</span>
            {{ str_pad($student->national_id, 10, '0', STR_PAD_LEFT) }}
        </div>
        <div class="info-row">
            <span class="info-label">Cohort:</span>
            {{ $cohort->cohort_name ?? 'No Absent' }}
        </div>
        <div class="info-row">
            <span class="info-label">Academy:</span>
            {{ $student->academy->academy_name ?? 'No Absent' }}
        </div>
    </div>

    <div class="statistics">
        <div class="stats-header">Absence Summary</div>
        <div class="stats-body">
            <div class="stat-item">
                <div class="stat-number">{{ $totalAbsent }}</div>
                <div>Absent Days</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $totalLate }}</div>
                <div>Late Arrivals</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $totalRecords }}</div>
                <div>Total Records</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ number_format($attendancePercentage ?? 0, 1) }}%</div>
                <div>Attendance Rate</div>
            </div>
        </div>
    </div>

    <div class="section-title">Detailed Records</div>

    @if($student->absences->isEmpty())
        <div class="no-records">
            <strong>No absence records found</strong><br>
            This student has perfect attendance.
        </div>
    @else
        <table class="records-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th width="15%">Date</th>
                    <th width="12%">Type</th>
                    <th width="12%">Duration</th>
                    <th width="35%">Reason</th>
                    <th width="15%">Action</th>
                    <th width="11%">Report</th>
                </tr>
            </thead>
            <tbody>
                @foreach($student->absences as $absence)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($absence->absences_date)->format('M d, Y') }}</td>
                        <td>
                            <span class="type-{{ $absence->absences_type }}">
                                {{ strtoupper($absence->absences_type) }}
                            </span>
                        </td>
                        <td>
                            @php
                                $duration = trim($absence->absences_duration);
                                if ($duration === '' || $duration === null) {
                                    echo 'No Absent';
                                } elseif (is_numeric($duration)) {
                                    $minutes = intval($duration);
                                    echo $minutes >= 60 ? number_format($minutes / 60, 1) . 'h' : $minutes . 'm';
                                } else {
                                    echo 'No Absent';
                                }
                            @endphp
                        </td>
                        <td>{{ \Illuminate\Support\Str::limit($absence->absences_reason, 40) }}</td>
                        <td>{{ $absence->actions ?: 'None' }}</td>
                        <td>{{ $absence->file_path ? 'Yes' : 'No' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="footer">
        <div>Generated: {{ $generatedDate }} at {{ $generatedTime }}</div>
        <div>By: {{ Auth::guard('staff')->user()->name ?? 'System' }}</div>
        <div style="margin-top: 5px; font-style: italic;">Orange Coding Academy - Student Management System</div>
    </div>
</body>
</html>
