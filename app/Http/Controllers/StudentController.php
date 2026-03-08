<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Academy;
use App\Models\Cohort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index($cohort_id)
    {
        $user = Auth::guard('staff')->user();
        
        // Only coordinators can access
        if ($user->role !== 'coordinator') {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // Verify the cohort exists and coordinator has access
        $cohort = Cohort::findOrFail($cohort_id);
        $academyIds = $user->academies->pluck('id')->toArray();
        
        if (!in_array($cohort->academy_id, $academyIds)) {
            return redirect()->back()->with('error', 'Unauthorized access to this cohort.');
        }

        $students = Student::with(['academy', 'cohort'])
            ->where('cohort_id', $cohort_id)
            ->paginate(15);

        return view('coordinator.students.index', compact('students', 'cohort', 'cohort_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create($cohort_id)
    {
        $user = Auth::guard('staff')->user();
        
        // Only coordinators can access
        if ($user->role !== 'coordinator') {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // Verify the cohort exists and coordinator has access
        $cohort = Cohort::findOrFail($cohort_id);
        $academyIds = $user->academies->pluck('id')->toArray();
        
        if (!in_array($cohort->academy_id, $academyIds)) {
            return redirect()->back()->with('error', 'Unauthorized access to this cohort.');
        }

        $academies = Academy::where('id', $cohort->academy_id)->get();
        $cohorts = Cohort::where('academy_id', $cohort->academy_id)->get();

        return view('coordinator.students.create', compact('cohorts', 'academies', 'cohort', 'cohort_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $cohort_id)
    {
        $user = Auth::guard('staff')->user();
        
        // Only coordinators can access
        if ($user->role !== 'coordinator') {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // Verify the cohort exists and coordinator has access
        $cohort = Cohort::findOrFail($cohort_id);
        $academyIds = $user->academies->pluck('id')->toArray();
        
        if (!in_array($cohort->academy_id, $academyIds)) {
            return redirect()->back()->with('error', 'Unauthorized access to this cohort.');
        }

        $validatedData = $request->validate([
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:6',
            'en_first_name' => 'nullable|string|max:255',
            'en_second_name' => 'nullable|string|max:255',
            'en_third_name' => 'nullable|string|max:255',
            'en_last_name' => 'nullable|string|max:255',
            'ar_first_name' => 'nullable|string|max:255',
            'ar_second_name' => 'nullable|string|max:255',
            'ar_third_name' => 'nullable|string|max:255',
            'ar_last_name' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:20',
            'birthdate' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female',
            'martial_status' => 'nullable|string',
            'nationality' => 'nullable|integer',
            'country' => 'nullable|string|max:255',
            'passport_number' => 'nullable|string|max:255',
            'national_id' => 'nullable|integer',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'education' => 'nullable|string|max:255',
            'educational_status' => 'nullable|string|max:255',
            'field' => 'nullable|string|max:255',
            'educational_background' => 'nullable|string',
            'ar_writing' => 'nullable|string|max:255',
            'ar_speaking' => 'nullable|string|max:255',
            'en_writing' => 'nullable|string|max:255',
            'en_speaking' => 'nullable|string|max:255',
            'relative_mobile_1' => 'nullable|integer',
            'relative_relation_1' => 'nullable|string|max:255',
            'fullName_1' => 'nullable|string|max:255',
            'relative_mobile_2' => 'nullable|integer',
            'relative_relation_2' => 'nullable|string|max:255',
            'fullName_2' => 'nullable|string|max:255',
            'academy_id' => 'required|exists:academies,id',
            'cohort_id' => 'required|exists:cohorts,id',
            'status' => 'nullable|string|max:255',
            'github_link' => 'nullable|url|max:255',
            'linkedin_link' => 'nullable|url|max:255',
            'id_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'personal_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vaccination_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Handle file uploads
        if ($request->hasFile('id_img')) {
            $validatedData['id_img'] = $request->file('id_img')->store('students/id_images', 'public');
        }
        if ($request->hasFile('personal_img')) {
            $validatedData['personal_img'] = $request->file('personal_img')->store('students/personal_images', 'public');
        }
        if ($request->hasFile('vaccination_img')) {
            $validatedData['vaccination_img'] = $request->file('vaccination_img')->store('students/vaccination_images', 'public');
        }

        // Set default values
        $validatedData['is_email_verified'] = $request->get('is_email_verified', 0);
        $validatedData['is_mobile_verified'] = $request->get('is_mobile_verified', 0);
        $validatedData['is_submitted'] = $request->get('is_submitted', 0);
        $validatedData['internship_status'] = $request->get('internship_status', 0);
        $validatedData['cohort_id'] = $cohort_id;

        Student::create($validatedData);

        return redirect()->route('coordinator.students.index', ['cohort_id' => $cohort_id])
            ->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $user = Auth::guard('staff')->user();
        
        // Only coordinators can access
        if ($user->role !== 'coordinator') {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $student = Student::with(['academy', 'cohort'])->findOrFail($id);

        return view('coordinator.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $user = Auth::guard('staff')->user();
        
        // Only coordinators can access
        if ($user->role !== 'coordinator') {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $student = Student::findOrFail($id);
        $academyIds = $user->academies->pluck('id')->toArray();
        $academies = Academy::whereIn('id', $academyIds)->get();
        $cohorts = Cohort::whereIn('academy_id', $academyIds)
            ->whereHas('staff', function ($q) use ($user) {
                $q->where('staff_id', $user->id);
            })
            ->get();

        return view('coordinator.students.edit', compact('student', 'academies', 'cohorts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = Auth::guard('staff')->user();
        
        // Only coordinators can access
        if ($user->role !== 'coordinator') {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $student = Student::findOrFail($id);

        $validatedData = $request->validate([
            'email' => 'required|email|unique:students,email,' . $id,
            'password' => 'nullable|string|min:6',
            'en_first_name' => 'nullable|string|max:255',
            'en_second_name' => 'nullable|string|max:255',
            'en_third_name' => 'nullable|string|max:255',
            'en_last_name' => 'nullable|string|max:255',
            'ar_first_name' => 'nullable|string|max:255',
            'ar_second_name' => 'nullable|string|max:255',
            'ar_third_name' => 'nullable|string|max:255',
            'ar_last_name' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:20',
            'birthdate' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female',
            'martial_status' => 'nullable|string',
            'nationality' => 'nullable|integer',
            'country' => 'nullable|string|max:255',
            'passport_number' => 'nullable|string|max:255',
            'national_id' => 'nullable|integer',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'education' => 'nullable|string|max:255',
            'educational_status' => 'nullable|string|max:255',
            'field' => 'nullable|string|max:255',
            'educational_background' => 'nullable|string',
            'ar_writing' => 'nullable|string|max:255',
            'ar_speaking' => 'nullable|string|max:255',
            'en_writing' => 'nullable|string|max:255',
            'en_speaking' => 'nullable|string|max:255',
            'relative_mobile_1' => 'nullable|integer',
            'relative_relation_1' => 'nullable|string|max:255',
            'fullName_1' => 'nullable|string|max:255',
            'relative_mobile_2' => 'nullable|integer',
            'relative_relation_2' => 'nullable|string|max:255',
            'fullName_2' => 'nullable|string|max:255',
            'github_link' => 'nullable|url|max:255',
            'linkedin_link' => 'nullable|url|max:255',
            'id_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'personal_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vaccination_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Hash password only if provided
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        // Handle file uploads
        if ($request->hasFile('id_img')) {
            // Delete old image if exists
            if ($student->id_img) {
                Storage::disk('public')->delete($student->id_img);
            }
            $validatedData['id_img'] = $request->file('id_img')->store('students/id_images', 'public');
        }
        if ($request->hasFile('personal_img')) {
            if ($student->personal_img) {
                Storage::disk('public')->delete($student->personal_img);
            }
            $validatedData['personal_img'] = $request->file('personal_img')->store('students/personal_images', 'public');
        }
        if ($request->hasFile('vaccination_img')) {
            if ($student->vaccination_img) {
                Storage::disk('public')->delete($student->vaccination_img);
            }
            $validatedData['vaccination_img'] = $request->file('vaccination_img')->store('students/vaccination_images', 'public');
        }

        $student->update($validatedData);

        return redirect()->route('coordinator.students.index', ['cohort_id' => $student->cohort_id])
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = Auth::guard('staff')->user();
        
        // Only coordinators can access
        if ($user->role !== 'coordinator') {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $student = Student::findOrFail($id);
        $cohortId = $student->cohort_id;

        // Delete associated images
        if ($student->id_img) {
            Storage::disk('public')->delete($student->id_img);
        }
        if ($student->personal_img) {
            Storage::disk('public')->delete($student->personal_img);
        }
        if ($student->vaccination_img) {
            Storage::disk('public')->delete($student->vaccination_img);
        }

        $cohortId = $student->cohort_id;
        $student->delete();

        return redirect()->route('coordinator.students.index', ['cohort_id' => $cohortId])
            ->with('success', 'Student deleted successfully.');
    }
}



