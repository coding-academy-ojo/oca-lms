<?php

namespace App\Http\Controllers;

use App\Trainee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Absence;
use App\Assignment;
use App\AssignmentSubmission;
use App\Cohort;
use App\Student;
use App\Project;
use App\Technology_Cohort;
use App\TraineeSkillsProgress;
use App\MasterpieceProgress;
use App\MasterpieceTask;
use App\MasterpieceDetail;

class SingleTraineeProgressController extends Controller
{
    public function index(Request $request, $id)
    {
        $staff = Auth::guard('staff')->user();
        $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();

        $cohortID = session('cohort_ID');
        $cohort = Cohort::findOrFail($cohortID);
        $student = Student::find($id);

        $absencesData = $this->getAbsencesData($id);
        $technologyData = $this->getTechnologyData($cohort);
        $assignmentsData = $this->getAssignmentsData($student, $technologyData['technologyIds']);
        $tasksWithProgress = $this->getMasterpieceProgress($id); // Updated here
        $studentProjects = $this->getStudentProjects($id);
        $masterpieceDetails = $this->getMasterpieceDetails($id);

        return view('trainer.trainee-progress-details', [
            'student' => $student,
            'absencesCount' => $absencesData['absencesCount'],
            'nonJustifiedAbsencesCount' => $absencesData['nonJustifiedAbsencesCount'],
            'lateCount' => $absencesData['lateCount'],
            'nonJustifiedLateCount' => $absencesData['nonJustifiedLateCount'],
            'technologyNames' => $technologyData['technologyNames'],
            'studentAssignments' => $assignmentsData['studentAssignments'],
            'countValues' => $assignmentsData['countValues'],
            'tasksWithProgress' => $tasksWithProgress,
            'studentProjects' => $studentProjects,
        ]);
    }

    private function getAbsencesData($studentId)
    {
        return [
            'absencesCount' => Absence::where('student_id', $studentId)
                ->whereNull('file_path')
                ->where('absences_type', 'absent')
                ->count(),
            'nonJustifiedAbsencesCount' => Absence::where('student_id', $studentId)
                ->whereNull('file_path')
                ->where('absences_type', 'absent')
                ->count(),
            'lateCount' => Absence::where('student_id', $studentId)
                ->whereNull('file_path')
                ->where('absences_type', 'late')
                ->count(),
            'nonJustifiedLateCount' => Absence::where('student_id', $studentId)
                ->whereNull('file_path')
                ->where('absences_type', 'late')
                ->count(),
        ];
    }

    private function getTechnologyData($cohort)
    {
        $technologies = $cohort->technology;
        $technologyNames = [];
        $technologyIds = [];

        foreach ($technologies as $cohortTechnology) {
            $technologyNames[] = $cohortTechnology->technologies_name;
            $technologyIds[] = $cohortTechnology->id;
        }

        return compact('technologyNames', 'technologyIds');
    }

    private function getAssignmentsData($student, $technologyIds)
    {
        $studentAssignments = $student->assignment()->with('topic.technologyCohort')->get();
        $assignmentCountsByTechnology = [];

        foreach ($studentAssignments as $assignment) {
            $assignmentTechnologyId = $assignment->topic->technologyCohort->technology_id;

            if (in_array($assignmentTechnologyId, $technologyIds)) {
                $assignmentCountsByTechnology[$assignmentTechnologyId] = ($assignmentCountsByTechnology[$assignmentTechnologyId] ?? 0) + 1;
            }

            $submission = $assignment->assignmentSubmissions()->where('student_id', $student->id)->first();
            $assignment->submissionStatus = $submission ? $submission->status : 'No Assignments Assigned';
            $assignment->dueDate = $assignment->assignment_due_date;
            $assignment->isLate = $submission ? ($submission->is_late ? 'Late' : 'On Time') : 'Not Submitted';
        }

        return [
            'studentAssignments' => $studentAssignments,
            'countValues' => array_values($assignmentCountsByTechnology),
        ];
    }
    private function getMasterpieceProgress($studentId)
    {
        // Retrieve all masterpiece tasks
        $allTasks = MasterpieceTask::all();

        // Retrieve progress entries for the student
        $progressEntries = MasterpieceProgress::where('student_id', $studentId)
            ->with(['student', 'staff', 'tasks'])
            ->join('masterpiece_tasks', 'masterpiece_progress.masterpiece_task_id', '=', 'masterpiece_tasks.id')
            ->select(
                'masterpiece_progress.*',
                'masterpiece_tasks.task_name',
                'masterpiece_tasks.deadline as task_deadline',
                'masterpiece_tasks.hours_spent'
            )
            ->get();

        // Map all tasks and ensure default values if no entry exists
        $tasksWithProgress = $allTasks->map(function ($task) use ($progressEntries) {
            $progressEntry = $progressEntries->firstWhere('masterpiece_task_id', $task->id);

            return [
                'task_name'     => $task->task_name,
                'progress'      => $progressEntry ? $progressEntry->progress : 0,
                'task_deadline' => $task->deadline,
                'notes'         => $progressEntry ? $progressEntry->notes : '',
                'hours_spent'   => $progressEntry ? $progressEntry->hours_spent : 0, // ✅ added
            ];
        });

        return $tasksWithProgress;
    }



    private function getStudentProjects($studentId)
    {
        $student = Student::find($studentId);
        $cohortId = $student->cohort_id;

        return Project::where('cohort_id', $cohortId)->get()->map(function ($project) use ($studentId) {
            $traineeProgress = TraineeSkillsProgress::where('student_id', $studentId)
                ->where('project_id', $project->id)
                ->first();

            return [
                'due_date' => $project->project_delivery_date,
                'project_name' => $project->project_name,
                'status' => $traineeProgress ? ($traineeProgress->project_status == 1 ? 'Passed' : 'Not Passed') : '',
                'submission_date' => $traineeProgress && $traineeProgress->created_at ? $traineeProgress->created_at->format('d/m/Y') : 'N/A',
            ];
        });
    }




    private function getMasterpieceDetails($studentId)
    {

        $details = MasterpieceDetail::with('student')->where('student_id', $studentId)->first();

        return $details;
    }
}
