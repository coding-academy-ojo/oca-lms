@extends('Layouts.app')
@section('title')
    Students Management
@endsection

@section('content')
    @include('Layouts.innerNav')

    <nav style="padding: 50px 50px 0;" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('academyview') }}">Cohorts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Students</li>
        </ol>
    </nav>

    <div class="container my-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Students Management</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Cohort Info -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $cohort->cohort_name }}</h5>
                <p class="card-text text-muted">{{ $cohort->cohort_description ?? 'No description' }}</p>
            </div>
        </div>

        <!-- Students Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Academy</th>
                                    <th scope="col">Cohort</th>
                                    <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $index => $student)
                                <tr>
                                    <th scope="row">{{ ($students->currentPage() - 1) * $students->perPage() + $index + 1 }}</th>
                                    <td>
                                        {{ $student->en_first_name ?? '' }} 
                                        {{ $student->en_second_name ?? '' }} 
                                        {{ $student->en_last_name ?? '' }}
                                        @if(empty($student->en_first_name) && empty($student->en_second_name))
                                            {{ $student->ar_first_name ?? '' }} 
                                            {{ $student->ar_second_name ?? '' }} 
                                            {{ $student->ar_last_name ?? '' }}
                                        @endif
                                    </td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->mobile ?? 'N/A' }}</td>
                                    <td>{{ $student->academy->academy_name ?? 'N/A' }}</td>
                                    <td>{{ $student->cohort->cohort_name ?? 'N/A' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('coordinator.students.show', $student->id) }}" 
                                               class="btn btn-sm btn-info" title="View">
                                                <span class="material-symbols-outlined" style="font-size: 18px;">visibility</span>
                                            </a>
                                            <a href="{{ route('coordinator.students.edit', $student->id) }}" 
                                               class="btn btn-sm btn-primary" title="Edit">
                                                <span class="material-symbols-outlined" style="font-size: 18px;">edit</span>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" title="Delete" 
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $student->id }}">
                                                <span class="material-symbols-outlined" style="font-size: 18px;">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No students found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modals -->
    @foreach($students as $student)
    <div class="modal fade" id="deleteModal{{ $student->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $student->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $student->id }}">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this student?</p>
                    <p><strong>{{ $student->en_first_name ?? $student->ar_first_name }} {{ $student->en_last_name ?? $student->ar_last_name }}</strong></p>
                    <p class="text-danger"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('coordinator.students.destroy', $student->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection

