<?php

namespace App\Imports;

use App\Student;
use App\MasterpieceProgress;
use App\MasterpieceTask;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterpieceProgressImport implements ToModel, WithHeadingRow
{
    private $cohortId;
    private $staffId;
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

        $norm = [
            'student_id'          => $row['student_id'] ?? null,
            'student_name'        => $row['student_name'] ?? null,
            'masterpiece_task_id' => $row['masterpiece_task_id'] ?? null,
            'progress'            => isset($row['progress']) && $row['progress'] !== '' ? (int)$row['progress'] : 100,
            'notes'               => $row['notes'] ?? null,
        ];

        $validator = Validator::make($norm, [
            'student_id'          => 'required|integer|exists:students,id',
            'student_name'        => 'nullable|string',
            'masterpiece_task_id' => 'required|integer|exists:masterpiece_tasks,id',
            'progress'            => 'nullable|integer|min:0|max:100',
            'notes'               => 'nullable|string',
        ]);

        if ($validator->fails()) {
            $this->errors[] = ['row' => $this->rowNum, 'errors' => $validator->errors()->all()];
            return null;
        }

        // Cohort lock
        $student = Student::where('id', $norm['student_id'])->where('cohort_id', $this->cohortId)->first();
        if (!$student) {
            $this->errors[] = ['row' => $this->rowNum, 'errors' => ["Student #{$norm['student_id']} not in current cohort {$this->cohortId}. Skipped."]];
            return null;
        }

        // Ensure task exists (exists rule already checks, this is extra fetch)
        $task = MasterpieceTask::find($norm['masterpiece_task_id']);
        if (!$task) {
            $this->errors[] = ['row' => $this->rowNum, 'errors' => ["Task #{$norm['masterpiece_task_id']} not found."]];
            return null;
        }

        // Upsert by (student_id, masterpiece_task_id)
        $progress = MasterpieceProgress::firstOrNew([
            'student_id'          => $student->id,
            'masterpiece_task_id' => $task->id,
        ]);

        $progress->progress  = $norm['progress'] ?? 0;
        $progress->notes     = $norm['notes'];
        $progress->staff_id  = $this->staffId;


        $progress->save();

        return $progress;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
