@extends('Layouts.app')
@section('title')
Technology
@endsection
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

@include('Layouts.innerNav')
<section class="inner-bred">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="/rodmap">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">{{ $technology->technologies_name }}</a></li>

        </ul>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}
<div class="innerPage  mt-3">
    <div class="container">
        <div class="">
            <div>
                <div>
                    <div class="vt" style="display: flex;
                               justify-content: flex-end;
                                             gap: 1rem;">

                        @if(Auth::guard('staff')->check() && Auth::guard('staff')->user()->role === 'trainer')
                        <form method="POST" action="{{ route('technology.destroy', ['technology' => $technology]) }}">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('technology.edit', ['technology' => $technology]) }}" class=" btn btn-primary m-auto">edit</a>
                            <button class=" btn btn-primary m-auto" type="submit">Delete</button>
                        </form>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" data-technologyid="{{$technologyCohort->id }}">
                        Add Topic
                    </button>
                        @endif

                    </div>
                    @if ($technology->technologies_photo)
                    <!-- <img src="{{ asset('images/' . $technology->technologies_photo) }}" alt="Technology Image"> -->
                    <img style="    width: 100%;
    height: 350px;
    object-fit: cover;
    margin: 2rem 0px;" src="{{ asset('assets/img/' . $technology->technologies_photo) }}" alt="Technology Image">


                    @else
                    <p>No image uploaded</p>
                    @endif
                    <h1>{{ $technology->technologies_name }}</h1>
                    <p>Description: {{ $technology->technologies_description }}</p>
                    <p>Resources:<a href="{{ $technology->technologies_resources }}" target="_blank"> {{ $technology->technologies_resources }}</a></p>
                    <p>Training Period: {{ $technology->technologies_trainingPeriod }}</p>
                    <!-- Add more details as needed -->
                    <!-- <p>Category: {{ $technology->technology_category_id }}</p> -->
                    <!-- If you have an image, you can display it like this -->
                    <p>Topics:</p>
                    <div class="table-responsive m-auto col-10 ">
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th scope="col ">ID</th>
                                    <th scope="col ">Topic Name</th>
                                    <th scope="col ">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Topics as $topic)                                    
                                <tr>
                                        <td>{{ $topic->id }}</td>
                                        <td>{{ $topic->topic_name }}</td>
                                        <td>
                                            <div class="my-auto d-flex">
                                                <a class="mx-2" data-bs-toggle="modal" data-bs-target="#editTopicModal{{$topic->id}}" href=""><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                          
                                                <form action="{{ route('topic.destroy', $topic->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="border border-0 m-auto bg-white"
                                                        onclick="return confirm('Are you sure you want to delete this topic')">
                                                        <i class="fa-solid fa-trash" style="color: #FF7900;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Model to save new topic  --}}                                    
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5" id="exampleModalLabel">Add Topic</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Close"><span class="visually-hidden">Close</span></button>
            </div>
            <div class="modal-body">
                <form id="editTopicForm" method="POST" action="{{ route('topic.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="topicName" class="form-label">Topic Name</label>
                            <input type="text" class="form-control" id="topicName" name="topic">
                            <input type="hidden" name="technology_id" id="technology_id" value="{{$technologyCohort->id }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- model to update topic  --}}
@foreach ($Topics as $topic)

<div class="modal fade" id="editTopicModal{{$topic->id}}" tabindex="-1" aria-labelledby="editTopicModalLabel{{$topic->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTopicModalLabel{{$topic->id}}">Edit Topic</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('topic.update', $topic->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="topicName" class="form-label">Topic Name</label>
                        <input type="text" class="form-control" id="topicName" name="topic_name" value="{{ $topic->topic_name }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection