<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Overall Attendance Report</title>
    <style>
        @page { margin: 24px 24px 40px 24px; }
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #333; font-size: 12px; }
        .header { background: #ff7900; color: #fff; padding: 16px; text-align: center; margin-bottom: 16px; }
        .title { font-size: 18px; font-weight: bold; }
        .subtitle { font-size: 11px; opacity: 0.9; }

        .section-title { font-size: 14px; font-weight: bold; margin: 14px 0 8px; padding-bottom: 4px; border-bottom: 2px solid #ff7900; }
        .muted { color: #777; }
        .kv { margin: 6px 0; }
        .kv .k { font-weight: bold; color: #ff7900; }
        .intro { background: #f7f7f7; padding: 10px 12px; border-left: 4px solid #ff7900; }

        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th { background: #ff7900; color: #fff; padding: 8px 6px; text-align: left; }
        td { padding: 7px 6px; border-bottom: 1px solid #eaeaea; vertical-align: top; }
        .wrap { word-break: break-word; white-space: normal; }

        .footer { position: fixed; left: 0; right: 0; bottom: -6px; text-align: center; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">ORANGE CODING ACADEMY</div>
        <div class="subtitle">Overall Attendance Report</div>
    </div>

    <div class="section-title">Cohort</div>
    <div class="kv"><span class="k">Cohort Name:</span> {{ $cohort->cohort_name ?? 'N/A' }}</div>
    <div class="kv"><span class="k">Academy:</span> {{ optional($cohort->academy)->academy_name ?? 'N/A' }}</div>
    <div class="kv"><span class="k">Cohort Duration:</span>
        {{ \Carbon\Carbon::parse($cohort->cohort_start_date)->format('Y-m-d') }}
        →
        {{ \Carbon\Carbon::parse($cohort->cohort_end_date)->format('Y-m-d') }}
        &nbsp; ({{ $totalCohortDays }} training days, excl. Fri/Sat)
    </div>

    <div class="section-title">Introduction</div>
    <div class="intro">{{ $introduction }}</div>

    <div class="section-title">Summary</div>
    <div class="kv"><span class="k">Total Enrolled Students:</span> {{ $totalEnrolled }}</div>
    <div class="kv"><span class="k">Total Participants in Post-Assessment:</span> {{ $totalPostAssessment }}</div>
    <div class="kv"><span class="k">Students Meeting 80% Attendance:</span> {{ $met80Count }}</div>
    <div class="kv"><span class="k">Students Not Meeting 80% Attendance:</span> {{ count($notMetList) }}</div>
    <div class="kv"><span class="k">Students Meeting Graduation Requirement (≥80% + Post-Assessment):</span> {{ $metGraduation }}</div>
    <div class="kv"><span class="k">Completion Rate (Target {{ $completionRateTarget }}%):</span>
        {{ number_format($completionRateActual, 1) }}%
    </div>

    <div class="section-title">Students Not Meeting 80% (with Justifications)</div>
    @if(count($notMetList))
        <table>
            <thead>
                <tr>
                    <th style="width: 30%;">Student</th>
                    <th style="width: 10%;">Attendance</th>
                    <th style="width: 60%;">Justification (Latest Reasons)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notMetList as $row)
                    <tr>
                        <td class="wrap">#{{ $row['student_id'] }} — {{ $row['student_name'] }}</td>
                        <td>{{ $row['attendancePct'] }}%</td>
                        <td class="wrap">
                            @if (!empty($row['reasons']))
                                {{ implode(' | ', $row['reasons']) }}
                            @else
                                <span class="muted">—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="muted">No students fall below 80% attendance based on current records.</div>
    @endif

    <div class="footer">
        Generated: {{ $generatedDate }} {{ $generatedTime }} &nbsp;|&nbsp; Orange Coding Academy — Student Management System
    </div>
</body>
</html>
