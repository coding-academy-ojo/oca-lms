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

    <!-- All announcements will appeare here based on newest date and time  -->
    @if ($announcements)
    @foreach($announcements as $announcement)
    <div class="card col-8 m-auto my-3">
        <div class="card-header d-flex justify-content-between align-items-center">

            <div>
                <img class="img-fluid announcement-card-custom-image"
                    src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIAJQAmQMBIgACEQEDEQH/xAAbAAEAAgMBAQAAAAAAAAAAAAAABQYCAwQBB//EADMQAQACAQIDBAgEBwAAAAAAAAABAgMEEQUSMSFBUaETIjJSYXGxwYGR0eEUFSMzQmJy/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/EABQRAQAAAAAAAAAAAAAAAAAAAAD/2gAMAwEAAhEDEQA/APpIAAAAAAAAAAAAAAAAAAAAAAAAH4AOvT8PzZtpn1K+Nv0dmg0EY9smeN791fdSII/HwrDX27Xt5N38v0223o/OXUA4L8K09o9Wb1n4Tv8AVxajhubFE2ptkr8Ov5JwBVxN67Q1zxN8fq5PKfmhbRNbTW0TExO07g8AAAAAAAAAASHCdNF7znvHZXsrHjPij1j0uP0WClNtto8wbQAAAAAEZxfTb19PXrHtJNjkrF6TS3S0bSCsj29Zpe1Z61naXgAAAAAAAAM8Ec2bHE99oWVWsNuXLS091olZQAAAAAACQBX9fERrMsR727nb9dbm1eWY97ZoAAAAAAAAAWDQ5ozaalt95jsn5q+7OHar0GXlv/bv1+E+IJwI6AAAAADXqMkYcN8k/wCMNiH4rqoyX9DTtrWd7T4yCPmZmZmesgAAAAAAAAAAzw4r5rxTHWZn6A7NBxD0W2PNMzSOlvD9kxW0WrFqzvE9JcWl4djxbWy7Xv5Q7YjboD0AAmdgBFa7iEWicenn4Tb9EYnNVoMWfeYjkv4x3/NEajT5NPblyV+Vo6SDUAAAAAAAADfo9NbU5eXpSPasD3SaS+pt2b1pHW32hOYMNMFOTHXaPq9x4646VrSIisdIhmAAAAAAAxyY65KTW9YtWe6WQCC1uhtp55qetjn84ciz2rFomJ6Sg9fpP4e/NSP6Vp7PhPgDkAAAAAB7Ws3tFaxvMztCw6TBXT4a447Z758ZRfCMPPqJyT7NI800AAAAAAAAAAAwzY65cdqXjstG0swFazY5w5bY7daywSfGcPbTNEf62+yMAAAABNcIpyaXm96Zn7O5p0leTTYq+FI+jcAAAAAAAAAAAADm4hjjJpMkd8RvH4dqAWe0RaJiekqxMTEzE9YAAAABZ6+zHyegAAAAAAAAAAAAArWo7NRk/wC5+oAwAB//2Q=="
                    alt="">
                <span class="mx-2"> {{$announcement->staff->staff_name}}</span>
                <span class="mx-2"> {{$announcement->created_at}}</span>
            </div>



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
        </div>
        <div class="card-body contentDiv" >
            <p class="card-text">{{ $announcement->content }}</p>
        </div>
        <div class="card-body editDiv"  style="display: none;">
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