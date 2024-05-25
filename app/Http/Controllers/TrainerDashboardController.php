<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use App\Staff;
use App\Student;
use App\Assignment;
use App\Project;
use App\Technology_Cohort;
use App\Cohort;
use App\SoftSkillsTraining;
use Carbon\Carbon;

class TrainerDashboardController extends Controller
{
    public function index($cohortId)
    {
        $cohort = Cohort::findOrFail($cohortId); 
        // dd($cohort);
        session(['cohort_ID' => $cohortId]);
        $softSkillsForCohort = $this->softSkillsForCohort();
        $cardsStatistics = $this->cardsStatistics();
        $milestoneOverview = $this->milestoneOverview();
        $attendanceOverview = $this->attendanceOverview();
        $technologiesOverview = $this->technologiesOverview();
        // dd($technologiesOverview,$attendanceOverview);
        return view('academies.view-cohort', compact('cardsStatistics', 'attendanceOverview', 'technologiesOverview' , 'softSkillsForCohort' ,'milestoneOverview'));
    }

    private function cardsStatistics()
    {
        $staff = Auth::guard('staff')->user();
    
        $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();
    
        if (!$runningCohort) {
            return [
                'cohort' => null, 
                'statistics' => [
                    'Number_of_Students' => 0,
                    'Number_of_Briefs' => 0,
                    'Total_Assignments' => 0,
                    'Total_Technologies' => 0,
                ],
            ];
        }
    
        $cohortId = $runningCohort->id;
    
        $numberOfStudents = Student::where('cohort_id', $cohortId)->count();
    
        $numberOfBriefs = Project::where('cohort_id', $cohortId)->count();
    
        $totalAssignments = Assignment::where('cohort_id', $cohortId)->count();
    
        $totalTechnologies = Technology_Cohort::where('cohort_id', $cohortId)->distinct()->count('technology_id');
    
        return [
            'cohort' => $runningCohort, 
            'statistics' => [
                'Number_of_Students' => $numberOfStudents,
                'Number_of_Briefs' => $numberOfBriefs,
                'Total_Assignments' => $totalAssignments,
                'Total_Technologies' => $totalTechnologies,
            ],
        ];
    }
    


    private function attendanceOverview() {
        $staff = Auth::guard('staff')->user();
        $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();
    
        if (!$runningCohort) {
            // If no running cohort is found, return a default set of values
            return [
                
                'cohort_name' => 'N/A',
                'date' => Carbon::now()->format('d-F-Y'),
                'attendance_data' => [],
                'late_data' => [],
                'absence_data' => []
            ];
        }
    
        $students = $runningCohort->students;
        $totalStudents = $students->count();
    
        if ($totalStudents == 0) {
            return [
                'cohort_name' => $runningCohort->cohort_name,
                'date' => Carbon::now()->format('d-F-Y'),
                'attendance_data' => [],
                'late_data' => [],
                'absence_data' => []
            ];
        }
    
        $attendanceData = [];
        $lateData = [];
        $absenceData = [];
    
        // Calculate dates for the last 7 days
        $startDate = Carbon::today()->subDays(6);
        $endDate = Carbon::today();
    
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dayOfWeek = $date->isoFormat('dddd');
    
            // Count attended, late, and absent students for the current date
            $attendanceCount = $students->filter(function($student) use ($date) {
                return $student->absences()->where('absences_date', $date->toDateString())
                ->doesntExist();
            })->count();
            $lateCount = $students->filter(function($student) use ($date) {
                return $student->absences()->where('absences_date', $date->toDateString())->where('absences_type', 'late')->count();
            })->count();
    
            $absenceCount = $totalStudents - $attendanceCount - $lateCount;
    
            // Store attendance, late, and absence counts for the current date
            $attendanceData[$dayOfWeek] = $attendanceCount;
            $lateData[$dayOfWeek] = $lateCount;
            $absenceData[$dayOfWeek] = $absenceCount;
        }
    
        return [
            'cohort_name' => $runningCohort->cohort_name,
            'date' => Carbon::now()->format('d-F-Y'),
            'attendance_data' => $attendanceData,
            'late_data' => $lateData,
            'absence_data' => $absenceData
        ];
    }
    


    private function technologiesOverview() {
        $staff = Auth::guard('staff')->user();
    
        $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();
    
        if (!$runningCohort) {
            return [];
        }
    
        $technologiesData = [];
    
        foreach ($runningCohort->technology as $technology) {
            $startDate = Carbon::parse($technology->pivot->start_date);
            $endDate = Carbon::parse($technology->pivot->end_date);
            $currentDate = Carbon::now();
    
            $trainingPeriodInWeeks = $startDate->diffInWeeks($endDate);
            $trainingPeriod = $trainingPeriodInWeeks . " Weeks";
    
            if ($currentDate->between($startDate, $endDate)) {
                $percentage = ($currentDate->diffInDays($startDate) / $startDate->diffInDays($endDate)) * 100;
                $status = 'In Progress';
            } elseif ($currentDate->gt($endDate)) {
                $percentage = 100;
                $status = 'Finished';
            } else {
                $percentage = 0;
                $status = 'Not Started';
            }
    
            $start_date = Carbon::parse($technology->pivot->start_date)->format('d-F-Y');

            $technologiesData[] = [
                'start_date' => $start_date,
                'name' => $technology->technologies_name,
                'description' => $technology->technologies_description,
                'resources' => $technology->technologies_resources,
                'training_period' => $trainingPeriod, 
                'status' => $status,
                'percentage' => $percentage,
            ];
        }
    
        return $technologiesData;
    }
    
    private function softSkillsForCohort()
    {
        $staff = Auth::guard('staff')->user();
        $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();

        if (!$runningCohort) {
            return [];
        }

        // Fetch soft skills data for the running cohort
        $softSkills = SoftSkillsTraining::where('cohort_id', $runningCohort->id)->get();

        return $softSkills;
    }

    private function milestoneOverview() {
        $staff = Auth::guard('staff')->user();
        $runningCohort = $staff->cohorts()->where('cohort_end_date', '>', now())->first();
    
        if (!$runningCohort) {
            return [];
        }
    
        $milestones = [];
        $currentDate = Carbon::now();
    
        // Fetch technology data
        foreach ($runningCohort->technology as $technology) {
            $startDate = Carbon::parse($technology->pivot->start_date);
            $endDate = Carbon::parse($technology->pivot->end_date);
    
            $percentage = 0;
            $status = 'Not Started';
    
            // Calculate the total days between start and end dates
            $totalDays = $startDate->diffInDays($endDate);
    
            if ($currentDate->between($startDate, $endDate)) {
                if ($totalDays > 0) { // Check to avoid division by zero
                    $percentage = ($currentDate->diffInDays($startDate) / $totalDays) * 100;
                } else { // If the start and end date are the same, we consider the progress as 100%
                    $percentage = 100;
                }
                $status = 'In Progress';
            } elseif ($currentDate->gt($endDate)) {
                $percentage = 100;
                $status = 'Finished';
            }
    
            $milestones[] = [
                'start_date' => $startDate->format('d-F-Y'),
                'name' => $technology->technologies_name,
                'description' => $technology->technologies_description,
                'status' => $status,
                'percentage' => round($percentage),
                'type' => 'Technology'
            ];
        }
    
        // Fetch soft skills data
        foreach ($runningCohort->softSkillsTrainings as $softSkill) {
            $skillDate = Carbon::parse($softSkill->date);
            $skillEndDate = $skillDate->copy()->addHours(12);
            $trainingHours = 12; // Training duration in hours
    
            $percentage = 0;
            if ($currentDate->gt($skillEndDate)) {
                $percentage = 100;
            } else if ($currentDate->between($skillDate, $skillEndDate)) {
                if ($trainingHours > 0) { // Check to avoid division by zero
                    $percentage = ($currentDate->diffInHours($skillDate) / $trainingHours) * 100;
                } else { // If training hours is zero, it should never be but just a safeguard
                    $percentage = 100;
                }
            }
    
            $milestones[] = [
                'start_date' => $skillDate->format('d-F-Y'),
                'name' => $softSkill->name,
                'description' => $softSkill->description,
                'status' => $currentDate->gt($skillEndDate) ? 'Completed' : 'In Progress',
                'percentage' => round($percentage),
                'type' => 'Soft Skill'
            ];
        }
    
        // Sort milestones by start date
        usort($milestones, function ($a, $b) {
            return $a['start_date'] <=> $b['start_date'];
        });
    
        return $milestones;
    }
    
    
    
}
