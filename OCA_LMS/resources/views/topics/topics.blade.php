@extends('layouts.app')
@section('title')
Topics
@endsection
@section('content')
{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

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
            <a href="{{route('createTopics')}}">Create Topics</a>
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
                               <a href="{{route('editTopics')}}">Edit</a>
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
                               <a href="{{route('editTopics')}}">Edit</a>
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
                               <a href="{{route('editTopics')}}">Edit</a>
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
                               <a href="{{route('editTopics')}}">Edit</a>
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
                               <a href="{{route('editTopics')}}">Edit</a>
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