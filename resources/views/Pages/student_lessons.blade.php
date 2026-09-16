@extends('Layouts.app')
@section('title')
    Lessons
@endsection
@section('content')
    @include('Layouts.innerNav')
    <section class="inner-bred my-3">
        <div class="container">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#"> Lessons </a></li>
            </ol>
        </div>
    </section>
    
    <div class="container mb-5">
        <div class="row mb-3">
            <div class="col-12">
                <h3 class="page-title text-primary fs-3">Learning Materials</h3>
                <p class="text-muted">Access your structured topic lessons and downloads below.</p>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 25%;">Lesson Title</th>
                            <th scope="col" style="width: 25%;">Topic</th>
                            <th scope="col" style="width: 35%;">Description</th>
                            <th scope="col" style="width: 15%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lessons as $lesson)
                            <tr>
                                <td>
                                    <span class="fw-semibold text-dark">{{ $lesson->title }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-primary border border-primary-subtle py-2 px-3">{{ optional($lesson->topic)->topic_name }}</span>
                                </td>
                                <td class="text-muted">
                                    {{ $lesson->description ?: 'No description' }}
                                </td>
                                <td class="text-center">
                                    @if ($lesson->pdf_path)
                                        <a href="{{ route('lessons.download', $lesson->id) }}" class="btn btn-primary btn-sm px-3 shadow-sm">
                                            <i class="fa-solid fa-download me-1"></i> Download PDF
                                        </a>
                                    @else
                                        <span class="text-muted">No attachment</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-5">
                                    <i class="fa-solid fa-book-open fs-2 mb-3 d-block text-secondary"></i>
                                    No lessons have been published for you yet.
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
