@extends('layouts.app')

@section('title')
Academies
@endsection

@section('content')
@include('layouts.innerNav')
@if(session('success'))
<div class="justify-content-center d-flex gap-2">   
    <div id="alertMessage" class="alert alert-success alert-dismissible fade show" role="alert"
         style="justify-content: center; min-width: 300px; background-color: #28a745; border: none; color: white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); border-radius: 5px;">
        {{ session('success') }}
    </div>
    <button id="closeAlertButton" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
            style="color: white; background-color: #28a745; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; border: none; ">
       
    </button>
</div>
@endif
@if(session('error'))
<div class="d-flex gap-2 justify-content-center">   
    <div id="alertMessage" class="alert alert-danger alert-dismissible fade show" role="alert"
         style="min-width: 300px; background-color: #dc3545; border: none; color: white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); border-radius: 5px;">
        {{ session('error') }}
    </div>
    <button id="closeAlertButton" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
            style="color: white; background-color: #dc3545; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; border: none; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.15);">
        &times;
    </button>
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
