<?php

namespace App\Http\Controllers;

use App\Student;
use App\MasterpieceDetail;
use App\MasterpieceTask;
use App\MasterpieceProgress;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class MasterpieceReportController extends Controller
{
    public function exportPdf($studentId)
    {
        $staff = Auth::guard('staff')->user();
        $cohortId = session('cohort_ID');

        $student = Student::with(['cohort', 'academy'])->findOrFail($studentId);
        if ($cohortId && (int)$student->cohort_id !== (int)$cohortId) {
            abort(403, 'Student is not in the current cohort.');
        }

        // Masterpiece Details
        $details = MasterpieceDetail::where('student_id', $student->id)->first();

        // Cohort trainers (project coordinators) — exclude a specific email
        $coordinators = collect();
        if ($student->cohort) {
            $blockedEmail = 'gt.ragda.almubaydin@orange.com';

            $coordinators = $student->cohort->staff()
                ->where('role', 'trainer')
                ->where(function ($q) use ($blockedEmail) {
                    // keep rows with NULL email OR email != blocked (case-insensitive)
                    $q->whereNull('staff_email')
                        ->orWhereRaw('LOWER(staff_email) <> ?', [strtolower($blockedEmail)]);
                })
                ->orderBy('staff_name')
                ->get();
        }


        // Tasks + progress
        $tasks  = MasterpieceTask::orderBy('deadline')->get();
        $byTask = MasterpieceProgress::where('student_id', $student->id)->get()->keyBy('masterpiece_task_id');

        $rows = $tasks->map(function ($task) use ($byTask) {
            $p        = $byTask->get($task->id);
            $progress = $p ? (int) $p->progress : 0;
            return [
                'task_name'   => $task->task_name,
                'progress'    => $progress,
                'deadline'    => $task->deadline ? Carbon::parse($task->deadline)->format('Y-m-d') : 'N/A',
                'hours_spent' => $task->hours_spent ?? 0,
                'notes'       => $p ? ($p->notes ?? '') : '',
            ];
        });

        $data = [
            'student'        => $student,
            'cohort'         => $student->cohort,
            'details'        => $details,
            'rows'           => $rows,
            'coordinators'   => $coordinators, // <-- pass to view
            'generatedDate'  => now()->format('M d, Y'),
            'generatedTime'  => now()->format('H:i'),
            'staffDisplay'   => $staff ? ($staff->staff_name ?? $staff->name ?? 'Staff') : 'System',
        ];

        $pdf = Pdf::loadView('pdf.masterpiece-report', $data)->setPaper('a4', 'portrait');

        $safeName = trim(($student->en_first_name ?? '') . ' ' . ($student->en_last_name ?? ''));
        $fileName = 'masterpiece_' . $student->id . '_' . str_replace(' ', '_', $safeName ?: 'student') . '.pdf';

        return $pdf->download($fileName);
    }
}
