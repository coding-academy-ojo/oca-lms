<?php
namespace App\Http\Controllers;

use App\Cohort;
use App\Technology;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class technologySatisfactionController extends Controller
{
    public function index($encryptedCohortId)
    {
        // Decrypt the cohort ID
        try {
            $cohortId = Crypt::decryptString($encryptedCohortId);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404, 'Invalid cohort ID');
        }

        // Retrieve the cohort instance from the database
        $cohort = Cohort::with('technology')->find($cohortId);
// dd($cohort);
        if (!$cohort) {
            abort(404, 'Cohort not found');
        }

        $technologiesOverview = $this->technologiesOverview($cohort);

        return view('technology_sutisfaction.index', compact(
            'cohort',
            'technologiesOverview',

        ));
    }

    private function technologiesOverview($cohort)
    {
        $staff = Auth::guard('staff')->user();
    
        if (!$cohort || !$cohort->technology) {
            return [];
        }
    
        $technologiesData = [];
        $currentDate = Carbon::now();
    
        foreach ($cohort->technology as $technology) {
            $startDate = Carbon::parse($technology->pivot->start_date);
            $endDate = Carbon::parse($technology->pivot->end_date);
    
            $trainingPeriodInWeeks = $startDate->diffInWeeks($endDate);
            $trainingPeriod = $trainingPeriodInWeeks . " Weeks";
    
            if ($currentDate->between($startDate, $endDate)) {
                $percentage = ($currentDate->diffInDays($startDate) / $startDate->diffInDays($endDate)) * 100;
                $status = 'In Progress';
            } elseif ($currentDate->gt($endDate)) {
                $percentage = 100;
                $status = 'Finished';
            } else {
                $percentage = 0;
                $status = 'Not Started';
            }
    
            $start_date = $startDate->format('d-F-Y');
    
            // Access satisfaction_rate directly through the technologyCohorts relationship
            $satisfactionRate = $technology->technologyCohorts()
                ->where('cohort_id', $cohort->id)
                ->value('satisfaction_rate');
    
            $technologiesData[] = [
                'id' => $technology->id,
                'start_date' => $start_date,
                'name' => $technology->technologies_name,
                'description' => $technology->technologies_description,
                'resources' => $technology->technologies_resources,
                'training_period' => $trainingPeriod,
                'status' => $status,
                'percentage' => $percentage,
                'satisfaction_rate' => $satisfactionRate ?? 'N/A', // Ensure correct retrieval
            ];
        }
        
        return $technologiesData;
    }
    
    

    public function updateSatisfaction(Request $request)
    {
        // dd($request);
        $request->validate([
            'technology_id' => 'required|exists:technology__cohorts,technology_id',
            'cohort_id' => 'required|exists:cohorts,id',
            'satisfaction' => 'required|integer|min:0|max:100',
        ]);
    
        // Fetch and update the satisfaction rate for the specific technology and cohort
        $techCohort = DB::table('technology__cohorts')
            ->where('technology_id', $request->technology_id)
            ->where('cohort_id', $request->cohort_id)
            ->first();
    
        if ($techCohort) {
            DB::table('technology__cohorts')
                ->where('technology_id', $request->technology_id)
                ->where('cohort_id', $request->cohort_id)
                ->update(['satisfaction_rate' => $request->satisfaction]);
        }
    
        return redirect()->back()->with('success', 'Satisfaction rate updated successfully.');
    }
    
    

}
