<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Academy;
use App\Models\Cohort;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FaceEnrollmentController extends Controller
{
    public function enrollFace(Request $request): JsonResponse
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'face_descriptor' => 'required',
            'face_photo' => 'nullable|string'
        ]);

        $student = Student::find($request->student_id);
        
        $student->update([
            'face_descriptor' => $request->face_descriptor,
            'face_photo' => $request->face_photo,
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Face enrolled successfully'
        ]);
    }

    public function getFaceData($id): JsonResponse
    {
        $student = Student::select('id', 'en_first_name', 'en_last_name', 'face_descriptor', 'face_photo')
            ->find($id);

        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        return response()->json($student);
    }

    public function getStudentsList(Request $request): JsonResponse
    {
        $query = Student::select('id', 'en_first_name', 'en_last_name', 'academy_id', 'cohort_id')
            ->with(['academy:id,academy_name', 'cohort:id,cohort_name']);

        if ($request->filled('cohort_id')) {
            $query->where('cohort_id', $request->cohort_id);
        }

        if ($request->filled('academy_id')) {
            $query->where('academy_id', $request->academy_id);
        }

        $students = $query->orderBy('en_first_name')->get();

        return response()->json($students);
    }

    public function getAcademies(): JsonResponse
    {
        $academies = Academy::select('id', 'academy_name')->orderBy('academy_name')->get();
        return response()->json($academies);
    }

    public function getCohorts(Request $request): JsonResponse
    {
        $query = Cohort::select('id', 'cohort_name', 'academy_id');

        if ($request->filled('academy_id')) {
            $query->where('academy_id', $request->academy_id);
        }

        $cohorts = $query->orderBy('created_at', 'desc')->get();
        return response()->json($cohorts);
    }
}