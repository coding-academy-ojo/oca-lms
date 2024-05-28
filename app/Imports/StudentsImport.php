<?php
namespace App\Imports;

use App\Student;
use App\Cohort;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Exception;

class StudentsImport implements ToModel, WithHeadingRow
{
    private $cohortId;
    private $academyId;
    private $errors = [];

    public function __construct($cohortId)
    {
        $this->cohortId = $cohortId;
        $this->academyId = Cohort::find($cohortId)->academy_id;
    }

    public function model(array $row): ?Student
    {
        $excelDate = $row['birthdate'];
        if (is_numeric($excelDate)) {
            $date = Carbon::instance(ExcelDate::excelToDateTimeObject($excelDate));
            $formattedDate = $date->format('Y-m-d');
        } else {
            try {
                $formattedDate = Carbon::createFromFormat('Y-m-d', $row['birthdate'])->format('Y-m-d');
            } catch (Exception $e) {
                $formattedDate = null;
            }
        }

        $row['birthdate'] = $formattedDate;

        $validator = Validator::make($row, [
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:8',
            'is_newsletter' => 'nullable|string',
            'provider_id' => 'nullable|string',
            'email_verification' => 'nullable|string',
            'is_email_verified' => 'nullable|boolean',
            'mobile' => 'nullable|numeric',
            'mobile_verification' => 'nullable|string',
            'is_mobile_verified' => 'nullable|boolean',
            'nationality' => 'nullable|integer',
            'country' => 'nullable|string',
            'passport_number' => 'nullable|string',
            'national_id' => 'nullable|integer',
            'birthdate' => 'nullable|date_format:Y-m-d',
            'en_first_name' => 'nullable|string',
            'en_second_name' => 'nullable|string',
            'en_third_name' => 'nullable|string',
            'en_last_name' => 'nullable|string',
            'ar_first_name' => 'nullable|string',
            'ar_second_name' => 'nullable|string',
            'ar_third_name' => 'nullable|string',
            'ar_last_name' => 'nullable|string',
            'gender' => 'nullable|string|in:male,female,other',
            'martial_status' => 'nullable|string',
            'remember_token' => 'nullable|string',
            'education' => 'nullable|string',
            'educational_status' => 'nullable|string',
            'field' => 'nullable|string',
            'educational_background' => 'nullable|string',
            'ar_writing' => 'nullable|string',
            'ar_speaking' => 'nullable|string',
            'en_writing' => 'nullable|string',
            'en_speaking' => 'nullable|string',
            'city' => 'nullable|string',
            'address' => 'nullable|string',
            'relative_mobile_1' => 'nullable|numeric',
            'relative_relation_1' => 'nullable|string',
            'fullName_1' => 'nullable|string',
            'relative_mobile_2' => 'nullable|numeric',
            'relative_relation_2' => 'nullable|string',
            'fullName_2' => 'nullable|string',
            'is_committed' => 'nullable|string',
            'is_submitted' => 'nullable|boolean',
            'status' => 'nullable|string',
            'result_1' => 'nullable|string',
            'academy_location' => 'nullable|string',
            'id_img' => 'nullable|string',
            'personal_img' => 'nullable|string',
            'vaccination_img' => 'nullable|string',
            'eligible_to_move' => 'nullable|string',
            'github_link' => 'nullable|string|url',
            'linkedin_link' => 'nullable|string|url',
        ]);

        if ($validator->fails()) {
            $this->errors[] = [
                'row' => $row,
                'errors' => $validator->errors()->all()
            ];
            return null;
        }

        return new Student([
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'is_newsletter' => $row['is_newsletter'] ?? null,
            'provider_id' => $row['provider_id'] ?? null,
            'email_verification' => $row['email_verification'] ?? null,
            'is_email_verified' => $row['is_email_verified'] ?? 0,
            'mobile' => $row['mobile'] ?? null,
            'mobile_verification' => $row['mobile_verification'] ?? null,
            'is_mobile_verified' => $row['is_mobile_verified'] ?? 0,
            'nationality' => $this->mapNationality($row['nationality'] ?? null),
            'country' => $row['country'] ?? null,
            'passport_number' => $row['passport_number'] ?? null,
            'national_id' => $row['national_id'] ?? null,
            'birthdate' => $formattedDate,
            'en_first_name' => $row['en_first_name'] ?? null,
            'en_second_name' => $row['en_second_name'] ?? null,
            'en_third_name' => $row['en_third_name'] ?? null,
            'en_last_name' => $row['en_last_name'] ?? null,
            'ar_first_name' => $row['ar_first_name'] ?? null,
            'ar_second_name' => $row['ar_second_name'] ?? null,
            'ar_third_name' => $row['ar_third_name'] ?? null,
            'ar_last_name' => $row['ar_last_name'] ?? null,
            'gender' => $row['gender'] ?? null,
            'martial_status' => $row['martial_status'] ?? null,
            'remember_token' => $row['remember_token'] ?? null,
            'education' => $row['education'] ?? null,
            'educational_status' => $row['educational_status'] ?? null,
            'field' => $row['field'] ?? null,
            'educational_background' => $row['educational_background'] ?? null,
            'ar_writing' => $row['ar_writing'] ?? null,
            'ar_speaking' => $row['ar_speaking'] ?? null,
            'en_writing' => $row['en_writing'] ?? null,
            'en_speaking' => $row['en_speaking'] ?? null,
            'city' => $row['city'] ?? null,
            'address' => $row['address'] ?? null,
            'relative_mobile_1' => $row['relative_mobile_1'] ?? null,
            'relative_relation_1' => $row['relative_relation_1'] ?? null,
            'fullName_1' => $row['fullName_1'] ?? null,
            'relative_mobile_2' => $row['relative_mobile_2'] ?? null,
            'relative_relation_2' => $row['relative_relation_2'] ?? null,
            'fullName_2' => $row['fullName_2'] ?? null,
            'is_committed' => $row['is_committed'] ?? null,
            'is_submitted' => $row['is_submitted'] ?? 0,
            'status' => $row['status'] ?? null,
            'result_1' => $row['result_1'] ?? null,
            'academy_location' => $row['academy_location'] ?? null,
            'id_img' => $row['id_img'] ?? null,
            'personal_img' => $row['personal_img'] ?? null,
            'vaccination_img' => $row['vaccination_img'] ?? null,
            'eligible_to_move' => $row['eligible_to_move'] ?? null,
            'github_link' => $row['github_link'] ?? null,
            'linkedin_link' => $row['linkedin_link'] ?? null,
            'academy_id' => $this->academyId,
            'cohort_id' => $this->cohortId,
        ]);
    }

    private function mapNationality($value)
    {
        $nationalities = [
            'jordan' => 1,
            'other_country' => 2,
        ];

        return $nationalities[strtolower($value)] ?? null;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
