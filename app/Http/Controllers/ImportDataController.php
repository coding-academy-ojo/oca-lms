<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cohort;
use App\TechnologyCategory;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use App\Imports\SoftSkillsTrainingsImport;
use App\Imports\TechnologiesImport;
use App\Topic;
use App\Imports\AssignmentsImport;

class ImportDataController extends Controller
{
    public function index($cohortId)
    {
        $tech_category = TechnologyCategory::all();
        $cohort = Cohort::findOrFail($cohortId);
        $topics = Topic::all();
        return view('import-data.import-data', compact('cohort','tech_category','topics'));
    }

    public function import(Request $request, $cohortId)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        $import = new StudentsImport($cohortId);
        Excel::import($import, $request->file('file'));
      

        $errors = $import->getErrors();

        if (empty($errors)) {
            return redirect()->back()->with('success', 'Students imported successfully.');
        } else {
            $errorMessages = [];
            foreach ($errors as $index => $error) {
                $errorMessages[] = 'Row ' . ($index + 1) . ' - ' . implode(', ', $error['errors']);
            }
            dd($errorMessages);
            return redirect()->back()->with('warning', 'Some rows were not imported: ' . implode('; ', $errorMessages));
        }
    }

    public function importSoftSkillsTrainings(Request $request, $cohortId)
{
    $request->validate([
        'file' => 'required|mimes:xlsx'
    ]);

    $import = new SoftSkillsTrainingsImport($cohortId);
    Excel::import($import, $request->file('file'));

    $errors = $import->getErrors();

    if (empty($errors)) {
        return redirect()->back()->with('success', 'Soft skills trainings imported successfully.');
    } else {
        $errorMessages = [];
        foreach ($errors as $index => $error) {
            $errorMessages[] = 'Row ' . ($index + 1) . ' - ' . implode(', ', $error['errors']);
        }
        return redirect()->back()->with('warning', 'Some rows were not imported: ' . implode('; ', $errorMessages));
    }
}


public function importTechnologies(Request $request, $cohortId)
    {
        $request->validate(['file' => 'required|mimes:xlsx']);
        $import = new TechnologiesImport($cohortId);
        Excel::import($import, $request->file('file'));
        $errors = $import->getErrors();

        if (empty($errors)) {
            return redirect()->back()->with('success', 'Technologies imported successfully.');
        } else {
            $errorMessages = [];
            foreach ($errors as $index => $error) {
                $errorMessages[] = 'Row ' . ($index + 1) . ' - ' . implode(', ', $error['errors']);
            }
            return redirect()->back()->with('warning', 'Some rows were not imported: ' . implode('; ', $errorMessages));
        }
    }


    public function importAssignments(Request $request, $cohortId)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);
    
        $import = new AssignmentsImport($cohortId);
        Excel::import($import, $request->file('file'));
    
        $errors = $import->getErrors();
    
        if (empty($errors)) {
            return redirect()->back()->with('success', 'Assignments imported successfully.');
        } else {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = 'Row ' . $error['row'] . ' - ' . implode(', ', $error['errors']);
            }
            return redirect()->back()->with('warning', 'Some rows were not imported: ' . implode('; ', $errorMessages));
        }
    }
    
}
