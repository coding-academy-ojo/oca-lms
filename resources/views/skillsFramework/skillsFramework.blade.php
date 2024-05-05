@extends('layouts.app')
@section('title')
Skills Framework (Competence)
@endsection



@section('content')
@include('layouts.innerNav')
<section class="inner-bred">
    <div class="container">
        <ul class="thm-breadcrumb">
            <li><a href="">Home</a> <span><i class="fa-solid fa-chevron-right"></i></span></li>
            <li><a href="">Skills Framework</a></li>

        </ul>
    </div>


</section>

{{-- =========================================================== --}}
{{-- =================== Breadcrumb Section ==================== --}}
{{-- =========================================================== --}}

<div class="innerPage mt-3">
    <div class="container">
        <div class="skillsFramework" style="    text-align: justify;">
            @auth('staff')
            <div class="actionbtn">
                <a class=" btn btn-primary mb-3" href="{{ route('createskillsFramework') }}">Add skills</a>
            </div>
            @endauth

            <div class="row">
                <div class="col-sm-3 mb-3">
                    <div class="tab">
                        @foreach($skills as $skill)
                        <button class="tablinks{{ $loop->first ? ' active' : '' }}" onclick="openCity(event, 'sk{{ $skill->id }}')">{{ $skill->skills_name }}</button>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-9 mb-3">
                    @foreach($skills as $key => $skill)
                    <div id="sk{{ $skill->id }}" class="tabcontent" @if($loop->first) style="display: block;" @endif>
                        <div class="row">
                            @auth('staff')
                            <div class="actionbtn">
                                <div class=" ms-auto mb-3">
                                    <a class=" btn btn-primary m-auto" href="{{ route('editSkill', ['skill' => $skill->id]) }}">Edit Skill</a>
                                </div>
                                <div class="actionbtn">
                                    <div class=" ms-auto mb-3">
                                        <a class=" btn btn-primary m-auto" href="{{ route('editSkillLevel', ['skill' => $skill->id]) }}">Edit all levels</a>
                                    </div>
                                </div>
                            </div>
                            @endauth
                            @foreach($skillLevels->where('skill_id', $skill->id) as $skillLevel)
                            <div class="col-sm-4 mb-3">
                                <h3>{{ $skillLevel->level->levels_name }}</h3>
                                <p>{{ $skillLevel->skillLevels_description }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    <!-- Move the link outside of the loop -->

                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>




<!-- <div class="innerPage  mt-3">
    <div class="container">

        <div class="skillsFramework">
            <div class="actionbtn">
                <div class="col-md-2 ms-auto mb-3">
                    <a href="{{route('createskillsFramework')}}">Add skills Framework</a>
                    &nbsp;
                </div>
                <div class="col-md-2 ms-auto mb-3">

                    <a href="/editSkillsFramework">Edit skills Framework</a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 mb-3">

                    <div class="tab">
                        @foreach($skills as $skill)

                        @if( $skill->id ==1)
                        <button class="tablinks active" onclick="openCity(event, 'sk{{ $skill->id }}')">{{ $skill->name }}</button>
                        @else
                        <button class="tablinks " onclick="openCity(event, 'sk{{ $skill->id }}')">{{ $skill->name }}</button>
                        @endif

                        @endforeach
                        <button class="tablinks" onclick="openCity(event, 'sk2')">Create static and adaptive web user interfaces</button>
                        <button class="tablinks" onclick="openCity(event, 'sk3')">Develop a dynamic web user interface</button>

                    </div>
                </div>
                <div class="col-sm-9 mb-3">
                    <div id="sk1" class="tabcontent" style="display: block;">
                        <div class="row">
                            <div class="actionbtn ">

                                <div class="col-md-3 ms-auto mb-3">
                                    <a href="/editSkillsLevel">Edit level</a>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <h3 class="text-center">level 1 (imitate) </h3>
                                <p>Using a specified mock-up tool, reproduce a mock-up created on the same tool. Describe the elements of the style guide used and the planned security features. Formalize the interface links using the example provided as inspiration. Be capable of demonstrating that the mock-up adapts to mobile devices. Be capable of explaining the reasons for choosing ergonomics for a positive user experience..</p>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <h3>level 2 (adapt) </h3>
                                <p>Using a specified mock-up tool, reproduce a mock-up created on the same tool. Describe the elements of the style guide used and the planned security features. Formalize the interface links using the example provided as inspiration. Be capable of demonstrating that the mock-up adapts to mobile devices. Be capable of explaining the reasons for choosing ergonomics for a positive user experience..</p>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <h3>level 3 (transpose) </h3>
                                <p>Using a specified mock-up tool, reproduce a mock-up created on the same tool. Describe the elements of the style guide used and the planned security features. Formalize the interface links using the example provided as inspiration. Be capable of demonstrating that the mock-up adapts to mobile devices. Be capable of explaining the reasons for choosing ergonomics for a positive user experience..</p>
                            </div>
                        </div>

                    </div>

                    <div id="sk2" class="tabcontent">
                        <div class="row">
                            <div class="actionbtn ">

                                <div class="col-md-3 ms-auto mb-3">
                                    <a href="/editSkillsLevel">Edit level</a>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <h3 class="text-center">level 1 (imitate) </h3>
                                <p>Using a specified mock-up tool, reproduce a mock-up created on the same tool. Describe the elements of the style guide used and the planned security features. Formalize the interface links using the example provided as inspiration. Be capable of demonstrating that the mock-up adapts to mobile devices. Be capable of explaining the reasons for choosing ergonomics for a positive user experience..</p>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <h3>level 2 (adapt) </h3>
                                <p>Using a specified mock-up tool, reproduce a mock-up created on the same tool. Describe the elements of the style guide used and the planned security features. Formalize the interface links using the example provided as inspiration. Be capable of demonstrating that the mock-up adapts to mobile devices. Be capable of explaining the reasons for choosing ergonomics for a positive user experience..</p>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <h3>level 3 (transpose) </h3>
                                <p>Using a specified mock-up tool, reproduce a mock-up created on the same tool. Describe the elements of the style guide used and the planned security features. Formalize the interface links using the example provided as inspiration. Be capable of demonstrating that the mock-up adapts to mobile devices. Be capable of explaining the reasons for choosing ergonomics for a positive user experience..</p>
                            </div>
                        </div>

                    </div>

                    <div id="sk3" class="tabcontent">
                        <div class="row">
                            <div class="actionbtn ">

                                <div class="col-md-3 ms-auto mb-3">
                                    <a href="/editSkillsLevel">Edit level</a>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <h3 class="text-center">level 1 (imitate) </h3>
                                <p>Using a specified mock-up tool, reproduce a mock-up created on the same tool. Describe the elements of the style guide used and the planned security features. Formalize the interface links using the example provided as inspiration. Be capable of demonstrating that the mock-up adapts to mobile devices. Be capable of explaining the reasons for choosing ergonomics for a positive user experience..</p>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <h3>level 2 (adapt) </h3>
                                <p>Using a specified mock-up tool, reproduce a mock-up created on the same tool. Describe the elements of the style guide used and the planned security features. Formalize the interface links using the example provided as inspiration. Be capable of demonstrating that the mock-up adapts to mobile devices. Be capable of explaining the reasons for choosing ergonomics for a positive user experience..</p>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <h3>level 3 (transpose) </h3>
                                <p>Using a specified mock-up tool, reproduce a mock-up created on the same tool. Describe the elements of the style guide used and the planned security features. Formalize the interface links using the example provided as inspiration. Be capable of demonstrating that the mock-up adapts to mobile devices. Be capable of explaining the reasons for choosing ergonomics for a positive user experience..</p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script> -->
@endsection