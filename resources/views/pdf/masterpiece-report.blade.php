<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Masterpiece Report</title>
    <style>
        @page {
            margin: 24px 24px 40px 24px;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            color: #333;
            font-size: 12px;
        }


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


        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 11px;
            opacity: 0.9;
        }

        .info {
            background: #f7f7f7;
            border-left: 4px solid #ff7900;
            padding: 12px;
            margin-bottom: 14px;
        }

        .badge {
            display: inline-block;
            background: #ffead6;
            color: #b65300;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 11px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin: 14px 0 8px;
            padding-bottom: 4px;
            border-bottom: 2px solid #ff7900;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #ff7900;
            color: #fff;
            padding: 8px 6px;
            text-align: left;
        }

        td {
            padding: 7px 6px;
            border-bottom: 1px solid #eaeaea;
            vertical-align: top;
        }

        .details-table {
            width: 100%;
            table-layout: fixed;
        }

        .details-table th,
        .details-table td {
            border-bottom: none;
        }

        .details-label {
            width: 30%;
            font-weight: bold;
            color: #ff7900;
        }

        .wrap {
            word-break: break-word;
            white-space: normal;
        }

        .muted {
            color: #777;
        }

        .footer {
            position: fixed;
            left: 0;
            right: 0;
            bottom: -6px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        /* Progress table column widths (Task wider than others) */
        .col-task {
            width: 46%;
        }

        /* widened */
        .col-progress {
            width: 14%;
        }

        .col-deadline {
            width: 16%;
        }

        .col-hours {
            width: 12%;
        }

        .col-actions {
            width: 12%;
        }

        .totals {
            margin-top: 8px;
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('images/Coding-Academy-LOGO-CMYK-Black-1024x576.png') }}" alt="Logo">
        <h1>Masterpiece Report</h1>
    </div>

    {{-- Student Header --}}
    <div class="info">
        <div>
            <strong>Student:</strong>
            {{ $student->en_first_name }} {{ $student->en_second_name }} {{ $student->en_last_name }}
            <span class="badge">#{{ str_pad($student->id, 6, '0', STR_PAD_LEFT) }}</span>
        </div>
        <div><strong>Cohort:</strong> {{ optional($cohort)->cohort_name ?? 'N/A' }}</div>
        <div><strong>Academy:</strong> {{ optional($student->academy)->academy_name ?? 'N/A' }}</div>
    </div>

    {{-- Project Mentors --}}
    <div class="section-title">Project Mentors</div>
    @if(isset($mentors) && $mentors->count())
        <div style="margin-bottom: 12px;">
            @foreach($mentors as $m)
                <span style="display:inline-block; margin-right:10px; margin-bottom:4px;">
                    {{ $m->staff_name }}
                    @if(!empty($m->staff_email)) <span class="muted">({{ $m->staff_email }})</span> @endif
                </span>
            @endforeach
        </div>
    @else
        <div class="muted">No mentors selected.</div>
    @endif

    {{-- Masterpiece Details --}}
    <div class="section-title">Masterpiece Details</div>

    <div style="font-weight: bold; margin:6px 0;">Project Information</div>
    <table class="details-table" style="margin-bottom: 10px;">
        <tr>
            <td class="details-label">Project Sector:</td>
            <td class="wrap">{{ !empty($details) ? ($details->project_sector ?? 'N/A') : 'N/A' }}</td>
        </tr>
        <tr>
            <td class="details-label">Project Name:</td>
            <td class="wrap">{{ !empty($details) ? ($details->project_name ?? 'N/A') : 'N/A' }}</td>
        </tr>
        <tr>
            <td class="details-label">Description:</td>
            <td class="wrap">{{ !empty($details) ? ($details->project_description ?? 'N/A') : 'N/A' }}</td>
        </tr>
    </table>

    {{-- Project Deliverables (ONLY GitHub link kept) --}}
    <div class="section-title">Project Deliverables</div>
    <div style="margin: 6px 0 16px;">
        <strong>GitHub Link:</strong>
        @if(!empty($details) && !empty($details->github_link))
            <a href="{{ $details->github_link }}">{{ $details->github_link }}</a>
        @else
            <span class="muted">—</span>
        @endif
    </div>

    {{-- Masterpiece Progress --}}
    <div class="section-title">Masterpiece Progress</div>
    <table>
        <thead>
            <tr>
                <th class="col-task">Task</th>
                <th class="col-progress">Progress</th>
                <th class="col-deadline">Deadline</th>
                <th class="col-hours">Duration</th>
                <th class="col-actions">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $r)
                <tr>
                    <td class="wrap">{{ $r['task_name'] }}</td>
                    <td>{{ $r['progress'] }}%</td>
                    <td>{{ $r['deadline'] }}</td>
                    <td>{{ rtrim(rtrim(number_format((float) $r['duration'], 2, '.', ''), '0'), '.') }} hrs</td>
                    <td class="wrap">{{ $r['actions'] !== '' ? $r['actions'] : '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="muted" style="text-align:center;">No tasks found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Total Hours --}}
    <div class="totals">
        Total Hours: {{ rtrim(rtrim(number_format($totalHours ?? 0, 2, '.', ''), '0'), '.') }} hrs
    </div>

    <div class="footer">
        Generated: {{ $generatedDate }} {{ $generatedTime }} &nbsp;|&nbsp;
        By: {{ $staffDisplay }} &nbsp;|&nbsp; Orange Coding Academy — Student Management System
    </div>
</body>

</html>