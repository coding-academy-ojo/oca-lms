@extends('layouts.app')

@section('title')
Academies
@endsection

@section('content')
@include('layouts.innerNav')
@if(session('success'))
<div class="justify-content-center d-flex gap-2">   

    <div id="alertMessage" class="alert alert-success alert-dismissible fade show" role="alert" style="    justify-content: center;
    min-width: 408px; background-color: #FF6B00; border-color: #FF6B00; color: white;">
        {{ session('success') }}
    </div>
    <button id="closeAlertButton" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="border :solid 1px black; color: white; width:20px;"></button>
</div>

    @endif
@if(session('error'))
<div id="alertMessage" class="d-flex gap-2 justify-content-center">   
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="background-color: #FF6B00; border-color: #FF6B00; color: white;">
        {{ session('success') }}
 
    </div>
    <button id="closeAlertButton" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="color: white;"></button>
</div> 
    @endif
<div class="d-flex align-items-center flex-wrap my-4 gap-3 justify-content-center g-4">
    @forelse ($academies as $academy)
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ asset('assets/img/img_read_thumb.jpg') }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{ $academy->academy_name }}</h5>
            <hr>
            <p class="card-text py-2">
                Manager: 
                @if ($academy->managers->first())
                    {{ $academy->managers->first()->staff_name }}
                @else
                    No manager assigned
                @endif
            </p>
            <div class="d-flex g-1 justify-content-end gap-2">
                <a href="{{ route('academyview', $academy->id) }}" class="btn btn-secondary">View</a>

                {{-- Conditionally show the "Edit" button only for super managers --}}
                @if ($isSuperManager)
                <a href="{{ route('editacademy', $academy->id) }}" class="btn btn-primary">Edit</a>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-warning" role="alert">
        There are no academies available.
    </div>
    @endforelse
</div>
@if ($isSuperManager)
@include('academies.offcanvas._create-academy')
@endif
<script>
    document.addEventListener("DOMContentLoaded", function() {
    var closeButton = document.getElementById('closeAlertButton');
    var alertMessage = document.getElementById('alertMessage');

    closeButton.addEventListener('click', function() {
        alertMessage.style.display = 'none';
        closeButton.style.display = 'none';
    });
});

</script>
@endsection
