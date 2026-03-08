<?php

namespace App\Http\Controllers;

use App\Models\MasterpieceDetail;
use App\Models\MasterpieceTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MasterpieceDeliverableController extends Controller
{
    public function index()
    {
        $student = Auth::guard('students')->user();
        $deliverables = MasterpieceDetail::with('task')
            ->where('student_id', $student->id)
            ->whereNotNull('masterpiece_task_id')
            ->orderByDesc('created_at')
            ->get();
        $tasks = $this->getDeliverableTasks();
        $taskFieldMap = $this->getTaskFieldMap($tasks);

        return view('student.masterpiece_deliverables.index', compact('student', 'deliverables', 'tasks', 'taskFieldMap'));
    }

    public function create()
    {
        $student = Auth::guard('students')->user();
        $tasks = $this->getDeliverableTasks();
        $taskFieldMap = $this->getTaskFieldMap($tasks);

        return view('student.masterpiece_deliverables.create', compact('student', 'tasks', 'taskFieldMap'));
    }

    public function store(Request $request)
    {
        $student = Auth::guard('students')->user();
        $staff = $this->getStudentStaff($student);

        if (!$staff) {
            return redirect()->back()->withErrors(['staff' => 'No trainer assigned to your cohort.']);
        }

        $validated = $this->validateDeliverable($request, $student->id);
        $validated['student_id'] = $student->id;
        $validated['staff_id'] = $staff->id;
        $validated['project_sector'] = $validated['project_sector'] ?? '';

        MasterpieceDetail::create($validated);

        return redirect()
            ->route('student.masterpiece.deliverables.index')
            ->with('success', 'Deliverable submitted successfully.');
    }

    public function edit(MasterpieceDetail $deliverable)
    {
        $student = Auth::guard('students')->user();
        $this->authorizeDeliverable($deliverable, $student->id);

        $tasks = $this->getDeliverableTasks();
        $taskFieldMap = $this->getTaskFieldMap($tasks);

        return view('student.masterpiece_deliverables.edit', compact('student', 'deliverable', 'tasks', 'taskFieldMap'));
    }

    public function update(Request $request, MasterpieceDetail $deliverable)
    {
        $student = Auth::guard('students')->user();
        $this->authorizeDeliverable($deliverable, $student->id);

        $validated = $this->validateDeliverable($request, $student->id, $deliverable->id);
        $validated['project_sector'] = $validated['project_sector'] ?? $deliverable->project_sector ?? '';
        $deliverable->update($validated);

        return redirect()
            ->route('student.masterpiece.deliverables.index')
            ->with('success', 'Deliverable updated successfully.');
    }

    public function destroy(MasterpieceDetail $deliverable)
    {
        $student = Auth::guard('students')->user();
        $this->authorizeDeliverable($deliverable, $student->id);

        $deliverable->delete();

        return redirect()
            ->route('student.masterpiece.deliverables.index')
            ->with('success', 'Deliverable deleted successfully.');
    }

    private function validateDeliverable(Request $request, $studentId, $deliverableId = null)
    {
        $rules = [
            'masterpiece_task_id' => [
                'required',
                'exists:masterpiece_tasks,id',
                Rule::unique('masterpiece_details', 'masterpiece_task_id')
                    ->where('student_id', $studentId)
                    ->ignore($deliverableId),
            ],
            'project_sector' => 'nullable|string|max:255',
            'masterpiece_project_name' => 'nullable|string|max:255',
            'masterpiece_brief' => 'nullable|string',
            'masterpiece_wireframe_mockup_link' => 'nullable|url|max:255',
            'masterpiece_presentation_link' => 'nullable|url|max:255',
            'masterpiece_documentation_link' => 'nullable|url|max:255',
            'github_link' => 'nullable|url|max:255',
            'masterpiece_idea_link' => 'nullable|url|max:255',
            'masterpiece_frontend_link' => 'nullable|url|max:255',
            'masterpiece_full_version_link' => 'nullable|url|max:255',
        ];

        $messages = [
            'masterpiece_task_id.required' => 'Please select a task.',
            'masterpiece_task_id.unique' => 'You already submitted a deliverable for this task.',
        ];
        $attributes = [
            'masterpiece_project_name' => 'project name',
            'masterpiece_brief' => 'project brief',
            'masterpiece_wireframe_mockup_link' => 'wireframe link',
            'masterpiece_presentation_link' => 'presentation link',
            'masterpiece_documentation_link' => 'documentation link',
            'github_link' => 'GitHub link',
            'masterpiece_idea_link' => 'idea link',
            'masterpiece_frontend_link' => 'frontend link',
            'masterpiece_full_version_link' => 'full version link',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        $task = MasterpieceTask::find($request->input('masterpiece_task_id'));
        $requiredFields = $this->requiredFieldsForTask($task ? $task->task_name : null);

        $validator->after(function ($validator) use ($request, $requiredFields, $attributes) {
            foreach ($requiredFields as $field) {
                if (!$request->filled($field)) {
                    $label = $attributes[$field] ?? str_replace('_', ' ', $field);
                    $validator->errors()->add($field, 'Please provide the ' . $label . ' for this task.');
                }
            }
        });

        return $validator->validate();
    }

    private function authorizeDeliverable(MasterpieceDetail $deliverable, $studentId)
    {
        if ($deliverable->student_id !== $studentId) {
            abort(403);
        }
    }

    private function getStudentStaff($student)
    {
        if (!$student || !$student->cohort) {
            return null;
        }

        $trainerRoles = ['trainer', 'coordinator', 'job_coach', 'auditer'];
        $staff = $student->cohort->staff()->whereIn('role', $trainerRoles)->orderBy('staff_name')->first();

        return $staff ?: $student->cohort->staff()->first();
    }

    private function requiredFieldsForTask($taskName)
    {
        if (!$taskName) {
            return [];
        }

        $name = strtolower($taskName);
        if (strpos($name, 'idea') !== false) {
            return ['masterpiece_project_name', 'masterpiece_brief', 'masterpiece_idea_link'];
        }
        if (strpos($name, 'wireframe') !== false || strpos($name, 'mockup') !== false) {
            return ['masterpiece_wireframe_mockup_link'];
        }
        if (strpos($name, 'front') !== false) {
            return ['masterpiece_frontend_link'];
        }
        if (strpos($name, 'final') !== false || strpos($name, 'full') !== false) {
            return ['masterpiece_full_version_link'];
        }
        if (strpos($name, 'deliverable') !== false || strpos($name, 'document') !== false) {
            return [
                'masterpiece_brief',
                'masterpiece_wireframe_mockup_link',
                'masterpiece_documentation_link',
                'masterpiece_presentation_link',
                'github_link',
            ];
        }

        return [];
    }

    private function getTaskFieldMap($tasks)
    {
        $map = [];
        foreach ($tasks as $task) {
            $map[$task->id] = $this->requiredFieldsForTask($task->task_name);
        }
        return $map;
    }

    private function getDeliverableTasks()
    {
        return MasterpieceTask::where('task_name', '<>', 'Masterpiece Jury')
            ->orderBy('id')
            ->get();
    }
}



