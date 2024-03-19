<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Academy;
use App\Cohort;
use Carbon\Carbon;
class SuperManagerController extends Controller
{
    public function index(){
        // Change this line to use the correct method name
        $dashboardCardsData = $this->getDashboardData();
        $graduatesByAcademyData = $this->getGraduatesByAcademyData();
        $academyPerformanceChartData = $this->getAcademyPerformanceChartData();
        $totalSummaryChartData = $this->getTotalSummaryChartData();
    
        return view('supermaneger.dashboard', compact('dashboardCardsData', 'graduatesByAcademyData', 'academyPerformanceChartData', 'totalSummaryChartData'));
    }


    private function getDashboardData() {
        $totalAcademies = Academy::count(); 

        // Count students in cohorts not yet ended (Total Students Enrolled)
        $totalStudentsEnrolled = Cohort::where('cohort_end_date', '>', Carbon::now()->format('Y-m-d'))
                                        ->withCount('students')
                                        ->get()
                                        ->sum('students_count');

        // Count students in cohorts that have ended (Total Students Graduated)
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
        // Get all academies with the count of students from cohorts that have ended
        $academiesWithGraduates = Academy::with(['cohorts' => function ($query) {
            $query->where('cohort_end_date', '<=', now()->format('Y-m-d'));
        }, 'cohorts.students'])->get();
    
        $labels = [];
        $data = [];
        foreach ($academiesWithGraduates as $academy) {
            $labels[] = $academy->academy_name; // Academy name for labels
    
            // Calculate total graduates for each academy
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
        
        // Define your colors
        $colors = ['#ad5129', '#e66c37', '#eb895f']; // Your three specific colors
        
        $datasets = [];
        foreach ($academies as $academy) {
            $cohortData = [];
            foreach ($academy->cohorts as $cohortIndex => $cohort) {
                $studentCount = $cohort->students->count();
                $colorIndex = $cohortIndex % count($colors); // Cycle through colors for each cohort
    
                $datasets[] = [
                    'label' => $cohort->cohort_name . ' - ' . $academy->academy_name,
                    'data' => array_fill(0, count($labels), 0), // Initialize with zeros
                    'backgroundColor' => $colors[$colorIndex],
                    'borderColor' => $colors[$colorIndex],
                    'borderWidth' => 1
                ];
                // Set the student count for the current academy's position in the data array
                $datasets[count($datasets) - 1]['data'][array_search($academy->academy_name, $labels)] = $studentCount;
            }
        }
    
        return [
            'labels' => $labels,
            'datasets' => $datasets,
        ];
    }
    
    
    

    private function getTotalSummaryChartData() {
        // Prepare your data for the "Total Summary" chart here
        // This should return the data structure needed to initialize the Chart.js chart
        return [
            // example structure
            'labels' => ['Remaining Enrolled', 'Remaining Graduates', 'Employed Graduates'],
            'datasets' => [
                // datasets here
            ],
        ];
    }
}
