<?php
namespace App\Imports;

use App\SoftSkillsTraining;
use Exception;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class SoftSkillsTrainingsImport implements ToModel, WithHeadingRow
{
    private  $cohortId;
    private  $errors = [];

    public function __construct($cohortId)
    {
        $this->cohortId = $cohortId;
    }

    /**
     * @throws Exception
     */
    public function model(array $row)
    {

        $excelDate = $row['date'];
        if (is_numeric($excelDate)) {
            $date = Carbon::instance(ExcelDate::excelToDateTimeObject($excelDate));
            $formattedDate = $date->format('Y-m-d');
        } else {
            try {
                $formattedDate = Carbon::createFromFormat('Y-m-d', $row['date'])->format('Y-m-d');
            } catch (Exception $e) {
                $formattedDate = null;
            }
        }

        $row['date'] = $formattedDate;

        $validator = Validator::make($row, [
            'name' => 'required|string',
            'description' => 'required|string',
            'trainer' => 'required|string',
            'date' => 'required|date_format:Y-m-d',
            'satisfaction' => 'required|integer|min:0|max:5',
        ]);

        if ($validator->fails()) {
            $this->errors[] = [
                'row' => $row,
                'errors' => $validator->errors()->all()
            ];
            return null;
        }

        return new SoftSkillsTraining([
            'name' => $row['name'],
            'description' => $row['description'],
            'trainer' => $row['trainer'],
            'date' => $formattedDate,
            'satisfaction' => $row['satisfaction'],
            'cohort_id' => $this->cohortId,
        ]);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
