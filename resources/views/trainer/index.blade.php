@extends('trainer.layouts.master')

@section('trainerHome')


    <div class="container-xxl bd-gutter mt-3 my-md-4 bd-layout d-flex">

        <main class="bd-main order-1">
            <div class="d-flex flex-row flex-wrap gap-2  justify-content-center">
                @if ($classrooms->isNotEmpty())
                    @foreach ($classrooms as $classroom)
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="https://www.gstatic.com/classroom/themes/img_bookclub.jpg"
                                alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $classroom->name }}</h5>
                                <p class="card-text py-4">{{ $classroom->manager->name ?? 'No Manager Assigned' }}</p>
                                <a href="#" class="btn btn-primary">View Class</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col text-center">
                                <p class="text-warning font-weight-bold">No classes available.</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://www.gstatic.com/classroom/themes/img_bookclub.jpg"
                        alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">CSS Class</h5>
                        <p class="card-text py-4"> Rawan</p>
                        <a href="#" class="btn btn-primary">View Class</a>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://www.gstatic.com/classroom/themes/img_bookclub.jpg"
                        alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">JS Class</h5>
                        <p class="card-text py-4"> Reem</p>
                        <a href="#" class="btn btn-primary">View Class</a>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://www.gstatic.com/classroom/themes/img_bookclub.jpg"
                        alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">JS Advance Class</h5>
                        <p class="card-text py-4"> Rawan</p>
                        <a href="#" class="btn btn-primary">View Class</a>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://www.gstatic.com/classroom/themes/img_bookclub.jpg"
                        alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">HTML Class</h5>
                        <p class="card-text py-4"> Rawan</p>
                        <a href="#" class="btn btn-primary">View Class</a>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://www.gstatic.com/classroom/themes/img_bookclub.jpg"
                        alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">PHP Class</h5>
                        <p class="card-text py-4"> Rawan</p>
                        <a href="#" class="btn btn-primary">View Class</a>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://www.gstatic.com/classroom/themes/img_bookclub.jpg"
                        alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">React Class</h5>
                        <p class="card-text py-4"> Rawan</p>
                        <a href="#" class="btn btn-primary">View Class</a>
                    </div>
                </div> --}}
            </div>
        </main>
    </div>
@endsection
