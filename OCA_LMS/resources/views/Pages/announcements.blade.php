<!-- resources/views/pages/announcements.blade.php -->
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


<div class="container">
@if (auth()->check() && (auth()->user()->role == "trainer" || auth()->user()->role == "manager"))

    <div class="row">
        <div class=" col-8 m-auto my-3">
            <!-- announce to your class input -->
            <form action="{{route('announcements.store')}}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" name="content" class="form-control  rounded-1 needs-validation" novalidate
                        placeholder="Announce to your class" aria-label="Recipient's username"
                        aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="submit" primary id="button-addon2">Post</button>
                </div>
            </form>
        </div>
    </div>
@endif
    <!-- All announcements will appeare here based on newest date and time  -->
    @if ($announcements)
    @foreach($announcements as $announcement)
    <div class="card col-10 m-auto my-4">
        <div class="card-header d-flex justify-content-between align-items-center">

            <div>
                <img class="img-fluid announcement-card-custom-image" src="https://placehold.co/400x400/white/FFF"
                    alt="">
                <span class="mx-2"> {{$announcement->staff->staff_name}}</span>

            </div>

            @if (auth()->check() && (auth()->user()->role == "trainer" || auth()->user()->role == "manager"))


            <div class=" d-flex justify-content-between align-items-center">
                <form action="{{route('destroy', $announcement-> id)}}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-icon" style="border: none; background: none;">
                        <i class="fa-solid fa-trash" style="color: #FF7900;"></i>
                    </button>
                </form>
                <a class="mx-2 editIcon" id="editIcon" href="#">
                    <i class="fa-solid fa-pen-to-square" style="color: #FF7900;"></i>
                </a>
            </div>
            @endif
        </div>
        
        <div class="card-body contentDiv d-flex justify-content-between">
            <div class="col-10"><p class="card-text">{{ $announcement->content }}</p> </div>
           <div class="col-2"> <span class="mx-2"> {{$announcement->created_at}}</span></div>
        </div>
        <div class="card-body editDiv" style="display: none;">
            <form action="{{ route('announcements.update', $announcement->id) }}" method="POST" id="updateForm">
                @csrf
                @method('PUT')
                <div class="input-group">
                    <input type="text" name="content" value="{{ $announcement->content }}"
                        class="form-control rounded-1 needs-validation" novalidate placeholder="Announce to your class"
                        aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="submit" primary id="button-addon2">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const editIcons = document.querySelectorAll('.editIcon');

        editIcons.forEach(editIcon => {
            editIcon.addEventListener('click', function(event) {
                event.preventDefault();

                // Hide all edit forms before displaying the selected one
                hideAllEditForms();

                const announcementCard = this.closest('.card');
                const contentDiv = announcementCard.querySelector('.contentDiv');
                const editDiv = announcementCard.querySelector('.editDiv');

                contentDiv.style.display = 'none';
                editDiv.style.display = 'block';
            });
        });

        function hideAllEditForms() {
            const editForms = document.querySelectorAll('.editDiv');
            editForms.forEach(form => {
                form.style.display = 'none';
            });
        }
    });
    </script>

    @endforeach

    @endif
    @endsection