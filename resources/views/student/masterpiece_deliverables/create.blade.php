@extends('Layouts.app')

@section('title', 'Submit Masterpiece Deliverable')

@section('content')
@include('Layouts.innerNav')

<section class="inner-bred my-3">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="/student-dashboard">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="{{ route('student.masterpiece.deliverables.index') }}">Masterpiece Deliverables</a></li>
        </ul>
    </div>
</section>

<div class="container my-4">
    <div class="card">
        <div class="card-body">
            <h4 class="text-primary mb-4">Submit Deliverable</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('student.masterpiece.deliverables.store') }}">
                @csrf

                <div class="form-group mb-3">
                    <label for="masterpiece_task_id">Task</label>
                    <select id="masterpiece_task_id" name="masterpiece_task_id" class="form-control" required>
                        <option value="">Select Task</option>
                        @foreach ($tasks as $task)
                            <option value="{{ $task->id }}"
                                data-fields="{{ implode(',', $taskFieldMap[$task->id] ?? []) }}"
                                data-task-name="{{ strtolower($task->task_name) }}"
                                {{ old('masterpiece_task_id') == $task->id ? 'selected' : '' }}>
                                {{ $task->task_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3 deliverable-field" data-field-key="masterpiece_project_name" style="display: none;">
                    <label for="masterpiece_project_name">Project Name</label>
                    <input id="masterpiece_project_name" name="masterpiece_project_name" type="text" class="form-control"
                        value="{{ old('masterpiece_project_name') }}" required>
                </div>

                <div class="form-group mb-3 deliverable-field" data-field-key="masterpiece_brief" style="display: none;">
                    <label for="masterpiece_brief">Project Brief</label>
                    <textarea id="masterpiece_brief" name="masterpiece_brief" class="form-control" rows="3" required>{{ old('masterpiece_brief') }}</textarea>
                </div>

                <div class="form-group mb-3 deliverable-field" data-field-key="masterpiece_idea_link" style="display: none;">
                    <label for="masterpiece_idea_link">Idea Link</label>
                    <input id="masterpiece_idea_link" name="masterpiece_idea_link" type="url" class="form-control"
                        value="{{ old('masterpiece_idea_link') }}" required>
                </div>

                <div class="form-group mb-3 deliverable-field" data-field-key="masterpiece_wireframe_mockup_link" style="display: none;">
                    <label for="masterpiece_wireframe_mockup_link" data-default-label="Wireframe & Mockup Link">Wireframe & Mockup Link</label>
                    <input id="masterpiece_wireframe_mockup_link" name="masterpiece_wireframe_mockup_link" type="url" class="form-control"
                        value="{{ old('masterpiece_wireframe_mockup_link') }}" required>
                </div>

                <div class="form-group mb-3 deliverable-field" data-field-key="masterpiece_presentation_link" style="display: none;">
                    <label for="masterpiece_presentation_link" data-default-label="Presentation Link">Presentation Link</label>
                    <input id="masterpiece_presentation_link" name="masterpiece_presentation_link" type="url" class="form-control"
                        value="{{ old('masterpiece_presentation_link') }}" required>
                </div>

                <div class="form-group mb-3 deliverable-field" data-field-key="masterpiece_documentation_link" style="display: none;">
                    <label for="masterpiece_documentation_link" data-default-label="Documentation Link">Documentation Link</label>
                    <input id="masterpiece_documentation_link" name="masterpiece_documentation_link" type="url" class="form-control"
                        value="{{ old('masterpiece_documentation_link') }}" required>
                </div>

                <div class="form-group mb-3 deliverable-field" data-field-key="github_link" style="display: none;">
                    <label for="github_link" data-default-label="GitHub Link">GitHub Link</label>
                    <input id="github_link" name="github_link" type="url" class="form-control"
                        value="{{ old('github_link') }}" required>
                </div>

                <div class="form-group mb-3 deliverable-field" data-field-key="masterpiece_frontend_link" style="display: none;">
                    <label for="masterpiece_frontend_link" data-default-label="Frontend Link">Frontend Link</label>
                    <input id="masterpiece_frontend_link" name="masterpiece_frontend_link" type="url" class="form-control"
                        value="{{ old('masterpiece_frontend_link') }}" required>
                </div>

                <div class="form-group mb-3 deliverable-field" data-field-key="masterpiece_full_version_link" style="display: none;">
                    <label for="masterpiece_full_version_link" data-default-label="Full Version Link">Full Version Link</label>
                    <input id="masterpiece_full_version_link" name="masterpiece_full_version_link" type="url" class="form-control"
                        value="{{ old('masterpiece_full_version_link') }}" required>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('student.masterpiece.deliverables.index') }}" class="btn btn-outline-secondary">Back</a>
                    <button type="submit" class="btn btn-primary" id="deliverable-submit" disabled>Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const taskSelect = document.getElementById('masterpiece_task_id');
        const fields = document.querySelectorAll('.deliverable-field');

        function updateFields() {
            const selected = taskSelect.options[taskSelect.selectedIndex];
            const fieldList = selected && selected.dataset.fields ? selected.dataset.fields.split(',') : [];

            fields.forEach((field) => {
                const key = field.getAttribute('data-field-key');
                const input = field.querySelector('input, textarea');
                const shouldShow = fieldList.length > 0 && fieldList.includes(key);
                field.style.display = shouldShow ? '' : 'none';
                if (input) {
                    input.required = shouldShow;
                }
            });

            const submitBtn = document.getElementById('deliverable-submit');
            if (submitBtn) {
                submitBtn.disabled = fieldList.length === 0;
            }
        }

        taskSelect.addEventListener('change', updateFields);
        updateFields();
    });
</script>

@endsection

