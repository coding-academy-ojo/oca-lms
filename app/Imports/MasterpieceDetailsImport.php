<?php

namespace App\Imports;

use App\Student;
use App\MasterpieceDetail;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterpieceDetailsImport implements ToModel, WithHeadingRow
{
    private $cohortId;
    private $staffId; // not stored in details, but kept for parity & possible auditing
    private $errors = [];
    private $rowNum = 1;

    public function __construct($cohortId, $staffId)
    {
        $this->cohortId = $cohortId;
        $this->staffId  = $staffId;
    }

    public function model(array $row)
    {
        $this->rowNum++;

        // Normalize keys
        $norm = [
            'student_id'            => $row['student_id']           ?? null,
            'student_name'          => $row['student_name']         ?? null,
            'sector'                => $row['sector']               ?? null,
            'description'           => $row['description']          ?? null,
            'project_name'          => $row['project_name']         ?? null,
            'wireframe_mockup_link' => $row['wireframe_mockup_link']?? null,
            'presentation_link'     => $row['presentation_link']    ?? null,
            'documentation_link'    => $row['documentation_link']   ?? null,
            'github_link'           => $row['github_link']          ?? null,
        ];

        // Validation (like your style)
        $validator = Validator::make($norm, [
            'student_id'            => 'required|integer|exists:students,id',
            'student_name'          => 'nullable|string',
            'sector'                => 'required|string',
            'description'           => 'nullable|string',
            'project_name'          => 'required|string',
            'wireframe_mockup_link' => 'nullable|string',
            'presentation_link'     => 'nullable|string',
            'documentation_link'    => 'nullable|string',
            'github_link'           => 'nullable|string',
        ]);

        if ($validator->fails()) {
            $this->errors[] = ['row' => $this->rowNum, 'errors' => $validator->errors()->all()];
            return null;
        }

        // Enforce cohort: ignore other cohorts
        $student = Student::where('id', $norm['student_id'])->where('cohort_id', $this->cohortId)->first();
        if (!$student) {
            $this->errors[] = ['row' => $this->rowNum, 'errors' => ["Student #{$norm['student_id']} not in current cohort {$this->cohortId}. Skipped."]];
            return null;
        }

        // Upsert by student_id
        $detail = MasterpieceDetail::firstOrNew(['student_id' => $student->id]);
        $detail->project_sector        = $norm['sector'];
        $detail->project_name          = $norm['project_name'];
        $detail->project_description   = $norm['description'];
        $detail->wireframe_mockup_link = $norm['wireframe_mockup_link'];
        $detail->presentation_link     = $norm['presentation_link'];
        $detail->documentation_link    = $norm['documentation_link'];
        $detail->github_link           = $norm['github_link'];
        $detail->save();

        return $detail;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
