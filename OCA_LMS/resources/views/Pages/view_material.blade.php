@extends('Layouts.app')
@section('content')
    <section class="innerImage classRoom">
        <img src="{{ asset('assets/img/img_bookclub.jpg') }}" alt="">
        <div class="pageTitle">
            <h2> Classroom</h2>
        </div>
    </section>
    @include('layouts.innerNav')
    <section class="inner-bred my-3">
        <div class="container">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href=""> Class</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href=""> Material </a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">View material </a></li>
            </ol>
        </div>
    </section>
    <div class="contanier">
        <div class="col-10 m-auto">
            <h2 class="col-12 m-auto">Laravel Resources</h2>
            <h4 class="mt-2">Topic:Laravel</h4>
         
            <div class="border border-light my-3 px-2 py-2 shadow">
                <div class="my-2">
                    <b>Resources links: </b><a class="link-offset-2 link-underline link-underline-opacity-0" target="_blank"
                        href="#">Curd in laravel</a>

                </div>
                <div><b>downloade pdf file</b></div>
            </div>
        </div>
    </div>
@endsection
