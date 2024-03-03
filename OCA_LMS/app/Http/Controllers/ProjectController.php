<?php

namespace App\Http\Controllers;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Skill;
use App\Level;
use App\Cohort; // Updated from Classroom to Cohort
use App\ProjectSkill;
use App\SkillLevel;
use App\ProjectSubmission;
use App\ProjectFeedback;
use App\Student; // Import the Student model
use App\Staff; // Import the Staff model

class ProjectController extends Controller
{

        public function showAllProjects()
    {
        // Check if the cohort_id is stored in the session for students and staff
        // session(['cohort_ID' => 1]);
        $cohortId = session('cohort_ID');
        // Retrieve projects based on the cohort_id
        $projects = Project::where('cohort_id', $cohortId)->get();
        // Pass the projects to the view
        return view('project.project', compact('projects'));
    }


    public function showAddProjectForm()
    {
        // Fetch available cohorts
        $cohorts = Cohort::all(); // Updated from Classroom to Cohort
        // Fetch skills and levels for the form
        $skills = Skill::all();
        $levels = Level::all();

        // Ensure the $project variable is available
        $project = null;
        return view('project.add_project', compact('skills', 'levels', 'cohorts', 'project'));

    }


    public function addProject(Request $request)
    {
        // Validate the request
        $request->validate([
            'project_name' => 'required',
            'project_description' => 'required',
            // 'project_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'project_image' => 'required',
            'project_start_date' => 'required|date',
            'project_delivery_date' => 'required|date|after:project_start_date',
            // 'cohort_id' => 'required',
            'project_deliverable' => 'nullable',
            'project_resources' => 'nullable',
            'project_assessment_methods' => 'nullable',
        ]);

        // Save the project details
        $project = new Project;
        $project->project_name = $request->input('project_name');
        $project->project_description = $request->input('project_description');
        // $project->cohort_id = $request->input('cohort_id'); // Update cohort_id directly

        // Get cohort_id from the session and update it directly
        $project->cohort_id = session('cohort_ID');
        $project->staff_id = auth()->user()->id;
        $project->project_start_date = $request->input('project_start_date');
        $project->project_delivery_date = $request->input('project_delivery_date');
        $project->project_deliverable = $request->input('project_deliverable');
        $project->project_resources = $request->input('project_resources');
        $project->project_assessment_methods = $request->input('project_assessment_methods');

        // Handle image upload
        if ($request->hasFile('project_image')) {
            $imageName = time().'.'.$request->project_image->extension();
            $request->project_image->move(public_path('images'), $imageName);
            $project->project_image = $imageName;
        }

        $project->save();
        return redirect()->route('add_project_skills_level', ['project_id' => $project->id]);
    }


    public function showAddProjectSkillsLevelForm($project_id)
    {
       // Retrieve the project based on the provided $project_id
       $project = Project::with('skills', 'cohort')->findOrFail($project_id); // Updated from Classroom to Cohort
       $skills = Skill::all();
       $levels = Level::all();
    // Fetch descriptions from skill_levels table
    $descriptions = SkillLevel::all();
    return view('project.add_project_skills_level', compact('project', 'skills', 'levels', 'descriptions'));
    }

        public function showProjectBrief($id)
    {
        // Fetch the project details and related skills with levels
        $project = Project::with('skills.levels')->findOrFail($id);
        $skills = $project->skills;  // Ensure this line is present
        $levels = Level::all();
        return view('project.project_brief', compact('project', 'skills','levels'));

    }

    public function processProjectSkillsLevelForm(Request $request)
    {
        // Validate the request
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'skills' => 'required|array',
            'levels' => 'required|array',
        ]);

        // Get project ID from the request
        $projectId = $request->input('project_id');

        // Detach existing skills and levels for the project
        ProjectSkill::where('project_id', $projectId)->delete();

        // Attach the selected skills and levels to the project
        $skills = $request->input('skills');
        $levels = $request->input('levels');

        foreach ($skills as $index => $skillId) {
            $levelId = $levels[$index];

            ProjectSkill::create([
                'project_id' => $projectId,
                'skill_id' => $skillId,
                'level_id' => $levelId,
            ]);
        }

        // Redirect to the next page or wherever you want to go
        return redirect()->route('project_brief', ['id' => $projectId]);
    }



    public function editProject($id)
    {
        $project = Project::findOrFail($id);
        $cohorts = Cohort::all(); // Updated from Classroom to Cohort
        $skills = Skill::all();
        $levels = Level::all();
        return view('project.edit_project', compact('project', 'cohorts', 'skills', 'levels'));
    }


    public function updateProject(Request $request, $id)
{
    $request->validate([
        'project_name' => 'required',
        'project_description' => 'required',
        // 'project_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'project_image' => 'required',
        'project_start_date' => 'required|date',
        'project_delivery_date' => 'required|date|after:start_date',
        // 'cohort_id' => 'required|exists:cohorts,id',
        'project_deliverable' => 'nullable',
        'project_resources' => 'nullable',
        'project_assessment_methods' => 'nullable',
    ]);

    $project = Project::findOrFail($id);
    $project->project_name = $request->input('project_name');
    $project->project_description = $request->input('project_description');
    $project->cohort_id = session('cohort_ID');
    $project->project_start_date = $request->input('project_start_date');
    $project->project_delivery_date = $request->input('project_delivery_date');
    $project->project_deliverable = $request->input('project_deliverable');
    $project->project_resources = $request->input('project_resources');
    $project->project_assessment_methods = $request->input('project_assessment_methods');

    if ($request->hasFile('project_image')) {
        $imageName = time().'.'.$request->project_image->extension();
        $request->project_image->move(public_path('images'), $imageName);
        $project->project_image = $imageName;
    }

    $project->save();

    return redirect()->route('project_brief', ['id' => $id]);
}

    public function editProjectSkillsLevel($id)
{
    $project = Project::with('skills.levels')->findOrFail($id);
    $skills = Skill::all();
    $levels = Level::all();

    // Retrieve descriptions from the database
    $descriptions = SkillLevel::all();

    // Fetch previously selected skills and levels for the project
    $selectedSkills = $project->skills->pluck('id')->toArray();
    $selectedLevels = $project->skills->pluck('pivot.level_id')->toArray();

    return view('project.edit_project_skills_level', compact('project', 'skills', 'levels', 'descriptions', 'selectedSkills', 'selectedLevels'));
}


   // New method to handle updating project skills and levels

    public function updateProjectSkillsLevel(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'skills' => 'required|array',
        'levels' => 'required|array',
    ]);

    // Get project ID from the route parameter
    $projectId = $id;

    // Detach existing skills and levels for the project
    ProjectSkill::where('project_id', $projectId)->delete();

    // Attach the selected skills and levels to the project
    $skills = $request->input('skills');
    $levels = $request->input('levels');

    foreach ($skills as $index => $skillId) {
        $levelId = $levels[$index];

        ProjectSkill::create([
            'project_id' => $projectId,
            'skill_id' => $skillId,
            'level_id' => $levelId,
        ]);
    }

    // Redirect to the project brief page
    return redirect()->route('project_brief', ['id' => $projectId]);
}

public function showEditProjectForm($id)
{
    $project = Project::findOrFail($id);
    $cohorts = Cohort::all(); // Updated from Classroom to Cohort

    return view('project.edit_project', compact('project', 'cohorts'));
}

public function showEditProjectSkillsLevelForm($projectId)
{
    // Retrieve the project based on the provided $projectId
    $project = Project::with('skills')->findOrFail($projectId);
    $skills = Skill::all();
    $levels = Level::all();

    // Fetch the selected skills and levels for the project
    $selectedSkills = DB::table('project_skills')->where('project_id', $projectId)->pluck('skill_id')->toArray();
    $selectedLevels = DB::table('project_skills')->where('project_id', $projectId)->pluck('level_id')->toArray();

    return view('project.edit_project_skills_level', compact('project', 'skills', 'levels', 'selectedSkills', 'selectedLevels'));
}

public function showAddProjectSubmissionModal($project_id)
{
    $project = Project::findOrFail($project_id);
    return view('project.add_project_submission_modal', compact('project'));
}


public function processProjectSubmission(Request $request, $project_id)
{
    // Validate the request
    $request->validate([
        'submission_link' => 'required|url',
    ]);

    // Save the project submission
    $submission = new ProjectSubmission;
    // $submission->trainee_id = Auth::user()->id;
    $submission->student_id = Auth::guard('students')->user()->id;
    $submission->project_id = $project_id;
    $submission->submission_link = $request->input('submission_link');
    $submission->save();

    return redirect()->route('project_brief', ['id' => $project_id])->with('success', 'Project submission added successfully');
}


// public function viewProjectSubmissions($project_id)
// {
//     $project = Project::findOrFail($project_id);
//     $cohort = $project->cohort; // Updated from Classroom to Cohort

//     // Fetch all submissions for the project
//     $submissions = ProjectSubmission::where('project_id', $project_id)->get();
//     return view('project.view_project_submissions', compact('project', 'cohort', 'submissions'));
// }
public function viewProjectSubmissions(Request $request, $project_id)
{
    $project = Project::findOrFail($project_id);
    $cohort = $project->cohort;

    // Fetch all submissions for the project
    $submissionsQuery = ProjectSubmission::where('project_id', $project_id);

    // Handle search
    $search = $request->input('search');
    if ($search) {
        $submissionsQuery->whereHas('student', function ($query) use ($search) {
            $query->where('en_first_name', 'LIKE', "%{$search}%");
        });
    }

    $submissions = $submissionsQuery->get();

    return view('project.view_project_submissions', compact('project', 'cohort', 'submissions', 'search'));
}



public function processFeedback(Request $request, $submission_id)
{
    // Validate the request
    $request->validate([
        'feedback' => 'required',
    ]);

    // Save the feedback
    $submission = ProjectSubmission::findOrFail($submission_id);
    $feedback = new ProjectFeedback;
    $feedback->staff_id = Auth::guard('staff')->user()->id;
    $feedback->student_id = $submission->student_id;
    $feedback->project_id = $submission->project_id;
    $feedback->submission_id = $submission->id; // Set submission_id
    $feedback->feedback = $request->input('feedback');
    $feedback->save();

    return redirect()->route('view_project_submissions', ['project_id' => $submission->project_id])->with('success', 'Feedback saved successfully');
}

    public function viewSubmissionsAndFeedback($project_id)
{

    // Fetch project details
    $project = Project::findOrFail($project_id);

    // Fetch the logged-in student or staff
    $user = Auth::guard('students')->check() ? Auth::guard('students')->user() : Auth::guard('staff')->user();

    // Fetch submissions and feedback for the project and the logged-in user
    // $submissionsAndFeedback = $project->submissionsAndFeedback($user->id);

    $submissionIdForConversation = request('submission_id');
    $studentIdForConversation = request('student_id');
    $submissionsAndFeedback = $project->submissionsAndFeedback($project->id, $studentIdForConversation);
    $conversation = $submissionIdForConversation ? ProjectSubmission::where('project_id', $project->id)->where('student_id', $studentIdForConversation)->first()->conversation : null;

    return view('project.view_submissions_feedback', compact('project', 'submissionsAndFeedback', 'user', 'conversation'));
}


}
