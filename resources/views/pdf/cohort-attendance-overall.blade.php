<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cohort Summary Report</title>
    <style>
        @page { margin: 24px 24px 40px 24px; }
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            color: #333;
            font-size: 12px;
            background: #fff;
        }

        /* ===== HEADER ===== */
        .header {
            background: #ffffff;
            color: #000;
            padding-top: 40px;
            padding-bottom: 10px;
            position: relative;
            margin-bottom: 24px;
        }
        .header img {
            position: absolute;
            top: 10px;
            right: 16px;
            width: 160px;
            height: auto;
        }
        .header h1 {
            color: #000;
            font-size: 22px;
            font-weight: bold;
            margin: 0;
            text-align: left;
        }
        .subline {
            color: #ff7900;
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
            margin-top: 6px;
        }

        /* ===== SECTIONS ===== */
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            margin: 18px 0 8px;
            padding-bottom: 6px;
            border-bottom: 2px solid #ff7900;
        }

        .kv { margin: 6px 0; }
        .kv .k {
            font-weight: bold;
            color: #ff7900;
            width: 220px;
            display: inline-block;
        }

        .intro {
            background: #f7f7f7;
            padding: 10px 12px;
            border-left: 4px solid #ff7900;
            line-height: 1.6;
        }

        /* ===== TABLES ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background: #ff7900;
            color: #fff;
            padding: 8px 6px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 7px 6px;
            border: 1px solid #ddd;
            vertical-align: top;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .wrap { word-break: break-word; white-space: normal; }
        .muted { color: #777; }

        /* ===== FOOTER ===== */
        .footer {
            position: fixed;
            left: 0;
            right: 0;
            bottom: -10px;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #ff7900;
            padding-top: 4px;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <img src="{{ public_path('images/Coding-Academy-LOGO-CMYK-Black-1024x576.png') }}" alt="Logo">
        <h1>Cohort Summary Report</h1>
        <h1>images/Coding-Academy-LOGO-CMYK-Black-1024x576.png</h1>
    </div>

    <!-- COHORT DETAILS -->
    <div class="section-title">Cohort Information</div>
    <div class="kv"><span class="k">Cohort Name:</span> {{ $cohort->cohort_name ?? 'N/A' }}</div>
    <div class="kv"><span class="k">Academy Location:</span> Coding Academy by Orange - {{ optional($cohort->academy)->academy_name ?? 'N/A' }}</div>
    <div class="kv"><span class="k">Cohort Start Date:</span> {{ \Carbon\Carbon::parse($cohort->cohort_start_date)->format('Y-m-d') }}</div>
    <div class="kv"><span class="k">Cohort End Date:</span> {{ \Carbon\Carbon::parse($cohort->cohort_end_date)->format('Y-m-d') }}</div>
    <div class="kv"><span class="k">Total Workdays:</span> {{ $totalCohortDays }} days</div>
    <div class="kv"><span class="k">Working Days:</span> Sun, Mon, Tue, Wed, Thu</div>
    <div class="kv"><span class="k">Working Hours:</span> 9:00 AM - 6:00 PM</div>

    <!-- INTRODUCTION -->
    <div class="section-title">Introduction</div>
    <div class="intro">{{ $introduction }}</div>

    <!-- SUMMARY -->
    <div class="section-title">Attendance Summary</div>
    <table>
        <thead>
            <tr>
                <th style="width: 45%;">Attendance Overview</th>
                <th style="width: 15%;">Count</th>
                <th style="width: 40%;">Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Enrolled Students</td>
                <td>{{ $totalEnrolled }}</td>
                <td>Total number of students enrolled in this cohort.</td>
            </tr>
            <tr>
                <td>Total Participants in Post-Assessment</td>
                <td>
                    @if($totalEnrolled > 0)
                        {{ round(($totalPostAssessment / $totalEnrolled) * 100, 1) }}%
                    @else
                        0%
                    @endif
                </td>
                <td>Percentage of enrolled students who completed the post-assessment.</td>
            </tr>
            <tr>
                <td>Students Meeting 80% Attendance</td>
                <td>
                    @if($totalEnrolled > 0)
                        {{ round(($met80Count / $totalEnrolled) * 100, 1) }}%
                    @else
                        0%
                    @endif
                </td>
                <td>Students who achieved at least 80% attendance throughout the cohort duration.</td>
            </tr>
            <tr>
                <td>Students Not Meeting 80% Attendance</td>
                <td>
                    @if($totalEnrolled > 0)
                        {{ round((count($notMetList) / $totalEnrolled) * 100, 1) }}%
                    @else
                        0%
                    @endif
                </td>
                <td>Students with attendance below 80%. Detailed justifications listed below.</td>
            </tr>
            <tr>
                <td>Students Meeting Graduation Requirement (≥80% + Post-Assessment)</td>
                <td>
                    @if($totalEnrolled > 0)
                        {{ round(($metGraduation / $totalEnrolled) * 100, 1) }}%
                    @else
                        0%
                    @endif
                </td>
                <td>Students fulfilling both attendance and assessment requirements for graduation.</td>
            </tr>
            <tr>
                <td>Completion Rate (Target {{ $completionRateTarget }}%)</td>
                <td>{{ number_format($completionRateActual, 1) }}%</td>
                <td>
                    @if($completionRateActual >= $completionRateTarget)
                        Target achieved — the cohort met or exceeded the expected completion rate.
                    @else
                        Below target — further review of attendance or engagement recommended.
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <!-- BELOW 80% SECTION -->
    <div class="section-title">Students Below 80% Attendance (with Justifications)</div>
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

    <!-- FOOTER -->
    <div class="footer">
        Orange Restricted — Generated: {{ $generatedDate }} {{ $generatedTime }} |
        Orange Coding Academy — Student Management System
    </div>

</body>
</html>
