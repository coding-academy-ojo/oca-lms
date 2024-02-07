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
            <li><a href="">Projects</a></li>
        </ul>
    </div>
</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}
<div class="innerPage  py-1 mt-5">
    <div class="container">
        
        <div class="col-md-2 ms-auto mb-3">
            <a href="">Create project</a>
        </div>

        <div class="projectCard">
            <div class="row">
                <div class="col-sm-3 mb-3">
                    <div class="card">
                        <a href="">
                            <img src="{{ asset('assets/img/project.png') }}" alt="">
                        </a>

                        <div class="innerCard">
                            <a href="">
                                <h4>Project 10 | Final Project : Full
                                    Stack Web Application</h4>
                            </a>

                            <p>The full-stack masterpiece project will be done
                                by using the technologies that you have
                                learned in the coding academy</p>

                            <div class="createdby">
                                <img src="{{ asset('assets/img/person.png') }}" alt="">
                                <div class="personInfo">
                                    <p>Sujoud Mohhammad</p>
                                    <p>created: 01/01/24</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-3 mb-3">
                    <div class="card">
                        <a href="">
                            <img src="{{ asset('assets/img/project.png') }}" alt="">
                        </a>

                        <div class="innerCard">
                            <a href="">
                                <h4>Project 10 | Final Project : Full
                                    Stack Web Application</h4>
                            </a>

                            <p>The full-stack masterpiece project will be done
                                by using the technologies that you have
                                learned in the coding academy</p>

                            <div class="createdby">
                                <img src="{{ asset('assets/img/person.png') }}" alt="">
                                <div class="personInfo">
                                    <p>Sujoud Mohhammad</p>
                                    <p>created: 01/01/24</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-3 mb-3">
                    <div class="card">
                        <a href="">
                            <img src="{{ asset('assets/img/project.png') }}" alt="">
                        </a>

                        <div class="innerCard">
                            <a href="">
                                <h4>Project 10 | Final Project : Full
                                    Stack Web Application</h4>
                            </a>

                            <p>The full-stack masterpiece project will be done
                                by using the technologies that you have
                                learned in the coding academy</p>

                            <div class="createdby">
                                <img src="{{ asset('assets/img/person.png') }}" alt="">
                                <div class="personInfo">
                                    <p>Sujoud Mohhammad</p>
                                    <p>created: 01/01/24</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-3 mb-3">
                    <div class="card">
                        <a href="">
                            <img src="{{ asset('assets/img/project.png') }}" alt="">
                        </a>

                        <div class="innerCard">
                            <a href="">
                                <h4>Project 10 | Final Project : Full
                                    Stack Web Application</h4>
                            </a>

                            <p>The full-stack masterpiece project will be done
                                by using the technologies that you have
                                learned in the coding academy</p>

                            <div class="createdby">
                                <img src="{{ asset('assets/img/person.png') }}" alt="">
                                <div class="personInfo">
                                    <p>Sujoud Mohhammad</p>
                                    <p>created: 01/01/24</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-3 mb-3">
                    <div class="card">
                        <a href="">
                            <img src="{{ asset('assets/img/project.png') }}" alt="">
                        </a>

                        <div class="innerCard">
                            <a href="">
                                <h4>Project 10 | Final Project : Full
                                    Stack Web Application</h4>
                            </a>

                            <p>The full-stack masterpiece project will be done
                                by using the technologies that you have
                                learned in the coding academy</p>

                            <div class="createdby">
                                <img src="{{ asset('assets/img/person.png') }}" alt="">
                                <div class="personInfo">
                                    <p>Sujoud Mohhammad</p>
                                    <p>created: 01/01/24</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection