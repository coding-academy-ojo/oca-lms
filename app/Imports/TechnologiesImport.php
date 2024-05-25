<?php
namespace App\Imports;

use App\Technology;
use App\Technology_Cohort;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class TechnologiesImport implements ToModel, WithHeadingRow
{
    private $cohortId;
    private $errors = [];

    public function __construct($cohortId)
    {
        $this->cohortId = $cohortId;
    }

    public function model(array $row)
    {
        // dd($row);
        // dd($row['technologies_trainingPeriod']);
        // Handle start_date format
        $excelStartDate = $row['start_date'];
        if (is_numeric($excelStartDate)) {
            $startDate = Carbon::instance(ExcelDate::excelToDateTimeObject($excelStartDate));
            $formattedStartDate = $startDate->format('Y-m-d');
        } else {
            try {
                $formattedStartDate = Carbon::createFromFormat('Y-m-d', $row['start_date'])->format('Y-m-d');
            } catch (\Exception $e) {
                $formattedStartDate = null;
            }
        }

        // Handle end_date format
        $excelEndDate = $row['end_date'];
        if (is_numeric($excelEndDate)) {
            $endDate = Carbon::instance(ExcelDate::excelToDateTimeObject($excelEndDate));
            $formattedEndDate = $endDate->format('Y-m-d');
        } else {
            try {
                $formattedEndDate = Carbon::createFromFormat('Y-m-d', $row['end_date'])->format('Y-m-d');
            } catch (\Exception $e) {
                $formattedEndDate = null;
            }
        }

        // Update the row data with formatted dates
        $row['start_date'] = $formattedStartDate;
        $row['end_date'] = $formattedEndDate;

        $validator = Validator::make($row, [
            'technology_category_id' => 'required|integer',
            'technologies_name' => 'required|string',
            'technologies_description' => 'required|string',
            'technologies_resources' => 'required|string',
            'technologies_trainingperiod' => 'required|string',
            'technologies_photo' => 'nullable|string',
            'start_date' => 'nullable|date_format:Y-m-d',
            'end_date' => 'nullable|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            $this->errors[] = [
                'row' => $row,
                'errors' => $validator->errors()->all()
            ];
            return null;
        }

        $technology = Technology::create([
            'technology_category_id' => $row['technology_category_id'],
            'technologies_name' => $row['technologies_name'],
            'technologies_description' => $row['technologies_description'],
            'technologies_resources' => $row['technologies_resources'],
            'technologies_trainingPeriod' => $row['technologies_trainingperiod'],
            'technologies_photo' => $row['technologies_photo'] ?? null,
        ]);

        Technology_Cohort::create([
            'technology_id' => $technology->id,
            'cohort_id' => $this->cohortId,
            'start_date' => $formattedStartDate ?? now(),
            'end_date' => $formattedEndDate,
        ]);

        return $technology;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
