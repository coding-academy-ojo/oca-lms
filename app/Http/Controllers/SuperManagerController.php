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
        // Fetch academies with cohorts and students
        $academies = Academy::with(['cohorts' => function($query) {
            $query->has('students');
        }, 'cohorts.students'])->get();
    
        $labels = [];
        $datasets = [
            [
                'label' => 'Total Students',
                'data' => [],
                'backgroundColor' => '#e66c37',
                'borderColor' => '#e66c37',
                'borderWidth' => 1,
            ],
            [
                'label' => 'Graduated Students',
                'data' => [],
                'backgroundColor' => '#32c832',
                'borderColor' => '#32c832',
                'borderWidth' => 1,
            ]
        ];
    
        $index = 0; // Index for label positioning
    
        // Prepare labels and datasets
        foreach ($academies as $academy) {
            foreach ($academy->cohorts as $cohort) {
                $cohortLabel =  $cohort->cohort_name;
                $labels[] = $cohortLabel;
    
                $totalStudentCount = $cohort->students->count();
                $graduatedStudentCount = $cohort->students->where('certificate_type', '!=', null)->count();
    
                // Initialize dataset arrays if they are not yet populated
                if (!isset($datasets[0]['data'][$index])) {
                    $datasets[0]['data'][$index] = 0; // Initialize total students data
                }
                if (!isset($datasets[1]['data'][$index])) {
                    $datasets[1]['data'][$index] = 0; // Initialize graduated students data
                }
    
                // Set dataset values
                $datasets[0]['data'][$index] = $totalStudentCount; // Total students
                $datasets[1]['data'][$index] = $graduatedStudentCount; // Graduated students
    
                $index++;
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
