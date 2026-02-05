@extends('Layouts.app')

@section('title', 'Masterpiece Deliverables')

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
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="text-primary mb-0">Masterpiece Deliverables</h1>
        <div class="d-flex gap-2">
            <a class="btn btn-outline-secondary" href="{{ route('student.dashboard') }}">Back</a>
            <a class="btn btn-primary" href="{{ route('student.masterpiece.deliverables.create') }}">Submit Deliverable</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($deliverables->isEmpty())
        <div class="card">
            <div class="card-body">
                <p class="text-muted mb-0">No deliverables submitted yet.</p>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Project Name</th>
                            <th>Idea Link</th>
                            <th>Frontend Link</th>
                            <th>Full Version Link</th>
                            <th>Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deliverables as $deliverable)
                            <tr>
                                <td>{{ $deliverable->task ? $deliverable->task->task_name : 'N/A' }}</td>
                                <td>{{ $deliverable->masterpiece_project_name }}</td>
                                <td>
                                    @if (!empty($deliverable->masterpiece_idea_link))
                                        <a href="{{ $deliverable->masterpiece_idea_link }}" target="_blank">View</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($deliverable->masterpiece_frontend_link))
                                        <a href="{{ $deliverable->masterpiece_frontend_link }}" target="_blank">View</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($deliverable->masterpiece_full_version_link))
                                        <a href="{{ $deliverable->masterpiece_full_version_link }}" target="_blank">View</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $deliverable->created_at ? $deliverable->created_at->format('d/m/Y') : '' }}</td>
                                <td class="d-flex gap-2 align-items-center flex-nowrap">
                                    <a class="btn p-0 border-0 bg-transparent"
                                        href="{{ route('student.masterpiece.deliverables.edit', $deliverable->id) }}"
                                        title="Edit">
                                        <i class="fa-solid fa-pen-to-square" style="color: #FF7900;"></i>
                                    </a>
                                    <form method="POST" class="m-0 delete-deliverable-form"
                                        action="{{ route('student.masterpiece.deliverables.destroy', $deliverable->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn p-0 border-0 bg-transparent" title="Delete">
                                            <i class="fa-solid fa-trash" style="color: #FF7900;"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        @endif

        document.querySelectorAll('.delete-deliverable-form').forEach((form) => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Delete deliverable?',
                    text: 'This action cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

@endsection

