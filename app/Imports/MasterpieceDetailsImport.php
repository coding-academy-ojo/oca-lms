<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\MasterpieceDetail;
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
            'student_id'                       => $row['student_id']                       ?? null,
            'student_name'                     => $row['student_name']                     ?? null,
            'project_sector'                   => $row['project_sector']                   ?? ($row['sector'] ?? null),
            'masterpiece_brief'                => $row['masterpiece_brief']                ?? ($row['description'] ?? null),
            'masterpiece_project_name'         => $row['masterpiece_project_name']         ?? ($row['project_name'] ?? null),
            'masterpiece_wireframe_mockup_link'=> $row['masterpiece_wireframe_mockup_link']?? ($row['wireframe_mockup_link'] ?? null),
            'masterpiece_presentation_link'    => $row['masterpiece_presentation_link']    ?? ($row['presentation_link'] ?? null),
            'masterpiece_documentation_link'   => $row['masterpiece_documentation_link']   ?? ($row['documentation_link'] ?? null),
            'masterpiece_idea_link'            => $row['masterpiece_idea_link']            ?? ($row['idea_link'] ?? null),
            'masterpiece_frontend_link'        => $row['masterpiece_frontend_link']        ?? ($row['frontend_link'] ?? null),
            'masterpiece_full_version_link'    => $row['masterpiece_full_version_link']    ?? ($row['full_version_link'] ?? null),
            'github_link'                      => $row['github_link']                      ?? null,
        ];

        // Validation (like your style)
        $validator = Validator::make($norm, [
            'student_id'                        => 'required|integer|exists:students,id',
            'student_name'                      => 'nullable|string',
            'project_sector'                    => 'required|string',
            'masterpiece_brief'                 => 'nullable|string',
            'masterpiece_project_name'          => 'required|string',
            'masterpiece_wireframe_mockup_link' => 'nullable|string',
            'masterpiece_presentation_link'     => 'nullable|string',
            'masterpiece_documentation_link'    => 'nullable|string',
            'masterpiece_idea_link'             => 'nullable|string',
            'masterpiece_frontend_link'         => 'nullable|string',
            'masterpiece_full_version_link'     => 'nullable|string',
            'github_link'                       => 'nullable|string',
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
        $detail->project_sector                    = $norm['project_sector'];
        $detail->masterpiece_project_name          = $norm['masterpiece_project_name'];
        $detail->masterpiece_brief                 = $norm['masterpiece_brief'];
        $detail->masterpiece_wireframe_mockup_link = $norm['masterpiece_wireframe_mockup_link'];
        $detail->masterpiece_presentation_link     = $norm['masterpiece_presentation_link'];
        $detail->masterpiece_documentation_link    = $norm['masterpiece_documentation_link'];
        $detail->masterpiece_idea_link             = $norm['masterpiece_idea_link'];
        $detail->masterpiece_frontend_link         = $norm['masterpiece_frontend_link'];
        $detail->masterpiece_full_version_link     = $norm['masterpiece_full_version_link'];
        $detail->github_link                       = $norm['github_link'];
        $detail->save();

        return $detail;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}

