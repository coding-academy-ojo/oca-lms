<?php

namespace App\Http\Controllers;

use App\Student;
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

        $totalStudentsEnrolled = Student::count();
        // Cohort::
        // where('cohort_end_date', '>', Carbon::now()->format('Y-m-d'))
        //                                 ->withCount('students')
        //                                 ->get()
        //                                 ->sum('students_count');

        // $totalStudentsGraduated = Cohort::where('cohort_end_date', '<=', Carbon::now()->format('Y-m-d'))
        //                                  ->withCount('students')
        //                                  ->get()
        //                                  ->sum('students_count');
        $totalStudentsGraduated = Student::where('certificate_type', '!=' , null)->count();
        return [
            'totalStudentsEnrolled' => $totalStudentsEnrolled,
            'totalStudentsGraduated' => $totalStudentsGraduated,
            'totalAcademies' => $totalAcademies,
        ];
    }

    private function getGraduatesByAcademyData() {
        $academiesWithGraduates = Academy::with(['cohorts.students'])->get();
    
        $labels = [];
        $graduatedData = [];
        $notGraduatedData = [];
        
        foreach ($academiesWithGraduates as $academy) {
            $labels[] = $academy->academy_name; 
    
            $totalGraduated = 0;
            $totalNotGraduated = 0;
    
            foreach ($academy->cohorts as $cohort) {
                // Count students with a non-null certificate_type (graduated)
                $graduatedCount = $cohort->students->where('certificate_type', '!=', null)->count();
                // Count students with a null certificate_type (not graduated)
                $notGraduatedCount = $cohort->students->where('certificate_type', '=', null)->count();
                
                $totalGraduated += $graduatedCount;
                $totalNotGraduated += $notGraduatedCount;
            }
    
            $graduatedData[] = $totalGraduated;
            $notGraduatedData[] = $totalNotGraduated;
        }
    
        return [
            'labels' => $labels,
            'datasets' => [
            
                [
                    'label' => 'Not Graduated Students',
                    'data' => $notGraduatedData,
                    'backgroundColor' => ['#e66c37'],
                    'borderColor' => ['#e66c37'],
                    'borderWidth' => 1,
                ]
            ],
        ];
    }
    
    

    private function getAcademyPerformanceChartData() {
        // Fetch academies with their cohorts and students
        $academies = Academy::with(['cohorts' => function($query) {
            $query->has('students');
        }, 'cohorts.students'])->get();
    
        // Labels for each academy
        $labels = $academies->pluck('academy_name')->toArray();
    
        // Colors for different cohorts
        $colors = ['#ad5129', '#e66c37', '#eb895f'];
    
        // Initialize datasets for both total and graduated students
        $datasets = [];
        
        // Iterate through each academy
        foreach ($academies as $academy) {
            foreach ($academy->cohorts as $cohortIndex => $cohort) {
                $totalStudentCount = $cohort->students->count();
                $graduatedStudentCount = $cohort->students->where('certificate_type', '!=', null)->count();
                $colorIndex = $cohortIndex % count($colors);
    
                // Dataset for total students in the cohort
                $datasets[] = [
                    'label' => $cohort->cohort_name . ' - Total Students',
                    'data' => array_fill(0, count($labels), 0), // Initialize all data points to 0
                    'backgroundColor' => $colors[$colorIndex],
                    'borderColor' => $colors[$colorIndex],
                    'borderWidth' => 1
                ];
                $datasets[count($datasets) - 1]['data'][array_search($academy->academy_name, $labels)] = $totalStudentCount;
    
                // Dataset for graduated students in the cohort
                $datasets[] = [
                    'label' => $cohort->cohort_name . ' - Graduated Students',
                    'data' => array_fill(0, count($labels), 0), // Initialize all data points to 0
                    'backgroundColor' => $this->adjustColorBrightness($colors[$colorIndex], -0.3), // Adjust the color for distinction
                    'borderColor' => $this->adjustColorBrightness($colors[$colorIndex], -0.3),
                    'borderWidth' => 1
                ];
                $datasets[count($datasets) - 1]['data'][array_search($academy->academy_name, $labels)] = $graduatedStudentCount;
            }
        }
    
        return [
            'labels' => $labels,
            'datasets' => $datasets,
        ];
    }
    
    // Helper function to adjust color brightness
    private function adjustColorBrightness($hex, $percent) {
        $hex = str_replace('#', '', $hex);
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    
        $r = max(0, min(255, $r + $r * $percent));
        $g = max(0, min(255, $g + $g * $percent));
        $b = max(0, min(255, $b + $b * $percent));
    
        return '#' . str_pad(dechex($r), 2, '0', STR_PAD_LEFT) . str_pad(dechex($g), 2, '0', STR_PAD_LEFT) . str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
    }
    
    
    
    

    private function getTotalSummaryChartData() {
     
            $academiesWithGraduates = Academy::with(['cohorts.students'])->get();
        
            $labels = [];
            $graduatedData = [];
            $notGraduatedData = [];
            
            foreach ($academiesWithGraduates as $academy) {
                $labels[] = $academy->academy_name; 
        
                $totalGraduated = 0;
                $totalNotGraduated = 0;
        
                foreach ($academy->cohorts as $cohort) {
                    // Count students with a non-null certificate_type (graduated)
                    $graduatedCount = $cohort->students->where('certificate_type', '!=', null)->count();
                    // Count students with a null certificate_type (not graduated)
                    $notGraduatedCount = $cohort->students->where('certificate_type', '=', null)->count();
                    
                    $totalGraduated += $graduatedCount;
                    $totalNotGraduated += $notGraduatedCount;
                }
        
                $graduatedData[] = $totalGraduated;
                $notGraduatedData[] = $totalNotGraduated;
            }
        
            return [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Graduated Students',
                        'data' => $graduatedData,
                        'backgroundColor' => ['#e66c37'],
                        'borderColor' => ['#e66c37'],
                        'borderWidth' => 1,
                    ],
                   
                ],
            ];
        }
        
    
    
}
