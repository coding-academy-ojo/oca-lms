
<!-- resources/views/add_project_submission_modal.blade.php -->

<form action="{{ route('process_project_submission', ['project_id' => $project->id]) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="submission_link" class="form-label">Submission Link</label>
        <input type="text" class="form-control" id="submission_link" name="submission_link" required>

        <label for="submission_message" class="form-label">Write a message</label>
        <input type="text" class="form-control" id="submission_message" name="submission_message" required>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
