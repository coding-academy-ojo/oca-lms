@extends('Layouts.app')
@section('title')
    Lessons List
@endsection
@section('content')
    @include('Layouts.innerNav')
    <section class="inner-bred my-3">
        <div class="container">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a href="{{ route('academyview') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#"> Lessons </a></li>
            </ol>
        </div>
    </section>
    
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show col-8 m-auto mb-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row d-flex align-items-center mb-3">
            <div class="col-6">
                <h3 class="page-title text-primary fs-3 m-0">Lessons</h3>
            </div>
            <div class="col-6 text-end">
                <a href="{{ route('lessons.create') }}" class="btn btn-primary">Create Lesson</a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 15%;">Title</th>
                            <th scope="col" style="width: 20%;">Topic</th>
                            <th scope="col" style="width: 25%;">Description</th>
                            <th scope="col" style="width: 10%;" class="text-center">Order</th>
                            <th scope="col" style="width: 10%;" class="text-center">Status</th>
                            <th scope="col" style="width: 10%;" class="text-center">PDF</th>
                            <th scope="col" style="width: 10%;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lessons as $lesson)
                            <tr>
                                <td>
                                    <span class="fw-semibold">{{ $lesson->title }}</span>
                                </td>
                                <td>
                                    {{ optional($lesson->topic)->topic_name }}
                                </td>
                                <td class="text-muted text-truncate" style="max-width: 250px;">
                                    {{ $lesson->description ?: 'No description' }}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="fw-bold me-2">{{ $lesson->order }}</span>
                                        <div class="d-flex flex-column">
                                            <form action="{{ route('lessons.move-up', $lesson->id) }}" method="post" class="m-0">
                                                @csrf
                                                <button type="submit" class="btn btn-link p-0 text-decoration-none text-primary" title="Move Up" style="line-height: 1;">
                                                    <i class="fa-solid fa-caret-up fs-5"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('lessons.move-down', $lesson->id) }}" method="post" class="m-0">
                                                @csrf
                                                <button type="submit" class="btn btn-link p-0 text-decoration-none text-primary" title="Move Down" style="line-height: 1;">
                                                    <i class="fa-solid fa-caret-down fs-5"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if ($lesson->is_published)
                                        <span class="badge bg-success text-white py-1 px-2 mb-1 d-inline-block">Published</span>
                                    @else
                                        <span class="badge bg-secondary text-white py-1 px-2 mb-1 d-inline-block">Draft</span>
                                    @endif
                                    <form action="{{ route('lessons.toggle-publish', $lesson->id) }}" method="post" class="m-0">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-link p-0 text-decoration-none text-muted" style="font-size: 0.8rem;">
                                            <i class="fa-solid {{ $lesson->is_published ? 'fa-eye-slash' : 'fa-eye' }} me-1"></i>
                                            {{ $lesson->is_published ? 'Unpublish' : 'Publish' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    @if ($lesson->pdf_path)
                                        <a href="{{ route('lessons.download', $lesson->id) }}" class="btn btn-sm btn-outline-secondary px-3" title="Download PDF">
                                            <i class="fa-solid fa-file-pdf text-danger me-1"></i> Download
                                        </a>
                                    @else
                                        <span class="text-muted">No file</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-link text-primary p-1 me-2" title="Edit">
                                            <i class="fa-solid fa-pen-to-square fs-5"></i>
                                        </a>
                                        <form action="{{ route('lessons.destroy', $lesson->id) }}" method="post" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-1 border-0 bg-transparent" 
                                                    onclick="return confirm('Are you sure you want to delete this lesson? This will delete the PDF and associated progress records.')"
                                                    title="Delete">
                                                <i class="fa-solid fa-trash fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No lessons found. Click "Create Lesson" to add one.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $lessons->links() }}
        </div>
    </div>
@endsection
