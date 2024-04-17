@extends('Layouts.app')
@section('title')
Announcements
@endsection

@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

@include('layouts.innerNav')
<section class="inner-bred my-3">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">test</a></li>
        </ul>
    </div>
</section>

<!-- masterpiece info form -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Masterpiece Progress</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('masterpiece.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="task">Task</label>
                            <select id="task" class="form-control @error('task') is-invalid @enderror" name="task"
                                required autocomplete="task" autofocus>
                                <option value="">Select Task</option>
                                <option >Idea pitching</option>
                                <option >Wireframe & Mockup</option>
                                <option >Fully responsive Front-end</option>
                                <option >Final version fully functional</option>
                                <option >All other deliverables</option>
                                
                            </select>
                            @error('task')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="progress">Progress (%)</label>
                            <input id="progress" type="number" min="0" max="100"
                                class="form-control @error('progress') is-invalid @enderror" name="progress"
                                value="{{ old('progress') }}" required autocomplete="progress">
                            @error('progress')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deadline">Deadline</label>
                            <input id="deadline" type="date"
                                class="form-control @error('deadline') is-invalid @enderror" name="deadline"
                                value="{{ old('deadline') }}" required autocomplete="deadline">
                            @error('deadline')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea id="notes" class="form-control @error('notes') is-invalid @enderror" name="notes"
                                required autocomplete="notes">{{ old('notes') }}</textarea>
                            @error('notes')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection