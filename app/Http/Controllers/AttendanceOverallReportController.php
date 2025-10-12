<?php

namespace App\Http\Controllers;

use App\Cohort;
use App\Student;
use App\Absence;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class AttendanceOverallReportController extends Controller
{
    /**
     * GET /attendance/overall/export?cohort_id=...&introduction=...
     * Builds a cohort-level Overall Attendance Report PDF.
     */
    public function exportPdf(Request $request)
    {
        // Resolve cohort id: explicit param > encrypted param > session
        $rawCohortId = $request->query('cohort_id', session('cohort_ID'));

        if (empty($rawCohortId)) {
            abort(400, 'cohort_id is required.');
        }

        // Support encrypted ids (optional)
        try {
            $cohortId = is_numeric($rawCohortId) ? (int) $rawCohortId : (int) Crypt::decryptString($rawCohortId);
        } catch (\Throwable $e) {
            // Not encrypted, keep as-is if numeric
            if (!is_numeric($rawCohortId)) {
                abort(400, 'Invalid cohort_id.');
            }
            $cohortId = (int) $rawCohortId;
        }

        $cohort = Cohort::with('students')->findOrFail($cohortId);

        // Total cohort instructional days (excludes Fri/Sat) up to today or end date
        $totalCohortDays = $this->calculateCohortDays($cohort);

        // Build student stats
        $students = $cohort->students()->with(['absences' => function ($q) {
            $q->orderBy('absences_date', 'desc');
        }])->get();

        $totalEnrolled = $students->count();

        // Per requirement: total participants in post-assessment == total enrolled
        $totalPostAssessment = $totalEnrolled;

        $met80Count = 0;
        $notMetList = [];

        foreach ($students as $s) {
            // Only count full-day absences against attendance requirement
            $absentDays = $s->absences->where('absences_type', 'absent')->count();
            $attendedDays = max(0, $totalCohortDays - $absentDays);

            $attendancePct = 0.0;
            if ($totalCohortDays > 0) {
                $attendancePct = round(($attendedDays / $totalCohortDays) * 100, 1);
                $attendancePct = max(0, min(100, $attendancePct));
            }

            $meets80 = ($attendancePct >= 80.0);

            if ($meets80) {
                $met80Count++;
            } else {
                // Justification list (latest absence reasons if any)
                $reasons = $s->absences
                    ->where('absences_type', 'absent')
                    ->pluck('absences_reason')
                    ->filter()
                    ->take(3)
                    ->values()
                    ->all();

                $notMetList[] = [
                    'student_id'    => $s->id,
                    'student_name'  => trim(($s->en_first_name ?? '') . ' ' . ($s->en_last_name ?? '')),
                    'attendancePct' => $attendancePct,
                    'reasons'       => $reasons,
                ];
            }
        }

        // Graduation requirement: attended >=80% AND participated in post assessment.
        // Since participants == enrolled, this is effectively those >=80%.
        $metGraduation = $met80Count;

        // Completion rate against the 95% target
        $completionRateActual = $totalEnrolled > 0 ? round(($metGraduation / $totalEnrolled) * 100, 1) : 0.0;
        $completionRateTarget = 95;

        // Optional intro from request
        $introduction = trim((string) $request->query('introduction', ''));
        if ($introduction === '') {
            $introduction = 'This report presents an overview of attendance performance for the cohort.';
        }

        $data = [
            'cohort'                 => $cohort,
            'introduction'           => $introduction,
            'totalCohortDays'        => $totalCohortDays,
            'totalEnrolled'          => $totalEnrolled,
            'totalPostAssessment'    => $totalPostAssessment,
            'met80Count'             => $met80Count,
            'notMetList'             => $notMetList, // likely empty based on your note
            'metGraduation'          => $metGraduation,
            'completionRateActual'   => $completionRateActual,
            'completionRateTarget'   => $completionRateTarget,
            'generatedDate'          => now()->format('M d, Y'),
            'generatedTime'          => now()->format('H:i'),
        ];

        $pdf = Pdf::loadView('pdf.cohort-attendance-overall', $data)->setPaper('a4', 'portrait');

        $safeCohort = preg_replace('/\s+/', '_', $cohort->cohort_name ?? 'cohort');
        $fileName = "Overall_Attendance_Report_{$safeCohort}_" . now()->format('Y-m-d') . ".pdf";

        return $pdf->download($fileName);
    }

    /**
     * Calculate total cohort days excluding weekends (Fri/Sat).
     */
    private function calculateCohortDays(Cohort $cohort): int
    {
        $startDate = Carbon::parse($cohort->cohort_start_date);
        $endDate   = Carbon::parse($cohort->cohort_end_date);
        $current   = Carbon::now();

        $calcEnd   = $current->lessThan($endDate) ? $current : $endDate;

        $total = 0;
        $d = $startDate->copy();

        while ($d->lessThanOrEqualTo($calcEnd)) {
            if (!in_array($d->dayOfWeek, [Carbon::FRIDAY, Carbon::SATURDAY], true)) {
                $total++;
            }
            $d->addDay();
        }

        return $total;
    }
}
