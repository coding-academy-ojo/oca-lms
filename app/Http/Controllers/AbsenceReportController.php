<?php

namespace App\Http\Controllers;

use App\Student;
use App\Absence;
use App\Cohort;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class AbsenceReportController extends Controller
{
    public function index(Request $request, $cohort_id = null)
    {
        try {
            if ($cohort_id) {
                $decryptedCohortId = Crypt::decryptString($cohort_id);
                session(['selected_cohort_id' => $decryptedCohortId]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid or expired cohort ID'], 400);
        }
        if ($request->ajax()) {
            $staff = Auth::guard('staff')->user();

            $selectedCohortId = $cohort_id ?: session('selected_cohort_id');

            if (!$selectedCohortId) {
                return response()->json(['message' => 'Cohort ID is required'], 400);
            }

            $runningCohort = Cohort::where('id', $selectedCohortId)->first();

            if (!$runningCohort) {
                return response()->json(['message' => 'Cohort not found'], 404);
            }

            // Calculate total cohort days excluding weekends
            $totalCohortDays = $this->calculateCohortDays($runningCohort);

            $studentsQuery = $runningCohort->students();

            $query = $request->input('query');

            try {
                if ($query) {
                    $studentsQuery->where(function ($queryBuilder) use ($query) {
                        $queryBuilder->where('en_first_name', 'LIKE', "%{$query}%")
                            ->orWhere('en_last_name', 'LIKE', "%{$query}%");
                    });
                }

                $students = $studentsQuery->withCount([
                    'absences as total_absent' => function ($query) {
                        $query->where('absences_type', 'absent');
                    },
                    'absences as total_late' => function ($query) {
                        $query->where('absences_type', 'late');
                    }
                ])->with(['absences' => function ($query) {
                    $query->whereNotNull('actions')
                        ->orderBy('absences_date', 'desc');
                }])->get();

                // Add attended days and action status to each student
                $students->each(function ($student) use ($totalCohortDays) {
                    $student->attended_days = $totalCohortDays - $student->total_absent;

                    // Calculate total absent and late days
                    $totalAbsentLateDays = $student->total_absent + $student->total_late;

                    // Get the latest action taken
                    $latestAction = $student->absences->first();

                    if ($latestAction && $latestAction->actions) {
                        // If there's an action taken, display the latest action
                        $student->action_status = $latestAction->actions;
                    } elseif ($totalAbsentLateDays > 5) {
                        // If more than 5 absent/late days with no actions taken
                        $student->action_status = 'Action Required';
                    } else {
                        // If less than 5 days or no absent/late days
                        $student->action_status = 'No Actions';
                    }
                });

                return response()->json([
                    'cohorts' => [$runningCohort],
                    'students' => $students,
                ], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error fetching students: ' . $e->getMessage()], 500);
            }
        } else {
            return view('supermaneger.absence');
        }
    }

    /**
     * Calculate total cohort days excluding weekends (Friday and Saturday)
     *
     * @param Cohort $cohort
     * @return int
     */
    private function calculateCohortDays(Cohort $cohort)
    {
        $startDate = Carbon::parse($cohort->cohort_start_date);
        $endDate = Carbon::parse($cohort->cohort_end_date);
        $currentDate = Carbon::now();

        // Use current date if cohort is still running, otherwise use end date
        $calculationEndDate = $currentDate->lessThan($endDate) ? $currentDate : $endDate;

        $totalDays = 0;
        $date = $startDate->copy();

        while ($date->lessThanOrEqualTo($calculationEndDate)) {
            // Skip Friday (5) and Saturday (6)
            if (!in_array($date->dayOfWeek, [Carbon::FRIDAY, Carbon::SATURDAY])) {
                $totalDays++;
            }
            $date->addDay();
        }

        return $totalDays;
    }
    public function updateAction(Request $request, $absence_id)
    {
        try {


            $request->validate([
                'actions' => 'nullable|in:null,Alert,Warning,Committee Review,Meeting with Manager/Job Coach'
            ]);

            $absence = Absence::findOrFail($absence_id);

            // Handle null value explicitly
            $actionValue = ($request->actions === 'null' || $request->actions === null) ? null : $request->actions;


            $absence->update([
                'actions' => $actionValue
            ]);

            $message = $actionValue ? 'Follow-up action updated successfully.' : 'Follow-up action cleared successfully.';
            return back()->withSuccess($message);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withError('Validation failed: ' . implode(', ', $e->validator->errors()->all()));
        } catch (ModelNotFoundException $e) {
            return back()->withError('Absence record not found.');
        } catch (\Exception $e) {
            return back()->withError('Error updating action: ' . $e->getMessage());
        }
    }

    public function show($studentId)
    {
        try {
            $student = Student::findOrFail($studentId);

            // Load the absence and late records for the student, sorted by date descending
            $student->load(['absences' => function ($query) {
                $query->whereIn('absences_type', ['absent', 'late'])
                    ->orderBy('absences_date', 'desc');
            }]);

            return view('supermaneger.spacificUserReport', ['student' => $student]);
        } catch (ModelNotFoundException $e) {
            return back()->withError('Student not found')->withInput();
        } catch (\Exception $e) {
            return back()->withError('Error fetching student records: ' . $e->getMessage())->withInput();
        }
    }
    public function exportPdf($studentId)
    {

        try {
            $student = Student::findOrFail($studentId);

            // Load absence + late records
            $student->load(['absences' => function ($query) {
                $query->whereIn('absences_type', ['absent', 'late'])
                    ->orderBy('absences_date', 'desc');
            }]);

            $totalAbsent  = $student->absences->where('absences_type', 'absent')->count();
            $totalLate    = $student->absences->where('absences_type', 'late')->count();
            $totalRecords = $totalAbsent + $totalLate;

            // Cohort + total cohort days (reuse your helper that skips Fri/Sat)
            $cohort = $student->cohort;
            $totalCohortDays = 0;
            if ($cohort) {
                $totalCohortDays = (int) $this->calculateCohortDays($cohort);
            }

            // ✅ Attendance = (cohort days - absent days)
            $attendedDays = max(0, $totalCohortDays - $totalAbsent);

            // ✅ Attendance % (avoid division by zero, clamp 0..100)
            $attendancePercentage = 0.0;
            if ($totalCohortDays > 0) {
                $attendancePercentage = round(($attendedDays / $totalCohortDays) * 100, 1);
                if ($attendancePercentage > 100) $attendancePercentage = 100.0;
                if ($attendancePercentage < 0)   $attendancePercentage = 0.0;
            }

            $data = [
                'student'               => $student,
                'cohort'                => $cohort,
                'totalAbsent'           => $totalAbsent,
                'totalLate'             => $totalLate,
                'totalRecords'          => $totalRecords,
                'totalCohortDays'       => $totalCohortDays,   // <-- NEW
                'attendancePercentage'  => $attendancePercentage, // <-- NEW
                'generatedDate'         => Carbon::now()->format('F d, Y'),
                'generatedTime'         => Carbon::now()->format('h:i A'),
            ];

            $pdf = PDF::loadView('pdf.student-absence-report', $data)->setPaper('A4', 'portrait');
            $fileName = 'Absence_Report_' . $student->en_first_name . '_' . $student->en_last_name . '_' . \Carbon\Carbon::now()->format('Y-m-d') . '.pdf';

            return $pdf->download($fileName);
        } catch (ModelNotFoundException $e) {
            return back()->withError('Student not found');
        } catch (\Exception $e) {
            return back()->withError('Error generating PDF: ' . $e->getMessage());
        }
    }



    public function UploudAbsenceReport(Request $request, $absenceId)
    {
        try {
            $absence = Absence::findOrFail($absenceId);

            $request->validate([
                'report_file' => 'required|file|max:102400',
            ]);

            $file = $request->file('report_file');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $publicPath = 'absence_reports/' . $fileName;
            $file->move(public_path('absence_reports'), $fileName);

            $absence->update([
                'file_path' => $publicPath,
            ]);

            return back()->withSuccess('Report uploaded successfully.');
        } catch (ModelNotFoundException $e) {
            return back()->withError('Absence not found');
        } catch (\Exception $e) {
            return back()->withError('Error uploading report: ' . $e->getMessage());
        }
    }

    public function downloadAbsenceReport($absenceId)
    {
        try {
            $absence = Absence::findOrFail($absenceId);

            if (!$absence->file_path) {
                return back()->withError('Absence report not found');
            }

            // Convert the file path to use the correct directory separator
            $filePath = public_path(str_replace('/', DIRECTORY_SEPARATOR, $absence->file_path));
            // dd($filePath);
            if (!file_exists($filePath)) {
                return back()->withError('File not found');
            }

            return response()->download($filePath);
        } catch (ModelNotFoundException $e) {
            return back()->withError('Absence not found');
        } catch (\Exception $e) {
            return back()->withError('Error downloading report: ' . $e->getMessage());
        }
    }
}
