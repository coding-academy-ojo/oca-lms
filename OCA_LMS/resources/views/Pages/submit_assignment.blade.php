@extends('Layouts.app')
@section('title')
Submit Assignment
@endsection
@section('content')

    @include('layouts.innerNav')
    <section class="inner-bred my-3">
        <div class="container">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href=""> Class</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href=""> Assignment </a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Submit Assignment </a></li>
            </ol>
        </div>
    </section>
    <div class="contanier">
        <div class="col-10 m-auto">
        <h2 class="col-12 m-auto">Create Database</h2>
        <div class="col-12 m-auto mt-3">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</div>
            <div class="mt-3">
              <b>Deadline: 12/Feb/2024</b> 
            </div>
        <form method="" action="" enctype="multipart/form-data" class="needs-validation"
        novalidate>
        @csrf
        <div class="input-group my-3">
            <input type="text" class="form-control" placeholder="submit your assignment" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-primary" type="button" id="button-addon2">Submit</button>
          </div>
        </form>
    </div>
    </div>
@endsection
