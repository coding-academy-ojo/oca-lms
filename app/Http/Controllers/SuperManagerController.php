<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Academy;
use App\Cohort;
use Carbon\Carbon;
class SuperManagerController extends Controller
{
    public function index(){
        $dashboardCardsData = $this->getDashboardData();
        $graduatesByAcademyData = $this->getGraduatesByAcademyData();
        $academyPerformanceChartData = $this->getAcademyPerformanceChartData();
        $totalSummaryChartData = $this->getTotalSummaryChartData();
    
        return view('supermaneger.dashboard', compact('dashboardCardsData', 'graduatesByAcademyData', 'academyPerformanceChartData', 'totalSummaryChartData'));
    }


    private function getDashboardData() {
        $totalAcademies = Academy::count(); 

        $totalStudentsEnrolled = Cohort::where('cohort_end_date', '>', Carbon::now()->format('Y-m-d'))
                                        ->withCount('students')
                                        ->get()
                                        ->sum('students_count');

        $totalStudentsGraduated = Cohort::where('cohort_end_date', '<=', Carbon::now()->format('Y-m-d'))
                                         ->withCount('students')
                                         ->get()
                                         ->sum('students_count');

        return [
            'totalStudentsEnrolled' => $totalStudentsEnrolled,
            'totalStudentsGraduated' => $totalStudentsGraduated,
            'totalAcademies' => $totalAcademies,
        ];
    }

    private function getGraduatesByAcademyData() {
        $academiesWithGraduates = Academy::with(['cohorts' => function ($query) {
            $query->where('cohort_end_date', '<=', now()->format('Y-m-d'));
        }, 'cohorts.students'])->get();
    
        $labels = [];
        $data = [];
        foreach ($academiesWithGraduates as $academy) {
            $labels[] = $academy->academy_name; 
    
          
            $totalGraduates = 0;
            foreach ($academy->cohorts as $cohort) {
                $totalGraduates += $cohort->students->count();
            }
            $data[] = $totalGraduates;
        }
    
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Sum of Total Graduates',
                    'data' => $data,
                    'backgroundColor' => ['#e66c37'],
                    'borderColor' => ['#e66c37'],
                    'borderWidth' => 1,
                ],
            ],
        ];
    }
    

    private function getAcademyPerformanceChartData() {
        $academies = Academy::with(['cohorts' => function($query) {
            $query->has('students');
        }, 'cohorts.students'])->get();
    
        $labels = $academies->pluck('academy_name')->toArray();
        
        $colors = ['#ad5129', '#e66c37', '#eb895f'];
        
        $datasets = [];
        foreach ($academies as $academy) {
            $cohortData = [];
            foreach ($academy->cohorts as $cohortIndex => $cohort) {
                $studentCount = $cohort->students->count();
                $colorIndex = $cohortIndex % count($colors); 
    
                $datasets[] = [
                    'label' => $cohort->cohort_name . ' - ' . $academy->academy_name,
                    'data' => array_fill(0, count($labels), 0), 
                    'backgroundColor' => $colors[$colorIndex],
                    'borderColor' => $colors[$colorIndex],
                    'borderWidth' => 1
                ];
                $datasets[count($datasets) - 1]['data'][array_search($academy->academy_name, $labels)] = $studentCount;
            }
        }
    
        return [
            'labels' => $labels,
            'datasets' => $datasets,
        ];
    }
    
    
    

    private function getTotalSummaryChartData() {
        // Count the total enrolled students (students whose cohort end date hasn't come yet)
        $totalEnrolledStudents = Cohort::where('cohort_end_date', '>', Carbon::now()->format('Y-m-d'))
                                        ->withCount('students')
                                        ->get()
                                        ->sum('students_count');
    
        // Count the total graduated students (students whose cohort end date has passed)
        $totalGraduatedStudents = Cohort::where('cohort_end_date', '<=', Carbon::now()->format('Y-m-d'))
                                        ->withCount('students')
                                        ->get()
                                        ->sum('students_count');
    
        return [
            'labels' => ['Remaining Enrolled', 'Remaining Graduates'],
            'datasets' => [
                [
                    'label' => 'Summary',
                    'data' => [$totalEnrolledStudents, $totalGraduatedStudents],
                    'backgroundColor' => [
                        '#e66c37',
                        '#ad5129' 
                    ],
                    'borderWidth' => 1
                ]
            ]
        ];
    }
    
}
