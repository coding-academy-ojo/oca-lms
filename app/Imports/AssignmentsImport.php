<?php

namespace App\Imports;

use App\Assignment;
use App\Topic;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class AssignmentsImport implements ToModel, WithHeadingRow
{
    private $cohortId;
    private $staffId;
    private $errors = [];
    private $currentRow = 0;

    public function __construct($cohortId)
    {
        $this->cohortId = $cohortId;
        $this->staffId = Auth::guard('staff')->id();
    }

    public function model(array $row)
    {
        $this->currentRow++;
        
        $excelDate = $row['assignment_due_date'];
        if (is_numeric($excelDate)) {
            $date = Carbon::instance(ExcelDate::excelToDateTimeObject($excelDate));
            $formattedDate = $date->format('Y-m-d');
        } else {
            try {
                $formattedDate = Carbon::createFromFormat('Y-m-d', $row['assignment_due_date'])->format('Y-m-d');
            } catch (\Exception $e) {
                $formattedDate = null;
            }
        }

        $row['assignment_due_date'] = $formattedDate;

        $validator = Validator::make($row, [
            'assignment_name' => 'required|string',
            'assignment_description' => 'nullable|string',
            'assignment_attached_file' => 'nullable|string',
            'assignment_level' => ['required', Rule::in(['easy', 'medium', 'advance'])],
            'assignment_due_date' => 'required|date_format:Y-m-d',
            'topic_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if (!Topic::where('id', $value)->exists()) {
                        $fail("The topic with ID $value does not exist.");
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            $this->errors[] = [
                'row' => $this->currentRow,
                'errors' => $validator->errors()->all()
            ];
            return null;
        }

        return new Assignment([
            'assignment_name' => $row['assignment_name'],
            'assignment_description' => $row['assignment_description'] ?? null,
            'assignment_attached_file' => $row['assignment_attached_file'] ?? null,
            'assignment_level' => $row['assignment_level'],
            'assignment_due_date' => $row['assignment_due_date'],
            'cohort_id' => $this->cohortId,
            'staff_id' => $this->staffId,
            'topic_id' => $row['topic_id'],
        ]);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
