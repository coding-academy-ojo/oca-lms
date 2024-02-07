@extends('layouts.app')
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}
<section class="innerImage classRoom">
    <img src="{{ asset('assets/img/img_bookclub.jpg') }}" alt="">

    <div class="pageTitle">
        <h2> Projects</h2>
    </div>

</section>
@include('layouts.innerNav')
<section class="inner-bred">

    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">Topics</a></li>
        </ul>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}
<div class="innerPage  py-1 mt-5">
    <div class="container">

        <div class="col-md-2 ms-auto mb-3">
            <a href="">Create Topics</a>
        </div>

        <div class="projectCard">
            <div class="row">
                <div class="col-sm-3 mb-3">
                    <div class="card">
                        <a href="">
                            <img src="{{ asset('assets/img/project.jpg') }}" alt="">
                        </a>

                        <div class="innerCard">
                            <a href="">
                                <h4 class="text-center">UI/UX</h4>
                            </a>
                            <div class="topicBt">
                               <a href="">Edit</a>
                               <a href="">Delete</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-3 mb-3">
                    <div class="card">
                        <a href="">
                            <img src="{{ asset('assets/img/project.jpg') }}" alt="">
                        </a>

                        <div class="innerCard">
                            <a href="">
                                <h4 class="text-center">HTML & CSS</h4>
                            </a>
                            <div class="topicBt">
                               <a href="">Edit</a>
                               <a href="">Delete</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-3 mb-3">
                    <div class="card">
                        <a href="">
                            <img src="{{ asset('assets/img/project.jpg') }}" alt="">
                        </a>

                        <div class="innerCard">
                            <a href="">
                                <h4 class="text-center">JS</h4>
                            </a>
                            <div class="topicBt">
                               <a href="">Edit</a>
                               <a href="">Delete</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-3 mb-3">
                    <div class="card">
                        <a href="">
                            <img src="{{ asset('assets/img/project.jpg') }}" alt="">
                        </a>

                        <div class="innerCard">
                            <a href="">
                                <h4 class="text-center">SQL</h4>
                            </a>
                            <div class="topicBt">
                               <a href="">Edit</a>
                               <a href="">Delete</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-3 mb-3">
                    <div class="card">
                        <a href="">
                            <img src="{{ asset('assets/img/project.jpg') }}" alt="">
                        </a>

                        <div class="innerCard">
                            <a href="">
                                <h4 class="text-center">OOP</h4>
                            </a>
                            <div class="topicBt">
                               <a href="">Edit</a>
                               <a href="">Delete</a>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection