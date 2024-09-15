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
        $graduatesByAcademyData = $this->getEnrolledStudentsByAcademyData();
        $academyPerformanceChartData = $this->getAcademyPerformanceChartData();
        $totalSummaryChartData = $this->getTotalSummaryChartData();
    
        return view('supermaneger.dashboard', compact('dashboardCardsData', 'graduatesByAcademyData', 'academyPerformanceChartData', 'totalSummaryChartData'));
    }


    private function getDashboardData() {
        $totalAcademies = Academy::count(); 

        $totalStudentsEnrolled = Student::count();
        $totalStudentsGraduated = Student::where('certificate_type', '!=' , null)->count();
        return [
            'totalStudentsEnrolled' => $totalStudentsEnrolled,
            'totalStudentsGraduated' => $totalStudentsGraduated,
            'totalAcademies' => $totalAcademies,
        ];
    }

    private function getEnrolledStudentsByAcademyData() {
        $academiesWithEnrolledStudents = Academy::with(['cohorts.students'])->get();
        
        $labels = [];
        $enrolledData = [];
        
        foreach ($academiesWithEnrolledStudents as $academy) {
            $labels[] = $academy->academy_name;
        
            $totalEnrolled = 0;
        
            foreach ($academy->cohorts as $cohort) {
                $enrolledCount = $cohort->students->count();
                $totalEnrolled += $enrolledCount;
            }
        
            $enrolledData[] = $totalEnrolled;
        }
        
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Enrolled Students',
                    'data' => $enrolledData,
                    'backgroundColor' => ['#f16e00'],
                    'borderColor' => ['#f16e00'],
                    'borderWidth' => 1,
                ]
            ],
        ];
    }
        
    

    private function getAcademyPerformanceChartData() {
        $academies = Academy::with(['cohorts' => function($query) {
            $query->has('students');
        }, 'cohorts.students'])->get();
    
        $labels = $academies->pluck('academy_name')->toArray();
        $datasets = [];
    
        foreach ($academies as $academy) {
            foreach ($academy->cohorts as $cohort) {
                $totalStudentCount = $cohort->students->count();
                $graduatedStudentCount = $cohort->students->where('certificate_type', '!=', null)->count();
                    $datasets[] = [
                    'label' => $cohort->cohort_name . ' - Total Students',
                    'data' => array_fill(0, count($labels), 0), 
                    'backgroundColor' => '#e66c37',
                    'borderColor' => '#e66c37',
                    'borderWidth' => 1
                ];
                $datasets[count($datasets) - 1]['data'][array_search($academy->academy_name, $labels)] = $totalStudentCount;
        
                $datasets[] = [
                    'label' => $cohort->cohort_name . ' - Graduated Students',
                    'data' => array_fill(0, count($labels), 0), 
                    'backgroundColor' => '#32c832', 
                    'borderColor' => '#32c832',
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
                        'backgroundColor' => ['#32c832'],
                        'borderColor' => ['#32c832'],
                        'borderWidth' => 1,
                    ],
                   
                ],
            ];
        }
        
    
    
}
