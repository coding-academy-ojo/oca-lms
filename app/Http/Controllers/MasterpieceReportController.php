<?php

namespace App\Http\Controllers;

use App\Student;
use App\MasterpieceDetail;
use App\MasterpieceTask;
use App\MasterpieceProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class MasterpieceReportController extends Controller
{
    /**
     * POST /masterpiece/{studentId}/export
     * Accepts selected mentor IDs and exports the PDF.
     */
public function exportPdf(Request $request, $studentId)
{
    $staff = Auth::guard('staff')->user();
    $cohortIdInSession = session('cohort_ID');

    $student = Student::with(['cohort', 'academy'])->findOrFail($studentId);
    if ($cohortIdInSession && (int) $student->cohort_id !== (int) $cohortIdInSession) {
        abort(403, 'Student is not in the current cohort.');
    }

    // Masterpiece details
    $details = MasterpieceDetail::where('student_id', $student->id)->first();

    // ---------- Mentors (checkbox selection) ----------
    $selectedMentorIds = collect((array) $request->input('selected_staff_ids', []))
        ->filter(fn ($v) => is_numeric($v))
        ->map(fn ($v) => (int) $v)
        ->values()
        ->all();

    $mentors = collect();
    if ($student->cohort) {
        $blockedEmail = 'gt.ragda.almubaydin@orange.com';

        // Fully qualify columns to avoid "ambiguous column" errors
        $mentorsQuery = $student->cohort->staff()
            ->select('staff.*')
            ->where('staff.role', 'trainer')
            ->where(function ($q) use ($blockedEmail) {
                $q->whereNull('staff.staff_email')
                  ->orWhereRaw('LOWER(staff.staff_email) <> ?', [strtolower($blockedEmail)]);
            });

        if (!empty($selectedMentorIds)) {
            $mentorsQuery->whereIn('staff.id', $selectedMentorIds);
        }

        $mentors = $mentorsQuery->orderBy('staff.staff_name', 'asc')->get();
    }

    // ---------- Tasks + Progress ----------
    // Duration displayed per row = planned hours for the task (masterpiece_tasks.hours_spent)
    // Total Hours footer = sum of (planned * progress/100) across tasks.
    $tasks = MasterpieceTask::orderBy('deadline')->get();
    $progressByTaskId = MasterpieceProgress::where('student_id', $student->id)
        ->get()
        ->keyBy('masterpiece_task_id');

    $totalTakenHours = 0.0;

    $rows = $tasks->map(function ($task) use ($progressByTaskId, &$totalTakenHours) {
        $p = $progressByTaskId->get($task->id);

        $progressPct = $p ? (int) ($p->progress ?? 0) : 0;
        $progressPct = max(0, min(100, $progressPct));

        $planned = (float) ($task->hours_spent ?? 0);              // what we DISPLAY as "Duration"
        $taken   = round($planned * ($progressPct / 100), 2);      // used only for Total Hours

        $totalTakenHours += $taken;

        return [
            'task_name'    => $task->task_name,
            'progress'     => $progressPct,
            'deadline'     => $task->deadline ? Carbon::parse($task->deadline)->format('Y-m-d') : 'N/A',
            'duration'     => $planned,                              // <-- show this in the table
            'taken_hours'  => $taken,                                // <-- not shown, used for diagnostics if needed
            'actions'      => $p ? (string) ($p->notes ?? '') : '',
        ];
    });

    $data = [
        'student'       => $student,
        'cohort'        => $student->cohort,
        'details'       => $details,
        'rows'          => $rows,
        'mentors'       => $mentors,
        'totalHours'    => round($totalTakenHours, 2),               // footer "Total Hours"
        'generatedDate' => now()->format('M d, Y'),
        'generatedTime' => now()->format('H:i'),
        'staffDisplay'  => $staff ? ($staff->staff_name ?? $staff->name ?? 'Staff') : 'System',
    ];

    $pdf = Pdf::loadView('pdf.masterpiece-report', $data)->setPaper('a4', 'portrait');

    $safeName = trim(($student->en_first_name ?? '') . ' ' . ($student->en_last_name ?? ''));
    $fileName = 'masterpiece_' . $student->id . '_' . str_replace(' ', '_', $safeName ?: 'student') . '.pdf';

    return $pdf->download($fileName);
}


}
