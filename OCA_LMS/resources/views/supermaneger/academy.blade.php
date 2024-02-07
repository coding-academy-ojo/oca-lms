@extends('Layouts.app')
@section('title')

Balqa Academy
@endsection

@section('content')

@include('layouts.innerNav')

<div class="d-flex align-items-center flex-wrap my-4 gap-3 justify-content-center g-4 ">
    <div class="card " style="width: 18rem; ">
        <img class="card-img-top " src="{{asset('assets/img/img_read_thumb.jpg')}} " alt="Card image cap ">
        <div class="card-body ">
            <h5 class="card-title ">Cohort 1</h5>
            <hr>
            <p class="card-text py-2 ">manager Dana</p>



            <div class="d-flex g-1 justify-content-end gap-2 ">
                <a href="{{ route('academyview') }}" class="btn btn-secondary">View</a>

                <a href="{{route('cohortedit')}}" class="btn btn-primary ">Edit</a>
            </div>
        </div>
    </div>
    <div class="card " style="width: 18rem; ">
        <img class="card-img-top " src="{{asset('assets/img/img_read_thumb.jpg')}} " alt="Card image cap ">
        <div class="card-body ">
            <h5 class="card-title ">Cohort 2</h5>
            <hr>
            <p class="card-text py-2 ">manager Dana</p>



            <div class="d-flex g-1 justify-content-end gap-2 ">
                <a href="{{ route('academyview') }}" class="btn btn-secondary">View</a>

                <a href="{{route('cohortedit')}}" class="btn btn-primary ">Edit</a>
            </div>
        </div>
    </div>
    <div class="card " style="width: 18rem; ">
        <img class="card-img-top " src="{{asset('assets/img/img_read_thumb.jpg')}} " alt="Card image cap ">
        <div class="card-body ">
            <h5 class="card-title ">Cohort 3</h5>
            <hr>
            <p class="card-text py-2 ">manager Dana</p>



            <div class="d-flex g-1 justify-content-end gap-2 ">
                <a href="{{ route('academyview') }}" class="btn btn-secondary">View</a>

                <a href="{{route('cohortedit')}}" class="btn btn-primary ">Edit</a>
            </div>
        </div>
    </div>



</div>

@endsection


